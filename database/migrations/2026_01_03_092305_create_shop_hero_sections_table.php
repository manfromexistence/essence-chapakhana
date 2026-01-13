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
        Schema::create('shop_hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('subtitle')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->json('badges')->nullable();

            // Stats 1
            $table->string('stat1_label')->nullable();
            $table->string('stat1_value')->nullable();
            $table->string('stat1_sublabel')->nullable();

            // Stats 2
            $table->string('stat2_label')->nullable();
            $table->string('stat2_value')->nullable();
            $table->string('stat2_sublabel')->nullable();

            // Stats 3
            $table->string('stat3_label')->nullable();
            $table->string('stat3_value')->nullable();
            $table->string('stat3_sublabel')->nullable();

            // Stats 4
            $table->string('stat4_label')->nullable();
            $table->string('stat4_value')->nullable();
            $table->string('stat4_sublabel')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop_hero_sections');
    }
};
