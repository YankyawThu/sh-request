<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $yan = User::create([
            'name' => 'YanKyaw Thu',
            'email' => 'yankyawthu@gmail.com',
            'password' => Hash::make('1234567890')
        ]);
        
        $guest = User::create([
            'name' => 'Guest',
            'email' => 'guest@gmail.com',
            'password' => Hash::make('1234567890'),
        ]);

        $admin = Role::where('name' , 'admin')->first();
        $user = Role::where('name' , 'user')->first();

        $yan->role()->attach($admin);
        $guest->role()->attach($user);
    }
}
