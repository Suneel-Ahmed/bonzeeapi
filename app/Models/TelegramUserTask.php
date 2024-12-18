<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramUserTask extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'telegram_user_id',
        'task_id',
        'is_submitted',
        'is_rewarded',
        'submitted_at',
    ];

    public function telegramUser()
    {
        return $this->belongsTo(TelegramUser::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
