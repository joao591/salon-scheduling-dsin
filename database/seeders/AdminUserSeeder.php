<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        $adminEmail = env('ADMIN_EMAIL', 'salon@adm.com');
        $adminPassword = env('ADMIN_PASSWORD', 'salon@123456');

        // Verifica se já existe um usuário administrador
        if (!User::where('email', $adminEmail)->exists()) {
            User::create([
                'name' => 'Administrador',
                'email' => $adminEmail,
                'password' => Hash::make($adminPassword),
                'role' => 'admin',
            ]);
        }
    }
}
