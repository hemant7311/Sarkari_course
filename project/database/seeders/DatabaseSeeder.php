<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ── Admin account ──────────────────────────────────────
        // Login: admin@sarkaricourse.com / Admin@123
        User::updateOrCreate(
            ['email' => 'admin@sarkaricourse.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('Admin@123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // ── Default categories (matches the exam category cards) ──
        collect(['SSC', 'Railway', 'Banking', 'UPSC', 'Police', 'State Exams'])
            ->each(fn ($name) => Category::firstOrCreate(['name' => $name]));
    }
}
