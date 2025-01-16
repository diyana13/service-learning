<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    protected $table = 'assessments';

    protected $fillable = [
        'project_id',
        'group_id',
        'assessor_id',
        'score',
        'comment',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function assessor()
    {
        return $this->belongsTo(User::class, 'assessor_id');
    }
}
