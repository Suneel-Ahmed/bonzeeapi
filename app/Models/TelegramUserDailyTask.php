<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramUserDailyTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'telegram_user_id',
        'daily_task_id',
        'completed',
        'submitted',
    ];

    /**
     * Get the telegram user that owns this daily task record.
     */
    public function telegramUser()
    {
        return $this->belongsTo(TelegramUser::class);
    }

    /**
     * Get the daily task associated with this record.
     */
    public function dailyTask()
    {
        return $this->belongsTo(DailyTask::class);
    }
}
