<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;
class Product extends Model
{
    use HasFactory;
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category',
        'price',
        'discount_price',
        'quantity',
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
