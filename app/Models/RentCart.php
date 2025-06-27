<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RentCart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'rent_item_id'
    ];

    /**
     * Get the user that owns the rent cart item.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the rent item associated with the rent cart item.
     */
    public function rentItem()
    {
        return $this->belongsTo(RentItem::class);
    }

    /**
     * Calculate total price for this rent cart item.
     */
    public function getTotalPriceAttribute()
    {
        return $this->rentItem->price ?? 0;
    }
}
