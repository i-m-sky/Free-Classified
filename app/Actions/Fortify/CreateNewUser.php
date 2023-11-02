<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {

       // dd($input);
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^[6-9]\d{9}$/'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],

            'tnc' => ['required'],
            'password' => $this->passwordRules(),
        ], [

            'phone.regex' => "Phone number must be valid number.",
            'tnc.required' => "Please check term & condition."
        ])->validate();

        return User::create([
            'id' => getUniqueID(12, 'users', 'id'),
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => (isset($input['phone']) && !empty($input['phone'])) ? $input['phone'] : NULL,
            'status' => 'active',
            'user_type' => 2,
            'password' => Hash::make($input['password']),
        ]);
    }
}
