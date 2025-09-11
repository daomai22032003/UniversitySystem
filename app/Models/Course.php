<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_code',
        'course_name',
        'description',
        'department_id',
        'credit',
        'teacher_id',
        'status',
    ];
     public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
