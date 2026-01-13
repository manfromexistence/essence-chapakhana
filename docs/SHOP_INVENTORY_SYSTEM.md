# Shop Inventory Management System

## Overview
Complete, independent shop inventory system for Chapakhana with product management, categories, cart, checkout, and order tracking. The shop is completely separate from service products/packages.

## System Components

### 1. Database Structure

#### Products Table
- `id` - Primary key
- `category_id` - Foreign key to categories
- `title` - Product name
- `slug` - URL-friendly identifier
- `description` - Product description
- `format` - Product format (Paperback, Hardback, etc.)
- `price` - Product price (decimal)
- `rating` - Average rating (0-5)
- `popularity` - Popularity score (0-100)
- `stock` - In stock boolean
- `badge` - Optional badge (New, Bestseller, etc.)
- `image` - Product image path
- `is_active` - Active status

#### Categories Table
- `id` - Primary key
- `name` - Category name
- `slug` - URL-friendly identifier
- `description` - Category description
- `is_active` - Active status

#### Orders Table
- `id` - Primary key
- `user_id` - Foreign key to users
- `order_number` - Unique order identifier
- Shipping information fields
- `payment_method` - Payment method used
- `subtotal`, `tax`, `total` - Financial data
- `status` - Order status (pending, processing, shipped, delivered, cancelled)

#### Order Items Table
- `id` - Primary key
- `order_id` - Foreign key to orders
- `product_id` - Foreign key to products (tracks which product)
- `product_title` - Product name at time of order
- `product_image` - Product image at time of order
- `format` - Product format
- `quantity` - Quantity ordered
- `price` - Price at time of order

### 2. Admin Management

#### Access Admin Dashboard
Navigate to: `/admin/dashboard`

#### Managing Categories
**Location:** `/admin/dashboard/categories`

**Features:**
- Create new categories
- Edit existing categories
- View product count per category
- Toggle active/inactive status
- Delete categories (soft delete)

**How to Add a Category:**
1. Click "Add Category" button
2. Fill in:
   - Category Name (required)
   - Description (optional)
   - Active Status checkbox
3. Click "Save"

#### Managing Products
**Location:** `/admin/dashboard/products`

**Features:**
- Create new products
- Edit existing products
- View product details
- Upload product images
- Set pricing and stock status
- Assign categories and formats
- Delete products (soft delete)

**How to Add a Product:**
1. Click "Add Product" button
2. Fill in required fields:
   - **Title:** Product name
   - **Category:** Select from dropdown
   - **Description:** Product details
   - **Format:** Product format (e.g., Paperback, Magazine)
   - **Price:** Product price in ৳
   - **Rating:** Initial rating (0-5)
   - **Popularity:** Popularity score (0-100)
   - **Image:** Upload product image
   - **Badge:** Optional (New, Bestseller, etc.)
   - **Stock:** Check if in stock
   - **Active:** Check to make visible on shop
3. Click "Save Product"

#### Managing Orders
**Location:** `/admin/dashboard/orders`

**Features:**
- View all orders with pagination
- See order details with items
- Update order status
- View customer information
- Track order financials
- Delete orders if needed

**Order Statuses:**
- `pending` - Order placed, awaiting processing
- `processing` - Order being prepared
- `shipped` - Order dispatched
- `delivered` - Order completed
- `cancelled` - Order cancelled

### 3. Shop Page Configuration

#### Shop Hero Section
**Location:** `/admin/shop`

**Configurable Elements:**
- **Subtitle:** Small text above title
- **Title:** Main heading
- **Description:** Hero description text
- **Cover Background Image:** Hero section background
- **Badges:** Feature badges (multiple)
- **4 Stat Cards:** Customizable statistics

**Example Configuration:**
```
Subtitle: CURATED PRINT CATALOGUE
Title: Shop every format in one place.
Description: Browse books, marketing kits, signage...
Badges: Lead times 48h, Color-managed, Proofing included

Stats:
- Average rating: 4.6 (Feefo verified)
- Formats: 30+ (Books to boxes)
- Turnaround: 48h (Express available)
- Support: 24/7 (Print specialists)
```

### 4. Frontend Shop Features

#### Shop Page
**URL:** `/shop`

**Customer Features:**
- **Search:** Find products by name or keyword
- **Category Filter:** Filter by Books, Marketing, Stationery, Signage, Packaging
- **Price Range:** Filter by maximum price (slider)
- **Format Filter:** Filter by product format
- **Rating Filter:** Filter by minimum rating
- **Stock Filter:** Show only in-stock items
- **Sorting Options:**
  - Most popular
  - Price: Low to High
  - Price: High to Low
  - Rating: High to Low

**Product Cards Display:**
- Product image
- Category badge
- Product title
- Description
- Price in ৳
- Format tag
- Stock status
- Star rating
- "Add to Cart" button

### 5. Shopping Cart System

#### Cart Features
**URL:** `/cart`

- Add products with quantity
- Update quantities
- Remove items
- View subtotal, tax, and total
- Products tracked by `product_id`
- Session-based cart storage
- Automatic total calculations

#### Cart Data Stored:
```php
[
    'product_id' => 1,
    'title' => 'Paperback Book Bundle',
    'category' => 'books',
    'format' => 'Paperback',
    'price' => 8.50,
    'rating' => 4.6,
    'image' => '/storage/products/...',
    'desc' => 'Product description',
    'stock' => true,
    'quantity' => 2
]
```

### 6. Checkout Process

#### Checkout Page
**URL:** `/checkout` (requires authentication)

**Dynamic Checkout Fields:**
Configurable from `/admin/dashboard/checkout-fields`

**Standard Fields:**
- Shipping Name
- Shipping Email
- Shipping Phone
- Shipping Country
- Shipping Address
- Shipping City
- Shipping State
- Shipping Zip
- Payment Method (credit_card, paypal, cash_on_delivery)
- Order Notes

**Process:**
1. Customer fills shipping information
2. Selects payment method
3. Reviews order summary
4. Places order
5. Order saved to database with:
   - Unique order number (ORD-XXXX)
   - All shipping details
   - Order items with product_id
   - Financial totals
   - Status: pending
6. Cart cleared
7. Redirect to orders page

### 7. Customer Order Management

**View Orders:** Integrated into user profile/account area

**Order Information Displayed:**
- Order number
- Order date
- Status
- Items ordered with quantities
- Total amount
- Shipping information

### 8. File Structure

```
app/
├── Models/
│   ├── Product.php (Enhanced with image accessor, relationships)
│   ├── Category.php
│   ├── Order.php
│   ├── OrderItem.php (With product_id relationship)
│
├── Http/Controllers/
│   ├── ShopController.php (Shop page display)
│   ├── ProductController.php (Admin product CRUD)
│   ├── CategoryController.php (Admin category CRUD)
│   ├── CartController.php (Cart management)
│   ├── CheckoutController.php (Checkout process)
│   └── Admin/
│       ├── OrderController.php (Admin order management)
│       └── ShopPageController.php (Shop hero configuration)
│
├── Services/
│   └── ShopService.php (Business logic for shop)
│
database/
├── migrations/
│   ├── create_products_table.php
│   ├── create_categories_table.php
│   ├── create_orders_table.php
│   └── create_order_items_table.php
│
└── seeders/
    └── ShopProductSeeder.php (Sample products)

resources/
├── views/
│   ├── pages/
│   │   └── shop.blade.php (Main shop page)
│   ├── cart/
│   │   └── index.blade.php (Cart page)
│   └── checkout/
│       └── index.blade.php (Checkout page)
│
└── js/Pages/Admin/
    ├── Products.jsx (Admin product list)
    ├── ProductForm.jsx (Product create/edit)
    ├── Categories.jsx (Admin categories)
    ├── Orders.jsx (Admin orders)
    └── Shop.jsx (Shop hero configuration)

routes/
├── admin.php (Admin routes)
├── shop.php (Shop routes)
└── web.php (General routes)
```

### 9. Sample Products Included

**12 Products Across 5 Categories:**

**Books:**
- Paperback Book Bundle (৳8.50)
- Hardback Photo Book (৳24.00)
- Cookbook Print Set (৳18.00)
- Leaflet Bundle (৳3.50)

**Marketing:**
- Magazine Run (৳4.20)
- Brochure Pack (৳12.00)
- Flyer Set (৳2.50)

**Stationery:**
- Business Card Premium (৳15.00)
- Letterhead Set (৳8.00)

**Signage:**
- Banner Large Format (৳45.00)
- Poster Print A1 (৳12.50)

**Packaging:**
- Custom Box Packaging (৳22.00)

### 10. Configuration

#### Shop Configuration
**File:** `config/shop.php`

```php
return [
    'tax_rate' => 0.08, // 8% tax rate
    'currency' => '৳',
    'currency_name' => 'BDT',
];
```

### 11. Key Features Summary

✅ **Complete Inventory Management**
- Product CRUD operations
- Category management
- Image uploads with proper paths
- Stock tracking
- Rating and popularity tracking

✅ **Customer-Facing Shop**
- Responsive product grid
- Advanced filtering (search, category, price, format, rating, stock)
- Multiple sort options
- Real-time product count
- Add to cart functionality

✅ **Shopping Cart**
- Session-based storage
- Product ID tracking
- Quantity management
- Automatic calculations
- Tax and total computation

✅ **Checkout System**
- Dynamic, configurable fields
- Shipping information collection
- Payment method selection
- Order creation with unique IDs
- Automatic cart clearing

✅ **Order Management**
- Admin order dashboard
- Status tracking (5 statuses)
- Customer information viewing
- Order item details with product links
- Financial tracking

✅ **Independent from Services**
- Completely separate from service products
- Own database tables
- Own controllers and routes
- Own admin interfaces

### 12. Usage Instructions

#### For Admin:

1. **Setup Categories:**
   - Go to `/admin/dashboard/categories`
   - Add all product categories you need

2. **Add Products:**
   - Go to `/admin/dashboard/products`
   - Click "Add Product"
   - Fill in all details and upload image
   - Make sure "Active" is checked

3. **Configure Shop Hero:**
   - Go to `/admin/shop`
   - Upload background image
   - Set hero text and stats
   - Add feature badges

4. **Manage Orders:**
   - Go to `/admin/dashboard/orders`
   - View new orders
   - Update status as you process them

#### For Customers:

1. **Browse Products:**
   - Visit `/shop`
   - Use filters to find products
   - Click products for details

2. **Add to Cart:**
   - Click "Add to Cart" on any product
   - View cart at `/cart`
   - Update quantities as needed

3. **Checkout:**
   - Click "Proceed to Checkout"
   - Fill in shipping information
   - Select payment method
   - Place order

4. **View Orders:**
   - Check profile/account area
   - View order history and status

### 13. Testing the System

Run the seeder to populate sample data:
```bash
php artisan db:seed --class=ShopProductSeeder
```

This creates:
- 5 categories (Books, Marketing, Stationery, Signage, Packaging)
- 12 sample products with various prices and formats

Then visit:
- `/shop` - View the shop page
- `/admin/dashboard/products` - Manage products
- `/admin/dashboard/categories` - Manage categories
- `/admin/dashboard/orders` - View orders

### 14. Future Enhancements

Potential additions:
- Product reviews and comments
- Wishlist functionality
- Product variants (sizes, colors)
- Discount codes and promotions
- Advanced inventory management (low stock alerts)
- Product recommendations
- Analytics dashboard
- Export orders to CSV/PDF
- Email notifications
- Customer order tracking page
- Product comparison feature

---

## System Status: ✅ FULLY OPERATIONAL

The shop inventory system is now complete and ready for production use. All admin tools are in place, products can be managed independently, and the complete customer journey from browsing to checkout is functional.
