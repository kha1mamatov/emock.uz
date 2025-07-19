<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // app/Models/User.php
    protected $fillable = ['name', 'email', 'google_id', 'avatar'];

    protected $hidden = ['role'];

    // Optional: fallback avatar
    public function getAvatarUrlAttribute()
    {
        return $this->avatar ?? '/images/default-avatar.png';
    }

    public function oneSkillResults()
    {
        return $this->hasMany(\App\Models\OneSkillResult::class);
    }

    public function loginLogs()
    {
        return $this->hasMany(LoginLog::class);
    }

    public function isAdmin()
    {
        return in_array($this->role, ['admin', 'boss']);
    }

    public function isBoss()
    {
        return $this->role === 'boss';
    }

    public function isTeacher()
    {
        return in_array($this->role, ['teacher', 'boss']);
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    public function reviewedResults()
    {
        return $this->hasMany(OneSkillResult::class, 'reviewed_by');
    }

}
