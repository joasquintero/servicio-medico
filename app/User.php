<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Permissions\HasPermissionsTrait as Permissions;

class User extends Authenticatable{
    use Notifiable;
    use Permissions; // Trait que contiene las funciones para el sistema de permisos

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at'
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'names', 
        'family_names', 
        'id_number', 
        'email', 
        'password',
        'phone',
        'address',
        'gender',
        'worker',
        'workdays',
        'major',
        'mention',
        'age',
        'id_creator',
        'birthdate',
        'entry_time',
        'exit_time',
        'birthplace',
    ];
}
