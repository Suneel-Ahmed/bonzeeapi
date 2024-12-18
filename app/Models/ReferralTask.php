<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralTask extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'number_of_referrals',
        'reward',
    ];

    /**
     * The users who have completed this referral task.
     */
    public function users()
    {
        return $this->belongsToMany(TelegramUser::class, 'telegram_user_referral_task')
            ->withPivot('is_completed')
            ->withTimestamps();
    }
}
