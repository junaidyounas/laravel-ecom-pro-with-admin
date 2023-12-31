<?php

namespace App\Http\Controllers;

use App\Models\Category; // Import the Category model
use App\Models\Product; // Import the Category model

use App\Models\ProductImage;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    

    public function view_category()
    {
        $data = Category::all();
        return view('admin.category', compact('data'));
    }

    public function add_category(Request $request)
    {
        $data = new Category;
        $data->category_name = $request->category_name;
        $data->save();

        return redirect()->back()->with('message', 'Category added successfully');
    }

    public function delete_category($id)
    {
        $data = Category::find($id);
        // Delete the category and its associated products
        $data->products()->delete();
        $data->delete();
        return redirect()->back()->with('message', 'Category deleted successfully');
    }

    public function view_product()
    {
        $category = Category::all();
        return view('admin.product', compact('category'));
    }

    public function add_product(Request $request)
    {
        $product = new Product();

        $product->title = $request->title;
        $product->description = $request->description;
        $product->category_id = $request->category;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->quantity = $request->quantity;
        $product->save();

        // Handle image uploads
        if ($request->hasFile('images')) {
            $imagePaths = [];

            foreach ($request->file('images') as $file) {
                $originalName = $file->getClientOriginalName();
                $imageName = time() . '_' . $originalName;

                // Save the image to the 'product_images' folder
                $file->move('product_images', $imageName);
                $imagePaths[] = $imageName;

                // Create a ProductImage record
                $image = new ProductImage();
                $image->product_id = $product->id; // Associate the image with the product
                $image->image_name = $imageName;
                $image->save();
            }

            // Update the 'images' field in the 'products' table with a comma-separated list of image names
            $product->images = implode(',', $imagePaths);
        }


        return redirect()->back()->with('message', 'Product added successfully');
    }



    public function all_products()
    {
        $products = Product::all();
        return view('admin.all_products', compact('products'));
    }

    public function delete_product($id)
    {
        $data = Product::find($id);

        // Now delete the product
        $data->delete();
        return redirect()->back()->with('message', 'Product deleted successfully');
    }

    public function edit_product($id)
    {
        $product = Product::find($id);
        $category = Category::all();

        return view('admin.edit_product', compact('category', 'product'));
    }

    public function confirm_update_product(Request $request, $id)
    {
        $product = Product::find($id);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->category_id = $request->category;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->quantity = $request->quantity;

        // Handle image uploads (appending new images)
        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $file) {
                $originalName = $file->getClientOriginalName();
                $imageName = time() . '_' . $originalName;
                // Save the new image to the 'product_images' folder
                $file->move('product_images', $imageName);
                // Create a new ProductImage record
                $image = new ProductImage();
                $image->product_id = $product->id; // Associate the image with the product
                $image->image_name = $imageName;
                $image->save();
            }

        }

        $product->save();

        return redirect()->back()->with('message', 'Product updated successfully');
    }
}