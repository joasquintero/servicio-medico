<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Background extends Model{
    protected $table = 'background';

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    protected $fillable = [
        'consultation_id',
        'illness_id',
        'relative'
    ];

    public function consultations(){
        return $this->belongsTo('App\Models\Consultation');
    }
}