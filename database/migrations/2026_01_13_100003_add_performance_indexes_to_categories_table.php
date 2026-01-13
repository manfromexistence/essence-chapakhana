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
        Schema::table('categories', function (Blueprint $table) {
            // Index for slug lookups
            $table->index('slug', 'categories_slug_index');

            // Index for parent category lookups (tree structure)
            $table->index('parent_id', 'categories_parent_id_index');

            // Index for active categories
            $table->index('is_active', 'categories_is_active_index');

            // Composite index for active categories by parent
            $table->index(['parent_id', 'is_active'], 'categories_parent_active_index');

            // Index for ordering
            $table->index('order', 'categories_order_index');

            // Index for soft deletes
            $table->index('deleted_at', 'categories_deleted_at_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex('categories_slug_index');
            $table->dropIndex('categories_parent_id_index');
            $table->dropIndex('categories_is_active_index');
            $table->dropIndex('categories_parent_active_index');
            $table->dropIndex('categories_order_index');
            $table->dropIndex('categories_deleted_at_index');
        });
    }
};
