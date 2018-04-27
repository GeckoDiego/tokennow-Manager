<?php

namespace App\Http\Controllers;


use App\User;
use App\Paises;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Session;

class UsuarioController extends Controller
{
	
	
	

	public function kyc(Request $request)
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
		
		$repaises = DB::select("select id_pais,name FROM paises WHERE estado = 1");  
		
		if ($reguser[0]->kyc1confirmed == 'YES' and $reguser[0]->confirmedChecks == 'NO' and $reguser[0]->confirmed == 'NO')
			{
				return redirect('/kyc_confirmation'); 
			}
		else
			{	
				if ($reguser[0]->kyc1confirmed == 'YES' and $reguser[0]->confirmedChecks == 'YES' and $reguser[0]->confirmed == 'NO')
					{
						return redirect('/kyc_process'); 			
					}
				else
					{	
						if ($reguser[0]->kyc1confirmed == 'NO' and $reguser[0]->confirmedChecks == 'NO' and $reguser[0]->confirmed == 'NO')
							{
								return view('dashboard.kyc',compact('reguser'))->with( ['paises'=>$repaises]);
							}	
					}	
			}	
		
			
	}
	
	
	public function kyc_confirmation(Request $request)
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
		
		$reguser = DB::select("select * FROM user WHERE id = ".$idusu);	
		
		return view('dashboard.kyc_confirmation',compact('reguser'))->with( ['idusu'=>$idusu]);	
			
			
	}		
	
	public function profile(Request $request)
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
		
		$reguser = DB::select("select * FROM user WHERE id = ".$idusu);	
		
		return view('dashboard.profile',compact('reguser'))->with( ['idusu'=>$idusu]);	
			
			
	}		
	
	public function store(Request $request)
		{
			
			header('Access-Control-Allow-Origin: *');
			header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
			header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
			
			//para evitar el acceso sin logueo
			if (is_null(Session::get('id_usuario')))
				{
					return redirect('/'); 
				}
			if($request->hasFile('identificationImage') and $request->hasFile('selfie') )  
				{
													
					//se procesa el avatar
					
					$imagen1 = $request->file('identificationImage');    
					
					//cambiando el nombre del avatar para que no haya conflicto
					
					$timestamp = str_replace([' ', ':'], '', Carbon::now()->toDateTimeString());
				
					$nombreavatar = $timestamp. '_' .$imagen1->getClientOriginalName();  
					
					$imagen1->move(storage_path().'/app/img/perfiles/', $nombreavatar); 
					
					/****************************************/
					
					//se procesa la segunda imagen-
					
					$imagen2 = $request->file('selfie');    
					
					//cambiando el nombre de la imagen
					
					$timestamp = str_replace([' ', ':'], '', Carbon::now()->toDateTimeString());
				
					$nombreimg2 = $timestamp. '_' .$imagen2->getClientOriginalName();  
					
					$imagen2->move(storage_path().'/app/img/perfiles/', $nombreimg2); 
					
					//se graban los datos en la tabla correspondiente
					 
					DB::table('user')->where('id', '=',$request->input('idusuario'))
									->update(['name' => $request->input('name'),
									'email'=>$request->input('email'),
									'country'=>$request->input('country'),
									'identificationType'=>$request->input('identificationType'),
									'identification'=>$request->input('identification'),
									'birthdate'=>$request->input('birthdate'),
									'gender'=>$request->input('gender'),
									'identificationImage'=>$nombreavatar,
									'selfie'=>$nombreimg2,	
									'kyc1confirmed'=>'YES',			
									
									]);  
					
					return redirect('/kyc_confirmation'); 
					
					
				}	
			else
				{
					Session::put('mensajeerror',trans("An error occurred with uploading files, please check"));
    		
					return back();
				}	
				
		}
		
		//permite mostrar las imagenes desde el storage
		public function mostrar(Request $request, $filename)
			{
				if (is_null(Session::get('id_usuario')))
					{
						return redirect('/');
					}
				@session_start();
				
				$display = file_get_contents(storage_path('/app/img/perfiles/').$filename);
				
				return $display;
				
			}
			
		public function kycconfirmed(Request $request)
			{
				header('Access-Control-Allow-Origin: *');
				header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
			
				if (is_null(Session::get('id_usuario')))
					{
						return redirect('/');
					}
				@session_start();	
				
				//se actualiza el campo de confirmedChecks 
				
				DB::table('user')->where('id', '=',$request->input('idusuario'))
						->update(['confirmedChecks' => 'YES',							
						
						]);  
									
				return redirect('/dashboard'); 					
			
			}
			
			
		public function tk(Request $request,$token)
			{
				header('Access-Control-Allow-Origin: *');
				header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');                              
				
				@session_start();	
			
				$regdatosuser = DB::select("SELECT * from user where confirmationCode = '".trim($token)."'");
				
				if (count($regdatosuser) > 0)
					{
											
						if ($regdatosuser[0]->emailconfirmed == 'NO')
							{
								Session::put('id_usuario',$regdatosuser[0]->id);
								Session::put('nombre',$regdatosuser[0]->name);
								Session::put('confirmed',$regdatosuser[0]->confirmed);
								
								//se le coloca como email comprobado
								DB::table('user')->where('id', '=',$regdatosuser[0]->id)
												->update(['emailconfirmed' => 'YES',							
												
												]);  
												
								if ($regdatosuser[0]->confirmedChecks == 'YES')
									{
										return redirect('/dashboard');
									}
								else
									{	
										return redirect('/kyc');
									}					
							}
						else
							{		
								if ($regdatosuser[0]->emailconfirmed == 'YES')
									{
										return redirect('/readyemail');
									}	
							}		
					}	
			}

		public function cper(Request $request,$email)
			{
				header('Access-Control-Allow-Origin: *');
				header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');                              
				
				@session_start();	
				
				$regdatosuser = DB::select("SELECT * from user where email = '".trim($email)."'");
				
				if (count($regdatosuser) > 0)
					{
						if ($regdatosuser[0]->emailconfirmed == 'YES')
							{
								return 1;
							}	
						else
							{
								return 2;							
							}
					}
				else
					{
						return 3;		
					}
			}		
			
		public function updateprofile(Request $request)
			{
				header('Access-Control-Allow-Origin: *');
				header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
			
				if (is_null(Session::get('id_usuario')))
					{
						return redirect('/');
					}
				@session_start();	
				
				//se actualiza el campo de confirmedChecks 
				
				DB::table('user')->where('id', '=',$request->input('idusuario'))
									->update(['name' => $request->input('name'),
									'ercWallet' => $request->input('ercWallet'),
									
									]);  
									
				Session::put('mensaje',trans("the data was updated"));
    		
				return back();					
							
			
			}	
			
		public function change_password(Request $request)
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
				
				$reguser = DB::select("select * FROM user WHERE id = ".$idusu);	
				
				return view('dashboard.change_password',compact('reguser'))->with( ['idusu'=>$idusu]);	
					
					
			}		
			
			
		public function changepassword(Request $request)
			{
				header('Access-Control-Allow-Origin: *');
				header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
			
				if (is_null(Session::get('id_usuario')))
					{
						return redirect('/');
					}
				@session_start();	
				
				if (trim($request->input('passwordactual')) == '' and trim($request->input('passwordnew')) == '' and trim($request->input('passwordnew')) == '')
					{	
						Session::put('mensajeerror',trans("Empty data is not accepted"));
    		
						return back();
					}
				//se busca el password actual en la bd
				
				$reguser = DB::select("select * FROM user WHERE id = ".Session::get('id_usuario'));	
				
				$passactual = md5(trim($request->input('passwordactual')));
				
				if ($reguser[0]->password != $passactual)
					{
						Session::put('mensajeerror',trans("Does not match the current key"));
    		
						return back();
					}	
				
				$passwordnew = md5(trim($request->input('passwordnew')));
				
				$passwordnew = md5(trim($request->input('passwordnew')));
				
				
				//se actualiza el campo de confirmedChecks 
				
				DB::table('user')->where('id', '=',$request->input('idusuario'))
									->update(['password' => $passwordnew,
									
									]);  
									
				Session::put('mensaje',trans("the data was updated"));
    		
				return back();					
							
			
			}		
			
		public function verificapass(Request $request,$pass)
			{
				header('Access-Control-Allow-Origin: *');
				header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');                              
				
				@session_start();
				
				if (is_null(Session::get('id_usuario')))
					{
						return redirect('/');
					}
				
				$pass = md5(trim($pass));			
				
				$idusu = Session::get('id_usuario');  
				
				$regdatosuser = DB::select("SELECT id from user where password = '".trim($pass)."' and id = ".$idusu);
				
				if (count($regdatosuser) > 0)
					{
						
						return 1;
							
					}
				else
					{
						return 0;		
					}
			}	

	public function kyc_process(Request $request)
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
				
				$reguser = DB::select("select * FROM user WHERE id = ".$idusu);	
				
				return view('dashboard.kyc_process',compact('reguser'))->with( ['idusu'=>$idusu]);	
										
		}				


}
