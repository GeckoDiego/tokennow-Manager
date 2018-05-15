<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Response;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;

class LoginController extends Controller
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
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
        {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
            header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
            
            $email=strtolower($request->input('emaillogin'));

            $clave=$request->input('passwordlogin');  

            $clave = md5($clave);  
                    
            $regdatosuser = DB::select("SELECT * from user_admin where email = '".trim($email)."' and password = '".trim($clave)."'");
           
            if (count($regdatosuser) > 0)
            //if (auth()->attempt(['email' => trim($email), 'password' => trim($clave)]))
                {
                    $user = Auth::user(); 
                  
                    Session::put('id_usuario',$regdatosuser[0]->id);
                    
                    Session::put('name',$regdatosuser[0]->name);

                    Session::put('email',$regdatosuser[0]->email);
                                        
                    return redirect('/dashboard');	
                    
                }
            else
                {
                    
                    return redirect('/');
                    
                }
        }

    public function logout()
        {
            
            @session_start();
            
            Auth::logout();
            
            Session::flush();

            return redirect('/');
            
        }



}
