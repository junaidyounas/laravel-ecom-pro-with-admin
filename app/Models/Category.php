<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{
    protected $fillable = ['category_name', 'id'];

    use HasFactory;
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
