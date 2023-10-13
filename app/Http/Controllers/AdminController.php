<?php

namespace App\Http\Controllers;
use App\Models\Category; // Import the Category model
use App\Models\Product; // Import the Category model

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function view_category(){
        $data = Category::all();
        return view('admin.category', compact('data'));
    }

    public function add_category(Request $request){
        $data = new Category;
        $data->category_name = $request->category_name;
        $data->save();

        return redirect()->back()->with('message', 'Category added successfully');
    }

    public function delete_category($id){
        $data=Category::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Category deleted successfully');
    }

    public function view_product(){
        $category = Category::all();
        return view('admin.product', compact('category'));
    }

    public function add_product(Request $request){
        $product = new Product();

        $product->title = $request->title;
        $product->description = $request->description;
        $product->category = $request->category;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->quantity = $request->quantity;

        $image = $request->image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product', $imagename);
        $product->image=$imagename;

        $product->save();

        return redirect()->back()->with('message', 'Product added successfully');


    }
}
