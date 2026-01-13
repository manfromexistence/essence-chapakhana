<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Index for category filtering
            $table->index('category_id', 'products_category_id_index');

            // Index for active product queries
            $table->index('is_active', 'products_is_active_index');

            // Index for stock availability queries
            $table->index('stock', 'products_stock_index');

            // Composite index for common query pattern: active products in a category
            $table->index(['category_id', 'is_active'], 'products_category_active_index');

            // Composite index for active products with stock
            $table->index(['is_active', 'stock'], 'products_active_stock_index');

            // Index for sorting by price
            $table->index('price', 'products_price_index');

            // Index for created_at (for latest products)
            $table->index('created_at', 'products_created_at_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('products_category_id_index');
            $table->dropIndex('products_is_active_index');
            $table->dropIndex('products_stock_index');
            $table->dropIndex('products_category_active_index');
            $table->dropIndex('products_active_stock_index');
            $table->dropIndex('products_price_index');
            $table->dropIndex('products_created_at_index');
        });
    }
};
