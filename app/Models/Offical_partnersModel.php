<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offical_partnersModel extends Model
{
    use HasFactory;

    protected $table = 'offical_partners';

    protected $fillable = [
        'partner_name',
        'partner_img'
    ];
}
