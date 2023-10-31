<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Product;
use Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Session;


class CustomAuthController extends Controller
{
    use PasswordValidationRules;
    public function redirect()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->usertype == '1') {
                if ($user->is_active == '1') {
                    return view('admin.home');
                } else {

                    Auth::logout(); // Log the user out
                    $products = Product::paginate(3);
                    Session::flash("message", "Shop is not activated yet");
                    return view('home.userpage', compact('products'));
                }
            } else {
                $products = Product::paginate(3);
                return view('home.userpage', compact('products'));
            }
        } else {
            $products = Product::paginate(3);
            return view('home.userpage', compact('products'));
        }
    }
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

        User::create([
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

        Session::flash('message', "Your shop has been successfully created. You'll receive a confirmation email shortly.");

        return redirect()->route('register/shop')->with('success', "Your shop has been successfully created. You'll receive a confirmation email shortly."); // Replace with your actual route
    }

    public function activate(User $user)
    {
        $user->update(['is_active' => true]);
        Session::flash('message', "User has been activated.");
        return redirect()->back();
    }

    public function deactivate(User $user)
    {
        $user->update(['is_active' => false]);
        Session::flash('message', "User has been deactivated.");
        return redirect()->back();
    }
}
