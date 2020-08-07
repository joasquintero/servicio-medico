<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Treatment extends Model {
    protected $table = 'treatments';

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    protected $fillable = [
        'name',
        'description',
        'id_creator'
    ];

    public function consultations(){
        return $this->belongsTo('App\Models\Consultation');
    }
}
