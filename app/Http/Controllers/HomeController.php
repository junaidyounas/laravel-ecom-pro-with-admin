<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    //
    public function index(){
        $products = Product::paginate(3);
        return view('home.userpage', compact('products'));
    }

    public function redirect(){

        if (Auth::check()) {
        $usertype = Auth::user()->usertype;

                if($usertype == '1'){
                    return view('admin.home');
                }else{
                    return view('home.userpage');
                }
        }

        
    }

    public function product_detail($id){
        $product = Product::find($id);

        return view('home.product_detail', compact('product'));
    }
}
