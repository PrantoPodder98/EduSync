<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalNoticeBoardAccommodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'unit_no',
        'property_type',
        'division',
        'area',
        'address',
        'map_link',
        'rent_type',
        'rent_amount',
        'advance_amount',
        'utility_bill',
        'bedrooms',
        'bathrooms',
        'balcony',
        'size_sqft',
        'contact_name',
        'contact_number',
        'user_id',
        'status',
        'is_approved',
        'bank_name',
        'bank_account_number',
        'bank_routing_number',
        'bkash_number'
    ];

    protected $casts = [
        'rent_amount' => 'integer',
        'advance_amount' => 'integer',
        'utility_bill' => 'integer',
        'bedrooms' => 'integer',
        'bathrooms' => 'integer',
        'balcony' => 'integer',
        'size_sqft' => 'integer'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'parentable');
    }

    public function reservations()
    {
        return $this->hasMany(RentalReservation::class, 'rental_notice_id');
    }
}
