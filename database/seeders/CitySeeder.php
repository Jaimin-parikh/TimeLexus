<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::factory(10)
        ->create()
        ->each(function($country) {
            // For each country, create 5 states
            State::factory(5)
                ->create(['country_id' => $country->id])
                ->each(function($state) {
                    // For each state, create 5 cities
                    City::factory(5)
                        ->create(['state_id' => $state->id]);
                });
        });
    }
}
