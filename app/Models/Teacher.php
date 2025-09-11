<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Teacher extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'user_id',
        'teacher_code',
        'name',
        'dob',
        'gender',
        'email',
        'phone',
        'department_id',
        'class_id', 
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
    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
}
