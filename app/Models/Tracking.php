<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    protected $table = 'tracking';

    protected $fillable = [
        'user_id',
        'user_rol_id',
        'module',
        'action'
    ];
}
