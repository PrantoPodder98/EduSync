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
            $table->enum('property_type', ['Flat', 'Hostel', 'Mess', 'Shared', 'House', 'Single'])->default('Flat');
            $table->string('division');
            $table->string('area');
            $table->string('address');
            $table->string('map_link')->nullable();

            // Rent details
            $table->enum('rent_type', ['monthly', 'daily'])->default('monthly');
            $table->integer('rent_amount');
            $table->integer('advance_amount')->nullable();
            $table->integer('utility_bill')->nullable();

            // Property features
            $table->unsignedTinyInteger('bedrooms')->default(1);
            $table->unsignedTinyInteger('bathrooms')->default(1);
            $table->unsignedTinyInteger('balcony')->default(0);
            $table->unsignedInteger('size_sqft')->nullable();

            // Contact
            $table->string('contact_name');
            $table->string('contact_number');

            // bank details
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_routing_number')->nullable();

            // bKash details
            $table->string('bkash_number')->nullable();

            // Meta
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedTinyInteger('is_approved')->default(0)->comment('0 = not approved, 1 = approved');
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
