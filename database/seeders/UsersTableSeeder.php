<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Administração
        User::create([
            'username' => 'admin',
            'email' => 'admin@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'role' => 'Administração',
        ]);

        // Professor
        User::create([
            'username' => 'professor',
            'email' => 'professor@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'role' => 'Professor',
        ]);

        // Aluno
        User::create([
            'username' => 'aluno',
            'email' => 'aluno@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123'),
            'role' => 'Aluno',
        ]);
    }
}
