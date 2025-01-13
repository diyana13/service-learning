<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMembers extends Model
{
    protected $table = 'group_members';

    protected $fillable = [
        'group_id',
        'student_id',
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');
    }

    
}
