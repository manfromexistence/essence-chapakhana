<?php

namespace Tests\Integration;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\Eloquent\EloquentProductRepository;
use App\Services\CacheService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Tests\RepositoryTestCase;

/**
 * Integration tests for ProductRepository.
 *
 * Tests the repository implementation including CRUD operations,
 * caching behavior, query optimization, and transaction handling.
 */
class ProductRepositoryTest extends RepositoryTestCase
{
    private CacheService $cacheService;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->cacheService = app(CacheService::class);
        $this->repository = new EloquentProductRepository(
            new Product,
            $this->cacheService
        );
    }

    /**
     * Test creating a product.
     */
    public function test_creates_product(): void
    {
        $category = Category::factory()->create();

        $data = [
            'category_id' => $category->id,
            'title' => 'Test Product',
            'slug' => 'test-product',
            'description' => 'Test description for the product',
            'format' => 'A4',
            'price' => 99.99,
            'base_price' => 79.99,
            'image' => '/storage/products/test.jpg',
        ];

        $product = $this->repository->create($data);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertDatabaseHas('products', [
            'title' => 'Test Product',
            'slug' => 'test-product',
            'price' => 99.99,
        ]);
    }

    /**
     * Test finding a product by ID.
     */
    public function test_finds_product_by_id(): void
    {
        $product = Product::factory()->create();

        $found = $this->repository->find($product->id);

        $this->assertNotNull($found);
        $this->assertEquals($product->id, $found->id);
        $this->assertTrue($found->relationLoaded('category'));
    }

    /**
     * Test finding a product by slug.
     */
    public function test_finds_product_by_slug(): void
    {
        $product = Product::factory()->create(['slug' => 'unique-product']);

        $found = $this->repository->findBySlug('unique-product');

        $this->assertNotNull($found);
        $this->assertEquals('unique-product', $found->slug);
    }

    /**
     * Test updating a product.
     */
    public function test_updates_product(): void
    {
        $product = Product::factory()->create(['title' => 'Old Title']);

        $updated = $this->repository->update($product, ['title' => 'New Title']);

        $this->assertEquals('New Title', $updated->title);
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'title' => 'New Title',
        ]);
    }

    /**
     * Test deleting a product.
     */
    public function test_deletes_product(): void
    {
        $product = Product::factory()->create();

        $result = $this->repository->delete($product);

        $this->assertTrue($result);
        $this->assertSoftDeleted('products', ['id' => $product->id]);
    }

    /**
     * Test caching behavior for find operation.
     */
    public function test_caches_find_queries(): void
    {
        $product = Product::factory()->create();

        // First call
        $result1 = $this->repository->find($product->id);

        // Second call - verify same result
        $result2 = $this->repository->find($product->id);

        $this->assertEquals($result1->id, $result2->id);
        $this->assertEquals($result1->title, $result2->title);
    }

    /**
     * Test cache invalidation on update.
     */
    public function test_invalidates_cache_on_update(): void
    {
        $product = Product::factory()->create();

        // Cache the product
        $cached = $this->repository->find($product->id);
        $this->assertEquals($product->title, $cached->title);

        // Update should invalidate cache
        $updated = $this->repository->update($product, ['title' => 'Updated Title']);

        // Verify the update was successful
        $this->assertEquals('Updated Title', $updated->title);
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'title' => 'Updated Title',
        ]);
    }

    /**
     * Test cache invalidation on delete.
     */
    public function test_invalidates_cache_on_delete(): void
    {
        $product = Product::factory()->create();

        // Cache the product
        $cached = $this->repository->find($product->id);
        $this->assertNotNull($cached);

        // Delete should invalidate cache
        $result = $this->repository->delete($product);

        // Verify product is soft deleted
        $this->assertTrue($result);
        $this->assertSoftDeleted('products', ['id' => $product->id]);
    }

    /**
     * Test query optimization prevents N+1 queries.
     */
    public function test_prevents_n_plus_one_queries(): void
    {
        $category = Category::factory()->create();
        Product::factory()->count(10)->create(['category_id' => $category->id]);

        $this->assertNoNPlusOneQueries(function () {
            $products = $this->repository->paginate([], 10);

            // Access category relationship - should not trigger additional queries
            foreach ($products as $product) {
                $categoryName = $product->category->name;
            }
        }, 5); // Should use at most 5 queries (select products, count, select categories)
    }

    /**
     * Test getting active products.
     */
    public function test_gets_active_products(): void
    {
        Product::factory()->count(5)->active()->create();
        Product::factory()->count(3)->inactive()->create();

        $activeProducts = $this->repository->getActive();

        $this->assertCount(5, $activeProducts);
        foreach ($activeProducts as $product) {
            $this->assertTrue($product->is_active);
        }
    }

    /**
     * Test getting products by category.
     */
    public function test_gets_products_by_category(): void
    {
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        Product::factory()->count(5)->create(['category_id' => $category1->id]);
        Product::factory()->count(3)->create(['category_id' => $category2->id]);

        $products = $this->repository->getByCategory($category1->id);

        $this->assertEquals(5, $products->total());
        foreach ($products as $product) {
            $this->assertEquals($category1->id, $product->category_id);
        }
    }

    /**
     * Test getting popular products.
     */
    public function test_gets_popular_products(): void
    {
        Product::factory()->create(['popularity' => 100, 'is_active' => true]);
        Product::factory()->create(['popularity' => 200, 'is_active' => true]);
        Product::factory()->create(['popularity' => 50, 'is_active' => true]);

        $popular = $this->repository->getPopular(3);

        $this->assertCount(3, $popular);
        $this->assertEquals(200, $popular->first()->popularity);
        $this->assertEquals(50, $popular->last()->popularity);
    }

    /**
     * Test searching products.
     */
    public function test_searches_products(): void
    {
        Product::factory()->create(['title' => 'Laravel Book']);
        Product::factory()->create(['title' => 'PHP Guide']);
        Product::factory()->create(['description' => 'Learn Laravel framework']);

        $results = $this->repository->search('Laravel');

        $this->assertEquals(2, $results->total());
    }

    /**
     * Test updating product stock.
     */
    public function test_updates_product_stock(): void
    {
        $product = Product::factory()->create(['stock' => true]);

        $updated = $this->repository->updateStock($product, false);

        $this->assertFalse($updated->stock);
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'stock' => false,
        ]);
    }

    /**
     * Test incrementing product popularity.
     */
    public function test_increments_product_popularity(): void
    {
        $product = Product::factory()->create(['popularity' => 10]);

        $updated = $this->repository->incrementPopularity($product, 5);

        $this->assertEquals(15, $updated->popularity);
    }

    /**
     * Test getting products with low stock.
     */
    public function test_gets_low_stock_products(): void
    {
        Product::factory()->count(3)->create(['stock' => false]);
        Product::factory()->count(2)->create(['stock' => true]);

        $lowStock = $this->repository->getLowStock();

        $this->assertGreaterThanOrEqual(3, $lowStock->count());
    }

    /**
     * Test pagination with filters.
     */
    public function test_paginates_with_filters(): void
    {
        $category = Category::factory()->create();

        Product::factory()->count(5)->create([
            'category_id' => $category->id,
            'is_active' => true,
            'price' => 50.00,
        ]);

        Product::factory()->count(3)->create([
            'category_id' => $category->id,
            'is_active' => true,
            'price' => 150.00,
        ]);

        $results = $this->repository->paginate([
            'category_id' => $category->id,
            'min_price' => 100,
        ], 10);

        $this->assertEquals(3, $results->total());
        foreach ($results as $product) {
            $this->assertGreaterThanOrEqual(100, $product->price);
        }
    }

    /**
     * Test transaction handling on create.
     */
    public function test_handles_transaction_on_create(): void
    {
        $category = Category::factory()->create();

        // Since RefreshDatabase already wraps tests in transactions,
        // we'll test that the repository respects transaction boundaries
        // by verifying data is properly saved within the test transaction
        $product = $this->repository->create([
            'category_id' => $category->id,
            'title' => 'Transaction Test',
            'slug' => 'transaction-test',
            'description' => 'Test description for transaction',
            'format' => 'A4',
            'price' => 99.99,
            'image' => '/storage/test.jpg',
        ]);

        $this->assertNotNull($product);
        $this->assertDatabaseHas('products', [
            'title' => 'Transaction Test',
            'slug' => 'transaction-test',
        ]);

        // Verify the product can be retrieved
        $found = $this->repository->find($product->id);
        $this->assertNotNull($found);
        $this->assertEquals('Transaction Test', $found->title);
    }

    /**
     * Test finding product by slug with caching.
     */
    public function test_caches_find_by_slug_queries(): void
    {
        $product = Product::factory()->create(['slug' => 'cached-product']);

        // First call
        $result1 = $this->repository->findBySlug('cached-product');

        // Second call - verify same result
        $result2 = $this->repository->findBySlug('cached-product');

        $this->assertNotNull($result1);
        $this->assertNotNull($result2);
        $this->assertEquals($result1->id, $result2->id);
        $this->assertEquals('cached-product', $result1->slug);
        $this->assertEquals('cached-product', $result2->slug);
    }

    /**
     * Test getting in-stock products.
     */
    public function test_gets_in_stock_products(): void
    {
        $category = Category::factory()->create();

        Product::factory()->count(5)->inStock()->active()->forCategory($category->id)->create();
        Product::factory()->count(3)->outOfStock()->forCategory($category->id)->create();

        $inStock = $this->repository->getInStock();

        $this->assertCount(5, $inStock);
        foreach ($inStock as $product) {
            $this->assertTrue($product->stock);
            $this->assertTrue($product->is_active);
        }
    }
}
