<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RentOrderItem extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'order_id',
        'rent_item_id',
        'price'
    ];

    protected $casts = [
        'price' => 'decimal:2'
    ];

    /**
     * Get the order that owns the rent order item
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the rent item
     */
    public function rentItem()
    {
        return $this->belongsTo(RentItem::class);
    }
}
