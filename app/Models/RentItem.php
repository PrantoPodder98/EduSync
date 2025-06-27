<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentItem extends Model
{
    protected $table = 'rent_items';

    protected $fillable = [
        'name',
        'brand',
        'item_type',
        'rent_type', // monthly or daily
        'rent_duration', // Duration in days for daily rent, or months for monthly rent
        'price',
        'description',
        'user_name', // Name of the user who posted the item
        'user_location', // Location of the user who posted the item
        'user_contact', // Contact information of the user who posted the item
        'user_id', // Foreign key for user who posted the item
        'user_payment_option', // Payment option selected by the user
        'user_bKash_number', // Bkash number if payment option is bkash
        'status', // 0 = rented, 1 = available
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'parentable');
    }

    public function rentOrderItems()
    {
        return $this->hasMany(RentOrderItem::class, 'rent_item_id');
    }
}
