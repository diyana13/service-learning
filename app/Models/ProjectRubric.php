<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectRubric extends Model
{
    protected $table = 'project_rubrics';

    protected $fillable = [
        'project_id',
        'rubric_id',
        'role',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function rubric()
    {
        return $this->belongsTo(Rubrics::class, 'rubric_id');
    }
}
