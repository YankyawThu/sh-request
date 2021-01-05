<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Models\Role;

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
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => 'required',
            // 'password' => $this->passwordRules(),
            'password' => ['required', 'string']
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        switch ($input['role']) {
            case 'admin':
                $admin = Role::where('name' , 'admin')->first();
                $user->role()->attach($admin);
                break;
            case 'user':
                $notadmin = Role::where('name' , 'user')->first();
                $user->role()->attach($notadmin);
                break;
            default:
                # code...
                break;
        }
    }
}
