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
        $user = User::where('email', 'admin@admin.com')->first();

        if ($user) {
            // Ensure roles exist
            $roleName = 'super admin';
            Role::firstOrCreate(['name' => $roleName, 'guard_name' => 'web']);
            
            $user->assignRole($roleName);
            $this->command->info("Role '$roleName' assigned to {$user->email}");
        } else {
            $this->command->error("User with email 'admin@admin.com' not found.");
        }
    }
}
