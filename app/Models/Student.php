<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_code',
        'name',
        'dob',
        'gender',
        'email',
        'phone',
        'address',
        'department_id',
        'class_id',  
        'academic_year_id',
        'status'
    ];
  
    // Quan hệ
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }
     public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
   

}
