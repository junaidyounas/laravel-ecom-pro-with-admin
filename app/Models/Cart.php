<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'reference'];

    protected $casts = [
        'cart_id' => 'integer',
    ];

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getGuestCart()
    {
        $sessionCartId = session('guest_cart_id');

        if ($sessionCartId) {
            // If a guest cart ID exists in the session, retrieve the cart
            return self::find($sessionCartId);
        } else {
            // If there's no guest cart ID in the session, create a new cart with a unique reference
            $cart = new Cart();
            $cart->reference = 'cart_' . time() . '_' . mt_rand(1000, 9999);
            $cart->save();

            // Store the newly created cart ID in the session
            session(['guest_cart_id' => $cart->id]);

            return $cart;
        }
    }
}