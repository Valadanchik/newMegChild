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
        Schema::create('accessors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('title_hy')->unique()->nullable();
            $table->string('title_en')->unique()->nullable();
            $table->text('description_hy')->nullable();
            $table->text('description_en')->nullable();
            $table->string('age', 60)->nullable();
            $table->string('main_image', 255);
            $table->string('slug', 255)->unique();
            $table->string('price');
            $table->string('isbn');
            $table->integer('in_stock');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accessors');
    }
};
