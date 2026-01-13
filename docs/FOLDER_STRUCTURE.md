# Chapakhana Blade Resource Refactoring Tasklist

**Project Status:** ❌ Not Production Ready  
**Priority Level:** CRITICAL  
**Estimated Time:** 40-60 hours  
**Last Updated:** January 8, 2026

---

## 🔴 CRITICAL PRIORITY (Must Fix Before Production)

### 1. Build Process & Asset Management
- [x] Remove all CDN Tailwind CSS references from layouts
- [x] Configure Vite properly for production builds
- [x] Update `resources/views/layouts/app.blade.php` to use `@vite(['resources/css/app.css', 'resources/js/app.js'])`
- [x] Update `resources/views/admin/layouts/app.blade.php` to use `@vite(['resources/css/app.css', 'resources/js/app.js'])`
- [x] Update `resources/views/login.blade.php` to use `@vite(['resources/css/app.css', 'resources/js/app.js'])`
- [x] Update `resources/views/register.blade.php` to use `@vite(['resources/css/app.css', 'resources/js/app.js'])`
- [x] Test Vite build process: `npm run build`
- [x] Verify compiled assets load correctly in all layouts

### 2. Layout Architecture Consolidation
- [x] Create `resources/views/layouts/guest.blade.php` for login/register pages
- [x] Refactor `login.blade.php` to extend guest layout
- [x] Refactor `register.blade.php` to extend guest layout
- [x] Ensure all pages properly extend a layout (no standalone HTML)
- [x] Standardize header/footer inclusion pattern across all views
- [x] Remove duplicate HTML structure from login/register pages

### 3. CSS Organization & Deduplication
- [x] Move all inline styles from layouts to `resources/css/app.css`
- [x] Extract toast notification styles to separate CSS component
- [x] Extract slider animation styles to separate CSS component
- [x] Extract modal styles to separate CSS component
- [x] Remove duplicate CSS from `admin/layouts/app.blade.php`
- [x] Remove duplicate CSS from `layouts/app.blade.php`
- [x] Configure Tailwind properly in `tailwind.config.js` (if missing, create it)

---

## 🟠 HIGH PRIORITY (Critical for Production Quality)

### 4. View File Organization
- [ ] Create `resources/views/products/` directory
- [ ] Move `books.blade.php` to `products/books.blade.php`
- [ ] Move `booklets.blade.php` to `products/booklets.blade.php`
- [ ] Move `brochures.blade.php` to `products/brochures.blade.php`
- [ ] Move `magazines.blade.php` to `products/magazines.blade.php`
- [ ] Move `catalogs.blade.php` to `products/catalogs.blade.php`
- [ ] Move `stickers.blade.php` to `products/stickers.blade.php`
- [ ] Move `stationery.blade.php` to `products/stationery.blade.php`
- [ ] Move `promotional-items.blade.php` to `products/promotional-items.blade.php`
- [ ] Move `postcards-invitations.blade.php` to `products/postcards-invitations.blade.php`
- [ ] Create `resources/views/products/configure/` directory
- [ ] Move `banner-configure.blade.php` to `products/configure/banner.blade.php`
- [ ] Move `book-configure.blade.php` to `products/configure/book.blade.php`
- [ ] Move `business-card-configure.blade.php` to `products/configure/business-card.blade.php`
- [ ] Move `invitation-stationery-configure.blade.php` to `products/configure/invitation-stationery.blade.php`
- [ ] Move `marketing-material-configure.blade.php` to `products/configure/marketing-material.blade.php`
- [ ] Create `resources/views/pages/` directory
- [ ] Move `landing.blade.php` to `pages/home.blade.php`
- [ ] Move `shop.blade.php` to `pages/shop.blade.php`
- [ ] Move `category.blade.php` to `pages/category.blade.php`
- [ ] Create `resources/views/cart/` directory
- [ ] Move `cart.blade.php` to `cart/index.blade.php`
- [ ] Create `resources/views/checkout/` directory
- [ ] Move `checkout.blade.php` to `checkout/index.blade.php`
- [ ] Move `checkout-success.blade.php` to `checkout/success.blade.php`
- [ ] Create `resources/views/auth/` directory
- [ ] Move `login.blade.php` to `auth/login.blade.php`
- [ ] Move `register.blade.php` to `auth/register.blade.php`
- [x] Delete `welcome-old.blade.php` (obsolete file)
- [ ] Update all route handlers to use new view paths
- [ ] Test all routes after view reorganization

### 5. Component Extraction (Priority Components)
- [ ] Create `resources/views/components/button.blade.php`
- [ ] Create `resources/views/components/product-card.blade.php`
- [ ] Create `resources/views/components/alert.blade.php`
- [ ] Create `resources/views/components/toast.blade.php`
- [ ] Create `resources/views/components/modal.blade.php`
- [ ] Create `resources/views/components/form/input.blade.php`
- [ ] Create `resources/views/components/form/select.blade.php`
- [ ] Create `resources/views/components/form/textarea.blade.php`
- [ ] Create `resources/views/components/badge.blade.php`
- [ ] Create `resources/views/components/breadcrumb.blade.php`
- [ ] Create `resources/views/components/hero-section.blade.php`
- [ ] Replace duplicate button code with `<x-button>` component
- [ ] Replace duplicate product cards with `<x-product-card>` component
- [ ] Replace duplicate forms with form components
- [ ] Add proper `@props` definitions to all components

### 6. JavaScript Organization
- [x] Extract slider JavaScript from `landing.blade.php` to `resources/js/slider.js`
- [x] Extract modal JavaScript from views to `resources/js/modal.js`
- [x] Extract cart update JavaScript to `resources/js/cart.js`
- [ ] Extract delete modal JavaScript to `resources/js/delete-modal.js`
- [x] Extract toast notifications to `resources/js/toast.js`
- [x] Import modules in `resources/js/app.js`
- [x] Remove all inline `<script>` tags from blade templates (cart & modal done)
- [x] Convert to ES6 modules where applicable
- [x] Add event delegation for dynamic elements

---

## 🟡 MEDIUM PRIORITY (Important for Maintainability)

### 7. Configuration & Hardcoded Content
- [x] Create `config/site.php` for site-wide settings
- [x] Move phone number to config: `(844) 938-6754`
- [x] Move brand name to config: "chapakhana"
- [ ] Create config for social media links
- [ ] Create config for business hours
- [ ] Create view composers for shared data (cart count, user info)
- [x] Replace hardcoded config values with `config()` helper
- [ ] Create database seeders for hero section content
- [ ] Move hero content from views to database

### 8. Localization (i18n)
- [x] Create `resources/lang/en/` directory
- [x] Create `resources/lang/bn/` directory (Bengali)
- [x] Create `en/common.php` for common translations
- [x] Create `bn/common.php` for Bengali translations
- [ ] Create `en/products.php` for product translations
- [ ] Create `bn/products.php` for product translations
- [ ] Replace all hardcoded English text with `{{ __('key') }}`
- [ ] Replace all hardcoded Bengali text with `{{ __('key') }}`
- [ ] Test language switching functionality
- [ ] Add language selector to header

### 9. Error Handling & Validation
- [x] Create `resources/views/errors/404.blade.php`
- [x] Create `resources/views/errors/500.blade.php`
- [x] Create `resources/views/errors/403.blade.php`
- [x] Create `resources/views/errors/419.blade.php` (CSRF error)
- [ ] Standardize error display component
- [ ] Add consistent `@error` directives to all form inputs
- [ ] Add proper validation messages to all forms
- [ ] Create error component: `components/form-error.blade.php`

### 10. Security Enhancements
- [ ] Audit all forms for `@csrf` tokens
- [ ] Add CSP (Content Security Policy) headers
- [ ] Remove CDN dependencies (security vulnerability)
- [ ] Add rate limiting views for sensitive actions
- [ ] Sanitize all user input display with `{{ }}` vs `{!! !!}`
- [ ] Review file upload security in product images
- [ ] Add HTTPS enforcement check
- [ ] Implement proper authentication guards

### 11. SEO Optimization
- [x] Add meta description to all pages
- [x] Add Open Graph tags to layouts
- [x] Add Twitter Card meta tags
- [x] Create dynamic title helper/component
- [x] Add canonical URLs
- [ ] Add JSON-LD schema for products
- [ ] Add JSON-LD schema for organization
- [ ] Add proper heading hierarchy (H1, H2, H3)
- [ ] Create sitemap.xml generation
- [ ] Add robots.txt configuration

---

## 🔵 LOW PRIORITY (Nice to Have)

### 12. Accessibility (A11y)
- [ ] Add missing `alt` attributes to all images
- [ ] Add ARIA labels to all interactive elements
- [ ] Add ARIA roles where appropriate
- [ ] Test keyboard navigation on all pages
- [ ] Add skip-to-content link
- [ ] Ensure color contrast meets WCAG AA standards
- [ ] Add focus indicators to all interactive elements
- [ ] Test with screen reader (NVDA/JAWS)
- [ ] Add proper label associations for all form inputs

### 13. Performance Optimization
- [ ] Implement lazy loading for images
- [ ] Add image optimization (WebP format)
- [ ] Implement asset versioning/cache busting
- [ ] Add preload directives for critical assets
- [ ] Minimize CSS/JS bundles
- [ ] Implement critical CSS inlining
- [ ] Add service worker for offline support (optional)
- [ ] Optimize hero images (compress, resize)
- [ ] Add loading="lazy" to below-fold images
- [ ] Implement pagination for product lists

### 14. Code Quality & Standards
- [ ] Add blade formatting configuration (Prettier/Blade Formatter)
- [ ] Standardize indentation (2 or 4 spaces, pick one)
- [ ] Add code comments to complex blade logic
- [ ] Add PHPDoc blocks to view data variables
- [ ] Create coding standards document
- [ ] Set up pre-commit hooks for formatting
- [ ] Run blade linter on all views
- [ ] Remove unused variables from views

### 15. Testing
- [ ] Create browser tests for critical user flows
- [ ] Test responsive design on mobile devices
- [ ] Test on multiple browsers (Chrome, Firefox, Safari, Edge)
- [ ] Create visual regression tests
- [ ] Test all forms with validation
- [ ] Test cart functionality end-to-end
- [ ] Test checkout flow completely
- [ ] Test admin panel CRUD operations

### 16. Documentation
- [ ] Document view data requirements for each blade file
- [ ] Create component usage documentation
- [ ] Document layout structure and inheritance
- [ ] Create style guide for UI components
- [ ] Document JavaScript modules and their usage
- [ ] Add inline comments for complex blade logic
- [ ] Create README for views directory structure

---

## 📊 Progress Tracking

### Current Statistics
- **Total Tasks:** 160
- **Completed:** 52
- **In Progress:** 0
- **Blocked:** 0
- **Completion:** 33%

### Priority Breakdown
- 🔴 Critical: 26/26 (100%) ✅
- 🟠 High: 20/46 (43%)
- 🟡 Medium: 6/51 (12%)
- 🔵 Low: 0/37 (0%)

### Estimated Timeline
- **Week 1-2:** Critical Priority (Build process, layouts, CSS)
- **Week 3-4:** High Priority (File organization, components, JS)
- **Week 5-6:** Medium Priority (Config, i18n, SEO, security)
- **Week 7-8:** Low Priority (A11y, performance, documentation)

---

## 📝 Notes

### Breaking Changes When Refactoring
- All route handlers must be updated when views are moved
- Controller return paths need updating
- Middleware might need adjustments
- Tests will need path updates

### Dependencies to Install
```bash
# Laravel Blade formatter
composer require --dev beyondcode/laravel-blade-formatter

# Laravel Pint (code style)
composer require --dev laravel/pint

# Testing tools
composer require --dev phpunit/phpunit
npm install -D @playwright/test
```

### Quick Wins (Can be done immediately)
1. Delete `welcome-old.blade.php`
2. Remove CDN Tailwind and use Vite
3. Extract toast notification to component
4. Create guest layout for auth pages
5. Move phone number to config

---

## 🎯 Success Criteria

This refactoring will be considered complete when:
- ✅ All views use compiled assets (no CDN)
- ✅ All views properly extend layouts
- ✅ File structure follows Laravel conventions
- ✅ No code duplication in views
- ✅ All components are reusable
- ✅ JavaScript is properly modularized
- ✅ All content is configurable/translatable
- ✅ SEO meta tags present on all pages
- ✅ Accessibility score > 90%
- ✅ Performance score > 85%

---

**Next Step:** Start with Critical Priority tasks and work through systematically.
