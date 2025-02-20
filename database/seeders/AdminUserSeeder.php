<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Create an admin user with your details
        $adminUser = User::create([
            'name' => 'Marlon',
            'email' => 'Admin@test.com',
            'password' => bcrypt('admin'),
        ]);
    
        // Log the created user
        Log::info('Created user: ' . $adminUser->id);
    
        // Get the admin role
        $adminRole = Role::where('name', 'admin')->first();
    
        // If the admin role exists, assign it to the user
        if ($adminRole) {
            $adminUser->roles()->attach($adminRole->id);
            Log::info('Assigned role ' . $adminRole->id . ' to user ' . $adminUser->id);
        } else {
            Log::error('Admin role not found');
        }
    }
}
?>