# Development Infrastructure Setup

This document describes the development tools and quality checks configured for this Laravel project.

## Tools Installed

### 1. Laravel Pint (Code Formatting)

Laravel Pint is configured to automatically format PHP code according to PSR-12 standards.

**Configuration:** `pint.json`

**Usage:**
```bash
# Format all files
composer format

# Format specific files
./vendor/bin/pint app/Services

# Check without fixing
./vendor/bin/pint --test
```

### 2. PHPStan (Static Analysis)

PHPStan is configured at level 5 with Larastan for Laravel-specific analysis.

**Configuration:** `phpstan.neon`

**Usage:**
```bash
# Analyze entire codebase
composer analyse

# Analyze specific directory
./vendor/bin/phpstan analyse app/Services

# Generate baseline (ignore existing errors)
./vendor/bin/phpstan analyse --generate-baseline
```

### 3. Pre-commit Hooks

Git pre-commit hooks automatically run code quality checks before each commit.

**Location:** `.git/hooks/pre-commit`

**What it does:**
- Runs Laravel Pint on staged PHP files
- Runs PHPStan analysis on staged PHP files
- Prevents commit if checks fail

**Bypass (use sparingly):**
```bash
git commit --no-verify
```

### 4. Laravel Telescope (Debugging)

Laravel Telescope provides debugging and monitoring capabilities for local development.

**Configuration:** `config/telescope.php`

**Access:** http://localhost:8000/telescope

**Features:**
- Request monitoring
- Query monitoring (logs queries slower than 50ms)
- Exception tracking
- Log monitoring
- Event tracking
- Job monitoring
- Cache operations
- Model events

**Environment Variables:**
```env
TELESCOPE_ENABLED=true
TELESCOPE_QUERY_WATCHER=true
TELESCOPE_EXCEPTION_WATCHER=true
TELESCOPE_REQUEST_WATCHER=true
TELESCOPE_LOG_WATCHER=true
```

## Composer Scripts

The following composer scripts are available for code quality:

```bash
# Run Laravel Pint
composer format

# Run PHPStan analysis
composer analyse

# Run both formatting and analysis
composer quality

# Run tests
composer test
```

## Recommended Workflow

1. **Before committing:**
   ```bash
   composer quality
   ```

2. **During development:**
   - Access Telescope at `/telescope` to monitor queries and exceptions
   - Check for slow queries (>50ms) in Telescope
   - Review exception details in Telescope

3. **Before pushing:**
   ```bash
   composer test
   composer quality
   ```

## PHPStan Levels

The project is currently configured at level 5. As code quality improves, this can be increased:

- **Level 0-4:** Basic checks
- **Level 5:** Current level - checks for unknown properties and methods
- **Level 6-7:** Stricter type checking
- **Level 8:** Maximum strictness (goal)

To increase the level, edit `phpstan.neon`:
```neon
parameters:
    level: 6  # Increase gradually
```

## Troubleshooting

### Pre-commit hook not running

On Windows, Git hooks should work automatically. If not:
1. Ensure Git is properly installed
2. Check that `.git/hooks/pre-commit` exists
3. Try running the hook manually: `.git/hooks/pre-commit`

### PHPStan memory issues

If PHPStan runs out of memory:
```bash
./vendor/bin/phpstan analyse --memory-limit=2G
```

### Telescope not accessible

1. Ensure migrations are run: `php artisan migrate`
2. Check `TELESCOPE_ENABLED=true` in `.env`
3. Clear config cache: `php artisan config:clear`
4. Access at: http://localhost:8000/telescope

## Best Practices

1. **Always run code quality checks before committing**
2. **Fix PHPStan errors immediately** - don't let them accumulate
3. **Use Telescope to identify performance issues** early
4. **Keep code formatted** with Laravel Pint
5. **Add type hints** to all methods for better static analysis
6. **Review Telescope queries** to prevent N+1 problems

## Next Steps

After setting up the development infrastructure:
1. Run `composer quality` to check current code quality
2. Fix any PHPStan errors found
3. Set up continuous integration to run these checks automatically
4. Consider increasing PHPStan level as code quality improves
