<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'mission_id',
        ];

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

    public function userMissions()
    {
        return $this->hasMany(TelegramUserMission::class, 'mission_level_id');
    }
}



// <?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class MissionLevel extends Model
// {
//     use HasFactory;


//     public function mission()
//     {
//         return $this->belongsTo(Mission::class);
//     }

//      // Relationship with TelegramUserMission
//      public function telegramUserMissions()
//      {
//          return $this->hasMany(TelegramUserMission::class, 'mission_level_id');
//      }
// }
