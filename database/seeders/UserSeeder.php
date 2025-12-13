<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@villafogoebrasa.com.br',
            'password' => Hash::make('Villa@2024'),
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');
        $this->command->info('Created admin user: admin@villafogoebrasa.com.br');

        // Create manager user
        $manager = User::create([
            'name' => 'Gerente Villa',
            'email' => 'gerente@villafogoebrasa.com.br',
            'password' => Hash::make('Villa@2024'),
            'email_verified_at' => now(),
        ]);
        $manager->assignRole('admin');
        $this->command->info('Created manager user: gerente@villafogoebrasa.com.br');

        // Create test user
        $test = User::create([
            'name' => 'Usuário Teste',
            'email' => 'teste@villafogoebrasa.com.br',
            'password' => Hash::make('teste123'),
            'email_verified_at' => now(),
        ]);
        $this->command->info('Created test user: teste@villafogoebrasa.com.br');

        // Create additional random users
        User::factory()->count(10)->create();
        $this->command->info('Created 10 random users');

        $this->command->info('Total users created: ' . User::count());
    }
}
