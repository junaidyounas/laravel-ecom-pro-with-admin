<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class CustomAuthController extends Controller
{
    //
    public function view_register(){
        return view('auth.shop-register');
    }

        public function create(array $input): User
    {
        $input['usertype'] = '1'; // Replace with your desired value
    $input['is_active'] = false; // Replace with your desired value

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'shop_name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('users', 'shop_name'), // Check uniqueness against the 'users' table and 'shop_name' column
        ],
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'shop_name' => $input['shop_name'],
            'usertype' => $input['usertype'],
        'is_active' => $input['is_active'],
            'phone' => $input['phone'],
            'post_code' => $input['post_code'],
            'province' => $input['province'],
            'address' => $input['address'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
