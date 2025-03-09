<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            'first_name'    => 'Jaimin',
            'last_name'     => 'Parikh',
            'email'         => 'parikhjaimin12@gmail.com',
            'password'      => Hash::make(MASTER_PASSWORD), // Default password: "password"
            'contact_number' => '9054196033',
            'is_admin'      => 1,
            'role'          => 0, // 1 = Customer, 2 = Vendor
            'profile_picture' => null,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'status'        => 1, // 1 = Active, 2 = Inactive, 3 = Banned
            'created_at'    => now(),
            'updated_at'    => now(),
        ];
        DB::table('users')->insert($user);
        User::factory(49)->create();
    }
}
