<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        DB::table('users')->insert([
            'username' => 'admin',
            'password' => Hash::make('123456'), // Mật khẩu admin
            'name'     => 'Admin',
            'email'    => 'admin@gmail.com',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
