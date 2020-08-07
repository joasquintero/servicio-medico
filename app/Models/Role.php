<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {
    protected $table = 'roles';

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
    protected $fillable = [
        'name',
        'slug'
    ];

    public function users(){
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class,'roles_permissions');
    }
}
