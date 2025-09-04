<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
