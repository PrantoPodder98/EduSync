<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * Get cart items with products
     */
    public function cartWithProducts()
    {
        return $this->hasMany(Cart::class)->with('secondHandProduct.images');
    }

    /**
     * Get the user's orders
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the user's rent cart items
     */
    public function rentCartItems()
    {
        return $this->hasMany(RentCart::class);
    }

    /**
     * Get rent cart items with rent items
     */
    public function rentCartWithItems()
    {
        return $this->hasMany(RentCart::class)->with('rentItem.images');
    }


}
