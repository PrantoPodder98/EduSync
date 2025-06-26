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
        Schema::table('second_hand_products', function (Blueprint $table) {
            $table->enum('user_payment_option', ['Cash on delivery', 'bKash'])->default('Cash on delivery')->after('user_contact');
            $table->string('user_bKash_number')->nullable()->after('user_payment_option');
            $table->tinyInteger('status')->default(1)->after('user_bKash_number')->comment('0 = sold, 1 = available');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('second_hand_products', function (Blueprint $table) {
            $table->dropColumn(['user_payment_option', 'user_bKash_number', 'status']);
        });
    }
};
