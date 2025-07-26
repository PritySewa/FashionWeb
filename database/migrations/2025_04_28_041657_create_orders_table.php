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
            $table->string('phone_number');
            $table->decimal('total_discount')->nullable();
            $table->foreignId('user_id')->constrained()->ondelete('cascade');
            $table->enum('payment_method',['cash_on_delivery','skypay']);
            $table->timestamp('payment_verified_at')->nullable();
            $table->datetime('cancelled_at_status')->nullable();
            $table->text('address');
            $table->enum('payment_status',['paid','unpaid']);
            $table->timestamp('completed_at_sales_total')->nullable();
            $table->timestamps();
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
