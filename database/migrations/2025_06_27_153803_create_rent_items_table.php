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
        Schema::create('rent_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand');
            $table->enum('item_type', ['Books', 'Phone', 'Laptop', 'Dress', 'Others']);
            $table->enum('item_state', ['Fully Functioning', 'Repaired', 'Not used yet']);
            $table->enum('rent_type', ['monthly', 'daily'])->default('daily');
            $table->integer('rent_duration')->nullable()->comment('Duration in days for daily rent, or months for monthly rent');
            $table->integer('price');
            $table->text('description')->nullable();
            $table->string('user_name');
            $table->string('user_location');
            $table->string('user_contact');
            $table->enum('user_payment_option', ['Cash on delivery', 'bKash'])->default('Cash on delivery');
            $table->string('user_bKash_number')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0 = sold, 1 = available');
            $table->unsignedBigInteger('user_id'); // Foreign key for user who
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_items');
    }
};
