<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentMark extends Model
{
    protected $table = 'student_marks';

    protected $fillable = [
        'student_id',
        'project_id',
        'lecturer_score',
        'assessor_score',
        'peers_score',
        'total_score',
    ];

    public function student()
    {
        return $this->belongsTo(User::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
