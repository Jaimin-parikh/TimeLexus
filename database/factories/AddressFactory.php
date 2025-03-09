<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'       => User::inRandomOrder()->first()->id, // Get random user_id
            'city_id'       => City::inRandomOrder()->first()->id, // Get random city_id
            'state_id'      => State::inRandomOrder()->first()->id, // Get random state_id
            'country_id'    => Country::inRandomOrder()->first()->id, // Get random country_id
            "address_line"  => fake()->sentence(),
            "zip_code"      => rand(3121432,986759),
            "type"          => rand(1,2),
            "is_default"    => rand(0,1),
            "created_at"    => fake()->dateTime(),
        ];
    }
}
