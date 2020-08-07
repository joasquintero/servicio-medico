<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Validator;
use App\User;

class UserController extends Controller {
    
    public function index(){
        $users = User::where('available', true)->get();
        return view('users.index')->with('users', $users);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'names'=> 'required|max:100',
            'family_names'=> 'required|max:100',
            'id_number'=> 'required|max:50|unique:users',
            'email'=> 'required|max:50|unique:users'
        ]);
        if ($validator->fails()) {
            $user = User::where('available', 1)
                    ->where(function($query) use($request){
                        $query->where('names', $request->names);
                        $query->orWhere('family_names', $request->family_names);
                        $query->orWhere('id_number', $request->id_number);
                        $query->orWhere('email', $request->email);
                    })->first();
            // $role = Role::updateOrCreate(['name' => $request->name, 'slug' => $request->slug], ['available' => true]);
            if($user){
                if($user->available !== 1){
                    $user->available = true;
                    $user->save();
                    return response()->json([200, 'save', $user]);
                }else {
                    $errors = $validator->errors();
                    return response()->json([500, 'save', $errors]);
                }
            } else {
                $user = User::create($request->all());
                $user->fill(['password' => bcrypt($request->password)])->save();
                return response()->json([200, 'save', $user]);
            }
        } else {
            $user = User::create($request->all());
            $user->fill(['password' => bcrypt($request->password)])->save();
            return response()->json([200, 'save', $user]);
        }
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'names'=> 'required|max:100',
            'family_names'=> 'required|max:100',
            'id_number'=> 'required|max:50|unique:users',
            'email'=> 'required|max:50|unique:users',
            'id'   => 'required'
        ]);
        if ($validator->fails()) {
            $user = User::where('available', 1)
                    ->where(function($query) use($request){
                        $query->where('names', $request->names);
                        $query->orWhere('family_names', $request->family_names);
                        $query->orWhere('id_number', $request->id_number);
                        $query->orWhere('email', $request->email);
                    })->first();
            // $role = Role::updateOrCreate(['name' => $request->name, 'slug' => $request->slug], ['available' => true]);
            if($user){
                if($user->available !== 1){
                    $user->available = true;
                    $user->save();
                    return response()->json([200, 'update', $user]);
                }else {
                    $errors = $validator->errors();
                    return response()->json([500, 'update', $errors]);
                }
            } else {
                $user = User::find($request->id);
                $user->update($request->except(['id']));
                $user->fill(['password' => bcrypt($request->password)])->save();
                return response()->json([200, 'update', $user]);
            }
        } else {
            $user = User::find($request->id);
            $user->update($request->except(['id']));
            $user->fill(['password' => bcrypt($request->password)])->save();
            return response()->json([200, 'update', $user]);
        }
    }

    /**
    	 *	Método para eliminar el registro dado
    	*/
        public function destroy(Request $request){
        	$user = User::find($request->id);
        	if ($user) {
                $user->available = false;
                $user->save();
        		return response()->json([200, 'delete']);
        	} else {
        		return response()->json([500, 'delete']);
        	}
        }

    public function getRecordFullInfo(Request $request) {
        $user = User::find($request->id);
        if($user) {
            return response()->json([200, 'info', $user]);
        } else {
            return response()->json([404, 'info']);
        }
    }

    // TODO: módulo para asignación de rol por el administrador
    public function indexRolPending(){
        $users = User::all();
        $roles = Role::where('slug', '!=', 'pending')->get();
        return view('users.admin.pending')->with([
            'users' => $users,
            'roles' => $roles        
        ]);
    }

    public function setUserRol(Request $request){
        $role = Role::where('slug', $request['role'])->get();
        $user = User::find($request['id']);
        $user->roles()->detach();
        $user->roles()->attach($role);
    }
}
