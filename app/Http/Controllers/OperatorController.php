<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Validator;
use App\User;

class OperatorController extends Controller {
    
    public function index(){
        $operators = User::whereHas('roles', function($query){
            $query->where('slug', 'operator');
        })->get();
        return view('operators.index')->with('operators', $operators);
    }

    public function store(Request $request){
        $operator_role = Role::where('slug', 'operator')->first();
        $operator_perm = Permission::where('slug','update-tasks')->first();
        $validator = Validator::make($request->all(), [
            'names'=> 'required|max:100',
            'family_names'=> 'required|max:100',
            'id_number'=> 'required|max:50|unique:users',
            'email'=> 'required|max:50|unique:users'
        ]);
        if ($validator->fails()) {
            $operator = User::where('available', 1)
                    ->where(function($query) use($request){
                        $query->where('names', $request->names);
                        $query->orWhere('family_names', $request->family_names);
                        $query->orWhere('id_number', $request->id_number);
                        $query->orWhere('email', $request->email);
                    })->first();
            if($operator){
                if($operator->available !== 1){
                    $operator->available = true;
                    $operator->save();
                    return response()->json([200, 'save', $operator]);
                }else {
                    $errors = $validator->errors();
                    return response()->json([500, 'save', $errors]);
                }
            } else {
                $operator = User::create($request->all());
                $operator->roles()->attach($operator_role);
                $operator->permissions()->attach($operator_perm);
                return response()->json([200, 'save', $operator]);
            }
        } else {
            $operator = User::create($request->all());
            $operator->roles()->attach($operator_role);
            $operator->permissions()->attach($operator_perm);
            return response()->json([200, 'save', $operator]);
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
            $operator = User::where('available', 1)
                    ->where(function($query) use($request){
                        $query->where('names', $request->names);
                        $query->orWhere('family_names', $request->family_names);
                        $query->orWhere('id_number', $request->id_number);
                        $query->orWhere('email', $request->email);
                    })->first();
            if($operator){
                if($operator->available !== 1){
                    $operator->available = true;
                    $operator->save();
                    return response()->json([200, 'update', $operator]);
                }elseif($operator->available == 1) {
                    $operator = User::find($request->id);
                    $operator->update($request->all());
                    return response()->json([200, 'update', $operator]);
                }else {
                    $errors = $validator->errors();
                    return response()->json([500, 'update', $errors]);
                }
            }
        } else {
            $operator = User::find($request->id);
            $operator->update($request->except(['id_number', 'email']));
            return response()->json([200, 'update', $operator]);
        }
    }

    /**
    	 *	Método para eliminar el registro dado
    	*/
        public function destroy(Request $request){
        	$operator = User::find($request->id);
        	if ($operator) {
                $operator->available = false;
                $operator->save();
        		return response()->json([200, 'delete']);
        	} else {
        		return response()->json([500, 'delete']);
        	}
        }

    public function getRecordFullInfo(Request $request) {
        $operator = User::find($request->id);
        if($operator) {
            return response()->json([200, 'info', $operator]);
        } else {
            return response()->json([404, 'info']);
        }
    }
}
