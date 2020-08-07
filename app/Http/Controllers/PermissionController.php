<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Validator;
use DB;

class PermissionController extends Controller {
    
    public function index(){
        $permissions = Permission::where('available', true)->get();
        return view('permissions.index')->with('permissions', $permissions);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name'=> 'required|max:50|unique:permissions',
            'slug'=> 'required|max:50|unique:permissions'
        ]);
        if ($validator->fails()) {
            $permission = Permission::where('available', 1)
                    ->where(function($query) use($request){
                        $query->where('name', $request->name);
                        $query->orWhere('slug', $request->slug);
                    })->first();
            // $role = Role::updateOrCreate(['name' => $request->name, 'slug' => $request->slug], ['available' => true]);
            if($permission){
                if($permission->available !== 1){
                    $permission->available = true;
                    $permission->save();
                    return response()->json([200, 'save', $permission]);
                }else {
                    $errors = $validator->errors();
                    return response()->json([500, 'save', $errors]);
                }
            } else {
                $permission = Permission::create($request->all());
                return response()->json([200, 'save', $permission]);
            }
        } else {
            $permission = Permission::create($request->all());
            return response()->json([200, 'save', $permission]);
        }
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50|unique:permissions',
            'slug' => 'required|max:50|unique:permissions',
            'id'   => 'required'
        ]);
        if ($validator->fails()) {
            $permission = Permission::where('available', 1)
                    ->where(function($query) use($request){
                        $query->where('name', $request->name);
                        $query->orWhere('slug', $request->slug);
                    })->first();
            // $role = Role::updateOrCreate(['name' => $request->name, 'slug' => $request->slug], ['available' => true]);
            if($permission){
                if($permission->available !== 1){
                    $permission->available = true;
                    $permission->save();
                    return response()->json([200, 'update', $permission]);
                }else {
                    $errors = $validator->errors();
                    return response()->json([500, 'update', $errors]);
                }
            } else {
                $permission = Permission::find($request->id);
                $permission->update($request->except(['id']));
                return response()->json([200, 'update', $permission]);
            }
        } else {
            $permission = Permission::find($request->id);
            $permission->update($request->except(['id']));
            return response()->json([200, 'update', $permission]);
        }
    }

    /**
    	 *	Método para eliminar el registro dado
    	*/
        public function destroy(Request $request){
        	$permission = Permission::find($request->id);
        	if ($permission) {
                $permission->available = false;
                $permission->save();
        		return response()->json([200, 'delete']);
        	} else {
        		return response()->json([500, 'delete']);
        	}
        }

    public function getRecordFullInfo(Request $request) {
        $permission = Permission::find($request->id);
        if($permission) {
            return response()->json([200, 'info', $permission]);
        } else {
            return response()->json([404, 'info']);
        }
    }
}
