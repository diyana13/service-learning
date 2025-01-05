<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    protected $fillable = [
        'project_id',
    ];

    public function members()
    {
        return $this->hasMany(GroupMembers::class, 'group_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
