# My Orders Feature - User Guide

## Overview
The "My Orders" feature allows users to view and track their printing orders in Chapakhana.

---

## Accessing My Orders

### Method 1: User Profile Dropdown
1. Click on your profile picture/name in the header
2. Click "My Orders" from the dropdown menu

### Method 2: Direct URL
- Visit: `https://chapakhana.notesofshahriar.com/orders`

---

## Features

### Orders List Page (`/orders`)

**What You'll See:**
- List of all your orders
- Order number and date
- Order status (Pending, Processing, Completed, Cancelled)
- Order items with images
- Total amount
- "View Details" button for each order

**Empty State:**
- If you haven't placed any orders yet, you'll see a friendly message
- "Browse Products" button to start shopping

### Order Details Page (`/orders/{id}`)

**What You'll See:**
- Order status timeline (Placed → Processing → Completed)
- Complete list of ordered items with images
- Order summary (Subtotal, Tax, Shipping, Total)
- Shipping information
- Payment method
- Design request details (if applicable)
- Contact support button

---

## Order Status Explained

| Status | Meaning | Color |
|--------|---------|-------|
| **Pending** | Order received, awaiting processing | Yellow |
| **Processing** | Order is being prepared/printed | Blue |
| **Completed** | Order finished and ready/delivered | Green |
| **Cancelled** | Order was cancelled | Red |

---

## Design Request Information

If you requested design assistance during checkout, you'll see:
- Purple "Design Request" card
- Your design requirements/notes
- Link to view uploaded reference files
- Status of design work

---

## Security

- ✅ Only logged-in users can access orders
- ✅ Users can only see their own orders
- ✅ Attempting to view another user's order returns 403 error
- ✅ Admin orders are completely separate at `/admin/orders`

---

## Technical Details

### Routes
```php
GET /orders              - List all user orders
GET /orders/{order}      - View specific order details
```

### Controller
- `App\Http\Controllers\UserOrderController`
- Methods: `index()`, `show()`

### Views
- `resources/views/orders/index.blade.php` - Orders list
- `resources/views/orders/show.blade.php` - Order details

### Models
- `App\Models\Order` - Order data
- `App\Models\OrderItem` - Order items data

---

## Troubleshooting

### 404 Error on /orders
**Possible Causes:**
1. Not logged in → Redirects to login page
2. Route not registered → Check `routes/auth.php`
3. View file missing → Check `resources/views/orders/`

**Solution:**
- Ensure you're logged in
- Clear route cache: `php artisan route:clear`
- Clear view cache: `php artisan view:clear`

### Orders Not Showing
**Possible Causes:**
1. No orders placed yet
2. Orders belong to different user account
3. Database connection issue

**Solution:**
- Place a test order
- Check you're logged in with correct account
- Verify database connection

### Images Not Loading
**Possible Causes:**
1. Storage link not created
2. Image path incorrect
3. File permissions

**Solution:**
```bash
php artisan storage:link
```

---

## For Developers

### Adding Order to Database
```php
use App\Models\Order;
use App\Models\OrderItem;

$order = Order::create([
    'user_id' => auth()->id(),
    'order_number' => 'ORD-' . strtoupper(uniqid()),
    'shipping_name' => 'John Doe',
    'shipping_email' => 'john@example.com',
    'shipping_phone' => '+880 1234567890',
    'shipping_address' => '123 Main St',
    'shipping_city' => 'Dhaka',
    'shipping_zip' => '1000',
    'payment_method' => 'cash_on_delivery',
    'subtotal' => 1000,
    'tax' => 80,
    'total' => 1080,
    'status' => 'pending',
]);

OrderItem::create([
    'order_id' => $order->id,
    'product_id' => 1,
    'product_title' => 'Business Cards',
    'product_image' => 'path/to/image.jpg',
    'format' => 'Standard',
    'quantity' => 100,
    'price' => 1000,
]);
```

### Querying User Orders
```php
// Get all orders for current user
$orders = auth()->user()->orders()->latest()->get();

// Get orders with items
$orders = auth()->user()->orders()->with('items')->get();

// Get pending orders only
$orders = auth()->user()->orders()->where('status', 'pending')->get();

// Get orders from last 30 days
$orders = auth()->user()->orders()
    ->where('created_at', '>=', now()->subDays(30))
    ->get();
```

### Customizing Views
Edit these files to customize the appearance:
- `resources/views/orders/index.blade.php`
- `resources/views/orders/show.blade.php`

---

## Future Enhancements

Potential features to add:
- [ ] Order tracking with real-time updates
- [ ] Download invoice as PDF
- [ ] Reorder functionality
- [ ] Order cancellation by user
- [ ] Email notifications for status changes
- [ ] Order search and filtering
- [ ] Export orders to CSV

---

## Support

For issues or questions:
- Email: support@chapakhana.com
- Check documentation in `docs/` folder
- Contact development team

**Last Updated**: January 19, 2026
