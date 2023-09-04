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
        Schema::table('order_book_pivote', function (Blueprint $table) {
            $table->renameColumn('book_id', 'product_id');
            $table->dropForeign(['book_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_id', function (Blueprint $table) {
            $table->renameColumn('product_id', 'book_id');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }
};
