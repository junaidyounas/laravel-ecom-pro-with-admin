<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Validation\Rule;


class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        //     'shop_name' => [
        //     'required',
        //     'string',
        //     'max:255',
        //     Rule::unique('users', 'shop_name'), // Check uniqueness against the 'users' table and 'shop_name' column
        // ],
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            // 'shop_name' => $input['shop_name'],
            'phone' => $input['phone'],
            'post_code' => $input['post_code'],
            'province' => $input['province'],
            'address' => $input['address'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
