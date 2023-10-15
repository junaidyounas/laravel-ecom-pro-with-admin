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

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
