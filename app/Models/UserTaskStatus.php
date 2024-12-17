<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTaskStatus extends Model
{
    //
    use HasFactory;

    protected $fillable = ['user_id', 'task_id', 'is_verified'];

    public function task()
    {
        return $this->belongsTo(OfficalTask::class, 'task_id');
    }

    public function user()
    {
        return $this->belongsTo(TelegramUser::class, 'user_id');
    }
}
