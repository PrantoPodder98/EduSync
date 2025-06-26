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
        Schema::create('rental_notice_board_accommodations', function (Blueprint $table) {
            $table->id();
             // Basic details
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('unit_no')->nullable();
            $table->enum('property_type', ['Flat', 'Sublet', 'Hostel', 'Mess', 'Shared', 'House']);
            $table->string('division');
            $table->string('area');
            $table->string('address');

            // Rent details
            $table->enum('rent_type', ['monthly', 'daily'])->default('monthly');
            $table->integer('rent_amount');
            $table->integer('advance_amount')->nullable();
            $table->integer('utility_bill')->nullable();

            // Property features
            $table->unsignedTinyInteger('bedrooms')->default(0);
            $table->unsignedTinyInteger('bathrooms')->default(0);
            $table->unsignedTinyInteger('balcony')->default(0);
            $table->unsignedInteger('size_sqft')->nullable();

            // Contact
            $table->string('contact_name');
            $table->string('contact_number');

            // Meta
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['active', 'inactive', 'rented'])->default('active');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_notice_board_accommodations');
    }
};
