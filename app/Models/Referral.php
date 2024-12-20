<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;

    protected $fillable = [
        'referrer_id',  // ID of the user who sent the referral
        'referred_id',  // ID of the user who accepted the referral
        'referral_code', // Unique referral code
    ];

    /**
     * Get the user who sent the referral.
     */
    public function referrer()
    {
        return $this->belongsTo(TelegramUser::class, 'referrer_id');
    }

    /**
     * Get the user who was referred.
     */
    public function referred()
    {
        return $this->belongsTo(TelegramUser::class, 'referred_id');
    }
}
