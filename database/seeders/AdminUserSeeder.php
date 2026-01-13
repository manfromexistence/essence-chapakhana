<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'chapakhana@gmail.com'],
            [
                'name' => 'Chapakhana Admin',
                'password' => Hash::make(config('app.admin_default_password', 'Chapakhana@2026#Secure')),
                'is_admin' => true,
            ]
        );
    }
}
