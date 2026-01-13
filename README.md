# Chapakhana - Professional Printing Services Platform

A production-ready Laravel e-commerce platform for printing services, built with modern architecture patterns and best practices.

[![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

## Table of Contents

- [About](#about)
- [Features](#features)
- [Architecture](#architecture)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Testing](#testing)
- [Deployment](#deployment)
- [Documentation](#documentation)
- [Contributing](#contributing)
- [License](#license)

## About

Chapakhana is a comprehensive e-commerce platform for printing services, developed by Alphainno for Nex Group. The platform provides a seamless experience for customers to order various printing products including business cards, brochures, magazines, and more.

### Key Highlights

- **Production-Ready**: Built with enterprise-grade patterns and practices
- **Scalable Architecture**: Repository pattern, service layer, and dependency injection
- **Comprehensive Testing**: Unit, integration, and feature tests with 80%+ coverage
- **Performance Optimized**: Redis caching, query optimization, and eager loading
- **Secure**: Input validation, CSRF protection, rate limiting, and security headers
- **Well-Documented**: Comprehensive API and architecture documentation

## Features

### Core Features

- **Product Management**: Full CRUD operations for products with categories
- **Order Processing**: Complete order workflow from cart to delivery
- **User Authentication**: Secure authentication with role-based access control
- **Admin Panel**: Comprehensive admin interface for managing the platform
- **Shopping Cart**: Session-based cart for guests, database-backed for users
- **Payment Integration**: Support for multiple payment methods
- **Image Management**: Product image upload and optimization
- **Search & Filtering**: Advanced product search and filtering capabilities

### Technical Features

- **Repository Pattern**: Abstracted data access layer
- **Service Layer**: Business logic encapsulation
- **Custom Exceptions**: Domain-specific error handling
- **Event System**: Decoupled operations through events
- **Caching Strategy**: Multi-layer caching with Redis
- **Queue Processing**: Async job processing for heavy operations
- **API Support**: RESTful API with authentication
- **Logging**: Structured logging with context
- **Monitoring**: Laravel Telescope for debugging

## Architecture

The application follows a layered architecture with clear separation of concerns:

```
┌─────────────────────────────────────────┐
│      Presentation Layer                 │
│  (Controllers, Views, API Routes)       │
└─────────────────────────────────────────┘
                  ↓
┌─────────────────────────────────────────┐
│      Application Layer                  │
│  (Services, Actions, Events)            │
└─────────────────────────────────────────┘
                  ↓
┌─────────────────────────────────────────┐
│      Domain Layer                       │
│  (Models, DTOs, Policies)               │
└─────────────────────────────────────────┘
                  ↓
┌─────────────────────────────────────────┐
│      Infrastructure Layer               │
│  (Repositories, Cache, Queue)           │
└─────────────────────────────────────────┘
```

For detailed architecture information, see [Architecture Documentation](docs/ARCHITECTURE.md).

## Requirements

### System Requirements

- **PHP**: 8.2 or higher
- **Composer**: 2.x
- **Node.js**: 18.x or higher
- **NPM**: 9.x or higher
- **Database**: MySQL 8.0+ or PostgreSQL 13+
- **Redis**: 6.x or higher (for caching and queues)
- **Web Server**: Apache 2.4+ or Nginx 1.18+

### PHP Extensions

- BCMath
- Ctype
- Fileinfo
- JSON
- Mbstring
- OpenSSL
- PDO
- Tokenizer
- XML
- GD or Imagick (for image processing)

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/chapakhana.git
cd chapakhana
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

### 3. Environment Configuration

```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Configure Environment

Edit `.env` file with your configuration:

```env
APP_NAME=Chapakhana
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=chapakhana
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

### 5. Database Setup

```bash
# Run migrations
php artisan migrate

# Seed database with sample data
php artisan db:seed

# Or run migrations with seeding
php artisan migrate:fresh --seed
```

### 6. Storage Setup

```bash
# Create storage link
php artisan storage:link

# Set proper permissions
chmod -R 775 storage bootstrap/cache
```

### 7. Build Assets

```bash
# Development build
npm run dev

# Production build
npm run build
```

### 8. Start Development Server

```bash
# Start Laravel development server
php artisan serve

# In another terminal, start Vite dev server
npm run dev

# Start queue worker (optional)
php artisan queue:work
```

Visit `http://localhost:8000` in your browser.

## Configuration

### Admin User

Default admin credentials (change in production):

```
Email: chapakhana@gmail.com
Password: Chapakhana@2026#Secure
```

### Cache Configuration

Configure cache settings in `config/cache.php`:

```php
'default' => env('CACHE_DRIVER', 'redis'),
'ttl' => [
    'short' => 300,    // 5 minutes
    'medium' => 3600,  // 1 hour
    'long' => 86400,   // 24 hours
],
```

### Queue Configuration

Configure queue settings in `config/queue.php`:

```php
'default' => env('QUEUE_CONNECTION', 'redis'),
```

Start queue workers:

```bash
php artisan queue:work --tries=3 --timeout=90
```

## Testing

### Running Tests

```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Unit
php artisan test --testsuite=Feature

# Run with coverage
php artisan test --coverage

# Run specific test file
php artisan test tests/Unit/ProductServiceTest.php
```

### Test Structure

```
tests/
├── Unit/              # Unit tests for services
├── Integration/       # Integration tests for repositories
├── Feature/           # Feature tests for endpoints
└── TestCase.php       # Base test class
```

### Code Quality

```bash
# Run Laravel Pint (code formatting)
./vendor/bin/pint

# Run PHPStan (static analysis)
./vendor/bin/phpstan analyse

# Run both
composer quality
```

## Deployment

### Production Checklist

1. **Environment Configuration**
   ```bash
   APP_ENV=production
   APP_DEBUG=false
   ```

2. **Optimize Application**
   ```bash
   php artisan optimize
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

3. **Run Migrations**
   ```bash
   php artisan migrate --force
   ```

4. **Build Assets**
   ```bash
   npm run build
   ```

5. **Set Permissions**
   ```bash
   chmod -R 755 storage bootstrap/cache
   ```

6. **Setup Queue Workers**
   ```bash
   # Using Supervisor
   sudo supervisorctl start chapakhana-worker:*
   ```

7. **Setup Cron Jobs**
   ```bash
   * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
   ```

### Deployment Command

Quick deployment command for cPanel or similar:

```bash
php artisan key:generate && \
php artisan migrate --force && \
rm -rf public/storage && \
php artisan storage:link && \
php artisan optimize:clear && \
php artisan optimize && \
php artisan queue:restart
```

### Zero-Downtime Deployment

For production environments, use deployment tools like:

- **Laravel Forge**: Automated deployment and server management
- **Laravel Envoyer**: Zero-downtime deployment
- **GitHub Actions**: CI/CD pipeline
- **Docker**: Containerized deployment

## Documentation

### Available Documentation

- [Architecture Documentation](docs/ARCHITECTURE.md) - System architecture and design patterns
- [API Documentation](docs/API.md) - RESTful API endpoints and usage
- [Repository Pattern Guide](docs/REPOSITORY_PATTERN.md) - Repository implementation details
- [Development Setup](docs/DEVELOPMENT_SETUP.md) - Detailed development environment setup
- [Testing Guide](docs/TESTING.md) - Testing strategies and best practices

### Code Documentation

All code is documented with PHPDoc comments:

```php
/**
 * Create a new product.
 *
 * @param  array<string, mixed>  $data  Product data
 * @param  UploadedFile|null  $image  Optional product image
 * @return Product The created product
 *
 * @throws ProductException When product creation fails
 */
public function create(array $data, ?UploadedFile $image = null): Product
```

## Project Structure

```
chapakhana/
├── app/
│   ├── DTOs/                  # Data Transfer Objects
│   ├── Exceptions/            # Custom exceptions
│   ├── Http/
│   │   ├── Controllers/       # HTTP controllers
│   │   ├── Middleware/        # Custom middleware
│   │   ├── Requests/          # Form request validation
│   │   └── Responses/         # API response helpers
│   ├── Models/                # Eloquent models
│   ├── Policies/              # Authorization policies
│   ├── Repositories/          # Repository pattern
│   │   ├── Contracts/         # Repository interfaces
│   │   └── Eloquent/          # Eloquent implementations
│   ├── Services/              # Business logic services
│   └── Traits/                # Reusable traits
├── config/                    # Configuration files
├── database/
│   ├── factories/             # Model factories
│   ├── migrations/            # Database migrations
│   └── seeders/               # Database seeders
├── docs/                      # Documentation
├── public/                    # Public assets
├── resources/
│   ├── css/                   # Stylesheets
│   ├── js/                    # JavaScript/React
│   └── views/                 # Blade templates
├── routes/                    # Route definitions
├── storage/                   # Storage files
├── tests/                     # Test files
└── vendor/                    # Composer dependencies
```

## Performance

### Optimization Techniques

- **Database Indexing**: Indexes on frequently queried columns
- **Eager Loading**: Prevents N+1 query problems
- **Query Caching**: Redis caching for expensive queries
- **Route Caching**: Cached route definitions
- **Config Caching**: Cached configuration files
- **View Caching**: Compiled Blade templates
- **Asset Optimization**: Minified and bundled assets
- **Image Optimization**: Optimized product images
- **Queue Processing**: Async processing for heavy tasks

### Performance Monitoring

- **Laravel Telescope**: Local debugging and profiling
- **Slow Query Logging**: Queries >100ms are logged
- **Cache Hit Rate Monitoring**: Track cache effectiveness
- **Response Time Tracking**: Monitor API response times

## Security

### Security Measures

- **Input Validation**: Form Request validation on all inputs
- **SQL Injection Prevention**: Eloquent ORM and prepared statements
- **XSS Prevention**: Blade template escaping
- **CSRF Protection**: Token-based CSRF protection
- **Rate Limiting**: API and authentication rate limits
- **Security Headers**: Custom security headers middleware
- **Password Hashing**: Bcrypt password hashing
- **Authorization**: Policy-based authorization

### Security Best Practices

1. Never commit `.env` file
2. Use strong passwords for admin accounts
3. Keep dependencies updated
4. Enable HTTPS in production
5. Regular security audits
6. Monitor logs for suspicious activity

## Contributing

We welcome contributions! Please follow these guidelines:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Coding Standards

- Follow PSR-12 coding standards
- Write comprehensive tests
- Document all public methods
- Follow SOLID principles
- Use meaningful variable names

### Pull Request Process

1. Update documentation if needed
2. Add tests for new features
3. Ensure all tests pass
4. Update CHANGELOG.md
5. Request review from maintainers

## Troubleshooting

### Common Issues

**Issue: Storage link not working**
```bash
php artisan storage:link
```

**Issue: Cache not clearing**
```bash
php artisan optimize:clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

**Issue: Queue jobs not processing**
```bash
php artisan queue:restart
php artisan queue:work
```

**Issue: Permission denied errors**
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## Support

For support and questions:

- **Email**: support@chapakhana.com
- **Documentation**: [docs/](docs/)
- **Issues**: [GitHub Issues](https://github.com/yourusername/chapakhana/issues)

## Credits

- **Developed by**: [Alphainno](https://alphainno.com)
- **Product of**: Nex Group
- **Framework**: [Laravel](https://laravel.com)
- **Frontend**: [React](https://react.dev) + [Inertia.js](https://inertiajs.com)

## License

This project is proprietary software. All rights reserved.

Copyright © 2026 Nex Group. Developed by Alphainno.

---

**Built with ❤️ using Laravel**
