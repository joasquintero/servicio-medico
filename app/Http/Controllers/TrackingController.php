<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tracking;
use App\User;

class TrackingController extends Controller
{
    public function index(){
        $tracking = Tracking::where('available', true)->orderBy('created_at', 'desc')->get();
        return view('tracking.index')->with('tracking', $tracking);
    }

    public function store(Request $request){
        $tracking = Tracking::create([
            'user_id'       => $request->user_id,
            'user_rol_id'   => User::find($request->user_id)->roles()->first()->id,
            'action'        => $request->action,
            'module'        => $request->module
        ]);
    }

    public function destroy(Request $request){
        $tracking = Tracking::find($request->id);
        if ($tracking) {
            $tracking->available = false;
            $tracking->save();
            return response()->json([200, 'delete']);
        } else {
            return response()->json([500, 'delete']);
        }
    }
}
