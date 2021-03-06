<?php

namespace App\Http\Controllers;


use App\User;
use App\Countries;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Session;
use Mail;

class UsuarioController extends Controller
{


	public function createThumb($isdir,$sImagen, $nWidth = false, $nHeight = false){

		$sNombre = null;
		$sPath = null;
		$sExt = null;
		$aImage = null;
		$aThumb = null;
		$aImageMarco = null;
		$ImTransparente = null;
		$aSize = null;
		$nWidthMarco = false;
		$nWidthHeight = false;
		$nX = false;
		$nY = false;
	
		// Obtenemos el nombre de la imagen
		$sNombre = basename( $sImagen );
		// Obtenemos la ruta especificada para buscar la imagen
		$sPath = dirname( $sImagen ) . '/';
		// Obtenemos la extension de la imagen
		$sExt = mime_content_type( $sImagen );
		
		// Creamos el directorio thumbs
		if (!file_exists($isdir.'thumbnail/')) 
			{
				
				@mkdir( $isdir . 'thumbnail/', 0777, true ) or die( 'No se ha podido crear el directorio "' . $isdir . 'thumbnail/".' );
			}	
		//if( ! is_dir( $sPath . 'thumbnail/' ) )
			
	   
		// Creamos la imagen a partir del tipo
		switch( $sExt )
		{
			// Imagen JPG
			case 'image/jpeg':
				$aImage = @imageCreateFromJpeg( $sImagen );
				break;
			// Imagen GIF
			case 'image/gif':
				$aImage = @imageCreateFromGif( $sImagen );
				break;
			// Imagen PNG
			case 'image/png':
				$aImage = @imageCreateFromPng( $sImagen );
				break;
			// Imagen BMP
			case 'image/wbmp':
				$aImage = @imageCreateFromWbmp( $sImagen );
				break;
			default:
				return 'No se conoce el tipo de imagen enviado, por favor cambie el formato. Sólo se permiten imágenes *.jpg, *.gif, *.png ó *.bmp.';
				break;
		}
	
		// Obtenemos el tamaño de la imagen original
		$aSize = getImageSize( $sImagen );
	
		// Calculamos las proporciones de la imagen //
	
		// Obteniendo el alto (Recogiendo ancho y no alto)
		if( $nWidth !== false && $nHeight === false )
			$nHeight = round( ( $aSize[1] * $nWidth ) / $aSize[0] );
		// Obteniendo el ancho (Recogiendo alto y no ancho)
		elseif( $nWidth === false && $nHeight !== false )
			$nWidth = round( ( $aSize[0] * $nHeight ) / $aSize[1] );
		// Obteniendo proporciones (Recogiendo alto y ancho)
		elseif( $nWidth !== false && $nHeight !== false )
		{
			// Guardamos las dimensiones del marco
			$nWidthMarco = $nWidth;
			$nHeightMarco = $nHeight;
	
			// Si el ancho es mayor
			if( $nWidth < $nHeight )
			{
				$nHeight = round( ( $aSize[1] * $nWidth ) / $aSize[0] );
				$nX = 0;
				$nY = round( ( $nHeightMarco - $nHeight ) / 2 );
			}
			// Si el alto es mayor
			elseif( $nHeight < $nWidth )
			{
				$nWidth = round( ( $aSize[0] * $nHeight ) / $aSize[1] );
				$nX = round( ( $nWidthMarco - $nWidth ) / 2 );;
				$nY = 0;
			}
		}
		// El ancho y el alto no se han enviado, informamos del error
		elseif( $nWidth === false && $nHeight === false )
			return 'No se ha especificado ningún valor para el ancho y el alto de la imágen.';
	
		// La nueva imagen reescalada
		$aThumb = imageCreateTrueColor( $nWidth, $nHeight );
	
		// Reescalamos
		imageCopyResampled( $aThumb, $aImage, 0, 0, 0, 0, $nWidth, $nHeight, $aSize[0], $aSize[1] );
	
		// Si tenemos que crear el marco
		if( $nWidthMarco !== false && $nHeightMarco !== false )
		{
			// El marco
			$aImageMarco = imageCreateTrueColor( $nWidthMarco, $nHeightMarco );
	
			// Establecemos la imagen de fondo transparente
			imageAlphaBlending( $aImageMarco, false );
			imageSaveAlpha( $aImageMarco, true );
	
			// Establecemos el color transparente (negro)
			$ImTransparente = imageColorAllocateAlpha( $aImageMarco, 0, 0, 0, 0xff/2 );
	
			// Ponemos el fondo transparente
			imageFilledRectangle( $aImageMarco, 0, 0, $nWidthMarco, $nHeightMarco, $ImTransparente );
	
			// Combinamos las imagenes
			imageCopyResampled( $aImageMarco, $aThumb, $nX, $nY, 0, 0, $nWidth, $nHeight, $nWidth, $nHeight );
	
			// Cambiamos la instancia
			$aThumb = $aImageMarco;
		}
	
		// Salvamos
		imagePng( $aThumb, $isdir . 'thumbnail/' . $sNombre );
	
		// Liberamos
		imageDestroy( $aImage );
		imageDestroy( $aThumb );

		return 1;


	}	
	
	public function kyc(Request $request)
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
		
		$idusu = Session::get('id_usuario');  
		
		@session_start();
		
		//para evitar el acceso sin logueo
		if (is_null(Session::get('id_usuario')))
			{
				return redirect('/'); 
			}
		
		
		//se extraen los datos del usuario para el formulario
		
		$reguser = DB::select("select * FROM user WHERE id = ".$idusu);
		
		Session::put('kyc1confirmed',$reguser[0]->kyc1confirmed);

		Session::put('confirmedChecks',$reguser[0]->confirmedChecks);
		
		Session::put('confirmed',$reguser[0]->confirmed);
   
   

		$repaises = DB::select("select id_country, name FROM countries WHERE estado = 1 order by name asc");  
		
		if( $reguser[0]->kyc1confirmed == 'NO' and $reguser[0]->confirmedChecks == 'YES' and $reguser[0]->confirmed == 'YES' ){
			return view('dashboard.kyc',compact('reguser'))->with( ['paises'=>$repaises]);
		}		
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
						else
							{
								if ($reguser[0]->kyc1confirmed == 'YES' and $reguser[0]->confirmedChecks == 'YES' and $reguser[0]->confirmed == 'YES')
									{
										return view('dashboard.kyc_actived',compact('reguser'))->with( ['paises'=>$repaises]);
									}	
								else
									{
										if ($reguser[0]->kyc1confirmed == 'YES' and $reguser[0]->confirmedChecks == 'YES' and $reguser[0]->confirmed == 'REC')
											{
												//se busca el motivo por el cual fue rechazado
												$regmotivo = DB::select("select reason FROM history_confirmed WHERE id_user = ".$idusu." order by id desc limit 1");  
												
												return view('dashboard.kyc',compact('reguser'))->with( ['paises'=>$repaises,'regmotivo'=>$regmotivo[0]->reason]);
											}	
										else
                      {
												if( $reguser[0]->kyc1confirmed == 'NO' and $reguser[0]->confirmedChecks == 'YES' and $reguser[0]->confirmed == 'NO' )
                          {
														return view('dashboard.kyc',compact('reguser'))->with( ['paises'=>$repaises]);
													}
                         else
                           {
                               if( $reguser[0]->kyc1confirmed == 'NO' and $reguser[0]->confirmedChecks == 'YES' and $reguser[0]->confirmed == 'NO' )
                                {
      														
                                  return redirect('/kyc_process');                                                                                                                        
      													}
                           }                                                                                                              
										   }
									}		
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
        
      if ($request->input('identificationImageorig') == '' and  $request->input('selfieorig') != '' )
        {   //se sube solo el avatar
            if($request->hasFile('identificationImage') )  
				      {
                   //se procesa el avatar
					
        					$imagen1 = $request->file('identificationImage');    
        					
        					//cambiando el nombre del avatar para que no haya conflicto
        					
        					$timestamp = str_replace([' ', ':'], '', Carbon::now()->toDateTimeString());
        				
        					$nombreavatar = $timestamp. '_' .$imagen1->getClientOriginalName();  
        					
							$imagen1->move(storage_path().'/app/img/perfiles/', $nombreavatar); 
							
							$this->createThumb(storage_path().'/app/img/perfiles/',storage_path().'/app/img/perfiles/'.$nombreavatar, $nWidth = 100);
        					
        					/****************************************/
        					
                 			 $nombreimg2 = $request->input('selfieorig');
        					        					
        					//se graban los datos en la tabla correspondiente
        					 
        					DB::table('user')->where('id', '=',$request->input('idusuario'))
        									->update(['name' => $request->input('name'),
                           					'lastname'=>$request->input('lastname'),                                      
        									//'email'=>$request->input('email'),
        									'country'=>$request->input('country'),
        									'identificationType'=>$request->input('identificationType'),
        									'identification'=>$request->input('identification'),
        									'birthdate'=>$request->input('birthdate'),
        									'gender'=>$request->input('gender'),
        									'identificationImage'=>$nombreavatar,
        									'selfie'=>$nombreimg2,	
											'kyc1confirmed'=>'YES',		
											'confirmed'	=> 'NO',	
        									
											]);  
							//se verifica si viene o no de un rechazo del admin
							
							$reguserverif = DB::select("select u.confirmedChecks FROM user u  WHERE u.id = ".$request->input('idusuario'));

							if ($reguserverif[0]->confirmedChecks == 'NO')
								{
									return redirect('/kyc_confirmation');        	
								}
							else
								{
									if ($reguserverif[0]->confirmedChecks == 'YES')
										{
											return redirect('/kyc_process');        	
										}
								}	
                 					                                             
              }
            else
              {  
                Session::put('mensajeerror',trans("An error occurred with uploading files, please check"));
    		
					      return back();  
              }                                             
        }
     else
         {
             if ($request->input('identificationImageorig') != '' and  $request->input('selfieorig') == '' )
                {
                    if($request->hasFile('selfie') )  
				                {
                              			//se procesa el avatar
                              
                             			 $nombreavatar = $request->input('identificationImageorig');  
								
                    					/****************************************/
                    					
                    					//se procesa la segunda imagen-
                    					       					  
                    					$imagen2 = $request->file('selfie');    
                    					//cambiando el nombre de la imagen
                    					
                    					$timestamp = str_replace([' ', ':'], '', Carbon::now()->toDateTimeString());
                    				
                    					$nombreimg2 = $timestamp. '_' .$imagen2->getClientOriginalName();  
                    					
										$imagen2->move(storage_path().'/app/img/perfiles/', $nombreimg2); 
										
										$this->createThumb(storage_path().'/app/img/perfiles/',storage_path().'/app/img/perfiles/'.$nombreimg2, $nWidth = 100);
                    					
                    					//se graban los datos en la tabla correspondiente
                    					 
                    					DB::table('user')->where('id', '=',$request->input('idusuario'))
                    									->update(['name' => $request->input('name'),
                                      					'lastname'=>$request->input('lastname') ,                                                      
                    									//'email'=>$request->input('email'),
                    									'country'=>$request->input('country'),
                    									'identificationType'=>$request->input('identificationType'),
                    									'identification'=>$request->input('identification'),
                    									'birthdate'=>$request->input('birthdate'),
                    									'gender'=>$request->input('gender'),
                    									'identificationImage'=>$nombreavatar,
                    									'selfie'=>$nombreimg2,	
														'kyc1confirmed'=>'YES',	
														'confirmed'	=> 'NO',			
                    									
                    									]);   
                                                                             
										//return redirect('/kyc_confirmation');    
										$reguserverif = DB::select("select u.confirmedChecks FROM user u  WHERE u.id = ".$request->input('idusuario'));

										if ($reguserverif[0]->confirmedChecks == 'NO')
											{
												return redirect('/kyc_confirmation');        	
											}
										else
											{
												if ($reguserverif[0]->confirmedChecks == 'YES')
													{
														return redirect('/kyc_process');        	
													}
											}	                                         
                        }                                           
                    else
                      {
                          Session::put('mensajeerror',trans("An error occurred with uploading files, please check"));
    		
					                return back();  
                      }
                }
             else
               {
                    if ($request->input('identificationImageorig') == '' and  $request->input('selfieorig') == '' )
                      {
                          if($request->hasFile('identificationImage') and $request->hasFile('selfie') )  
			                      	{
                                   //se procesa el avatar
                               
      					
                          					$imagen1 = $request->file('identificationImage');    
                          					
                          					//cambiando el nombre del avatar para que no haya conflicto
                          					
                          					$timestamp = str_replace([' ', ':'], '', Carbon::now()->toDateTimeString());
                          				
                          					$nombreavatar = $timestamp. '_' .$imagen1->getClientOriginalName();  
                          					
											$imagen1->move(storage_path().'/app/img/perfiles/', $nombreavatar); 
											  
											//se crea el thumb del documento

											$this->createThumb(storage_path().'/app/img/perfiles/',storage_path().'/app/img/perfiles/'.$nombreavatar, $nWidth = 100);
                                                                                        
                                   			// $nombreimg2 = $request->input('selfieorig');
                          					
                          					/****************************************/
                          					
                          					//se procesa la segunda imagen-
                          					       					  
                          					$imagen2 = $request->file('selfie');   
                          					//cambiando el nombre de la imagen
                          					
                          					$timestamp = str_replace([' ', ':'], '', Carbon::now()->toDateTimeString());
                          				
                          					$nombreimg2 = $timestamp. '_' .$imagen2->getClientOriginalName();  
                          					
											$imagen2->move(storage_path().'/app/img/perfiles/', $nombreimg2); 
											  
											//se crea el thumb del selfie

											$this->createThumb(storage_path().'/app/img/perfiles/',storage_path().'/app/img/perfiles/'.$nombreimg2, $nWidth = 100);
                          					
                          					//se graban los datos en la tabla correspondiente
                          					 
                          					DB::table('user')->where('id', '=',$request->input('idusuario'))
                          									->update(['name' => $request->input('name'),
                                             				'lastname'=>$request->input('lastname') ,                                                      
                          									//'email'=>$request->input('email'),
                          									'country'=>$request->input('country'),
                          									'identificationType'=>$request->input('identificationType'),
                          									'identification'=>$request->input('identification'),
                          									'birthdate'=>$request->input('birthdate'),
                          									'gender'=>$request->input('gender'),
                          									'identificationImage'=>$nombreavatar,
                          									'selfie'=>$nombreimg2,	
															'kyc1confirmed'=>'YES',	
															'confirmed'	=> 'NO',			
                          									
                          									]);                                    
                                                                      
											//return redirect('/kyc_confirmation');                                    
											$reguserverif = DB::select("select u.confirmedChecks FROM user u  WHERE u.id = ".$request->input('idusuario'));

											if ($reguserverif[0]->confirmedChecks == 'NO')
												{
													return redirect('/kyc_confirmation');        	
												}
											else
												{
													if ($reguserverif[0]->confirmedChecks == 'YES')
														{
															return redirect('/kyc_process');        	
														}
												}	    
                              }      
                          else
                              {
                                  Session::put('mensajeerror',trans("An error occurred with uploading files, please check"));
    		
					                        return back();  
                              }
                                                                
                      }//fin de si se deben subir ambas imagenes
                   else
                      {
                         if ($request->input('identificationImageorig') != '' and  $request->input('selfieorig') != '' )
                            {
                                if($request->hasFile('identificationImage') and $request->hasFile('selfie') )  
    			                      	{
                                       			//se procesa el avatar
                                   
          					
                              					$imagen1 = $request->file('identificationImage');    
                              					
                              					//cambiando el nombre del avatar para que no haya conflicto
                              					
                              					$timestamp = str_replace([' ', ':'], '', Carbon::now()->toDateTimeString());
                              				
                              					$nombreavatar = $timestamp. '_' .$imagen1->getClientOriginalName();  
                              					
												$imagen1->move(storage_path().'/app/img/perfiles/', $nombreavatar); 
												  
												$this->createThumb(storage_path().'/app/img/perfiles/',storage_path().'/app/img/perfiles/'.$nombreavatar, $nWidth = 100);
                                                                                            
                                       			// $nombreimg2 = $request->input('selfieorig');
                              					
                              					/****************************************/
                              					
                              					//se procesa la segunda imagen-
                              					       					  
                              					$imagen2 = $request->file('selfie');   
                              					//cambiando el nombre de la imagen
                              					
                              					$timestamp = str_replace([' ', ':'], '', Carbon::now()->toDateTimeString());
                              				
                              					$nombreimg2 = $timestamp. '_' .$imagen2->getClientOriginalName();  
                              					
                              					$imagen2->move(storage_path().'/app/img/perfiles/', $nombreimg2); 
												  
												$this->createThumb(storage_path().'/app/img/perfiles/',storage_path().'/app/img/perfiles/'.$nombreimg2, $nWidth = 100);  
                              					//se graban los datos en la tabla correspondiente
                              					 
                              					DB::table('user')->where('id', '=',$request->input('idusuario'))
                              									->update(['name' => $request->input('name'),
                                                				'lastname'=>$request->input('lastname')  ,                                                      
                              									//'email'=>$request->input('email'),
                              									'country'=>$request->input('country'),
                              									'identificationType'=>$request->input('identificationType'),
                              									'identification'=>$request->input('identification'),
                              									'birthdate'=>$request->input('birthdate'),
                              									'gender'=>$request->input('gender'),
                              									'identificationImage'=>$nombreavatar,
                              									'selfie'=>$nombreimg2,	
                              									'kyc1confirmed'=>'YES',	
                                               					 'confirmed'=>'NO',			
                              									
                              									]);                                    
                                                                          
												//return redirect('/kyc_confirmation');    
												$reguserverif = DB::select("select u.confirmedChecks FROM user u  WHERE u.id = ".$request->input('idusuario'));

												if ($reguserverif[0]->confirmedChecks == 'NO')
													{
														return redirect('/kyc_confirmation');        	
													}
												else
													{
														if ($reguserverif[0]->confirmedChecks == 'YES')
															{
																return redirect('/kyc_process');        	
															}
													}	                                     
                                  }      
                              else
                                  {
                                          
                                       if($request->hasFile('identificationImage') and !$request->hasFile('selfie') )  
              			                      	{
                                                 			//se procesa el avatar
                                             
                    					
                                        					$imagen1 = $request->file('identificationImage');    
                                        					
                                        					//cambiando el nombre del avatar para que no haya conflicto
                                        					
                                        					$timestamp = str_replace([' ', ':'], '', Carbon::now()->toDateTimeString());
                                        				
                                        					$nombreavatar = $timestamp. '_' .$imagen1->getClientOriginalName();  
                                        					
          													$imagen1->move(storage_path().'/app/img/perfiles/', $nombreavatar); 
          												  
          													$this->createThumb(storage_path().'/app/img/perfiles/',storage_path().'/app/img/perfiles/'.$nombreavatar, $nWidth = 100);
                                                                                                      
                                                 			// $nombreimg2 = $request->input('selfieorig');
                                        					
                                        					/****************************************/
                                        					
                                        						$nombreimg2 = $request->input('selfieorig');       
                                        					 
                                        					DB::table('user')->where('id', '=',$request->input('idusuario'))
                                        									->update(['name' => $request->input('name'),
                                                          				'lastname'=>$request->input('lastname')  ,                                                      
                                        									//'email'=>$request->input('email'),
                                        									'country'=>$request->input('country'),
                                        									'identificationType'=>$request->input('identificationType'),
                                        									'identification'=>$request->input('identification'),
                                        									'birthdate'=>$request->input('birthdate'),
                                        									'gender'=>$request->input('gender'),
                                        									'identificationImage'=>$nombreavatar,
                                        									'selfie'=>$nombreimg2,	
                                        									'kyc1confirmed'=>'YES',	
                                                          					'confirmed'=>'NO',			
                                        									
                                        									]);                                    
                                                                                    
															//return redirect('/kyc_confirmation');       
															$reguserverif = DB::select("select u.confirmedChecks FROM user u  WHERE u.id = ".$request->input('idusuario'));

															if ($reguserverif[0]->confirmedChecks == 'NO')
																{
																	return redirect('/kyc_confirmation');        	
																}
															else
																{
																	if ($reguserverif[0]->confirmedChecks == 'YES')
																		{
																			return redirect('/kyc_process');        	
																		}
																}	                               
                                            }   
                                         else
                                             {
                                                 if(!$request->hasFile('identificationImage') and $request->hasFile('selfie') )  
                        			                      	{
                                                           			//se procesa el avatar
                                                       
                              					
                                                  					$nombreavatar = $request->input('identificationImageorig');    
                                                  					
                                                  					/****************************************/
                                                  					
                                                  					$imagen2 = $request->file('selfie');   
                                                              					//cambiando el nombre de la imagen
                                                              					
                                                              					$timestamp = str_replace([' ', ':'], '', Carbon::now()->toDateTimeString());
                                                              				
                                                              					$nombreimg2 = $timestamp. '_' .$imagen2->getClientOriginalName();  
                                                              					
                                                              					$imagen2->move(storage_path().'/app/img/perfiles/', $nombreimg2); 
                                												  
                                												$this->createThumb(storage_path().'/app/img/perfiles/',storage_path().'/app/img/perfiles/'.$nombreimg2, $nWidth = 100);  
                                                              					//se graban los datos en la tabla correspondiente 
                                                  					 
                                                  								DB::table('user')->where('id', '=',$request->input('idusuario'))
																							->update(['name' => $request->input('name'),
																							'lastname'=>$request->input('lastname')  ,                                                      
																							//'email'=>$request->input('email'),
																							'country'=>$request->input('country'),
																							'identificationType'=>$request->input('identificationType'),
																							'identification'=>$request->input('identification'),
																							'birthdate'=>$request->input('birthdate'),
																							'gender'=>$request->input('gender'),
																							'identificationImage'=>$nombreavatar,
																							'selfie'=>$nombreimg2,	
																							'kyc1confirmed'=>'YES',	
                                                                    						'confirmed'=>'NO',			
                                                  									
                                                  									]);                                    
                                                                                              
																	   				//return redirect('/kyc_confirmation');      
																					$reguserverif = DB::select("select u.confirmedChecks FROM user u  WHERE u.id = ".$request->input('idusuario'));

																					if ($reguserverif[0]->confirmedChecks == 'NO')
																						{
																							return redirect('/kyc_confirmation');        	
																						}
																					else
																						{
																							if ($reguserverif[0]->confirmedChecks == 'YES')
																								{
																									return redirect('/kyc_process');        	
																								}
																						}	                               
                                                      } 
                                                    else
                                                      {
                                                          $nombreavatar = $request->input('identificationImageorig');    
                                                                                            
                                                              		$nombreimg2 = $request->input('selfieorig');                        					
                                                    					
                                                    					
                                                    					//se graban los datos en la tabla correspondiente
                                                    					 
                                                    					DB::table('user')->where('id', '=',$request->input('idusuario'))
                                                    									->update(['name' => $request->input('name'),
                                                                       					'lastname'=>$request->input('lastname'),                                                       
                                                    									//'email'=>$request->input('email'),
                                                    									'country'=>$request->input('country'),
                                                    									'identificationType'=>$request->input('identificationType'),
                                                    									'identification'=>$request->input('identification'),
                                                    									'birthdate'=>$request->input('birthdate'),
                                                    									'gender'=>$request->input('gender'),
                                                    									'identificationImage'=>$nombreavatar,
                                                    									'selfie'=>$nombreimg2,	
                                                    									'kyc1confirmed'=>'YES',			
                                                    									'confirmed'=>'NO',	
                                                    									]);                                    
                                                                                                
																		 //return redirect('/kyc_confirmation');  
																		 $reguserverif = DB::select("select u.confirmedChecks FROM user u  WHERE u.id = ".$request->input('idusuario'));

																		 if ($reguserverif[0]->confirmedChecks == 'NO')
																			 {
																				 return redirect('/kyc_confirmation');        	
																			 }
																		 else
																			 {
																				 if ($reguserverif[0]->confirmedChecks == 'YES')
																					 {
																						 return redirect('/kyc_process');        	
																					 }
																			 }	  
                                                      }
                                                        
                                             }   
                                          
                                          
                                                                                            				
                              					
                                  }
                            
                            }
                      }
               }
         }   
       	
      			
		}
		
		//permite mostrar las imagenes desde el storage
		public function mostrar(Request $request, $filename)
			{
				
				@session_start();
				
				$display = file_get_contents(storage_path('/app/img/perfiles/').$filename);
				
				return $display;
				
			}
			
		//permite mostrar las imagenes desde el storage/thumbs
		public function mostrarthumb(Request $request, $filename)
		{
			
			@session_start();
			
			$display = file_get_contents(storage_path('/app/img/perfiles/thumbnail/').$filename);
			
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
              			'kyc1confirmed'=>'YES',									
						
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
													'confirmed' => 'NO',
													
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

				$telegramuser1 = $request->input('telegramuser');

				if (substr($telegramuser1, 0,1) != '@')
					{
						$telegramuser = '@'.$telegramuser1;
					}
				else
					{

						$telegramuser = $telegramuser1;
					}	
				
				DB::table('user')->where('id', '=',$request->input('idusuario'))
									->update(['name' => $request->input('name'),
                  							'lastname' => $request->input('lastname'),
											'ercWallet' => $request->input('ercWallet'),
											'telegramuser' => $telegramuser,
									
									]);  
									
				Session::put('mensaje',trans("Your data was updated"));
    		
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
			
      
     public function recovery(Request $request)
			{
				header('Access-Control-Allow-Origin: *');
				header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
			
			
				@session_start();	
				
				if (trim($request->input('email')) == '')
					{	
						Session::put('mensajeerror',trans("Empty data is not accepted"));
    		
						return back();
					}
				//se crea un password temporal
        //dd(date('YmdHis'));
        $elpass = trim('Belotto#'.date('YmdHis'));  
        
        $newpass = md5(trim($elpass));
				
				$reguser = DB::select("select * FROM user WHERE email = '".strtolower($request->input('email'))."'");	
    
        if (count($reguser) == 0)
          {
            Session::put('mensajeerror',trans("the mail does not correspond to the user"));
    		
						return back();
				  }
             
				 	DB::table('user')->where('id', '=',$reguser[0]->id)
									->update(['password' => $newpass,
									
									]);  
                                                   
          //se envia el correo         
          
          $valores = array( 'email' => strtolower($request->input('email')));
					
				 $data = array('name'=>"Mr(s). ".$request->input('name'), 
						"body" => 'your temporary password is',
            "nombre"  => $reguser[0]->name,       
						"newpassword"=>trim($elpass));
   
				 Mail::send('email.emailactive', $data, function($message) use ($valores){	 
					
					$message->to($valores['email'], 'recover password')
								->subject('Password recovery');
						
					$message->from('noreply@belotto.io', 'Belotto');
					
				});	                                
									
				Session::put('mensaje',trans("A message has been sent with instructions to reset your password"));
    		
				return back();					
							
			
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
				
				if (trim($reguser[0]->password) != trim($passactual))
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
									
				Session::put('mensaje',trans("Your data was updated"));
    		
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
				
				$pass = md5(trim($pass));			//md5(trim($request->input('password'))),
				
				$idusu = Session::get('id_usuario');  //echo "SELECT id from user where password = '".trim($pass)."' and id = ".$idusu; exit;
				
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
    
    public function registerreferrals(Request $request,$tokenreferrals)
		{
				header('Access-Control-Allow-Origin: *');
				header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
				//echo $tokenreferrals; exit;
				//se busca el usuario de ese tokenreferrals

				$reguser = DB::select("select email FROM user WHERE tokenreferrals = '".$tokenreferrals."'");	
				
				if (count($reguser) > 0)
					{
						return view('auth.register')->with( ['emailreferrals'=>$reguser[0]->email]);	
					}
				else
					{

					}	
    	
        	
	}


		public function generatokenreferrals(Request $request)
		{
				header('Access-Control-Allow-Origin: *');
				header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
				
				//se recorren los usuarios y se le genera el token referrals si no lo tiene

				$reguser = DB::select("select id FROM user WHERE tokenreferrals = ''");
				
				
				
				if (count($reguser) > 0)
					{

						foreach ($reguser as $dato) 
							{	
								//se le crea el tokenrefferals 
								
								$length = 11;
								$token = "";
								$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
								$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
								$codeAlphabet.= "0123456789";
								$max = strlen($codeAlphabet); // edited
					
								for ($i=0; $i < $length; $i++) {
									$token .= $codeAlphabet[random_int(0, $max-1)];
								}

								DB::table('user')->where('id', '=',$dato->id)
										->update(['tokenreferrals' => $token,
									]);  

							}		


					}
				else
					{

					}	
		
			
	}

	public function generathumb(Request $request)
	{
			header('Access-Control-Allow-Origin: *');
			header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
			header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
			
			//se recorren los usuarios y se le genera el token referrals si no lo tiene

			$reguser = DB::select("select id,identificationImage,selfie FROM user WHERE kyc1confirmed = 'YES' ");
			
			
			if (count($reguser) > 0)
				{

					foreach ($reguser as $dato) 
						{	
							$imgdocumento = $dato->identificationImage;

							if (file_exists(storage_path().'/app/img/perfiles/'.$imgdocumento))
								{
									$this->createThumb(storage_path().'/app/img/perfiles/',storage_path().'/app/img/perfiles/'.$imgdocumento, $nWidth = 100);
								}
							else
								{
									//dd('no');
								}
							//el selfie
							//sleep(7);
							$imgselfie = $dato->selfie;

							if (file_exists(storage_path().'/app/img/perfiles/'.$imgselfie))
								{
									$this->createThumb(storage_path().'/app/img/perfiles/',storage_path().'/app/img/perfiles/'.$imgselfie, $nWidth = 100);
								}
							else
								{
									//dd('no');
								}

						}	

					echo 'listo';		
				}
			else
				{

				}	
	
		
		}

		public function genermasivoemail(Request $request)
		{
				header('Access-Control-Allow-Origin: *');
				header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
				
				//se recorren los usuarios y se le genera el token referrals si no lo tiene
	
				$reguser = DB::select("select id,name,lastname,confirmationCode,email FROM user WHERE date(createDate) >= '2018-05-05' and emailconfirmed = 'NO' ");
				//$reguser = DB::select("select id,name,lastname,confirmationCode,email FROM user WHERE id=188 ");

				if (count($reguser) > 0)
					{
						$enviados[]=array();

						$ij = 0;
						foreach ($reguser as $dato) 
							{
								$valores = array( 'email' => strtolower($dato->email));

								$tk = $dato->confirmationCode;

								$enviados[$ij] = $dato->name." ".$dato->lastname.": ".$dato->email;

								$ij = $ij + 1;
					
								$data = array('name'=>"Mr(s). ".$dato->name." ".$dato->lastname, 
										"body" => 'To validate your account, proceed to open the link...',
										"url"=>"belotto.tokennow.io/tk/".$tk); 
				
								Mail::send('email.activation', $data, function($message) use ($valores){	  
									
									$message->to($valores['email'], 'Validate email')
												->subject('Verification Email');
										
									$message->from('noreply@belotto.io', 'Belotto');
									
								});	
							}
					}	
					
					

				
		}		

}


