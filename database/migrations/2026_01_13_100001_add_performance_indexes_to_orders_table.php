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
        Schema::table('orders', function (Blueprint $table) {
            // Index for user's orders lookup
            $table->index('user_id', 'orders_user_id_index');

            // Index for order status filtering
            $table->index('status', 'orders_status_index');

            // Index for date-based queries
            $table->index('created_at', 'orders_created_at_index');

            // Index for email lookups (guest orders)
            $table->index('customer_email', 'orders_customer_email_index');

            // Composite index for user's orders by status
            $table->index(['user_id', 'status'], 'orders_user_status_index');

            // Composite index for user's orders by date
            $table->index(['user_id', 'created_at'], 'orders_user_created_index');

            // Composite index for status and date (admin dashboard)
            $table->index(['status', 'created_at'], 'orders_status_created_index');

            // Index for soft deletes
            $table->index('deleted_at', 'orders_deleted_at_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropIndex('orders_user_id_index');
            $table->dropIndex('orders_status_index');
            $table->dropIndex('orders_created_at_index');
            $table->dropIndex('orders_customer_email_index');
            $table->dropIndex('orders_user_status_index');
            $table->dropIndex('orders_user_created_index');
            $table->dropIndex('orders_status_created_index');
            $table->dropIndex('orders_deleted_at_index');
        });
    }
};
