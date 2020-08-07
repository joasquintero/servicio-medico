<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Illness;
use Validator;
use DB;

class IllnessController extends Controller {
    
    public function index(){
        $illnesses = Illness::where('available', true)->get();
        return view('illnesses.index')->with('illnesses', $illnesses);
    }

    public function getAll(){
        $illnesses = Illness::where('available', true)->get();
        return response()->json([200, 'panel', $illnesses]);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name'=> 'required|max:100|unique:illnesses'
        ]);
        if ($validator->fails()) {
            $illness = Illness::where('available', 1)
                    ->where(function($query) use($request){
                        $query->where('name', $request->name);
                    })->first();
            if($illness){
                if($illness->available !== 1){
                    $illness->available = true;
                    $illness->save();
                    return response()->json([200, 'save', $illness]);
                }else {
                    $errors = $validator->errors();
                    return response()->json([500, 'save', $errors]);
                }
            }
        } else {
            $illness = Illness::create($request->all());
            return response()->json([200, 'save', $illness]);
        }
    }

    public function update(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50|unique:roles',
            'id'   => 'required'
        ]);
        if ($validator->fails()) {
            $illness = Illness::where('available', 1)
                    ->where(function($query) use($request){
                        $query->where('name', $request->name);
                        $query->orWhere('slug', $request->slug);
                    })->first();
            if($illness){
                if($illness->available !== 1){
                    $illness->available = true;
                    $illness->save();
                    return response()->json([200, 'update', $illness]);
                }else {
                    $errors = $validator->errors();
                    return response()->json([500, 'update', $errors]);
                }
            }
        } else {
            $illness = Illness::find($request->id);
            $illness->update($request->except(['id']));
            return response()->json([200, 'update', $illness]);
        }
    }

    /**
    	 *	Método para eliminar el registro dado
    	*/
        public function destroy(Request $request){
        	$illness = Illness::find($request->id);
        	if ($illness) {
                $illness->available = false;
                $illness->save();
        		return response()->json([200, 'delete']);
        	} else {
        		return response()->json([500, 'delete']);
        	}
        }

    public function getRecordFullInfo(Request $request) {
        $illness = Illness::find($request->id);
        if($illness) {
            return response()->json([200, 'info', $illness]);
        } else {
            return response()->json([404, 'info']);
        }
    }
}
