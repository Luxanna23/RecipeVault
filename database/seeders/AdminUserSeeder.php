<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin Toto',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123')],
        );
        $user->assignRole('Admin');
    }
}
