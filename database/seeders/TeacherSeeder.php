<?php

namespace Database\Seeders;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Department; 
class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $department = Department::first();
        $user = User::firstOrCreate(
    ['username' => 'teacher1'],   // kiểm tra username đã tồn tại chưa
    [
        'name' => 'Tran Van B',
        'email' => 'teacher1@example.com',
        'password' => Hash::make('123456'),
    ]
);

        Teacher::create([
            'user_id' => $user->id,
            'name' => 'Tran Van B', 
            'teacher_code' => 'GV001',
            'specialization' => 'Toán học',
            'department_id' => $department->id,
        ]);
    }
}
