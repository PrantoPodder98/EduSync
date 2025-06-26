<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecondHandProduct extends Model
{
    protected $table = 'second_hand_products';

    protected $fillable = [
        'name',
        'brand',
        'item_type',
        'item_state',
        'price',
        'description',
        'user_name', // Name of the user who posted the product
        'user_location', // Location of the user who posted the product
        'user_contact', // Contact information of the user who posted the product
        'user_id', // Foreign key for user who posted the product
        'user_payment_option', // Payment option selected by the user
        'user_bKash_number', // Bkash number if payment option is bkash
        'status', // 0 = sold, 1 = available
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'parentable');
    }
}
