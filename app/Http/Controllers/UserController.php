<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::where('usertype', 0)->get();
        return view('admin.pages.shops', compact('users'));
    }
}
