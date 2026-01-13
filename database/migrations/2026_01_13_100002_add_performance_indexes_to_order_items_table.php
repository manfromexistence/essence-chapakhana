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
        Schema::table('order_items', function (Blueprint $table) {
            // Index for order's items lookup
            $table->index('order_id', 'order_items_order_id_index');

            // Index for product's order history
            $table->index('product_id', 'order_items_product_id_index');

            // Composite index for order items by product
            $table->index(['order_id', 'product_id'], 'order_items_order_product_index');

            // Index for created_at (for analytics)
            $table->index('created_at', 'order_items_created_at_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropIndex('order_items_order_id_index');
            $table->dropIndex('order_items_product_id_index');
            $table->dropIndex('order_items_order_product_index');
            $table->dropIndex('order_items_created_at_index');
        });
    }
};
