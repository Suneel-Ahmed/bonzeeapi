<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramUserMission extends Model
{
    use HasFactory;

    protected $fillable = [
        'telegram_user_id',
        'mission_level_id',
        'level',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'telegram_user_id');
    }

    public function missionLevel()
    {
        return $this->belongsTo(MissionLevel::class);
    }
}










// <?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class TelegramUserMission extends Model
// {
//     use HasFactory;

//     protected $guarded = [];

//     protected $fillable = ['user_id', 'mission_level_id'];

//     // Relationship with MissionLevel
//     public function missionLevel()
//     {
//         return $this->belongsTo(MissionLevel::class);
//     }
// }
