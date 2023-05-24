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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_category_id')->nullable();
            $table->string('slug')->unique();
            $table->string('title_hy')->unique();
            $table->string('title_en')->unique();
            $table->string('description_hy')->nullable();
            $table->string('description_en')->nullable();
            $table->text('text_hy');
            $table->text('text_en');
            $table->text('image');
            $table->timestamps();

            $table->foreign('post_category_id')->references('id')->on('post_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
