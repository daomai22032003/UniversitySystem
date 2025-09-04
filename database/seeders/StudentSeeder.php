<?php

namespace Database\Seeders;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;  
class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $user = User::updateOrCreate(
    ['username' => 'student1'],
    [
        'name' => 'Nguyen Van A',
        'email' => 'student1@example.com',
        'password' => Hash::make('123456'),
    ]
);

Student::updateOrCreate(
    ['user_id' => $user->id],
    [
        'student_code' => 'SV001',
        'name' => 'Nguyen Van A',
        'dob' => '2003-01-01',
        'department_id' => 1,
        'academic_year_id' => 1,
        'class_id' => 1,
    ]
);
    }
}
