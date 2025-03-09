<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name'    => fake()->firstName(),
            'last_name'     => fake()->lastName(),
            'email'         => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'      => Hash::make('password'),
            "contact_number"=> str_replace("+","",fake()->unique()->e164PhoneNumber()),
            "role"          => rand(1,2),
            'profile_picture' => null,
            'status' => 1, // 1 = Active, 2 = Inactive, 3 = Banned
            'created_at' => fake()->dateTime(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
