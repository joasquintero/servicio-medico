<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $title = "this is index";
        return view('pages.index')->with('title', $title);
    }
    public function dailyAttention()
    {
        $title = "this is daily Attention";
        return view('pages.dailyCheck')->with('title', $title);
    }
    public function newPatient(){
        $title = "this is new Patient";
        return view('pages.newPatient')->with('title',$title);
    }
}
