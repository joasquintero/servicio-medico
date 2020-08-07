<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model {
    protected $table = 'meetings';

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    protected $fillable = [
        'date',
        'hour',
        'to_consultation',
        'available',
        'patient_id',
        'doctor_id'
    ];

    public function users(){
        return $this->hasMany('App\User')->withTimestamps();
    }
    public function consultations(){
        return $this->hasMany('App\Models\Consultation');
    }
}
