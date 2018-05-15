<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $data = array(
            "label_caption" => 'Management Users'
        );  
        return view('dashboard/dashboard', compact('data'));
    }
}
