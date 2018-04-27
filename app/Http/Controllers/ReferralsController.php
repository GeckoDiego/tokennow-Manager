<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Session;

class ReferralsController extends Controller
{
	
	
	

	public function referrals(Request $request)
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
		
		$idusu = Session::get('id_usuario');  		
				
		//para evitar el acceso sin logueo
		if (is_null(Session::get('id_usuario')))
			{
				return redirect('/'); 
			}
				
		//se extraen los datos del usuario para el formulario
		
		$reguser = DB::select("select * FROM user WHERE id = ".$idusu);
		
		//se verifica cuantas referencias tiene
		
		$regreferr = DB::select("select count(id) as referrals FROM user WHERE emailReferred = '".$reguser[0]->email."'");
		  		
		return view('dashboard.referrals',compact('reguser'))->with( ['regreferr'=>$regreferr[0]->referrals]);
		
			
	}
	
	
	
}
