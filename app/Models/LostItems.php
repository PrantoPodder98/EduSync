<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LostItems extends Model
{
    protected $table = 'lost_items';

    protected $fillable = [
        'item_name',
        'location',
        'lost_date',
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
