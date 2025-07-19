<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\WritingAnswer;

class OneSkillResult extends Model
{
    protected $fillable = [
        'user_id',
        'mock_test_id',
        'skill',                  // always "writing"
        'status',                 // e.g., reviewed
        'band_score',
        'task_response',
        'coherence_cohesion',
        'vocabulary',
        'grammar',
        'evaluation',
    ];

    protected $casts = [
        'evaluation' => 'array',
    ];

    public function test()
    {
        return $this->belongsTo(MockTest::class, 'mock_test_id');
    }

    public function writingAnswer()
    {
        return $this->hasOne(WritingAnswer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
