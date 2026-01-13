# Architecture Documentation

## Overview

This document describes the architecture of the Chapakhana Laravel application, a production-ready e-commerce platform for printing services. The application follows Laravel best practices, SOLID principles, and implements enterprise-grade patterns for maintainability and scalability.

## Table of Contents

1. [Architectural Patterns](#architectural-patterns)
2. [Layered Architecture](#layered-architecture)
3. [Repository Pattern](#repository-pattern)
4. [Service Layer](#service-layer)
5. [Data Flow](#data-flow)
6. [Caching Strategy](#caching-strategy)
7. [Error Handling](#error-handling)
8. [Testing Strategy](#testing-strategy)

## Architectural Patterns

### Core Patterns

The application implements several design patterns:

- **Repository Pattern**: Abstracts data access logic
- **Service Layer Pattern**: Encapsulates business logic
- **Dependency Injection**: Promotes loose coupling
- **Factory Pattern**: Used for model factories and test data
- **Observer Pattern**: Implemented through Laravel events
- **Strategy Pattern**: Used for configurable behaviors

### SOLID Principles

All code follows SOLID principles:

- **Single Responsibility**: Each class has one reason to change
- **Open/Closed**: Open for extension, closed for modification
- **Liskov Substitution**: Subtypes are substitutable for their base types
- **Interface Segregation**: Clients depend only on interfaces they use
- **Dependency Inversion**: Depend on abstractions, not concretions

## Layered Architecture

```
┌─────────────────────────────────────────────────────────┐
│                    Presentation Layer                    │
│  (Controllers, Inertia Pages, Blade Views, API Routes)  │
│                                                          │
│  - HTTP Controllers                                      │
│  - Form Requests (Validation)                           │
│  - API Resources                                         │
│  - Inertia/React Components                             │
└─────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────┐
│                    Application Layer                     │
│     (Services, Actions, Commands, Event Handlers)       │
│                                                          │
│  - Service Classes (Business Logic)                     │
│  - Event Listeners                                       │
│  - Job Classes                                           │
│  - Console Commands                                      │
└─────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────┐
│                      Domain Layer                        │
│        (Models, DTOs, Policies, Domain Events)          │
│                                                          │
│  - Eloquent Models                                       │
│  - Data Transfer Objects (DTOs)                         │
│  - Authorization Policies                                │
│  - Custom Exceptions                                     │
└─────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────┐
│                  Infrastructure Layer                    │
│  (Repositories, External APIs, Cache, Queue, Storage)   │
│                                                          │
│  - Repository Implementations                            │
│  - Cache Service                                         │
│  - Logging Service                                       │
│  - External API Integrations                            │
└─────────────────────────────────────────────────────────┘
```

### Layer Responsibilities

#### Presentation Layer
- Handles HTTP requests and responses
- Validates user input through Form Requests
- Transforms data for presentation
- Routes requests to appropriate services

#### Application Layer
- Contains business logic in Service classes
- Orchestrates operations across multiple domains
- Handles transactions and error recovery
- Dispatches events and jobs

#### Domain Layer
- Defines core business entities (Models)
- Implements business rules and validation
- Defines domain events and exceptions
- Contains authorization logic (Policies)

#### Infrastructure Layer
- Abstracts data persistence (Repositories)
- Manages caching and performance
- Handles external service integration
- Provides logging and monitoring

## Repository Pattern

### Structure

```
app/Repositories/
├── Contracts/
│   ├── RepositoryInterface.php          # Base repository contract
│   ├── ProductRepositoryInterface.php   # Product-specific contract
│   ├── CategoryRepositoryInterface.php  # Category-specific contract
│   └── OrderRepositoryInterface.php     # Order-specific contract
└── Eloquent/
    ├── BaseRepository.php               # Base implementation
    ├── EloquentProductRepository.php    # Product implementation
    ├── EloquentCategoryRepository.php   # Category implementation
    └── EloquentOrderRepository.php      # Order implementation
```

### Benefits

1. **Abstraction**: Decouples business logic from data access
2. **Testability**: Easy to mock repositories in tests
3. **Flexibility**: Can swap implementations (e.g., Eloquent to MongoDB)
4. **Caching**: Centralized caching logic
5. **Query Optimization**: Consistent eager loading and N+1 prevention

### Example Usage

```php
// Interface
interface ProductRepositoryInterface
{
    public function find(int $id): ?Product;
    public function findBySlug(string $slug): ?Product;
    public function create(array $data): Product;
    public function update(Product $product, array $data): Product;
}

// Implementation
class EloquentProductRepository implements ProductRepositoryInterface
{
    public function find(int $id): ?Product
    {
        return Cache::remember("product.{$id}", 3600, function () use ($id) {
            return Product::with('category')->find($id);
        });
    }
}

// Service usage
class ProductService
{
    public function __construct(
        private ProductRepositoryInterface $repository
    ) {}
    
    public function getProduct(int $id): Product
    {
        return $this->repository->find($id) 
            ?? throw ProductException::notFound($id);
    }
}
```

## Service Layer

### Purpose

Service classes encapsulate business logic and orchestrate operations across multiple repositories and external services.

### Structure

```
app/Services/
├── ProductService.php      # Product business logic
├── OrderService.php        # Order business logic
├── CartService.php         # Cart management
├── CacheService.php        # Caching utilities
├── LoggingService.php      # Structured logging
└── MetricsService.php      # Performance metrics
```

### Responsibilities

1. **Business Logic**: Implements domain-specific rules
2. **Transaction Management**: Ensures data consistency
3. **Event Dispatching**: Triggers domain events
4. **Error Handling**: Throws domain-specific exceptions
5. **Logging**: Records important operations
6. **Cache Invalidation**: Maintains cache consistency

### Example

```php
class ProductService
{
    public function __construct(
        private ProductRepositoryInterface $repository,
        private CacheService $cache,
        private LoggingService $logger
    ) {}
    
    public function create(array $data, ?UploadedFile $image = null): Product
    {
        return DB::transaction(function () use ($data, $image) {
            // Upload image
            if ($image) {
                $data['image'] = $this->uploadImage($image);
            }
            
            // Create product
            $product = $this->repository->create($data);
            
            // Dispatch event
            event(new ProductCreated($product));
            
            // Log operation
            $this->logger->info('Product created', [
                'product_id' => $product->id,
                'user_id' => auth()->id(),
            ]);
            
            // Invalidate cache
            $this->cache->invalidate('products.*');
            
            return $product;
        });
    }
}
```

## Data Flow

### Request Flow

```
1. HTTP Request
   ↓
2. Route → Middleware → Controller
   ↓
3. Form Request (Validation)
   ↓
4. Controller → Service
   ↓
5. Service → Repository
   ↓
6. Repository → Database
   ↓
7. Database → Repository (with caching)
   ↓
8. Repository → Service
   ↓
9. Service → Controller
   ↓
10. Controller → Response (JSON/View)
```

### Example: Creating a Product

```
POST /api/products
   ↓
ProductController@store
   ↓
StoreProductRequest (validation)
   ↓
ProductService@create
   ↓
ProductRepository@create
   ↓
Database INSERT
   ↓
Cache invalidation
   ↓
Event dispatch (ProductCreated)
   ↓
Response (201 Created)
```

## Caching Strategy

### Multi-Layer Caching

```
┌─────────────────┐
│  Application    │
└────────┬────────┘
         │
    ┌────▼────┐
    │  Redis  │ (Primary cache)
    └────┬────┘
         │
    ┌────▼────┐
    │Database │ (Source of truth)
    └─────────┘
```

### Cache Keys

```
products.{id}                    # Single product
products.slug.{slug}             # Product by slug
products.category.{id}           # Products by category
products.active                  # All active products
categories.tree                  # Category hierarchy
orders.user.{id}                 # User orders
```

### Cache TTL

- **Short (5 minutes)**: Frequently changing data (cart, session)
- **Medium (1 hour)**: Semi-static data (products, categories)
- **Long (24 hours)**: Static data (site settings, configurations)

### Cache Invalidation

```php
// Invalidate specific key
Cache::forget('products.123');

// Invalidate pattern
Cache::tags(['products'])->flush();

// Invalidate in service
$this->cacheService->invalidate('products.*');
```

## Error Handling

### Exception Hierarchy

```
Exception
└── DomainException (abstract)
    ├── ProductException
    ├── OrderException
    ├── CartException
    ├── CategoryException
    └── PaymentException
```

### Exception Structure

```php
abstract class DomainException extends Exception
{
    protected int $statusCode = 500;
    
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
    
    public function toArray(): array
    {
        return [
            'error' => class_basename($this),
            'message' => $this->getMessage(),
            'code' => $this->getCode(),
        ];
    }
}

class ProductException extends DomainException
{
    protected int $statusCode = 422;
    
    public static function notFound(int $id): self
    {
        return new self("Product not found: {$id}", 404);
    }
    
    public static function outOfStock(Product $product): self
    {
        return new self("Product out of stock: {$product->title}", 422);
    }
}
```

### Global Exception Handler

```php
// In Handler.php
public function register(): void
{
    $this->renderable(function (DomainException $e, Request $request) {
        Log::error($e->getMessage(), [
            'exception' => get_class($e),
            'trace' => $e->getTraceAsString(),
        ]);
        
        if ($request->expectsJson()) {
            return response()->json($e->toArray(), $e->getStatusCode());
        }
        
        return back()->with('error', $e->getMessage());
    });
}
```

## Testing Strategy

### Test Pyramid

```
        ┌─────────────┐
        │   E2E Tests │  (5%)
        └─────────────┘
      ┌─────────────────┐
      │ Integration Tests│  (15%)
      └─────────────────┘
    ┌─────────────────────┐
    │   Feature Tests     │  (30%)
    └─────────────────────┘
  ┌─────────────────────────┐
  │      Unit Tests         │  (50%)
  └─────────────────────────┘
```

### Test Structure

```
tests/
├── Unit/
│   ├── ProductServiceTest.php
│   ├── OrderServiceTest.php
│   └── CartServiceTest.php
├── Integration/
│   ├── ProductRepositoryTest.php
│   └── OrderRepositoryTest.php
├── Feature/
│   ├── ProductApiTest.php
│   └── OrderApiTest.php
└── TestCase.php (base class)
```

### Test Base Classes

```php
// Unit tests
class ServiceTestCase extends TestCase
{
    use RefreshDatabase;
    
    protected function mockRepository(string $interface): MockInterface
    {
        return Mockery::mock($interface);
    }
}

// Integration tests
class RepositoryTestCase extends TestCase
{
    use RefreshDatabase;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'TestDataSeeder']);
    }
}

// API tests
class ApiTestCase extends TestCase
{
    use RefreshDatabase;
    
    protected function authenticateUser(): User
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        return $user;
    }
}
```

## Configuration Management

### Environment-Specific Configuration

```
config/
├── app.php              # Application settings
├── database.php         # Database connections
├── cache.php            # Cache configuration
├── queue.php            # Queue configuration
├── repositories.php     # Repository bindings
└── shop.php             # Business logic settings
```

### Service Container Bindings

```php
// In AppServiceProvider
public function register(): void
{
    // Repository bindings
    $this->app->bind(
        ProductRepositoryInterface::class,
        EloquentProductRepository::class
    );
    
    // Singleton services
    $this->app->singleton(CacheService::class);
    $this->app->singleton(LoggingService::class);
}
```

## Performance Optimization

### Database Optimization

1. **Indexes**: Added on frequently queried columns
2. **Eager Loading**: Prevents N+1 queries
3. **Query Scopes**: Reusable query logic
4. **Connection Pooling**: Efficient connection management

### Caching

1. **Query Result Caching**: Cache expensive queries
2. **Model Caching**: Cache frequently accessed models
3. **View Caching**: Cache rendered views
4. **Route Caching**: Cache route definitions

### Queue Processing

1. **Async Jobs**: Time-consuming tasks run in background
2. **Job Batching**: Process multiple jobs efficiently
3. **Job Prioritization**: Critical jobs run first
4. **Failed Job Handling**: Automatic retry with exponential backoff

## Security Measures

### Input Validation

- Form Request classes for all user input
- Custom validation rules (NoXss, NoSqlInjection)
- Sanitization middleware

### Authentication & Authorization

- Laravel Sanctum for API authentication
- Policy classes for authorization
- Role-based access control (RBAC)

### Protection Mechanisms

- CSRF protection on all state-changing operations
- Rate limiting on API endpoints
- SQL injection prevention through Eloquent
- XSS prevention through Blade escaping
- Security headers middleware

## Monitoring & Observability

### Logging

- Structured logging with context
- Log levels: debug, info, warning, error, critical
- Log channels: daily, slack, database
- Correlation IDs for request tracking

### Performance Monitoring

- Laravel Telescope for local debugging
- Slow query detection (>100ms)
- Request/response logging
- Exception tracking

### Metrics

- Product view tracking
- Order conversion rates
- API response times
- Cache hit rates

## Deployment

### Deployment Checklist

1. Run tests: `php artisan test`
2. Clear caches: `php artisan optimize:clear`
3. Run migrations: `php artisan migrate --force`
4. Optimize: `php artisan optimize`
5. Queue restart: `php artisan queue:restart`
6. Storage link: `php artisan storage:link`

### Environment Configuration

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis
```

## Conclusion

This architecture provides a solid foundation for a scalable, maintainable, and testable Laravel application. By following these patterns and principles, the codebase remains clean, organized, and easy to extend with new features.

## Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Repository Pattern Guide](docs/REPOSITORY_PATTERN.md)
- [API Documentation](docs/API.md)
- [Testing Guide](docs/TESTING.md)
