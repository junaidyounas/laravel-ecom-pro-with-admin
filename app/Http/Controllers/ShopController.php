<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ShopController extends Controller
{
    //
    public function index(){
        $users = User::where('usertype', 1)->get();
        return view('admin.pages.shops', compact('users'));
    }
}
