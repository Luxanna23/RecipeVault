<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $create = Permission::firstOrCreate(['name' => 'create dishes']);
        $update = Permission::firstOrCreate(['name' => 'update dishes']);
        $delete = Permission::firstOrCreate(['name' => 'delete dishes']);

        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $admin->givePermissionTo([$create, $update, $delete]);

        if ($user = User::where('email', 'admin@gmail.com')->first()) {
            $user->assignRole('Admin');
        }
    }
}
