<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@dailist.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Free subscription for admin
        Subscription::create([
            'user_id' => $admin->id,
            'plan_type' => 'free',
            'status' => 'active',
            'started_at' => now(),
        ]);

        // Create Demo User (Free tier)
        $demoUser = User::create([
            'name' => 'Demo User',
            'email' => 'user@dailist.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        Subscription::create([
            'user_id' => $demoUser->id,
            'plan_type' => 'free',
            'status' => 'active',
            'started_at' => now(),
        ]);

        // Create Premium User
        $premiumUser = User::create([
            'name' => 'Premium User',
            'email' => 'premium@dailist.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        Subscription::create([
            'user_id' => $premiumUser->id,
            'plan_type' => 'premium',
            'status' => 'active',
            'started_at' => now(),
            'expired_at' => now()->addMonth(),
        ]);

        $this->command->info('Admin and demo users created successfully!');
        $this->command->info('Admin: admin@dailist.com / password');
        $this->command->info('User: user@dailist.com / password');
        $this->command->info('Premium: premium@dailist.com / password');
    }
}
