<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Validator;
use App\User;

class DoctorController extends Controller {
    
    /**
     * @todo filter by field available = true
     */
    public function index(){
        $doctors = User::whereHas('roles', function($query){
            $query->where('slug', 'doctor');
        })->get();
        return view('doctors.index')->with('doctors', $doctors);
    }

    public function store(Request $request){
        $doctor_role = Role::where('slug', 'doctor')->first();
        $doctor_perm = Permission::where('slug','create-tasks')->first();
        $validator = Validator::make($request->all(), [
            'names'=> 'required|max:100',
            'family_names'=> 'required|max:100',
            'id_number'=> 'required|max:50|unique:users',
            'email'=> 'required|max:50|unique:users'
        ]);
        if ($validator->fails()) {
            $doctor = User::where('available', 1)
                    ->where(function($query) use($request){
                        $query->where('names', $request->names);
                        $query->orWhere('family_names', $request->family_names);
                        $query->orWhere('id_number', $request->id_number);
                        $query->orWhere('email', $request->email);
                    })->first();
            if($doctor){
                if($doctor->available !== 1){
                    $doctor->available = true;
                    $doctor->save();
                    return response()->json([200, 'save', $doctor]);
                }else {
                    $errors = $validator->errors();
                    return response()->json([500, 'save', $errors]);
                }
            } else {
                $doctor = User::create($request->all());
                $doctor->roles()->attach($doctor_role);
                $doctor->permissions()->attach($doctor_perm);
                return response()->json([200, 'save', $doctor]);
            }
        } else {
            $doctor = User::create($request->all());
            $doctor->roles()->attach($doctor_role);
            $doctor->permissions()->attach($doctor_perm);
            return response()->json([200, 'save', $doctor]);
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
            $doctor = User::where('available', 1)
                    ->where(function($query) use($request){
                        $query->where('names', $request->names);
                        $query->orWhere('family_names', $request->family_names);
                        $query->orWhere('id_number', $request->id_number);
                        $query->orWhere('email', $request->email);
                    })->first();
            if($doctor){
                if($doctor->available !== 1){
                    $doctor->available = true;
                    $doctor->save();
                    return response()->json([200, 'update', $doctor]);
                }elseif($doctor->available == 1) {
                    $doctor = User::find($request->id);
                    $doctor->update($request->all());
                    return response()->json([200, 'update', $doctor]);
                }else {
                    $errors = $validator->errors();
                    return response()->json([500, 'update', $errors]);
                }
            }
        } else {
            $doctor = User::find($request->id);
            $doctor->update($request->except(['id_number', 'email']));
            return response()->json([200, 'update', $doctor]);
        }
    }

    /**
    	 *	Método para eliminar el registro dado
    	*/
        public function destroy(Request $request){
        	$doctor = User::find($request->id);
        	if ($doctor) {
                $doctor->available = false;
                $doctor->save();
        		return response()->json([200, 'delete']);
        	} else {
        		return response()->json([500, 'delete']);
        	}
        }

    public function getRecordFullInfo(Request $request) {
        $doctor = User::find($request->id);
        if($doctor) {
            return response()->json([200, 'info', $doctor]);
        } else {
            return response()->json([404, 'info']);
        }
    }

    public function indexDocWorkdays(){
        $doctors = User::whereHas('roles', function($query){
            $query->where('slug', 'doctor');
        })->get();
        return view('doctors.workdays')->with([
            'doctors' => $doctors
        ]);
    }
}
