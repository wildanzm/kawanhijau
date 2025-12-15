<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\PetaniProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        // Base validation rules
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'role' => ['required', 'string', Rule::in(['user', 'petani'])],
            'terms' => ['required', 'accepted'],
        ];

        // Add petani-specific validation rules if role is petani
        if (isset($input['role']) && $input['role'] === 'petani') {
            $rules = array_merge($rules, [
                'farm_name' => ['nullable', 'string', 'max:255'],
                'phone_number' => ['required', 'string', 'max:20'],
                'city' => ['nullable', 'string', 'max:100'],
                'farm_address' => ['required', 'string', 'max:500'],
                'farm_size' => ['nullable', 'numeric', 'min:0', 'max:10000'],
                'farming_experience' => ['nullable', 'string', Rule::in(['beginner', 'intermediate', 'experienced', 'expert'])],
                'bio' => ['nullable', 'string', 'max:1000'],
            ]);
        }

        // Validate input
        Validator::make($input, $rules, [
            'terms.required' => __('You must accept the terms and conditions.'),
            'terms.accepted' => __('You must accept the terms and conditions.'),
            'role.required' => __('Please select a role.'),
            'role.in' => __('Invalid role selected.'),
        ])->validate();

        // Create user and assign role in a transaction
        return DB::transaction(function () use ($input) {
            // Create the user
            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]);

            // Assign role using Spatie Permission
            $roleName = $input['role'] === 'petani' ? 'petani' : 'user';
            
            // Check if role exists, if not create it
            $role = \Spatie\Permission\Models\Role::firstOrCreate(['name' => $roleName]);
            $user->assignRole($role);

            // If user is petani, create petani profile
            if ($input['role'] === 'petani') {
                PetaniProfile::create([
                    'user_id' => $user->id,
                    'farm_name' => $input['farm_name'] ?? null,
                    'phone_number' => $input['phone_number'],
                    'city' => $input['city'] ?? null,
                    'address' => $input['farm_address'],
                    'farm_size' => $input['farm_size'] ?? null,
                    'farming_experience' => $input['farming_experience'] ?? null,
                    'bio' => $input['bio'] ?? null,
                    'verification_status' => 'pending',
                ]);
            }

            return $user;
        });
    }
}
