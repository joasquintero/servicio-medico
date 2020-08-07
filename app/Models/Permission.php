<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model {
    public $table = 'permissions';

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    
    public $fillable = [
        'name',
        'slug',
        'id_creator'
    ];

    public function roles(){
        return $this->belongsToMany(Role::class,'roles_permissions');
    }
}
