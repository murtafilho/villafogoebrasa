<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin
                            {--email= : Email do administrador}
                            {--password= : Senha do administrador}
                            {--name= : Nome do administrador}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria um usuario administrador';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $email = $this->option('email') ?? $this->ask('Email do administrador');
        $password = $this->option('password') ?? $this->secret('Senha do administrador');
        $name = $this->option('name') ?? $this->ask('Nome do administrador', 'Administrador');

        $existingUser = User::where('email', $email)->first();

        if ($existingUser) {
            // Atualizar senha se fornecida
            if ($password) {
                $existingUser->password = Hash::make($password);
                $existingUser->save();
                $this->info("Senha atualizada para o usuario: {$email}");
            }

            if (! $existingUser->hasRole('admin')) {
                $existingUser->assignRole('admin');
                $this->info("Role 'admin' atribuida ao usuario existente: {$email}");
            } else {
                $this->info("Usuario {$email} ja existe e ja e administrador.");
            }

            return self::SUCCESS;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'email_verified_at' => now(),
        ]);

        $user->assignRole('admin');

        $this->info("Administrador criado com sucesso: {$email}");

        return self::SUCCESS;
    }
}
