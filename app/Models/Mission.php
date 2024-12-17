<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'link',
        'code',
        'code_verify',
        'user_id', // Ensure 'image' is fillable
    ];

    public function getImageAttribute($value)
    {
        return $value ? env("APP_STORAGE_URL", "/") . '/storage' . $value : null;
    }


    public function user()
    {
        return $this->belongsTo(TelegramUser::class);
    }
}
