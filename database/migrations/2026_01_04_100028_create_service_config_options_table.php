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
        Schema::create('service_config_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_product_id')->constrained()->onDelete('cascade');
            $table->string('option_name'); // e.g., "Binding", "Size", "Paper Type"
            $table->string('option_type'); // 'radio', 'select', 'button', 'tabs', 'number', 'text'
            $table->json('option_values'); // Array of available values
            $table->json('option_prices')->nullable(); // Array of prices for each value
            $table->string('default_value')->nullable();
            $table->integer('display_order')->default(0);
            $table->boolean('is_required')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_config_options');
    }
};
