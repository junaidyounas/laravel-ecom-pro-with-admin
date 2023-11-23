<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;


class VerificationController extends Controller
{
    public function verifyEmail($token)
    {
        $user = User::where('verification_token', $token)->first();
        if ($user) {
            // Mark the email as verified
            $user->update([
                'email_verified_at' => now(),
                'verification_token' => null,
                'is_active'=> True
            ]);

            // Send a welcome email or any other notification
            Mail::to($user->email)->send(new WelcomeEmail());

            Session::flash('message', "Email verified successfully. You can now log in.");
            return redirect('/user/login');
        } else {
            Session::flash('error', "Invalid verification token.");
            return redirect('/user/login');
        }
    }
}
