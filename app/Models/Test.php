<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model{
    protected $table = 'tests';

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    protected $fillable = [
        'name',
        'file',
        'consultation_id',
        'description'
    ];

    public function consultations(){
        return $this->belongsTo('App\Models\Consultation');
    }
}