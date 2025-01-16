<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    protected $fillable = [
        'project_id',
        'group_number',
        'is_lecturer_evaluate',
        'is_assessor_evaluate',
        'is_peer_evaluate',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function members()
    {
        return $this->hasMany(GroupMembers::class, 'group_id');
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class, 'group_id');
    }

    public function peersAssessments()
    {
        return $this->hasMany(PeersAssessment::class, 'group_id');
    }
}
