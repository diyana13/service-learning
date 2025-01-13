<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RubricsCriteria extends Model
{
    protected $table = 'rubrics_criterias';

    protected $fillable = [
        'rubric_id',
        'criteria_bi',
        'criteria_bm',
        'score',
    ];

    public function rubric()
    {
        return $this->belongsTo(Rubrics::class, 'rubric_id');
    }
}
