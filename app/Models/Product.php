<?php

namespace App\Models;

use App\Traits\HasSlugFromTitle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, HasSlugFromTitle, SoftDeletes;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'description',
        'format',
        'price',
        'base_price',
        'min_quantity',
        'min_pages',
        'max_pages',
        'rating',
        'popularity',
        'stock',
        'badge',
        'config_options',
        'image',
        'is_active',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'base_price' => 'decimal:2',
        'rating' => 'decimal:2',
        'stock' => 'boolean',
        'is_active' => 'boolean',
        'config_options' => 'array',
        'min_quantity' => 'integer',
        'min_pages' => 'integer',
        'max_pages' => 'integer',
    ];

    protected $appends = ['formatted_price'];

    /**
     * Eager load relationships by default to prevent N+1 queries.
     *
     * @var array
     */
    protected $with = ['category'];

    // Relationship with category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship with order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Accessor for formatted price
    public function getFormattedPriceAttribute()
    {
        return '৳'.number_format($this->price ?? 0, 2);
    }

    // Accessor to ensure image path is correct
    public function getImageAttribute($value)
    {
        if (! $value) {
            return asset('images/placeholder-product.jpg');
        }

        // If already a full URL, return as is
        if (str_starts_with($value, 'http')) {
            return $value;
        }

        // If starts with /, return with asset()
        if (str_starts_with($value, '/')) {
            return asset($value);
        }

        // Otherwise, prepend /storage/
        return asset('storage/'.$value);
    }

    // Scope for active products
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for in-stock products
    public function scopeInStock($query)
    {
        return $query->where('stock', true);
    }

    /**
     * Scope for popular products (ordered by popularity).
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePopular($query)
    {
        return $query->orderBy('popularity', 'desc');
    }

    /**
     * Scope for products by category.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByCategory($query, int $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Scope for products with price range.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePriceRange($query, ?float $minPrice = null, ?float $maxPrice = null)
    {
        if ($minPrice !== null) {
            $query->where('price', '>=', $minPrice);
        }

        if ($maxPrice !== null) {
            $query->where('price', '<=', $maxPrice);
        }

        return $query;
    }

    /**
     * Scope for latest products.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLatest($query, int $limit = 10)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }

    /**
     * Scope for products with search term.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, string $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        });
    }
}
