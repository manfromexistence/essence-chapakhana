# Category Page Management System

## Overview
Dynamic category page management system for controlling all frontend category pages (Books, Magazines, Business Cards, etc.) from a single admin interface.

## Features
✅ **11 Dynamic Categories** managed from admin panel:
- books, magazines, catalogs, brochures, business-cards
- postcards-invitations, banners, promotional-items, stickers
- booklets, stationery

✅ **4-Tab Editor Interface** for each category:
1. **Basic Info**: Title, description, headline, grid title/subtitle
2. **Hero Slider**: Multiple slides with title, description, images
3. **Products Grid**: Product cards with title, URL, image, price, badge
4. **Offer Banner**: Promotional content section

✅ **Product Management Features**:
- Add/remove products
- Reorder products (up/down buttons)
- Image upload and preview
- Price and badge fields
- URL routing for each product

✅ **Database-Backed**: Uses PageSection model to store JSON content
✅ **Sonner Notifications**: Toast messages on save/error
✅ **Clean Routes**: Modularized routing system

## How It Works

### Admin Side
1. Go to `/admin/pages` - see all 11 category cards
2. Click any category card - opens unified editor
3. Edit content across 4 tabs
4. Click "Save Changes" - stores to database
5. Toast notification confirms save

### Frontend Display
1. User visits category page (e.g., `/books`)
2. `CategoryPageController::show($slug)` loads content
3. Checks database for `PageSection` records
4. Falls back to `getDefaultContent()` if no data
5. Renders `category.blade.php` with dynamic data

### Product Routes
- Category pages: `/books`, `/magazines`, `/business-cards`, etc.
- Product pages: `/books/paperback`, `/business-cards/classic`, etc.

## File Structure

### Controllers
- `app/Http/Controllers/CategoryPageController.php` - Frontend display
- `app/Http/Controllers/Admin/PageController.php` - Admin CRUD

### Admin Pages (Inertia.js + React)
- `resources/js/Pages/Admin/Pages/index.jsx` - Category dashboard
- `resources/js/Pages/Admin/Pages/category.jsx` - Unified editor

### Routes
- `routes/web.php` - Main entry, includes modular routes
- `routes/shop.php` - Category & product routes
- `routes/admin.php` - Admin routes with auth middleware

### Frontend Views
- `resources/views/pages/category.blade.php` - Category template
- Uses dynamic data from CategoryPageController

## Database
**Table**: `page_sections`
- `page` - Category slug (e.g., 'books')
- `section_key` - Section identifier (basic_info, hero_slider, products_grid, offer_banner)
- `title` - Section title
- `content` - JSON data
- `is_active` - Visibility toggle
- `order` - Display order

## Default Content
Each category has default content in `CategoryPageController::getDefaultContent()`:
- Basic info with Bengali titles
- Sample hero slider images
- Product grid samples
- Offer banner template

## Toast Notifications
Uses Sonner library configured in:
- `resources/js/Layouts/AdminLayout.jsx`
- Import: `import { Toaster } from 'sonner'`
- Usage: `toast.success('Changes saved successfully!')`

## Middleware
- Admin routes: `auth`, `admin` middleware
- Cart/Checkout: `auth` middleware only
- Frontend pages: Public access

## Usage Examples

### Editing a Category
```javascript
// Admin clicks "Books" card → navigates to /admin/pages/category/books
// Edit form loads with current data or defaults
// Admin adds products in "Products Grid" tab
// Click "Save Changes"
// POST to /admin/pages/category/books with form data
```

### Accessing Frontend
```php
// User visits /books
Route::get('/books', [CategoryPageController::class, 'show'])
    ->defaults('slug', 'books');

// Controller loads PageSection where page='books'
// Returns view('pages.category', compact('content'))
```

## Testing Checklist
- [ ] Admin login works
- [ ] Category cards display in admin dashboard
- [ ] Editor opens for each category
- [ ] All 4 tabs load correctly
- [ ] Save button stores to database
- [ ] Toast notifications appear
- [ ] Frontend pages load with saved data
- [ ] Product links work correctly
- [ ] Image uploads function properly
- [ ] Product reordering works

## Next Steps
1. Run migrations if PageSection table missing
2. Seed default data for categories
3. Test admin panel functionality
4. Verify frontend rendering
5. Add image optimization
6. Implement caching for performance

## Notes
- All category slugs use kebab-case (e.g., 'business-cards')
- Bengali titles supported in all text fields
- Images stored in public/uploads directory
- Product URLs are relative (e.g., '/books/paperback')
