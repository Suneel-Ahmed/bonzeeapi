<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class PaymentMethod extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'method',
        'account_holder_name',
        'account_number',
        'locked',
    ];

    public function user()
    {
        return $this->belongsTo(TelegramUser::class, 'user_id', 'id');
    }
}