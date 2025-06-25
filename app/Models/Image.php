<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
   use HasFactory;

    protected $fillable = [
        'url',
        'type',
        'parentable_type',
        'parentable_id',
    ];

    public function parentable() {
        return $this->morphTo();
    }
}

