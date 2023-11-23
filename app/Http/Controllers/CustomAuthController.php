<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\PasswordValidationRules;
use App\Mail\CustomEmail;
use App\Models\Product;
use Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Notifications\VerifyEmailNotification;


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
                $user = auth()->user();

                if ($user->is_active) {
                    $products = Product::paginate(3);
                    return view('home.userpage', compact('products'));
                } else {
                    // User is not active, logout and show an error message
                    auth()->logout();
                    Session::flash('error', 'Your account is not active. Please contact the administrator.');
                    return back();
                }

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

    public function view_user_register()
    {
        return view('auth.register');
    }

    public function create_user(Request $request)
    {

        $verificationToken = Str::random(60);


        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:15'],
            'province' => ['required', 'string', 'max:30'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'verification_token' => $verificationToken,
            'usertype' => '0',
            'is_active' => '0',
            'phone' => $request->phone,
            'post_code' => (string) $request->input('post_code'),
            'province' => $request->province,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        $verificationLink = route('verification.verifyEmail', ['token' => $verificationToken]);
        Mail::to($user->email)->send(new CustomEmail('Welcome to ChungiApp', "$verificationLink"));

        Session::flash('message', "Your account has been successfully created. You'll receive a confirmation email shortly.");

        return redirect()->route('user/register')->with('success', "Your account has been successfully created. You'll receive a confirmation email shortly."); // Replace with your actual route
    }

    public function create(Request $request)
    {
        $verificationToken = Str::random(60);
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

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'verification_token' => $verificationToken,
            'shop_name' => $request->shop_name,
            'usertype' => '1',
            'is_active' => '0',
            'phone' => $request->phone,
            'post_code' => (string) $request->input('post_code'),
            'province' => $request->province,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        $verificationLink = route('verification.verifyEmail', ['token' => $verificationToken]);
        Mail::to($user->email)->send(new CustomEmail('Welcome to ChungiApp', "$verificationLink"));
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

    public function user_login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            // Check if the user is active
            $user = auth()->user();

            if ($user->is_active) {
                // User is active, redirect to the intended page after login
                return redirect()->intended('/');
            } else {
                // User is not active, logout and show an error message
                auth()->logout();
                Session::flash('error', 'Your account is not active. Please contact the administrator.');
                return back();
            }
        } else {
            // Invalid email or password
            Session::flash('error', 'Invalid email or password');
            return back();
        }
    }

    public function show_user_login()
    {
        if (Auth::check()) {
            return redirect()->intended('/'); // Redirect to the intended page after login
        }
        return view('auth.user-login');
    }

    public function logout(Request $request)
    {
        // Add your custom logout logic here, if needed

        Auth::logout(); // This will log the user out

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
