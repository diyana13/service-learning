<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'project_name',
        'project_code',
        'description',
        'max_groups',
        'max_group_members',
        'lecturer_id',
    ];

    public function lecturer()
    {
        return $this->belongsTo(User::class, 'lecturer_id');
    }

    public function groups()
    {
        return $this->hasMany(Group::class, 'project_id');
    }

    public function registrations()
    {
        return $this->hasMany(ProjectRegistration::class, 'project_id');
    }

    public function projectRubrics()
    {
        return $this->hasMany(ProjectRubric::class, 'project_id');
    }
}
