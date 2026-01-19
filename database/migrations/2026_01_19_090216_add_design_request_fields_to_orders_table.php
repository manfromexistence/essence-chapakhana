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
            $table->boolean('has_design_request')->default(false)->after('notes');
            $table->text('design_request_notes')->nullable()->after('has_design_request');
            $table->string('design_file_path')->nullable()->after('design_request_notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['has_design_request', 'design_request_notes', 'design_file_path']);
        });
    }
};
