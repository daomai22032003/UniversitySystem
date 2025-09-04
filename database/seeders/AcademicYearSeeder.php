<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AcademicYear;

class AcademicYearSeeder extends Seeder
{
    public function run(): void
    {
        AcademicYear::create(['term_name' => '2023 - 2024']);
        AcademicYear::create(['term_name' => '2024 - 2025']);
        AcademicYear::create(['term_name' => '2025 - 2026']);
    }
}
