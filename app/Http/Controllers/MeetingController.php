<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;
use App\User;
use Validator;

class MeetingController extends Controller {
    
    public function index(){
        $meetings = Meeting::where('available', true)->get();
        $patients = User::whereHas('roles', function($query){
            $query->where('slug', 'patient');
        })->get();
        $doctors = User::whereHas('roles', function($query){
            $query->where('slug', 'doctor');
        })->get();
        return view('meetings.index')->with([
            'meetings'=> $meetings,
            'patients'=> $patients,
            'doctors'=> $doctors
            ]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'patient_id'=> 'required',
            'doctor_id'=> 'required',
            'date'=> 'required'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([500, 'save', $errors]);
        } else {
            $meeting = Meeting::create([
                'patient_id' => getUserId($request->patient_id),
                'doctor_id'  => getUserId($request->doctor_id),
                'date'       => $request->date,
                'hour'       => $request->hour
            ]);
            return response()->json([200, 'save', $meeting]);
        }
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'patient_id'=> 'required',
            'doctor_id'=> 'required',
            'date'=> 'required',
            'id'   => 'required'
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([500, 'update', $errors]);
        } else {
            $meeting = Meeting::find($request->id);
            $meeting->update([
                'patient_id' => getUserId($request->patient_id),
                'doctor_id'  => getUserId($request->doctor_id),
                'date'       => $request->date,
                'hour'       => $request->hour
            ]);
            return response()->json([200, 'update', $meeting]);
        }
    }

    /**
    	 *	Método para eliminar el registro dado
    	*/
        public function destroy(Request $request){
        	$meeting = Meeting::find($request->id);
        	if ($meeting) {
                $meeting->available = false;
                $meeting->save();
        		return response()->json([200, 'delete']);
        	} else {
        		return response()->json([500, 'delete']);
        	}
        }

    public function getRecordFullInfo(Request $request) {
        $meeting = Meeting::find($request->id);
        if($meeting) {
            return response()->json([200, 'info', $meeting]);
        } else {
            return response()->json([404, 'info']);
        }
    }
}
