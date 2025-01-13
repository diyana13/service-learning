<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rubrics extends Model
{
    protected $table = 'rubrics';

    protected $fillable = [
        'rubric_name',
    ];

    public function rubricsCriteria()
    {
        return $this->hasMany(RubricsCriteria::class, 'rubric_id');
    }

    public function projectRubric()
    {
        return $this->hasMany(ProjectRubric::class, 'rubric_id');
    }
}
