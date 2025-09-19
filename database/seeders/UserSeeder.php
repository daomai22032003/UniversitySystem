<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin account
        DB::table('users')->updateOrInsert(
            ['username' => 'admin'],
            [
                'password' => Hash::make('12345'),
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 'admin',
            ]
        );

        // Teacher account
        DB::table('users')->updateOrInsert(
            ['username' => 'teacher1'],
            [
                'password' => Hash::make('12345'),
                'name' => 'Teacher One',
                'email' => 'teacher1@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 'teacher',
            ]
        );

        // Student account
        DB::table('users')->updateOrInsert(
            ['username' => 'student1'],
            [
                'password' => Hash::make('12345'),
                'name' => 'Student One',
                'email' => 'student1@gmail.com',
                'created_at' => now(),
                'updated_at' => now(),
                'role' => 'student',
            ]
        );
    }
}
