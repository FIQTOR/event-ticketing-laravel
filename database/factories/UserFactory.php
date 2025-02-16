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
     *
     * This static property holds the password that will be used for 
     * creating user instances. It is initialized only once to avoid 
     * hashing the password multiple times.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * This method returns an array of default values for the User model.
     * It includes a randomly generated name, a unique email address, 
     * the current timestamp for email verification, a hashed password, 
     * and a random remember token.
     *
     * @return array<string, mixed> The default state of the User model.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * This method modifies the state of the User model to set the 
     * 'email_verified_at' attribute to null, indicating that the 
     * email address has not been verified.
     *
     * @return static The updated UserFactory instance.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
