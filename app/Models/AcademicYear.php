<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
     protected $fillable = [
        'term_name',
        'start_date',
        'end_date',
        'status',
    ];
    public function classes()
{
    return $this->hasMany(Classroom::class, 'academic_year_id');
}
}

