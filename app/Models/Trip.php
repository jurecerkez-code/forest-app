<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'start_time',
        'end_time',
        'duration',
        'satisfaction',
        'audio_file',
    ];
    
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function voiceSession()
    {
        return $this->hasOne(VoiceSession::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}