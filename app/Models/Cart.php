<?php

namespace App\Models;
use App\Models\SecondHandProduct;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'second_hand_product_id'
    ];

    /**
     * Get the user that owns the cart item
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product associated with the cart item
     */
    public function secondHandProduct()
    {
        return $this->belongsTo(SecondHandProduct::class);
    }

    /**
     * Calculate total price for this cart item
     */
    public function getTotalPriceAttribute()
    {
        return $this->secondHandProduct->price ?? 0;
    }
}
