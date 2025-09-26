<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grades';

    protected $fillable = [
        'student_id',
        'course_id',
        'academic_year_id',
        'grade',
        'status'
    ];

    // Quan hệ: Mỗi grade thuộc về 1 sinh viên
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    // Quan hệ: Mỗi grade thuộc về 1 môn học
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // Quan hệ: Mỗi grade thuộc về 1 năm/kỳ học
    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }
}
