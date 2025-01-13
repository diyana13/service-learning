<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectRegistration extends Model
{
    protected $table = 'project_registrations';

    protected $fillable = [
        'project_id',
        'student_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function projects()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}
