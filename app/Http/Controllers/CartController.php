<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    //
    public function add_to_cart($id){
        if (Auth::check()) {
            $user = Auth::user();
            $product = Product::find($id);
            return redirect()->back();
        }else{
            return view('/login');
        }
    }
}
