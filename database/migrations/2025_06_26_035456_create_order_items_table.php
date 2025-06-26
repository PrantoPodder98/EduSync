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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('second_hand_product_id');
            $table->decimal('price', 10, 2); // Store price at time of purchase
            $table->timestamps();
            
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('second_hand_product_id')->references('id')->on('second_hand_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
