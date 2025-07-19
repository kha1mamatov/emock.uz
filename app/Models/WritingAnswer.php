<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WritingAnswer extends Model
{
    protected $fillable = [
        'one_skill_result_id',
        'answer',
        'word_count',
    ];

    public function result()
    {
        return $this->belongsTo(OneSkillResult::class, 'one_skill_result_id');
    }
}
