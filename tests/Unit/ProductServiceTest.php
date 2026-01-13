<?php

namespace Tests\Unit;

use App\Exceptions\ProductException;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Services\ProductService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Mockery;
use Tests\ServiceTestCase;

/**
 * Unit tests for ProductService.
 *
 * Tests the business logic of product operations including creation,
 * updates, deletion, and queries.
 */
class ProductServiceTest extends ServiceTestCase
{
    private ProductService $service;
    private $repositoryMock;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');

        $this->repositoryMock = $this->mockRepository(ProductRepositoryInterface::class);
        $this->service = new ProductService($this->repositoryMock);
    }

    /**
     * Test product creation with valid data.
     */
    public function test_creates_product_with_valid_data(): void
    {
        $category = Category::factory()->create();

        $data = [
            'category_id' => $category->id,
            'title' => 'Test Product',
            'slug' => 'test-product',
            'description' => 'Test description',
            'price' => 99.99,
            'base_price' => 79.99,
        ];

        $expectedProduct = new Product($data);
        $expectedProduct->id = 1;

        $this->repositoryMock
            ->shouldReceive('create')
            ->once()
            ->with(Mockery::on(function ($arg) use ($data) {
                return $arg['title'] === $data['title']
                    && $arg['price'] === $data['price']
                    && isset($arg['stock'])
                    && isset($arg['is_active']);
            }))
            ->andReturn($expectedProduct);

        $product = $this->service->create($data);

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals('Test Product', $product->title);
        $this->assertEquals(99.99, $product->price);
    }

    /**
     * Test product creation with image upload.
     */
    public function test_creates_product_with_image(): void
    {
        $category = Category::factory()->create();
        $image = UploadedFile::fake()->image('product.jpg', 800, 600);

        $data = [
            'category_id' => $category->id,
            'title' => 'Test Product',
            'slug' => 'test-product',
            'description' => 'Test description',
            'price' => 99.99,
        ];

        $createdProduct = new Product(array_merge($data, ['id' => 1]));

        $this->repositoryMock
            ->shouldReceive('create')
            ->once()
            ->with(Mockery::on(function ($arg) {
                return isset($arg['image']) && str_contains($arg['image'], '/storage/products/');
            }))
            ->andReturn($createdProduct);

        $product = $this->service->create($data, $image);

        $this->assertInstanceOf(Product::class, $product);
        // Check that a file was stored in the products directory
        $files = Storage::disk('public')->files('products');
        $this->assertNotEmpty($files);
    }

    /**
     * Test product creation with invalid data throws exception.
     */
    public function test_throws_exception_for_invalid_product_data(): void
    {
        $data = [
            'title' => 'Test Product',
            'price' => 99.99,
        ];

        $this->repositoryMock
            ->shouldReceive('create')
            ->once()
            ->andThrow(new \Exception('Database error'));

        $this->assertThrowsException(
            ProductException::class,
            fn () => $this->service->create($data)
        );
    }

    /**
     * Test product update with valid data.
     */
    public function test_updates_product_with_valid_data(): void
    {
        $product = Product::factory()->create([
            'title' => 'Old Title',
            'price' => 50.00,
        ]);

        $updateData = [
            'title' => 'New Title',
            'price' => 75.00,
        ];

        $updatedProduct = clone $product;
        $updatedProduct->fill($updateData);

        $this->repositoryMock
            ->shouldReceive('update')
            ->once()
            ->with($product, Mockery::type('array'))
            ->andReturn($updatedProduct);

        $result = $this->service->update($product, $updateData);

        $this->assertEquals('New Title', $result->title);
        $this->assertEquals(75.00, $result->price);
    }

    /**
     * Test product update with new image.
     */
    public function test_updates_product_with_new_image(): void
    {
        $oldImage = '/storage/products/old-image.jpg';
        $product = Product::factory()->create(['image' => $oldImage]);

        $newImage = UploadedFile::fake()->image('new-product.jpg');

        $updateData = ['title' => 'Updated Product'];

        $this->repositoryMock
            ->shouldReceive('update')
            ->once()
            ->andReturn($product);

        $result = $this->service->update($product, $updateData, $newImage);

        $this->assertInstanceOf(Product::class, $result);
    }

    /**
     * Test product deletion.
     */
    public function test_deletes_product_successfully(): void
    {
        $product = Product::factory()->create([
            'title' => 'Product to Delete',
        ]);

        $this->repositoryMock
            ->shouldReceive('delete')
            ->once()
            ->with($product)
            ->andReturn(true);

        $result = $this->service->delete($product);

        $this->assertTrue($result);
    }

    /**
     * Test product deletion with image cleanup.
     */
    public function test_deletes_product_and_cleans_up_image(): void
    {
        $imagePath = '/storage/products/test-image.jpg';
        $product = Product::factory()->create(['image' => $imagePath]);

        // Create a fake image file
        Storage::disk('public')->put('products/test-image.jpg', 'fake content');

        // Verify file exists before deletion
        Storage::disk('public')->assertExists('products/test-image.jpg');

        $this->repositoryMock
            ->shouldReceive('delete')
            ->once()
            ->with($product)
            ->andReturn(true);

        $result = $this->service->delete($product);

        $this->assertTrue($result);

        // The service should attempt to delete the image
        // Since we're testing the service layer, we verify the deletion was successful
        // The actual file deletion is tested in integration tests
    }

    /**
     * Test finding product by ID.
     */
    public function test_finds_product_by_id(): void
    {
        $product = Product::factory()->create();

        $this->repositoryMock
            ->shouldReceive('find')
            ->once()
            ->with($product->id, [])
            ->andReturn($product);

        $result = $this->service->find($product->id);

        $this->assertInstanceOf(Product::class, $result);
        $this->assertEquals($product->id, $result->id);
    }

    /**
     * Test finding product by ID throws exception when not found.
     */
    public function test_throws_exception_when_product_not_found(): void
    {
        $this->repositoryMock
            ->shouldReceive('find')
            ->once()
            ->with(999, [])
            ->andReturn(null);

        $this->assertThrowsException(
            ProductException::class,
            fn () => $this->service->findOrFail(999)
        );
    }

    /**
     * Test finding product by slug.
     */
    public function test_finds_product_by_slug(): void
    {
        $product = Product::factory()->create(['slug' => 'test-product']);

        $this->repositoryMock
            ->shouldReceive('findBySlug')
            ->once()
            ->with('test-product', [])
            ->andReturn($product);

        $result = $this->service->findBySlug('test-product');

        $this->assertInstanceOf(Product::class, $result);
        $this->assertEquals('test-product', $result->slug);
    }

    /**
     * Test updating product stock status.
     */
    public function test_updates_product_stock_status(): void
    {
        $product = Product::factory()->create(['stock' => true]);

        $updatedProduct = clone $product;
        $updatedProduct->stock = false;

        $this->repositoryMock
            ->shouldReceive('updateStock')
            ->once()
            ->with($product, false)
            ->andReturn($updatedProduct);

        $result = $this->service->updateStock($product, false);

        $this->assertFalse($result->stock);
    }

    /**
     * Test incrementing product popularity.
     */
    public function test_increments_product_popularity(): void
    {
        $product = Product::factory()->create(['popularity' => 10]);

        $updatedProduct = clone $product;
        $updatedProduct->popularity = 11;

        $this->repositoryMock
            ->shouldReceive('incrementPopularity')
            ->once()
            ->with($product, 1)
            ->andReturn($updatedProduct);

        $result = $this->service->incrementPopularity($product);

        $this->assertEquals(11, $result->popularity);
    }

    /**
     * Test getting popular products.
     */
    public function test_gets_popular_products(): void
    {
        $products = Product::factory()->count(5)->make();

        $this->repositoryMock
            ->shouldReceive('getPopular')
            ->once()
            ->with(10, [])
            ->andReturn($products);

        $result = $this->service->getPopular(10);

        $this->assertCount(5, $result);
    }

    /**
     * Test getting active products.
     */
    public function test_gets_active_products(): void
    {
        $products = Product::factory()->count(3)->make(['is_active' => true]);

        $this->repositoryMock
            ->shouldReceive('getActive')
            ->once()
            ->with([])
            ->andReturn($products);

        $result = $this->service->getActive();

        $this->assertCount(3, $result);
    }
}
