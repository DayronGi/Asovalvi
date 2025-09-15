<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuarios específicos para pruebas usando updateOrCreate para evitar duplicados
        User::updateOrCreate(
            ['email' => 'admin@projectav.com'],
            [
                'first_name' => 'Admin',
                'last_name' => 'Sistema',
                'document_number' => '1234567890',
                'user_type' => 'Administrador(a)',
                'password' => Hash::make('admin123'),
                'status' => 2,
            ]
        );

        User::updateOrCreate(
            ['email' => 'secretaria@projectav.com'],
            [
                'first_name' => 'María',
                'last_name' => 'Secretaria',
                'document_number' => '0987654321',
                'user_type' => 'Secretario(a)',
                'password' => Hash::make('secretaria123'),
                'status' => 2,
            ]
        );

        User::updateOrCreate(
            ['email' => 'cartera@projectav.com'],
            [
                'first_name' => 'Carlos',
                'last_name' => 'Tesorero',
                'document_number' => '1122334455',
                'user_type' => 'Cartera',
                'password' => Hash::make('cartera123'),
                'status' => 2,
            ]
        );

        User::updateOrCreate(
            ['email' => 'miembro@projectav.com'],
            [
                'first_name' => 'Ana',
                'last_name' => 'Miembro',
                'document_number' => '5566778899',
                'user_type' => 'Miembro',
                'password' => Hash::make('miembro123'),
                'status' => 2,
            ]
        );

        // Solo crear usuarios aleatorios si no existen muchos usuarios ya
        $userCount = User::count();
        
        if ($userCount < 20) {
            // Crear usuarios aleatorios usando factories
            User::factory()
                ->administrator()
                ->count(2)
                ->create();

            User::factory()
                ->secretary()
                ->count(3)
                ->create();

            User::factory()
                ->wallet()
                ->count(2)
                ->create();

            User::factory()
                ->member()
                ->count(10)
                ->create();

            // Crear algunos usuarios inactivos
            User::factory()
                ->inactive()
                ->count(3)
                ->create();
        }
    }
}
