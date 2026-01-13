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
        // Add indexes to products table
        Schema::table('products', function (Blueprint $table) {
            $table->index('category_id', 'idx_products_category_id');
            $table->index('is_featured', 'idx_products_is_featured');
            $table->index('is_active', 'idx_products_is_active');
            $table->index(['is_active', 'stock'], 'idx_products_active_stock');
            // Removed fulltext index as it's not supported by all database drivers
            // For search functionality, consider using Laravel Scout with Meilisearch/Algolia
        });

        // Add indexes to orders table
        Schema::table('orders', function (Blueprint $table) {
            $table->index('user_id', 'idx_orders_user_id');
            $table->index('status', 'idx_orders_status');
            $table->index('created_at', 'idx_orders_created_at');
            $table->index(['user_id', 'status'], 'idx_orders_user_status');
        });

        // Add indexes to order_items table
        Schema::table('order_items', function (Blueprint $table) {
            $table->index('order_id', 'idx_order_items_order_id');
        });

        // Add indexes to categories table
        Schema::table('categories', function (Blueprint $table) {
            $table->index('is_active', 'idx_categories_is_active');
            $table->index('slug', 'idx_categories_slug');
        });

        // Add indexes to formats table if exists
        if (Schema::hasTable('formats')) {
            Schema::table('formats', function (Blueprint $table) {
                $table->index('is_active', 'idx_formats_is_active');
                $table->index('slug', 'idx_formats_slug');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIndex('idx_products_category_id');
            $table->dropIndex('idx_products_is_featured');
            $table->dropIndex('idx_products_is_active');
            $table->dropIndex('idx_products_active_stock');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex('idx_orders_user_id');
            $table->dropIndex('idx_orders_status');
            $table->dropIndex('idx_orders_created_at');
            $table->dropIndex('idx_orders_user_status');
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropIndex('idx_order_items_order_id');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex('idx_categories_is_active');
            $table->dropIndex('idx_categories_slug');
        });

        if (Schema::hasTable('formats')) {
            Schema::table('formats', function (Blueprint $table) {
                $table->dropIndex('idx_formats_is_active');
                $table->dropIndex('idx_formats_slug');
            });
        }
    }
};
