<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AssignSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure role exists
        $roleName = 'super admin';
        Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);

        $user = User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Super Admin',
                'password' => \Illuminate\Support\Facades\Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $user->assignRole($roleName);
        $this->command->info("User {$user->email} created/updated with role '$roleName'.");
    }
}
