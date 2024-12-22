<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethodLock extends Model
{
    use HasFactory;

    protected $table = 'payment_method_locks';

    protected $fillable = [
        'method',
        'locked',
    ];
}
