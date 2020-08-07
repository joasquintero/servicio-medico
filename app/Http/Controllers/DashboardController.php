<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Models\Tracking;
use Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $tracking = Tracking::where('available', true)->orderBy('created_at', 'desc')->paginate(3);
        $pat_meetings = Meeting::where(['patient_id'=> Auth::user()->id, 'available' => true])->get();
        $all_meetings = Meeting::where('available', true)->get();
        $doc_meetings = Meeting::where(['doctor_id'=> Auth::user()->id, 'available' => true])->get();
        return view('dashboard.index')->with([
            'pat_meetings' => $pat_meetings,
            'all_meetings' => $all_meetings,
            'doc_meetings' => $doc_meetings,
            'tracking'     => $tracking
        ]);
    }
}
