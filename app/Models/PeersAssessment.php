<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeersAssessment extends Model
{
    protected $table = 'peers_assessments';

    protected $fillable = [
        'project_id',
        'group_id',
        'evaluator_id',
        'evaluatee_id',
        'score',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }

    public function evaluatee()
    {
        return $this->belongsTo(User::class, 'evaluatee_id');
    }
}
