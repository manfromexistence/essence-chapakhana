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
            $table->json('config_options')->nullable()->after('badge');
            $table->decimal('base_price', 10, 2)->nullable()->after('price');
            $table->integer('min_quantity')->default(1)->after('base_price');
            $table->integer('min_pages')->nullable()->after('min_quantity');
            $table->integer('max_pages')->nullable()->after('min_pages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['config_options', 'base_price', 'min_quantity', 'min_pages', 'max_pages']);
        });
    }
};
