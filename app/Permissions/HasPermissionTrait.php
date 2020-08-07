<?php
namespace App\Permissions;

use App\Models\Role;
use App\Models\Permission;

trait HasPermissionsTrait {
    // Relación de User a roles
    public function roles() {
        return $this->belongsToMany(Role::class,'users_roles');
  
     }
    //  Relación de User a permisos
     public function permissions() {
        return $this->belongsToMany(Permission::class,'users_permissions');
  
     }
    //  Función para verificar si el rol existe
     public function hasRole( $roles ) {
         if(is_array($roles)){
            foreach ($roles as $role) {
                if ($this->roles->contains('slug', $role)) {
                   return true;
                }
             }
         } else {
            if ($this->roles->contains('slug', $roles)) {
                return true;
             }
         }
        return false;
     }

    //  Función para ver si existe el permiso
     public function hasPermissionTo($permission) {
        return $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
     }
     
     protected function hasPermission($permission) {
        return (bool) $this->permissions->where('slug', $permission->slug)->count();
     }

    public function hasPermissionThroughRole($permission) {
        foreach ($permission->roles as $role){
           if($this->roles->contains($role)) {
              return true;
           }
        }
        return false;
    }

    
    // Método para dar permiso
    // El parametro debe ser un array
    public function givePermissionsTo($permissions) {
        $permissions = $this->getAllPermissions($permissions);
        // dd($permissions);
        if($permissions === null) {
           return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
     }

    //  Método para dar permiso a un usuario
     public function deletePermissions( $permissions ) {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
     }

    protected function getAllPermissions(array $permissions) {
        return Permission::whereIn('slug', $permissions)->get();
    }
}