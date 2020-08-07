<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Validator;
use App\User;

class PatientController extends Controller {
    
    public function index(){
        $patients = User::whereHas('roles', function($query){
            $query->where('slug', 'patient');
        })->get();
        return view('patients.index')->with('patients', $patients);
    }

    public function store(Request $request){
        $patient_role = Role::where('slug', 'patient')->first();
        $patient_perm = Permission::where('slug','view-tasks')->first();
        $validator = Validator::make($request->all(), [
            'names'=> 'required|max:100',
            'family_names'=> 'required|max:100',
            'id_number'=> 'required|max:50|unique:users',
            'email'=> 'required|max:50|unique:users'
        ]);
        if ($validator->fails()) {
            $patient = User::where('available', 1)
                    ->where(function($query) use($request){
                        $query->where('names', $request->names);
                        $query->orWhere('family_names', $request->family_names);
                        $query->orWhere('id_number', $request->id_number);
                        $query->orWhere('email', $request->email);
                    })->first();
            if($patient){
                if($patient->available !== 1){
                    $patient->available = true;
                    $patient->save();
                    return response()->json([200, 'save', $patient]);
                }else {
                    $errors = $validator->errors();
                    return response()->json([500, 'save', $errors]);
                }
            } else {
                $patient = User::create($request->all());
                $patient->roles()->attach($patient_role);
                $patient->permissions()->attach($patient_perm);
                return response()->json([200, 'save', $patient]);
            }
        } else {
            $patient = User::create($request->all());
            $patient->roles()->attach($patient_role);
            $patient->permissions()->attach($patient_perm);
            return response()->json([200, 'save', $patient]);
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
            $patient = User::where('available', 1)
                    ->where(function($query) use($request){
                        $query->where('names', $request->names);
                        $query->orWhere('family_names', $request->family_names);
                        $query->orWhere('id_number', $request->id_number);
                        $query->orWhere('email', $request->email);
                    })->first();
            if($patient){
                if($patient->available !== 1){
                    $patient->available = true;
                    $patient->save();
                    return response()->json([200, 'update', $patient]);
                }elseif($patient->available == 1) {
                    $patient = User::find($request->id);
                    $patient->update($request->all());
                    return response()->json([200, 'update', $patient]);
                }else {
                    $errors = $validator->errors();
                    return response()->json([500, 'update', $errors]);
                }
            }
        } else {
            $patient = User::find($request->id);
            $patient->update($request->except(['id_number', 'email']));
            return response()->json([200, 'update', $patient]);
        }
    }

    /**
    	 *	Método para eliminar el registro dado
    	*/
        public function destroy(Request $request){
        	$patient = User::find($request->id);
        	if ($patient) {
                $patient->available = false;
                $patient->save();
        		return response()->json([200, 'delete']);
        	} else {
        		return response()->json([500, 'delete']);
        	}
        }

    public function getRecordFullInfo(Request $request) {
        $patient = User::find($request->id);
        if($patient) {
            return response()->json([200, 'info', $patient]);
        } else {
            return response()->json([404, 'info']);
        }
    }
}
