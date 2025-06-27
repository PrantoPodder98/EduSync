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
        Schema::create('rental_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rental_notice_id')
                ->constrained('rental_notice_board_accommodations')
                ->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Customer Information
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company_name')->nullable();
            $table->text('address');
            $table->string('country');
            $table->string('city');
            $table->string('zip_code');
            $table->string('email');
            $table->string('phone_number');
            $table->text('order_notes')->nullable();

            // Payment Information
            $table->enum('payment_method', ['card', 'bkash']);
            $table->decimal('reservation_fee', 10, 2);
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->json('payment_details')->nullable();
            $table->string('reservation_code')->unique();

            $table->timestamps();

            // Indexes
            $table->index(['rental_notice_id', 'user_id']);
            $table->index('status');
            $table->index('payment_status');
            $table->index('reservation_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_reservations');
    }
};
