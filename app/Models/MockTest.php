<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MockTest extends Model
{
    protected $fillable = [
        'title',
        'prompt',
        'model_answer',
        'task_type',      // task 1 or 2
        'writing_type',   // general or academic
        'categories',
    ];

    protected $casts = [
        'categories' => 'array',
        'writing_type' => 'array',
    ];

    public function results()
    {
        return $this->hasMany(OneSkillResult::class);
    }
}
