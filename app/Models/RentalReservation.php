<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_notice_id',
        'user_id',
        'first_name',
        'last_name',
        'company_name',
        'address',
        'country',
        'city',
        'zip_code',
        'email',
        'phone_number',
        'order_notes',
        'payment_method',
        'reservation_fee',
        'status',
        'payment_status',
        'payment_details',
        'reservation_code',
    ];

    protected $casts = [
        'payment_details' => 'array',
        'reservation_fee' => 'decimal:2',
    ];

    // Relationships
    public function rentalNotice()
    {
        return $this->belongsTo(RentalNoticeBoardAccommodation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getFormattedReservationFeeAttribute()
    {
        return number_format($this->reservation_fee, 2);
    }

    // Status check methods
    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isConfirmed()
    {
        return $this->status === 'confirmed';
    }

    public function isCancelled()
    {
        return $this->status === 'cancelled';
    }

    public function isPaid()
    {
        return $this->payment_status === 'paid';
    }
}