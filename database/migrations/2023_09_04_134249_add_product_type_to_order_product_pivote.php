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
        Schema::table('order_product_pivote', function (Blueprint $table) {
            $table->enum('product_type', ['book', 'accessor'])->default('book')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_product_pivote', function (Blueprint $table) {
            $table->dropColumn('product_type');
        });
    }
};
