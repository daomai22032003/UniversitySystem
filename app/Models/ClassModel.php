<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes';  // bảng trong DB
    protected $fillable = [
        'class_code',
        'class_name',
        'department_id',       
        'academic_year_id',
        'teacher_id', 
        'status'               
    ];

    // Quan hệ với Khoa
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // Quan hệ với Năm học
    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }
    
 
}
