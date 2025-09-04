<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'enrolled_at',
        'status',
    ];

    // Quan hệ với Student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Quan hệ với Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
