<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;
use App\Models\User;

class Order extends Model
{
    protected $fillable = ['user_id', 'reference', 'status', 'name', 'phone', 'address', 'province'];

    use HasFactory;

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // app/Models/Order.php
    public function markAsShipped()
    {
        $this->status = 'shipped';
        $this->save();
    }
}
