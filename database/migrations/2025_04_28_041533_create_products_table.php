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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('parent_id');
            $table->foreignId('category_id')->constrained()->onDelete('cascade')->nullable();
            $table->foreignId('badge_id')->nullable()->constrained()->nullOnDelete();            $table->string('price');
            $table->text('thumb_images_url');
            $table->json('image_urls')->nullable();

            $table->text('description');
            $table->text('stock');
            $table->enum('status', ['active','inactive']);
            $table->text('is_variant');
            $table->text('size');
            $table->text('color');
            $table->text('specifications');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
