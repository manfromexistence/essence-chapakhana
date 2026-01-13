# Quick Start: Development Tools

## Daily Workflow

### Before Committing
```bash
# Check and fix code style
composer format

# Run static analysis
composer analyse

# Or run both at once
composer quality
```

### During Development
- Access Telescope at: http://localhost:8000/telescope
- Monitor slow queries (>50ms)
- Track exceptions and errors
- Review request/response data

## Common Commands

```bash
# Format all PHP files
composer format

# Check formatting without fixing
./vendor/bin/pint --test

# Run static analysis
composer analyse

# Run both quality checks
composer quality

# Run tests
composer test
```

## Pre-commit Hook

The pre-commit hook automatically runs on every commit:
- ✅ Formats staged PHP files with Pint
- ✅ Analyzes staged PHP files with PHPStan
- ❌ Blocks commit if issues found

**Bypass (emergency only):**
```bash
git commit --no-verify
```

## Telescope Access

**URL:** http://localhost:8000/telescope

**What to monitor:**
- 🐌 Slow queries (>50ms)
- 🐛 Exceptions and errors
- 📊 Request performance
- 💾 Cache operations
- 📧 Email sending
- 🔄 Job execution

## PHPStan Levels

Current: **Level 5**

As code quality improves, increase the level in `phpstan.neon`:
```neon
parameters:
    level: 6  # Increase gradually to 8
```

## Troubleshooting

### PHPStan out of memory
```bash
./vendor/bin/phpstan analyse --memory-limit=2G
```

### Telescope not accessible
```bash
php artisan migrate
php artisan config:clear
```

### Pre-commit hook not running
Check that `.git/hooks/pre-commit` exists and Git is properly installed.

## Documentation

Full documentation: `docs/DEVELOPMENT_SETUP.md`
