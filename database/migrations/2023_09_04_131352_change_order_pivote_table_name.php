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
        Schema::rename('order_book_pivote', 'order_product_pivote');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('order_product_pivote', 'order_book_pivote');
    }
};
