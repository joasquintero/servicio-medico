<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model{
    protected $table = 'diagnosis';

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    protected $fillable = [
        'consultation_id',
        'illness_id',
        'description'
    ];

    public function consultations(){
        return $this->belongsTo('App\Models\Consultation');
    }
}