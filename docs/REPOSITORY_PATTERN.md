# Repository Pattern Documentation

## Overview

This document describes the repository pattern implementation in the Laravel application. The repository pattern provides an abstraction layer between the business logic and data access, making the code more maintainable, testable, and flexible.

## Architecture

```
┌─────────────────────────────────────────────────────────┐
│                    Controllers/Services                  │
│              (Business Logic Layer)                      │
└─────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────┐
│                  Repository Interfaces                   │
│    (ProductRepositoryInterface, OrderRepositoryInterface)│
└─────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────┐
│               Eloquent Repositories                      │
│  (EloquentProductRepository, EloquentOrderRepository)   │
└─────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────┐
│                   Eloquent Models                        │
│              (Product, Category, Order)                  │
└─────────────────────────────────────────────────────────┘
```

## Directory Structure

```
app/
├── Repositories/
│   ├── Contracts/
│   │   ├── RepositoryInterface.php          # Base interface
│   │   ├── ProductRepositoryInterface.php   # Product-specific interface
│   │   ├── CategoryRepositoryInterface.php  # Category-specific interface
│   │   └── OrderRepositoryInterface.php     # Order-specific interface
│   └── Eloquent/
│       ├── BaseRepository.php               # Base implementation
│       ├── EloquentProductRepository.php    # Product implementation
│       ├── EloquentCategoryRepository.php   # Category implementation
│       └── EloquentOrderRepository.php      # Order implementation
```

## Usage Examples

### Basic Usage in Controllers

```php
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductController extends Controller
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {}

    public function index()
    {
        $products = $this->productRepository->paginate(
            filters: ['is_active' => true],
            perPage: 20
        );

        return view('products.index', compact('products'));
    }

    public function show(int $id)
    {
        $product = $this->productRepository->findOrFail($id);
        return view('products.show', compact('product'));
    }
}
```

### Usage in Services

```php
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class ProductService
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private CategoryRepositoryInterface $categoryRepository
    ) {}

    public function createProduct(array $data): Product
    {
        // Validate category exists
        $category = $this->categoryRepository->findOrFail($data['category_id']);

        // Create product
        return $this->productRepository->create($data);
    }

    public function getProductsByCategory(int $categoryId): LengthAwarePaginator
    {
        return $this->productRepository->getByCategory($categoryId);
    }
}
```

### Working with Caching

```php
// Disable caching for a specific query
$products = $this->productRepository
    ->withoutCache()
    ->getActive();

// Re-enable caching
$products = $this->productRepository
    ->withCache()
    ->getActive();

// Set custom cache TTL
$products = $this->productRepository
    ->setCacheTtl(1800) // 30 minutes
    ->getPopular(10);
```

### Order Repository with Transactions

```php
use App\Repositories\Contracts\OrderRepositoryInterface;

class CheckoutService
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository
    ) {}

    public function placeOrder(array $orderData, array $items): Order
    {
        // This method handles the transaction internally
        return $this->orderRepository->createWithItems($orderData, $items);
    }

    public function cancelOrder(Order $order, string $reason): Order
    {
        return $this->orderRepository->cancel($order, $reason);
    }
}
```

## Available Methods

### Base Repository Interface

| Method | Description |
|--------|-------------|
| `find(int $id, array $relations = [])` | Find by ID |
| `findOrFail(int $id, array $relations = [])` | Find by ID or throw exception |
| `all(array $relations = [])` | Get all records |
| `paginate(array $filters = [], int $perPage = 15, array $relations = [])` | Paginated results |
| `create(array $data)` | Create new record |
| `update(Model $model, array $data)` | Update existing record |
| `delete(Model $model)` | Delete record |

### Product Repository Interface

| Method | Description |
|--------|-------------|
| `findBySlug(string $slug, array $relations = [])` | Find product by slug |
| `getActive(array $relations = [])` | Get active products |
| `getByCategory(int $categoryId, array $filters = [], int $perPage = 15)` | Get products by category |
| `getInStock(array $relations = [])` | Get in-stock products |
| `getPopular(int $limit = 10, array $relations = [])` | Get popular products |
| `search(string $query, array $filters = [], int $perPage = 15)` | Search products |
| `updateStock(Product $product, bool $inStock)` | Update stock status |
| `incrementPopularity(Product $product, int $amount = 1)` | Increment popularity |
| `getLowStock()` | Get low/out of stock products |

### Category Repository Interface

| Method | Description |
|--------|-------------|
| `findBySlug(string $slug, array $relations = [])` | Find category by slug |
| `getActive(array $relations = [])` | Get active categories |
| `getWithProductCounts(bool $activeOnly = true)` | Get categories with product counts |
| `getTree(bool $activeOnly = true)` | Get category tree structure |
| `getRoots(bool $activeOnly = true)` | Get root categories |
| `getForSelect(bool $activeOnly = true)` | Get categories for dropdown |
| `hasProducts(Category $category)` | Check if category has products |
| `getWithProducts(int $categoryId, array $productFilters = [])` | Get category with products |
| `reorder(array $order)` | Reorder categories |

### Order Repository Interface

| Method | Description |
|--------|-------------|
| `findByOrderNumber(string $orderNumber, array $relations = [])` | Find by order number |
| `getByUser(User\|int $user, array $filters = [], int $perPage = 15)` | Get user's orders |
| `getByStatus(string $status, array $filters = [], int $perPage = 15)` | Get orders by status |
| `getRecent(int $limit = 10, array $relations = [])` | Get recent orders |
| `createWithItems(array $orderData, array $items)` | Create order with items (transactional) |
| `updateStatus(Order $order, string $status)` | Update order status |
| `getByDateRange(string $startDate, string $endDate, array $filters = [])` | Get orders in date range |
| `getStatistics(?string $startDate = null, ?string $endDate = null)` | Get order statistics |
| `getTotalRevenue(?string $startDate = null, ?string $endDate = null)` | Get total revenue |
| `getCountByStatus()` | Get order counts by status |
| `cancel(Order $order, ?string $reason = null)` | Cancel an order |
| `getPendingOlderThan(int $hoursOld = 24)` | Get old pending orders |
| `search(string $query, array $filters = [], int $perPage = 15)` | Search orders |

## Configuration

Repository settings can be configured in `config/repositories.php`:

```php
return [
    'cache' => [
        'enabled' => env('REPOSITORY_CACHE_ENABLED', true),
        'ttl' => env('REPOSITORY_CACHE_TTL', 3600),
        'driver' => env('REPOSITORY_CACHE_DRIVER', null),
        'prefix' => env('REPOSITORY_CACHE_PREFIX', 'repo'),
    ],
    'pagination' => [
        'per_page' => env('REPOSITORY_PER_PAGE', 15),
        'max_per_page' => env('REPOSITORY_MAX_PER_PAGE', 100),
    ],
];
```

## Testing

### Unit Testing with Mocks

```php
use App\Repositories\Contracts\ProductRepositoryInterface;
use Mockery;

class ProductServiceTest extends TestCase
{
    public function test_creates_product_successfully()
    {
        $mockRepository = Mockery::mock(ProductRepositoryInterface::class);
        $mockRepository->shouldReceive('create')
            ->once()
            ->with(['title' => 'Test Product'])
            ->andReturn(new Product(['title' => 'Test Product']));

        $this->app->instance(ProductRepositoryInterface::class, $mockRepository);

        $service = app(ProductService::class);
        $product = $service->createProduct(['title' => 'Test Product']);

        $this->assertEquals('Test Product', $product->title);
    }
}
```

### Integration Testing

```php
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private ProductRepositoryInterface $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = app(ProductRepositoryInterface::class);
    }

    public function test_can_create_and_find_product()
    {
        $product = $this->repository->create([
            'title' => 'Test Product',
            'price' => 99.99,
            'category_id' => Category::factory()->create()->id,
        ]);

        $found = $this->repository->find($product->id);

        $this->assertEquals('Test Product', $found->title);
    }
}
```

## Best Practices

1. **Always inject interfaces, not implementations**
   ```php
   // Good
   public function __construct(ProductRepositoryInterface $repository)

   // Bad
   public function __construct(EloquentProductRepository $repository)
   ```

2. **Use eager loading to prevent N+1 queries**
   ```php
   $products = $this->productRepository->all(['category', 'orderItems']);
   ```

3. **Leverage caching for read-heavy operations**
   ```php
   // Popular products are cached automatically
   $popular = $this->productRepository->getPopular(10);
   ```

4. **Use transactions for multi-step operations**
   ```php
   // Order creation with items is transactional
   $order = $this->orderRepository->createWithItems($orderData, $items);
   ```

5. **Keep repositories focused on data access**
   - Business logic belongs in Services
   - Validation belongs in Form Requests
   - Repositories handle data persistence and retrieval

## Extending Repositories

To add a new repository:

1. Create the interface in `app/Repositories/Contracts/`
2. Create the implementation in `app/Repositories/Eloquent/`
3. Register the binding in `AppServiceProvider`

```php
// 1. Interface
interface UserRepositoryInterface extends RepositoryInterface
{
    public function findByEmail(string $email): ?User;
}

// 2. Implementation
class EloquentUserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->model->where('email', $email)->first();
    }
}

// 3. Register in AppServiceProvider
$this->app->bind(
    UserRepositoryInterface::class,
    EloquentUserRepository::class
);
```
