<?php

namespace App\Http\Controllers\Auth;

use App\user;
//use Lang;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

	 public function store(Request $request)
		{
			
				header('Access-Control-Allow-Origin: *');
				header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

							
				//se genera el token
				
				$opciones = ['cost' => 12,];
				
				$tk =  password_hash($request->input('name').md5(trim($request->input('password'))).date('YmdHis'), PASSWORD_BCRYPT, $opciones);
				
				$tk = str_replace('/', '_._', $tk);
				
				$tk = str_replace("'", '_.._', $tk);
				
				$tk = str_replace(".", '_,_', $tk);
				
				
								
				DB::table('user')->insert(
							array(
									'name'     			=> $request->input('name'),
									'email'   			=> strtolower($request->input('email')),
									'password'   		=> md5(trim($request->input('password'))),
									'emailReferred'		=> strtolower($request->input('emailrefered')),
									'ercWallet'			=> $request->input('ercWallet'),
									'confirmationCode'	=> $tk,
									'confirmedChecks'	=> 'NO',
									'emailconfirmed'	=> 'NO',
									
									'createDate'	=> date("Y-m-d H:m:s")
							)
					);
					
				//se envia el token al email del usuario

				$valores = array( 'email' => strtolower($request->input('email')));
					
				$data = array('name'=>"Mr(s). ".$request->input('name'), 
						"body" => 'To validate your account, proceed to open the link...',
						"url"=>"http://www.tokennow.gecko/tk/".$tk);
   
				Mail::send('email.activation', $data, function($message) use ($valores){	  
					
					$message->to($valores['email'], 'Validate email')
								->subject('Tokennow');
						
					$message->from('tokennows@tokennow.com','Messenger Service');
					
				});	
				
				Session::put('mensaje',trans("A validation link has been sent to your email, please access using that link"));
				
				return redirect('/');
				
			
		}
	
}
