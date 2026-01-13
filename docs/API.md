# API Documentation

## Overview

This document describes the RESTful API endpoints for the Chapakhana e-commerce platform. All API endpoints follow REST principles and return JSON responses.

## Base URL

```
Production: https://yourdomain.com/api
Development: http://localhost:8000/api
```

## Authentication

### API Authentication

The API uses Laravel Sanctum for authentication. Include the authentication token in the `Authorization` header:

```
Authorization: Bearer {your-api-token}
```

### Getting an API Token

```http
POST /api/auth/login
Content-Type: application/json

{
  "email": "user@example.com",
  "password": "password"
}
```

**Response:**
```json
{
  "token": "1|abc123def456...",
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "user@example.com"
  }
}
```

## Rate Limiting

API endpoints are rate-limited to prevent abuse:

- **General API**: 60 requests per minute per IP/user
- **Authentication**: 5 requests per minute per IP

Rate limit headers are included in responses:
```
X-RateLimit-Limit: 60
X-RateLimit-Remaining: 59
X-RateLimit-Reset: 1642089600
```

## Response Format

### Success Response

```json
{
  "success": true,
  "data": {
    // Response data
  },
  "message": "Operation successful"
}
```

### Error Response

```json
{
  "success": false,
  "error": "ProductNotFoundException",
  "message": "Product not found with ID: 123",
  "code": 404
}
```

### Validation Error Response

```json
{
  "message": "The given data was invalid.",
  "errors": {
    "title": [
      "The title field is required."
    ],
    "price": [
      "The price must be greater than 0."
    ]
  }
}
```

## HTTP Status Codes

- `200 OK`: Request successful
- `201 Created`: Resource created successfully
- `204 No Content`: Request successful, no content to return
- `400 Bad Request`: Invalid request data
- `401 Unauthorized`: Authentication required
- `403 Forbidden`: Insufficient permissions
- `404 Not Found`: Resource not found
- `422 Unprocessable Entity`: Validation failed
- `429 Too Many Requests`: Rate limit exceeded
- `500 Internal Server Error`: Server error

## Products API

### List Products

Get a paginated list of products.

```http
GET /api/products
```

**Query Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| page | integer | Page number (default: 1) |
| per_page | integer | Items per page (default: 15, max: 100) |
| category_id | integer | Filter by category ID |
| search | string | Search in title and description |
| min_price | float | Minimum price filter |
| max_price | float | Maximum price filter |
| is_active | boolean | Filter by active status |
| sort | string | Sort field (price, created_at, popularity) |
| order | string | Sort order (asc, desc) |

**Example Request:**
```http
GET /api/products?category_id=1&min_price=10&max_price=100&sort=price&order=asc
```

**Response:**
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "title": "Business Cards",
        "slug": "business-cards",
        "description": "Professional business cards",
        "price": 25.00,
        "formatted_price": "৳25.00",
        "stock": true,
        "is_active": true,
        "image": "https://example.com/storage/products/business-cards.jpg",
        "category": {
          "id": 1,
          "name": "Business Cards",
          "slug": "business-cards"
        },
        "created_at": "2026-01-13T10:00:00.000000Z",
        "updated_at": "2026-01-13T10:00:00.000000Z"
      }
    ],
    "first_page_url": "http://localhost:8000/api/products?page=1",
    "from": 1,
    "last_page": 5,
    "last_page_url": "http://localhost:8000/api/products?page=5",
    "next_page_url": "http://localhost:8000/api/products?page=2",
    "path": "http://localhost:8000/api/products",
    "per_page": 15,
    "prev_page_url": null,
    "to": 15,
    "total": 75
  }
}
```

### Get Product

Get a single product by ID or slug.

```http
GET /api/products/{id}
GET /api/products/slug/{slug}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Business Cards",
    "slug": "business-cards",
    "description": "Professional business cards with premium finish",
    "price": 25.00,
    "base_price": 20.00,
    "formatted_price": "৳25.00",
    "stock": true,
    "is_active": true,
    "rating": 4.5,
    "popularity": 150,
    "config_options": {
      "sizes": ["Standard", "Large"],
      "finishes": ["Matte", "Glossy"]
    },
    "image": "https://example.com/storage/products/business-cards.jpg",
    "category": {
      "id": 1,
      "name": "Business Cards",
      "slug": "business-cards",
      "description": "Professional business card printing"
    },
    "created_at": "2026-01-13T10:00:00.000000Z",
    "updated_at": "2026-01-13T10:00:00.000000Z"
  }
}
```

### Create Product

Create a new product (Admin only).

```http
POST /api/products
Authorization: Bearer {admin-token}
Content-Type: multipart/form-data
```

**Request Body:**

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| title | string | Yes | Product title (max: 255) |
| slug | string | No | URL-friendly slug (auto-generated if not provided) |
| description | string | Yes | Product description |
| price | float | Yes | Product price (min: 0) |
| base_price | float | No | Base price before markup |
| category_id | integer | Yes | Category ID (must exist) |
| stock | boolean | No | In stock status (default: true) |
| is_active | boolean | No | Active status (default: true) |
| config_options | object | No | Configuration options (JSON) |
| image | file | No | Product image (jpg, png, max: 2MB) |

**Example Request:**
```http
POST /api/products
Content-Type: multipart/form-data

title=Business Cards
description=Professional business cards
price=25.00
category_id=1
image=@business-cards.jpg
```

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Business Cards",
    "slug": "business-cards",
    "price": 25.00,
    "category_id": 1,
    "created_at": "2026-01-13T10:00:00.000000Z"
  },
  "message": "Product created successfully"
}
```

### Update Product

Update an existing product (Admin only).

```http
PUT /api/products/{id}
PATCH /api/products/{id}
Authorization: Bearer {admin-token}
Content-Type: application/json
```

**Request Body:** Same as Create Product (all fields optional)

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "title": "Updated Business Cards",
    "price": 30.00,
    "updated_at": "2026-01-13T11:00:00.000000Z"
  },
  "message": "Product updated successfully"
}
```

### Delete Product

Delete a product (Admin only).

```http
DELETE /api/products/{id}
Authorization: Bearer {admin-token}
```

**Response:**
```json
{
  "success": true,
  "message": "Product deleted successfully"
}
```

## Categories API

### List Categories

Get all categories.

```http
GET /api/categories
```

**Query Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| is_active | boolean | Filter by active status |
| with_products | boolean | Include product count |

**Response:**
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Business Cards",
      "slug": "business-cards",
      "description": "Professional business card printing",
      "is_active": true,
      "products_count": 15,
      "created_at": "2026-01-13T10:00:00.000000Z"
    }
  ]
}
```

### Get Category

Get a single category with products.

```http
GET /api/categories/{id}
GET /api/categories/slug/{slug}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Business Cards",
    "slug": "business-cards",
    "description": "Professional business card printing",
    "is_active": true,
    "products_count": 15,
    "products": [
      {
        "id": 1,
        "title": "Standard Business Cards",
        "price": 25.00
      }
    ]
  }
}
```

## Orders API

### List Orders

Get user's orders (authenticated users) or all orders (admin).

```http
GET /api/orders
Authorization: Bearer {token}
```

**Query Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| page | integer | Page number |
| per_page | integer | Items per page |
| status | string | Filter by status |
| start_date | date | Filter by start date (Y-m-d) |
| end_date | date | Filter by end date (Y-m-d) |

**Response:**
```json
{
  "success": true,
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 1,
        "order_number": "ORD-20260113-001",
        "status": "pending",
        "subtotal": 100.00,
        "tax": 8.00,
        "total": 108.00,
        "shipping_name": "John Doe",
        "shipping_email": "john@example.com",
        "items": [
          {
            "id": 1,
            "product_id": 1,
            "product_title": "Business Cards",
            "quantity": 2,
            "price": 25.00,
            "subtotal": 50.00
          }
        ],
        "created_at": "2026-01-13T10:00:00.000000Z"
      }
    ],
    "total": 10
  }
}
```

### Get Order

Get a specific order.

```http
GET /api/orders/{id}
Authorization: Bearer {token}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "order_number": "ORD-20260113-001",
    "status": "pending",
    "subtotal": 100.00,
    "tax": 8.00,
    "total": 108.00,
    "shipping_name": "John Doe",
    "shipping_email": "john@example.com",
    "shipping_phone": "+8801234567890",
    "shipping_address": "123 Main St",
    "shipping_city": "Dhaka",
    "shipping_country": "Bangladesh",
    "payment_method": "cash_on_delivery",
    "notes": "Please deliver before 5 PM",
    "items": [
      {
        "id": 1,
        "product_id": 1,
        "product_title": "Business Cards",
        "quantity": 2,
        "price": 25.00,
        "subtotal": 50.00,
        "product": {
          "id": 1,
          "title": "Business Cards",
          "image": "https://example.com/storage/products/business-cards.jpg"
        }
      }
    ],
    "created_at": "2026-01-13T10:00:00.000000Z",
    "updated_at": "2026-01-13T10:00:00.000000Z"
  }
}
```

### Create Order

Create a new order from cart.

```http
POST /api/orders
Authorization: Bearer {token} (optional)
Content-Type: application/json
```

**Request Body:**

| Field | Type | Required | Description |
|-------|------|----------|-------------|
| shipping_name | string | Yes | Customer name |
| shipping_email | string | Yes | Customer email |
| shipping_phone | string | Yes | Customer phone |
| shipping_address | string | Yes | Shipping address |
| shipping_city | string | Yes | Shipping city |
| shipping_country | string | Yes | Shipping country |
| payment_method | string | Yes | Payment method (cash_on_delivery, card, etc.) |
| notes | string | No | Order notes |
| cart_items | array | Yes | Array of cart items |

**Example Request:**
```json
{
  "shipping_name": "John Doe",
  "shipping_email": "john@example.com",
  "shipping_phone": "+8801234567890",
  "shipping_address": "123 Main St",
  "shipping_city": "Dhaka",
  "shipping_country": "Bangladesh",
  "payment_method": "cash_on_delivery",
  "notes": "Please deliver before 5 PM",
  "cart_items": [
    {
      "product_id": 1,
      "quantity": 2,
      "price": 25.00
    }
  ]
}
```

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "order_number": "ORD-20260113-001",
    "total": 108.00,
    "status": "pending"
  },
  "message": "Order created successfully"
}
```

### Update Order Status

Update order status (Admin only).

```http
PATCH /api/orders/{id}/status
Authorization: Bearer {admin-token}
Content-Type: application/json
```

**Request Body:**
```json
{
  "status": "processing"
}
```

**Valid Statuses:**
- `pending`: Order created, awaiting processing
- `processing`: Order is being prepared
- `shipped`: Order has been shipped
- `delivered`: Order has been delivered
- `completed`: Order completed successfully
- `cancelled`: Order was cancelled
- `refunded`: Order was refunded

**Response:**
```json
{
  "success": true,
  "data": {
    "id": 1,
    "status": "processing",
    "updated_at": "2026-01-13T11:00:00.000000Z"
  },
  "message": "Order status updated successfully"
}
```

## Error Codes

### Product Errors

| Code | Error | Description |
|------|-------|-------------|
| 404 | ProductNotFoundException | Product not found |
| 422 | ProductOutOfStockException | Product is out of stock |
| 422 | ProductCreationFailedException | Failed to create product |

### Order Errors

| Code | Error | Description |
|------|-------|-------------|
| 404 | OrderNotFoundException | Order not found |
| 422 | EmptyCartException | Cannot create order with empty cart |
| 422 | InvalidOrderStatusException | Invalid status transition |

### Category Errors

| Code | Error | Description |
|------|-------|-------------|
| 404 | CategoryNotFoundException | Category not found |

## Pagination

All list endpoints support pagination with the following structure:

```json
{
  "current_page": 1,
  "data": [...],
  "first_page_url": "...",
  "from": 1,
  "last_page": 5,
  "last_page_url": "...",
  "next_page_url": "...",
  "path": "...",
  "per_page": 15,
  "prev_page_url": null,
  "to": 15,
  "total": 75
}
```

## Filtering and Sorting

### Filtering

Use query parameters to filter results:

```http
GET /api/products?category_id=1&is_active=true&min_price=10
```

### Sorting

Use `sort` and `order` parameters:

```http
GET /api/products?sort=price&order=asc
GET /api/products?sort=created_at&order=desc
```

### Searching

Use the `search` parameter:

```http
GET /api/products?search=business+cards
```

## Best Practices

### 1. Always Handle Errors

```javascript
try {
  const response = await fetch('/api/products/1');
  const data = await response.json();
  
  if (!response.ok) {
    throw new Error(data.message);
  }
  
  // Handle success
} catch (error) {
  // Handle error
  console.error(error.message);
}
```

### 2. Use Pagination

Always paginate large result sets:

```javascript
const response = await fetch('/api/products?per_page=20&page=1');
```

### 3. Cache Responses

Cache GET requests when appropriate:

```javascript
const response = await fetch('/api/products', {
  headers: {
    'Cache-Control': 'max-age=3600'
  }
});
```

### 4. Include Authentication

Always include the auth token for protected endpoints:

```javascript
const response = await fetch('/api/orders', {
  headers: {
    'Authorization': `Bearer ${token}`,
    'Content-Type': 'application/json'
  }
});
```

## Rate Limit Handling

Handle rate limit errors gracefully:

```javascript
const response = await fetch('/api/products');

if (response.status === 429) {
  const retryAfter = response.headers.get('Retry-After');
  console.log(`Rate limited. Retry after ${retryAfter} seconds`);
  // Wait and retry
}
```

## Testing

### Using cURL

```bash
# Get products
curl -X GET "http://localhost:8000/api/products" \
  -H "Accept: application/json"

# Create product (admin)
curl -X POST "http://localhost:8000/api/products" \
  -H "Authorization: Bearer {token}" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Business Cards",
    "description": "Professional cards",
    "price": 25.00,
    "category_id": 1
  }'
```

### Using Postman

1. Import the API collection
2. Set the base URL variable
3. Add authentication token to environment
4. Test endpoints

## Support

For API support, contact:
- Email: support@chapakhana.com
- Documentation: https://docs.chapakhana.com
- GitHub Issues: https://github.com/chapakhana/issues
