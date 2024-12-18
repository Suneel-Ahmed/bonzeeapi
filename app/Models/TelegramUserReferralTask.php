<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TelegramUserReferralTask extends Pivot
{
    protected $table = 'telegram_user_referral_task';

    protected $fillable = [
        'referral_task_id',
        'telegram_user_id',
        'is_completed',
    ];
}
