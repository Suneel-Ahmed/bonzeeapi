<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficalTask extends Model
{
    //
    use HasFactory;

    protected $fillable = ['name', 'link', 'code', 'image'];

    public function userStatuses()
    {
        return $this->hasMany(UserTaskStatus::class, 'task_id');
    }
    public function users()
    {
        return $this->belongsToMany(TelegramUser::class, 'user_task_statuses', 'task_id', 'user_id')
            ->withPivot('is_verified')  // Make sure 'is_verified' is included in the pivot
            ->withTimestamps();
    }
}
