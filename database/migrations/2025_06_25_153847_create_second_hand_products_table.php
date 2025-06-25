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
        Schema::create('second_hand_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand');
            $table->enum('item_type', ['Books', 'Phone', 'Laptop', 'Dress', 'Others']);
            $table->enum('item_state', ['Fully Functioning', 'Repaired', 'Not used yet']);
            $table->integer('price');
            $table->text('description')->nullable();
            $table->string('user_name');
            $table->string('user_location');
            $table->string('user_contact');
            $table->unsignedBigInteger('user_id'); // Foreign key for user who
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('second_hand_products');
    }
};
