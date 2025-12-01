<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $roleAdmin = Role::create(['name' => 'admin']);
        $roleFarmer = Role::create(['name' => 'farmer']);
        $roleUser = Role::create(['name' => 'user']);

        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123')
        ]);
        $admin->assignRole($roleAdmin);

        $farmer = User::create([
            'name' => 'Petani',
            'email' => 'petani@gmail.com',
            'password' => Hash::make('password123')
        ]);
        $farmer->assignRole($roleFarmer);

        $user = User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password123')
        ]);
        $user->assignRole($roleUser);
    }
}
