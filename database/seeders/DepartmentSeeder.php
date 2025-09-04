<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
         Department::create([
            'code' => 'CNTT',
            'name' => 'Công nghệ thông tin',
        ]);

        Department::create([
            'code' => 'KT',
            'name' => 'Kinh tế',
        ]);

        Department::create([
            'code' => 'NN',
            'name' => 'Ngoại ngữ',
        ]);
    }
}
