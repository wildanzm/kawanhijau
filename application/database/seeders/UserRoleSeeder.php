<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\PetaniProfile;
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

        // Create roles
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $rolePetani = Role::firstOrCreate(['name' => 'petani']);
        $roleUser = Role::firstOrCreate(['name' => 'user']);

        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password123')
            ]
        );
        if (!$admin->hasRole('admin')) {
            $admin->assignRole($roleAdmin);
        }

        // Create petani user
        $petani = User::firstOrCreate(
            ['email' => 'petani@gmail.com'],
            [
                'name' => 'Petani',
                'password' => Hash::make('password123')
            ]
        );
        if (!$petani->hasRole('petani')) {
            $petani->assignRole($rolePetani);
        }
        
        // Create petani profile if not exists
        if (!$petani->petaniProfile) {
            PetaniProfile::create([
                'user_id' => $petani->id,
                'phone_number' => '081234567890',
                'address' => 'Jl. Pertanian Organik No. 123, Bandung',
                'city' => 'Bandung',
                'farm_size' => 5.5,
                'farming_experience' => 'experienced',
                'verification_status' => 'approved',
                'bio' => 'Petani organik dengan pengalaman lebih dari 10 tahun',
            ]);
        }

        // Create regular user
        $user = User::firstOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'User',
                'password' => Hash::make('password123')
            ]
        );
        if (!$user->hasRole('user')) {
            $user->assignRole($roleUser);
        }
    }
}
