<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoiceSession extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_id',
        'audio_file',
        'duration',
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}