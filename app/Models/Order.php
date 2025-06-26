<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'first_name',
        'last_name',
        'company_name',
        'address',
        'country',
        'region_state',
        'city',
        'zip_code',
        'email',
        'phone_number',
        'total_amount',
        'order_notes',
        'status',
        'payment_method',
        'payment_status',
        'bkash_number'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2'
    ];

    /**
     * Generate order number
     */
    public static function generateOrderNumber()
    {
        return 'ORD-' . date('Y') . '-' . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT);
    }

    /**
     * Get the user that owns the order
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the order items
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get full name
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}