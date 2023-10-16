<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;
use App\Models\Category;
class Product extends Model
{
    use HasFactory;
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'discount_price',
        'quantity',
        'category_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            // Delete associated images from the storage folder
            foreach ($product->images as $image) {
                $imagePath = public_path('product_images/' . $image->image_name);

                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
