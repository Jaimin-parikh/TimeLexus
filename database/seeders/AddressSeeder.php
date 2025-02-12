<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $address = [
            'user_id'       => 1,
            'address_line'  => Str::random(20) . ' Street',
            'city'          => "Ahmedabad",
            'state'         => "Gujarat",
            'country'       => "India",
            'zip_code'      => "380053",
            'type'          => 1, // 1 = Shipping, 2 = Billing
            'is_default'    => 1,
            'created_at'    => now(),
            'updated_at'    => now(),
        ];
        DB::table('addresses')->insert($address);
    }
}
