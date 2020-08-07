<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Illness extends Model {
    protected $table = 'illnesses';

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    protected $fillable = [
        'name',
        'type',
        'description',
        'id_creator'
    ];

    /* public function users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    } */
}
