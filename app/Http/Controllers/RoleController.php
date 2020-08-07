<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Validator;
use DB;

class RoleController extends Controller {
    
    public function index(){
        $roles = Role::where('available', true)->get();
        return view('roles.index')->with('roles', $roles);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name'=> 'required|max:50|unique:roles',
            'slug'=> 'required|max:50|unique:roles'
        ]);
        if ($validator->fails()) {
            $role = Role::where('available', 1)
                    ->where(function($query) use($request){
                        $query->where('name', $request->name);
                        $query->orWhere('slug', $request->slug);
                    })->first();
            // $role = Role::updateOrCreate(['name' => $request->name, 'slug' => $request->slug], ['available' => true]);
            if($role){
                if($role->available !== 1){
                    $role->available = true;
                    $role->save();
                    return response()->json([200, 'save', $role]);
                }else {
                    $errors = $validator->errors();
                    return response()->json([500, 'save', $errors]);
                }
            } else {
                $role = Role::create($request->all());
                return response()->json([200, 'save', $role]);
            }
        } else {
            $role = Role::create($request->all());
            return response()->json([200, 'save', $role]);
        }
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50|unique:roles',
            'slug' => 'required|max:50|unique:roles',
            'id'   => 'required'
        ]);
        if ($validator->fails()) {
            $role = Role::where('available', 1)
                    ->where(function($query) use($request){
                        $query->where('name', $request->name);
                        $query->orWhere('slug', $request->slug);
                    })->first();
            // $role = Role::updateOrCreate(['name' => $request->name, 'slug' => $request->slug], ['available' => true]);
            if($role){
                if($role->available !== 1){
                    $role->available = true;
                    $role->save();
                    return response()->json([200, 'update', $role]);
                }else {
                    $errors = $validator->errors();
                    return response()->json([500, 'update', $errors]);
                }
            } else {
                $role = Role::find($request->id);
                $role->update($request->except(['id']));
                return response()->json([200, 'update', $role]);
            }
        } else {
            $role = Role::find($request->id);
            $role->update($request->except(['id']));
            return response()->json([200, 'update', $role]);
        }
    }

    /**
     *	Método para eliminar el registro dado
    */
    public function destroy(Request $request){
        $role = Role::find($request->id);
        if ($role) {
            $role->available = false;
            $role->save();
            return response()->json([200, 'delete']);
        } else {
            return response()->json([500, 'delete']);
        }
    }

    public function getRecordFullInfo(Request $request) {
        $role = Role::find($request->id);
        if($role) {
            return response()->json([200, 'info', $role]);
        } else {
            return response()->json([404, 'info']);
        }
    }
}
