<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoundItems extends Model
{
    protected $table = 'found_items';

    protected $fillable = [
        'item_name',
        'location',
        'found_date',
        'description',
        'user_name',
        'contact_number',
        'user_id', // Foreign key for user who found the item
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function image()
    {
        return $this->morphOne(Image::class, 'parentable');
    }
}
