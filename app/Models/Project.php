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
        'mark_lecturer',
        'mark_student',
        'mark_assessor',
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
}
