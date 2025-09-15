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
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'document_number' => fake()->unique()->numerify('##########'),
            'user_type' => fake()->randomElement(['Administrador(a)', 'Secretario(a)', 'Cartera', 'Miembro']),
            'password' => static::$password ??= Hash::make('password'),
            'status' => 2, // Activo
        ];
    }

    /**
     * Create an administrator user.
     */
    public function administrator(): static
    {
        return $this->state(fn (array $attributes) => [
            'user_type' => 'Administrador(a)',
        ]);
    }

    /**
     * Create a secretary user.
     */
    public function secretary(): static
    {
        return $this->state(fn (array $attributes) => [
            'user_type' => 'Secretario(a)',
        ]);
    }

    /**
     * Create a wallet user.
     */
    public function wallet(): static
    {
        return $this->state(fn (array $attributes) => [
            'user_type' => 'Cartera',
        ]);
    }

    /**
     * Create a member user.
     */
    public function member(): static
    {
        return $this->state(fn (array $attributes) => [
            'user_type' => 'Miembro',
        ]);
    }

    /**
     * Create an inactive user.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 1, // Inactivo
        ]);
    }
}
