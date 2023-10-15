<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    //
    public function deleteImage($id)
    {
        $image = ProductImage::find($id);

        if ($image) {
            // Delete the image file from the folder
            $filePath = public_path('product_images/' . $image->image_name);

            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Delete the image record from the database
            $image->delete();

            return redirect()->back()->with('message', 'Image deleted successfully');
        } else {
            return redirect()->back()->with('message', 'Image not found or unable to delete');
        }
    }
}
