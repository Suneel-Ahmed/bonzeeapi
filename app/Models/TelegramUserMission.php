<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramUserMission extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = ['user_id', 'mission_level_id'];

    // Relationship with MissionLevel
    public function missionLevel()
    {
        return $this->belongsTo(MissionLevel::class);
    }
}
