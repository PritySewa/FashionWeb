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
        Schema::create('offer__items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offers_id')->constrained()->onDelete('cascade');
            $table->text('offers_items');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->date('valid_date');
            $table->text('limitations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer__items');
    }
};
