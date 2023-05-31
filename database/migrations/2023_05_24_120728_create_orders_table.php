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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->unsignedBigInteger('order_payment_id');
            $table->string('name');
            $table->string('lastname');
            $table->string('company')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->string('region')->nullable();
            $table->string('street')->nullable();
            $table->string('house')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('order_text')->nullable();
            $table->unsignedInteger('total_price')->nullable();
            $table->unsignedInteger('total_price_with_discount')->nullable();
            $table->unsignedInteger('payment_method');
            $table->longText('payment_callback')->nullable();
            $table->integer('status');
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade');
            $table->foreign('region_id')->references('id')->on('regions')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
