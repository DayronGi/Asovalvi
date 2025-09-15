<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meeting>
 */
class MeetingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $adminUsers = User::where('user_type', 'Administrador(a)')->pluck('id');
        $secretaryUsers = User::where('user_type', 'Secretario(a)')->pluck('id');
        $allUsers = User::pluck('id');

        return [
            'meeting_date' => fake()->dateTimeBetween('-3 months', '+1 month')->format('Y-m-d'),
            'start_hour' => fake()->time('H:i'),
            'called_by' => fake()->randomElement($adminUsers),
            'director' => fake()->randomElement($adminUsers),
            'secretary' => fake()->randomElement($secretaryUsers),
            'placement' => fake()->address(),
            'meeting_description' => fake()->paragraph(3),
            'empty_field' => fake()->optional()->sentence(),
            'topics' => fake()->paragraph(2),
            'created_by' => fake()->randomElement($allUsers),
            'creation_date' => now(),
            'status' => fake()->randomElement([3, 4]), // Creado o Realizado
        ];
    }
}
