<?php

namespace App\Http\Controllers;


use App\user;
//use Lang;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;

class ApiloginController extends Controller
{
	/*
	 |--------------------------------------------------------------------------
	 | Login Controller
	 |--------------------------------------------------------------------------
	 |
	 | This controller handles authenticating users for the application and
	 | redirecting them to your home screen. The controller uses a trait
	 | to conveniently provide its functionality to your applications.
	 |
	 */
	 
	use AuthenticatesUsers;
	
	

	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/login';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest', ['except' => 'logout']);
	}


	public function showLoginForm()
	{
		@session_start();

		return redirect('/');
	}

	public function login(Request $request)
	{
		
		
		@session_start();
		
		//$idioma  = Lang::locale();
		
		$email=$request->input('email');

		$clave=$request->input('password');  

		$clave = md5($clave);

		//$regdatosuser = DB::select("SELECT * from user where id > 0"); print_r($regdatosuser); exit;

		$regdatosuser = DB::select("SELECT * from user where email = '".trim($email)."' and password = '".trim($clave)."'");
		
		//if (auth()->attempt(['email' => trim($email), 'password' => trim($clave)]))
		if (count($regdatosuser) > 0)
			{

				Session::put('id_usuario',$regdatosuser[0]->id);
				Session::put('nombre',$regdatosuser[0]->name);
				Session::put('confirmed',$regdatosuser[0]->confirmed);

				return response()->json((['status'=>'ok','code'=>200,'message'=>'Login Sucessfull ','name'=>$regdatosuser[0]->name,'data'=>$regdatosuser[0]->id,'confirmed'=>$regdatosuser[0]->confirmed]));
			}
		else
			{
				
				return response()->json((['status'=>'error','code'=>215,'message'=>'Invalid data']));
			}
			
	}
	
}
