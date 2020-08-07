<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model{
    protected $table = 'consultations';

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    protected $fillable = [
        'origin',
        'reference',
        'motives',
        'patient_id',
        'doctor_id',
        'meeting_id',
        'cih',
        'phisic_test',
        'available',
        'date',
        'id_creator'
    ];

    public function users(){
        return $this->hasMany('App\User')->withTimestamps();
    }
    public function backgrounds(){
        return $this->hasMany('App\Models\Background');
    }
    public function diagnosis(){
        return $this->hasMany('App\Models\Diagnosis');
    }
    public function tests(){
        return $this->hasMany('App\Models\Test');
    }
    public function treatments(){
        return $this->hasMany('App\Models\Treatment');
    }
    public function meetings(){
        return $this->belongsTo('App\Models\Meeting');
    }
}
