<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

class Order extends Model
{
        protected $fillable = ['user_id'];

    use HasFactory;
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
