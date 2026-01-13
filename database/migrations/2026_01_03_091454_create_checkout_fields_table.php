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
        Schema::create('checkout_fields', function (Blueprint $table) {
            $table->id();
            $table->string('section'); // shipping, payment, notes, sidebar
            $table->string('field_key')->unique();
            $table->string('label');
            $table->string('placeholder')->nullable();
            $table->string('type')->default('text'); // text, email, tel, textarea, radio
            $table->boolean('is_required')->default(true);
            $table->boolean('is_visible')->default(true);
            $table->integer('sort_order')->default(0);
            $table->json('options')->nullable(); // For radio or select fields
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkout_fields');
    }
};
