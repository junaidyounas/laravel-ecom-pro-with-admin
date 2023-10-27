<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Jetstream\Jetstream;


class CustomAuthController extends Controller
{
    use PasswordValidationRules;

    //
    public function view_register()
    {
        return view('auth.shop-register');
    }

    public function create(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'shop_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'shop_name'),
                // Check uniqueness against the 'users' table and 'shop_name' column
            ],
        ]);

        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'shop_name' => $request->shop_name,
            'usertype' => '1',
            'is_active' => '0',
            'phone' => $request->phone,
            'post_code' => (string) $request->input('post_code'),
            'province' => $request->province,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        // return redirect()->route('order.confirmation', ['reference' => $reference]);

    }
}
