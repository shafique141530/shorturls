<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'user_role_id' => 1,
            'email_verified_at' => NULL,
            'created_by' => 0,
            'company_id' => 0,
            'password' => Hash::make('password@123'),
        ]);
    }
}
