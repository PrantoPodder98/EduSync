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
        Schema::create('lost_items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->string('location');
            $table->date('lost_date');
            $table->text('description')->nullable();
            $table->string('user_name')->nullable(); // Name of the person who found the item
            $table->string('contact_number')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); // Foreign key for user who
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lost_items');
    }
};
