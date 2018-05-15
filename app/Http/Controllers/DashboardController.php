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
use Mail;

use App\Logadmin;

class DashboardController extends Controller
{
	
	
	

	public function dashboard(Request $request)
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
		
		$idusu = Session::get('id_usuario');  		
		
		//para evitar el acceso sin logueo fv
		if (is_null(Session::get('id_usuario')))
			{
				
				return redirect('/'); 
			}
		
		$buscar = '';	

		//los paises
     
		$repaises = DB::select("select id_country, name FROM countries WHERE estado = 1 order by name asc"); 
			
		return view('dashboard.dashboard')->with(['buscar'=>$buscar,'repaises'=>$repaises]);
			
	}
	
	public function dashboardKyc(Request $request)
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
		
		$buscar = '';	
   
     //los paises
     
     $repaises = DB::select("select id_country, name FROM countries WHERE estado = 1 order by name asc");  
			
		return view('dashboard.dashboardKyc')->with(['buscar'=>$buscar,'repaises'=>$repaises]);
			
	}
	

	public function buscardatospagina(Request $request, $pagina,$num_total_registros,$buscar,$estatusreg,$fecha,$country,$fecha2) 
	{
		/*KYC Table PAge 1*/
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
		
		$idusu = Session::get('id_usuario');  
    
    if ($country != 'all')
      {		
		    $country = $country * 1;
      }
		$tiempo_inicio = microtime(true);

		//para evitar el acceso sin logueo
		if (is_null(Session::get('id_usuario')))
			{
				return redirect('/'); 
			}			
		$root_path = \Request::root();

		//se arma el listado en base a los parametros suministrados
		if ($buscar== '_;_')
			{
				$buscar= '';
			}	
		else
			{
				$buscar= str_replace('_..._', '%', $buscar); 

				$buscar= str_replace('_...._', '|', $buscar); 
			}	
			
		$TAMANO_PAGINA = 10;
					
		if ($pagina == 0 or $pagina == 1) 
			{
				$inicio = 0;
				$pagina = 1;
			}
		else 
			{
				//dd($pagina);
				$inicio = ($pagina - 1) * $TAMANO_PAGINA;
				
				//$inicio = $inicio + 1;
			} 		

		$sql = " limit ".$inicio.",".$TAMANO_PAGINA;	



		if ($fecha > $fecha2)
			{
				$fecha2 =  $fecha;
			}
		if ($fecha == '0000-00-00' and  $fecha2 != '0000-00-00')
			{
				$fecha =  $fecha2;
			}	
		if ($fecha != '0000-00-00' and  $fecha2 == '0000-00-00')
			{
				$fecha2 =  date('Y-m-d');
			}
			
		if ($buscar == '')
			{
				if ($estatusreg == 'all')
          		{
					if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
						{
							if ($country == 'all')
							{
										$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and kyc1confirmed = 'YES' and confirmedChecks = 'YES' order by u.name asc ".$sql);
							}
							else
							{
								if ($country != 'all')
									{ 
										$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and kyc1confirmed = 'YES' and confirmedChecks = 'YES' and c.id_country = ".$country." order by u.name asc ".$sql);
									}  
							}                               
						}
					else
						{
							if ($country == 'all')
								{  
								$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and kyc1confirmed = 'YES' and confirmedChecks = 'YES' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') order by u.name asc ".$sql); 
								}
							else
								{
									if ($country != 'all')
										{
											$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and kyc1confirmed = 'YES' and confirmedChecks = 'YES' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and c.id_country = ".$country." order by u.name asc ".$sql);
										}
								}     
							
						}                          
				}
			else
				{
					if ($estatusreg != 'all')
						{
							if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
								{
									if ($country == 'all')
										{
												$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and kyc1confirmed = 'YES' and confirmedChecks = 'YES' and confirmed = '".$estatusreg."' order by u.name asc ".$sql);
										}
									else
									{
										if ($country != 'all')
											{
												$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and kyc1confirmed = 'YES' and confirmedChecks = 'YES' and confirmed = '".$estatusreg."'  and c.id_country = ".$country." order by u.name asc ".$sql);
											}
									}                               
								}
							else
								{
									if ($country == 'all')
										{
										$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and kyc1confirmed = 'YES' and confirmedChecks = 'YES' and confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') order by u.name asc ".$sql);
										}
									else
									{
										if ($country != 'all')
											{
												$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and kyc1confirmed = 'YES' and confirmedChecks = 'YES' and confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and c.id_country = ".$country." order by u.name asc ".$sql);
											}
									}       
								}                         
						}               
          		}                   
			}
		else
			{  //el buscar tiene datos
					if ($estatusreg == 'all')
					{
						if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
							{
								if ($country == 'all')
								{
									$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE)  and kyc1confirmed = 'YES' and confirmedChecks = 'YES' order by u.name asc  ".$sql);
								}
								else
								{
									if ($country != 'all')
										{
										$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE)  and kyc1confirmed = 'YES' and confirmedChecks = 'YES'  order by u.name asc  ".$sql);
										}  
								}    
							}
						else
							{
								if ($country == 'all')
								{
									$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE)  and kyc1confirmed = 'YES' and confirmedChecks = 'YES' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."')  order by u.name asc  ".$sql);
								}
								else
								{
									if ($country != 'all')
										{
											$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE)  and kyc1confirmed = 'YES' and confirmedChecks = 'YES' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."')  and c.id_country = ".$country." order by u.name asc  ".$sql);
										} 
								}      
							}                                       
					}
					else
					{
						if ($estatusreg != 'all')
							{
							if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
								{
									if ($country == 'all')
									{
										$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."' and kyc1confirmed = 'YES' and confirmedChecks = 'YES' order by u.name asc  ".$sql);
									}
									else
									{
										if ($country != 'all')
											{
												$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."' and kyc1confirmed = 'YES' and c.id_country = ".$country." and confirmedChecks = 'YES' order by u.name asc  ".$sql);
											}
									}    
								}
							else
								{
									if ($country == 'all')
										{
										$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and kyc1confirmed = 'YES' and confirmedChecks = 'YES' order by u.name asc  ".$sql);
										}
									else
									{
										if ($country != 'all')
											{
												$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and c.id_country = ".$country." and kyc1confirmed = 'YES' and confirmedChecks = 'YES' order by u.name asc  ".$sql);
											}
									}      
								}                        
							}
					}
									
			}	
		
		$abuscar = $buscar;
		echo '<script type="text/javascript">
				$(document).ready(function() {  
				var $myGroup = $("#contentuser");
				$myGroup.on("show.bs.collapse",".collapse", function() {
				$("body").find("div.collapse").removeClass("in")
				});
				});
				</script>';

		if ($pagina == 0 or $pagina == 1)
			{
				//se buscan el total de registros
				//se verifican los filtros
        
        if ($buscar == '')
			    {
              if ($estatusreg == 'all')
                { 
                    if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
                      {
                          if ($country == 'all')
                            {
  				                    $regusertotal = DB::select("select count(id) as totalregbuscar FROM user WHERE id > 1 and kyc1confirmed = 'YES' and confirmedChecks = 'YES' ");
                            }
                          else
                            {
                                if ($country != 'all')
                                  {
        				                    $regusertotal = DB::select("select count(u.id) as totalregbuscar FROM user u left join countries c on u.country = c.id_country WHERE u.id > 1 and c.id_country = ".$country." and u.kyc1confirmed = 'YES' and u.confirmedChecks = 'YES' ");
                                  }
                            }                                        
                      }
                  else
                    {
                        if ($country == 'all')
                            {
                                $regusertotal = DB::select("select count(id) as totalregbuscar FROM user WHERE id > 1 and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and kyc1confirmed = 'YES' and confirmedChecks = 'YES' ");
                            }
                         else
                           {
                               if ($country != 'all')
                                  {
                                       $regusertotal = DB::select("select count(u.id) as totalregbuscar FROM user u left join countries c  on u.country = c.id_country WHERE u.id > 1 and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and c.id_country = ".$country." and u.kyc1confirmed = 'YES' and u.confirmedChecks = 'YES' ");
                                  }
                           }       
                    }                                                    
                }
              else
                {
                     if ($estatusreg != 'all')
                        {
							if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
                                {
                                    if ($country == 'all')
				    {
                                        $regusertotal = DB::select("select count(id) as totalregbuscar FROM user WHERE id > 1 and confirmed = '".$estatusreg."' and kyc1confirmed = 'YES' and confirmedChecks = 'YES' ");
                                      }
                                    else
                                      {
                                          if ($country != 'all')
                                              {
                                                  $regusertotal = DB::select("select count(u.id) as totalregbuscar FROM user u left join countries c on u.country = c.id_country WHERE u.id > 1 and u.confirmed = '".$estatusreg."' and c.id_country = ".$country." and u.kyc1confirmed = 'YES' and u.confirmedChecks = 'YES' ");
                                              }
                                      }    
                                }
                              else
                                {
                                    if ($country == 'all')
                                      {
                                        $regusertotal = DB::select("select count(id) as totalregbuscar FROM user WHERE id > 1 and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and confirmed = '".$estatusreg."' and kyc1confirmed = 'YES' and confirmedChecks = 'YES' ");
                                      }
                                    else
                                      {
                                          if ($country != 'all')
                                              {
                                                  $regusertotal = DB::select("select count(u.id) as totalregbuscar FROM user u left join countries c on u.country = c.id_country WHERE u.id > 1 and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and u.confirmed = '".$estatusreg."' and c.id_country = ".$country." and u.kyc1confirmed = 'YES' and u.confirmedChecks = 'YES' ");
                                              }
                                      }
                                          
                                }      
                        }
                }                              
          }
        else
          {
              if ($estatusreg == 'all')
                { 
                    if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
                        {
                             if ($country == 'all')
                                {
                                  $regusertotal = DB::select("select count(id) as totalregbuscar FROM user WHERE MATCH(name,lastname,email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and kyc1confirmed = 'YES' and confirmedChecks = 'YES' ");
                                }
                              else
                                {
                                  if ($country != 'all')
                                      {
                                         $regusertotal = DB::select("select count(u.id) as totalregbuscar FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and u.kyc1confirmed = 'YES' and c.id_country = ".$country." and u.confirmedChecks = 'YES' ");
                                      }
                                }    
                        }
                    else
                      {
                        if ($country == 'all')
                            {
                              $regusertotal = DB::select("select count(id) as totalregbuscar FROM user WHERE MATCH(name,lastname,email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and kyc1confirmed = 'YES' and confirmedChecks = 'YES' ");
                            }
                         else
                           {
                               if ($country != 'all')
                                 {
                                     $regusertotal = DB::select("select count(u.id) as totalregbuscar FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and c.id_country = ".$country." and kyc1confirmed = 'YES' and confirmedChecks = 'YES' ");
                                 }
                           }     
                      }      
                }
              else
                {
                    if ($estatusreg != 'all')
                        {
                            if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
                              {
                                  if ($country == 'all')
                                    {
                                      $regusertotal = DB::select("select count(id) as totalregbuscar FROM user WHERE MATCH(name,lastname,email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."' and kyc1confirmed = 'YES' and confirmedChecks = 'YES' ");
                                    }
                                  else
                                    {
                                         if ($country != 'all')
                                           {  
                                               $regusertotal = DB::select("select count(u.id) as totalregbuscar FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and u.confirmed = '".$estatusreg."' and c.id_country = ".$country." and u.kyc1confirmed = 'YES' and u.confirmedChecks = 'YES' ");
                                           }
                                     }  
                              }
                            else
                              {
                                if ($country == 'all')
                                    {
                                       $regusertotal = DB::select("select count(id) as totalregbuscar FROM user WHERE MATCH(name,lastname,email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and kyc1confirmed = 'YES' and confirmedChecks = 'YES' ");
                                    }
                                  else
                                    {
                                        if ($country != 'all')
                                           { 
                                               $regusertotal = DB::select("select count(u.id) as totalregbuscar FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and u.confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and c.id_country = ".$country." and u.kyc1confirmed = 'YES' and u.confirmedChecks = 'YES' ");
                                           }
                                    }     
                              }      
                        }
                }
                  
              
          }                            
        																											
   				$cuantosregtotal = $regusertotal[0]->totalregbuscar;

				$num_total_registros = $cuantosregtotal;
								
				$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA); 

				if ($cuantosregtotal > 0)
					{
						echo '<div id="msgbox" class="alert alert-success" style="width:45%!important;padding: 5px;!important;display:none;">   ';
						echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
						echo '<div class="bg-green alert-icon">';
						echo '<i class="glyph-icon icon-check"></i>';
						echo '</div>';
						echo '<div class="alert-content"> ';
						echo '<h4 id="titulomsg" class="alert-title"></h4>';
						echo '<p id="boxms"></p>';
						echo '</div>';
						echo '</div>';
						echo '<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">';
						echo '<table id="tbldashboard" class="table">';
						echo '<thead>';
						echo '<tr>';
						echo '<th scope="col"></th>';
						echo '<th scope="col">Name</th>';
     	      echo '<th scope="col">Lastname</th>';          
						echo '<th scope="col">Email</th>';
						echo '<th scope="col">Country</th>';
						echo '<th scope="col">Created At</th>';
						echo '<th scope="col">Status</th>';
						echo '</tr>';
						echo '</thead>';
						echo '<tbody id="contentuser">';
						foreach ($reguser as $dato) 
							{
								echo ' <tr>';
								echo '<th class="align-middle" width="50"><a style="border:#392068 !important; background:#392068 !important;" class="btn btn-info expa" data-toggle="collapse" href="#collapseExample'.$dato->id.'" role="button" aria-expanded="true" aria-controls="#collapseExample'.$dato->id.'"><i class="fas fa-angle-double-down"></i></th></a>';
								echo '<td class="align-middle colorcelda_'.$dato->id.'">'.$dato->name.'</td>';
                				echo '<td class="align-middle colorcelda_'.$dato->id.'">'.$dato->lastname.'</td>';
								echo '<td class="align-middle colorcelda_'.$dato->id.'">'.$dato->email.'</td>'; 
								echo '<td class="align-middle colorcelda_'.$dato->id.'">'.$dato->namecountry.'</td>';
								echo '<td class="align-middle colorcelda_'.$dato->id.'">'.$dato->createDate.'</td>'; 
								echo '<td id="elestatus_'.$dato->id.'" class="align-middle colorcelda_'.$dato->id.'" width="150">';
								if ($dato->confirmed == 'YES'){
									echo '<span class="label label-success">Accept</span>';
								}else{
									if ($dato->confirmed == 'NO'){
											echo '<span data-feather="alert-triangle"></span><a>&nbsp;Pending</a></td>';
									}else{
										if ($dato->confirmed == 'REC'){
											echo '<span class="label label-danger">Decline</span>';
										}	

									}	
								}									
								echo '</tr>';
								$photo;
								$document;
								if ($dato->identificationImage != ''){
									$document = '<a data-fancybox="gallery" href="https://belotto.tokennow.io/'.$dato->identificationImage.'/mostrar"><img src="https://belotto.tokennow.io/'.$dato->identificationImage.'/mostrarthumb" class="img-thumbnail" width="50" /></a>';
								}else{
									$document = '<a data-fancybox="gallery" href="https://belotto.tokennow.io/img/default-avatar.png"><img src="https://belotto.tokennow.io/img/default-avatar.png" class="img-thumbnail" width="50" /></a>';
								}  
								if ($dato->selfie != ''){
									$photo = '<a data-fancybox="gallery" href="https://belotto.tokennow.io/'.$dato->selfie.'/mostrar"><img src="https://belotto.tokennow.io/'.$dato->selfie.'/mostrarthumb" class="img-thumbnail" width="50" /></a>';
								} else{
									$photo = '<a data-fancybox="gallery" href="https://belotto.tokennow.io/img/default-avatar.png"><img src="https://belotto.tokennow.io/img/default-avatar.png" class="img-thumbnail" width="50" /></a>';
								}  
								/* Select Action */
								$select = "";
								$colspan;
								$th = "";
								$td = "";
								if ($dato->confirmed == 'YES'){
									$colspan = 7;
									$select.='<option value="YES" selected="selected">Accept</option>';	
									$th.='<th class="tg-yw4l">Status</th>';
									$td.='<td class="align-middle" style="vertical-align: middle;">
											<select id="gec'.$dato->id.'" name="gec'.$dato->id.'" onchange="activarregister('.$dato->id.')">
												'.$select.'
											</select>
										</td>';
								}else{
									$colspan = 7;
									$th.='<th class="tg-yw4l">Status</th><th class="tg-yw4l">Action</th>';
									if ($dato->confirmed == 'NO'){
										$select.='<option value="YES" >Accept</option>';	
										$select.='<option value="REC">Decline</option>';
										$select.=' <option value="NO" selected="selected" >Pending</option>';
									}else{
										if ($dato->confirmed == 'REC'){
											$select.='<option value="YES"  >Accept</option>';	
											$select.='<option value="REC" selected="selected" >Decline</option>';
											$select.=' <option value="NO" >Pending</option>';
										}	

									}
									$td.='<td class="align-middle" style="vertical-align: middle;">
											<select id="gec'.$dato->id.'" name="gec'.$dato->id.'" onchange="activarregister('.$dato->id.')">
												'.$select.'
											</select>
										</td><td class="align-middle" width="150" style="vertical-align: middle;">
											<button id="register'.$dato->id.'" disabled type="button" class="btn btn-info btn-sm" style="opacity:0.5!important;filter: alpha(opacity=50)!important;background: #392068!important;border: #392068 !important;"  onclick="register('.$dato->id.')">
												<i class="material-icons">check</i>
											</button>
										</td>';

								}
								echo '<tr><td colspan="'.$colspan.'" style="padding:0px !important;"><div class="collapse" id="collapseExample'.$dato->id.'" data-parent="#collapseExample'.$dato->id.'">
								  <table class="table" border="0" width="100%" style="margin-bottom:0px; background:#f5f5f5 !important; border:none !important;">
									  <tr>
										<th class="tg-yw4l">Wallet</th>
										<th class="tg-yw4l" width="180">ID Type</th>
										<th class="tg-yw4l">ID Number</th>
										<th class="tg-yw4l">Birthday</th>										
										<th class="tg-yw4l">Photo</th>
										<th class="tg-yw4l">Document</th>
										'.$th.'
									  </tr>
									  <tr>
										<td class="align-middle" style="vertical-align: middle;">'.$dato->ercWallet.'</td>
										<td class="align-middle" style="vertical-align: middle;">'.$dato->identificationType.'</td>
										<td class="align-middle" style="vertical-align: middle;">'.$dato->identification.'</td>
										<td class="align-middle" style="vertical-align: middle;">'.$dato->birthdate.'</td>										
										<td class="align-middle" style="vertical-align: middle;">'.$document.'</td>
										<td class="align-middle" style="vertical-align: middle;">'.$photo.'</td>
										'.$td.'
									  </tr>
									</table>
								</div></td></tr>';										
							}
							echo  '</tbody>';
							echo  '</table> ';		
					}//fin de si hay registros

			}	
		else
			{
				if ($pagina > 1)
					{
						$cuantosregtotal = $num_total_registros;											
															
						$num_total_registros = $cuantosregtotal;
						
						$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA); 

						if ($cuantosregtotal > 0)
							{	
								echo '<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">';
								echo '<table id="tbldashboard" class="table">';
								echo '<thead>';
								echo '<tr>';
								echo '<th scope="col" width="65"></th>';
								echo '<th scope="col">Name</th>';
                				echo '<th scope="col">Lastname</th>';  
								echo '<th scope="col">Email</th>';
								echo '<th scope="col">Country</th>';
								echo '<th scope="col">Created At</th>';
								echo '<th scope="col">Status</th>';
								echo '</tr>';
								echo '</thead>';
								echo '<tbody id="contentuser">';
								foreach ($reguser as $dato) 
							{


                                                                 								
								echo ' <tr id="'.$dato->id.'">';
 								echo '<th class="align-middle" width="50"><a style="border:#392068 !important; background:#392068 !important;" class="btn btn-info expa" data-toggle="collapse" href="#collapseExample'.$dato->id.'" role="button" aria-expanded="true" aria-controls="#collapseExample'.$dato->id.'"><i class="fas fa-angle-double-down"></i></th></a>';
								echo '<th class="align-middle colorcelda_'.$dato->id.'">'.$dato->name.'</th>';
								echo '<td class="align-middle colorcelda_'.$dato->id.'">'.$dato->lastname.'</td>';
                				echo '<td class="align-middle colorcelda_'.$dato->id.'">'.$dato->email.'</td>';
								echo '<td class="align-middle colorcelda_'.$dato->id.'">'.$dato->namecountry.'</td>'; 
								echo '<td class="align-middle colorcelda_'.$dato->id.'">'.$dato->createDate.'</td>';
								echo '<td id="elestatus_'.$dato->id.'" class="align-middle colorcelda_'.$dato->id.'" width="150">';
								if ($dato->confirmed == 'YES'){
									echo '<span class="label label-success">Accept</span>';
								}else{
									if ($dato->confirmed == 'NO'){
											echo '<span data-feather="alert-triangle"></span><a>&nbsp;Pending</a></td>';
									}else{
										if ($dato->confirmed == 'REC'){
											echo '<span class="label label-danger">Decline</span>';
										}	

									}	
								}									
								echo '</tr>';
								$photo;
								$document;
								if ($dato->identificationImage != ''){
									$document = '<a data-fancybox="gallery" href="https://belotto.tokennow.io/'.$dato->identificationImage.'/mostrar"><img src="https://belotto.tokennow.io/'.$dato->identificationImage.'/mostrarthumb" class="img-thumbnail" width="50" /></a>';
								}else{
									$document = '<a data-fancybox="gallery" href="https://belotto.tokennow.io/img/default-avatar.png"><img src="https://belotto.tokennow.io/img/default-avatar.png" class="img-thumbnail" width="50" /></a>';
								}  
								if ($dato->selfie != ''){
									$photo = '<a data-fancybox="gallery" href="https://belotto.tokennow.io/'.$dato->selfie.'/mostrar"><img src="https://belotto.tokennow.io/'.$dato->selfie.'/mostrarthumb" class="img-thumbnail" width="50" /></a>';
								} else{
									$photo = '<a data-fancybox="gallery" href="https://belotto.tokennow.io/img/default-avatar.png"><img src="https://belotto.tokennow.io/img/default-avatar.png" class="img-thumbnail" width="50" /></a>';
								}  
								/* Select Action */
								$select = "";
								$colspan;
								$th = "";
								$td = "";
								if ($dato->confirmed == 'YES'){
									$colspan = 7;
									$select.='<option value="YES" selected="selected">Accept</option>';	
									$th.='<th class="tg-yw4l">Status</th>';
									$td.='<td class="align-middle" style="vertical-align: middle;">
											<select id="gec'.$dato->id.'" name="gec'.$dato->id.'" onchange="activarregister('.$dato->id.')">
												'.$select.'
											</select>
										</td>';
								}else{
									$colspan = 7;
									$th.='<th class="tg-yw4l">Status</th><th class="tg-yw4l">Action</th>';
									if ($dato->confirmed == 'NO'){
										$select.='<option value="YES" >Accept</option>';	
										$select.='<option value="REC">Decline</option>';
										$select.=' <option value="NO" selected="selected" >Pending</option>';
									}else{
										if ($dato->confirmed == 'REC'){
											$select.='<option value="YES"  >Accept</option>';	
											$select.='<option value="REC" selected="selected" >Decline</option>';
											$select.=' <option value="NO" >Pending</option>';
										}	

									}
									$td.='<td class="align-middle">
											<select id="gec'.$dato->id.'" name="gec'.$dato->id.'" onchange="activarregister('.$dato->id.')">
												'.$select.'
											</select>
										</td><td class="align-middle" width="150">
									       <button id="register'.$dato->id.'" disabled type="button" class="btn btn-info btn-sm" style="opacity:0.5!important;filter: alpha(opacity=50)!important;background: #392068!important;border: #392068 !important;"  onclick="register('.$dato->id.')">		
														

												<i class="material-icons">check</i>
											</button>
										</td>';

								}
								echo '<tr><td colspan="'.$colspan.'" style="padding:0px !important;"><div class="collapse" id="collapseExample'.$dato->id.'">
								  <table class="table" border="0" width="100%" style="margin-bottom:0px; background:#f5f5f5 !important; border:none !important;">
									  <tr>
										<th class="tg-yw4l">Wallet</th>
										<th class="tg-yw4l" width="180">ID Type</th>
										<th class="tg-yw4l">ID Number</th>
										<th class="tg-yw4l">Birthday</th>										
										<th class="tg-yw4l">Photo</th>
										<th class="tg-yw4l">Document</th>
										'.$th.'
									  </tr>
									  <tr>
										<td class="align-middle" width="100" style="vertical-align: middle;">'.$dato->ercWallet.'</td>
										<td class="align-middle" style="vertical-align: middle;">'.$dato->identificationType.'</td>
										<td class="align-middle" style="vertical-align: middle;">'.$dato->identification.'</td>
										<td class="align-middle" style="vertical-align: middle;">'.$dato->birthdate.'</td>										
										<td class="align-middle" style="vertical-align: middle;">'.$document.'</td>
										<td class="align-middle" style="vertical-align: middle;">'.$photo.'</td>
										'.$td.'
									  </tr>
									</table>
								</div></td></tr>';										
							}
								echo  '</tbody>';
								echo  '</table> ';	

							}	//fin de si hay registros

					}	
			}	
			echo  '</div>';
            echo  '<div id="divbot" style="position:relative; left:1%!important;text-align:center;" >';
			//paginador///////
			$script = '';
			if ($total_paginas > 1)
				{
				
						if ($pagina - 1 > 0)
							{
							$antespagina = $pagina - 1;
							}	
						else
							{
							$antespagina = $total_paginas;
							}
						if ($pagina == 1)
							{
							$script .=  "<a id='pagina_atras' href='javascript:;' class='btn'  disabled='disabled' data-atras='1' style='font-size: 0.7em;padding: 3px 6px!important;color:#ffffff;background-color:#392068' onclick='verlista(".$antespagina.",&quot;".$abuscar."&quot;,".$num_total_registros.",&quot;".$estatusreg."&quot;,&quot;".$fecha."&quot;,&quot;".$country."&quot;,&quot;".$fecha2."&quot;)' >Back</a> ";  //$buscar,$estatusreg,$fecha
							}
						else
							{
							$script .=  "<a id='pagina_sig' href='javascript:;' class='btn'   style='font-size: 0.7em;padding: 3px 6px!important;color:#ffffff;background-color:#392068' data-sig='0' onclick='verlista(1,&quot;".$abuscar."&quot;,".$num_total_registros.",&quot;".$estatusreg."&quot;,&quot;".$fecha."&quot;,&quot;".$country."&quot;,&quot;".$fecha2."&quot;)' >First</a> ";

							$script .=  "<a id='pagina_atras' href='javascript:;' class='btn'  data-atras='1' style='font-size: 0.7em;padding: 3px 6px!important;color:#ffffff;background-color:#392068' onclick='verlista(".$antespagina.",&quot;".$abuscar."&quot;,".$num_total_registros.",&quot;".$estatusreg."&quot;,&quot;".$fecha."&quot;,&quot;".$country."&quot;,&quot;".$fecha2."&quot;)' >Back</a> ";
							}	
						
						for ($i=1;$i<=$total_paginas;$i++){
							
							if ($pagina == $i)
								{
									//si muestro el ÃƒÂ­ndice de la pÃƒÂ¡gina actual, no coloco enlace
									$script .=  $pagina . " ";
								} 
							else
								{
									//si el ÃƒÂ­ndice no corresponde con la pÃƒÂ¡gina mostrada actualmente, coloco el enlace para ir a esa pÃƒÂ¡gina $ruta  style='font-size: 0.7em;'
									$v1zq = $pagina - 3; 
									
									$v2zq = $pagina - 2;	
									
									$v4zq = $pagina - 1;
									
									//por el derecho
									
									$v1der = $pagina + 1;
									
									$v2der = $pagina + 2;	
									
									$v4der = $pagina + 3;
									
									if ($i >= $v1zq and $i <= $v4der )
										{
											$script .=  "<a id='pagina_".$i."' href='javascript:;' class='btn' data-pagina='".$i."' style='font-size: 0.7em;padding: 3px 6px!important;color:#ffffff;background-color:#392068' onclick='verlista(".$i.",&quot;".$abuscar."&quot;,".$num_total_registros.",&quot;".$estatusreg."&quot;,&quot;".$fecha."&quot;,&quot;".$country."&quot;,&quot;".$fecha2."&quot;)' >" . $i . "</a> ";
										}
									else
										{
											$script .=  "<a id='pagina_".$i."' href='javascript:;' class='btn' style='display:none;font-size: 0.7em;padding: 3px 6px!important;color:#ffffff;background-color:#392068' data-pagina='".$i."' onclick='verlista(".$i.",&quot;".$abuscar."&quot;,".$num_total_registros.",&quot;".$estatusreg."&quot;,&quot;".$fecha."&quot;,&quot;".$country."&quot;,&quot;".$fecha2."&quot;)' >" . $i . "</a> ";
										}
								}			
						}
				$buscar = "";	
				
				if (($pagina + 1) <  $total_paginas)
					{
					$siguientepagina = $pagina + 1;
					}	
				else
					{
					$siguientepagina = 0;
					}
				
				$script .=  "<a id='pagina_sig' href='javascript:;' class='btn'   data-sig='1' style='font-size: 0.7em;padding: 3px 6px!important;color:#ffffff;background-color:#392068' onclick='verlista(".$siguientepagina.",&quot;".$abuscar."&quot;,".$num_total_registros.",&quot;".$estatusreg."&quot;,&quot;".$fecha."&quot;,&quot;".$country."&quot;,&quot;".$fecha2."&quot;)' >Next</a> ";
				
				$script .=  "<a id='pagina_sig' href='javascript:;' class='btn'   style='font-size: 0.7em;padding: 3px 6px!important;color:#ffffff;background-color:#392068' data-sig='".$total_paginas."' onclick='verlista(".$total_paginas.",&quot;".$abuscar."&quot;,".$num_total_registros.",&quot;".$estatusreg."&quot;,&quot;".$fecha."&quot;,&quot;".$country."&quot;,&quot;".$fecha2."&quot;)' >last</a> ";									
				
				}	
		
			$tiempo_fin = microtime(true);
			
			$totaltime =  " (".($tiempo_fin - $tiempo_inicio)." segundos) "; 
				
			$script .= "<br><label style='font-size: 0.9em;'>Records found: " . number_format($num_total_registros) . "</label><br>";    //" ".$totaltime.
			//$script .= "Se muestran pÃƒÂ¡ginas de " . $TAMANO_PAGINA . " registros cada una<br>";
			$script .= "<label style='font-size: 0.9em;'>Showing the page " . $pagina . " of " . number_format($total_paginas) . "</label>";
			$script .= "</div>";
			echo $script;
			
			/**********paginador **********************///		

	}

	 //para el listado de usuarios (no kyc)

	public function buscardatospaginaUsers(Request $request, $pagina,$num_total_registros,$buscar,$estatusreg,$fecha,$country,$fecha2)  
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
		
		$idusu = Session::get('id_usuario');  		
		
		$tiempo_inicio = microtime(true);

		//para evitar el acceso sin logueo
		if (is_null(Session::get('id_usuario')))
			{
				return redirect('/'); 
			}

		//se arma el listado en base a los parametros suministrados
		if ($buscar== '_;_')
			{
				$buscar= '';
			}	
		else
			{
				$buscar= str_replace('_..._', '%', $buscar); 

				$buscar= str_replace('_...._', '|', $buscar); 
			}	
			
		$TAMANO_PAGINA = 10;
					
		if ($pagina == 0 or $pagina == 1) 
			{
				$inicio = 0;
				$pagina = 1;
			}
		else 
			{
				
				$inicio = ($pagina - 1) * $TAMANO_PAGINA;
				
			} 		

		$sql = " limit ".$inicio.",".$TAMANO_PAGINA;	

		if ($fecha > $fecha2)
		{
			$fecha2 =  $fecha;
		}
		if ($fecha == '0000-00-00' and  $fecha2 != '0000-00-00')
			{
				$fecha =  $fecha2;
			}	
		if ($fecha != '0000-00-00' and  $fecha2 == '0000-00-00')
			{
				$fecha2 =  date('Y-m-d');
			}
		if ($buscar == '')
			{
				if ($estatusreg == 'all')
          		{
					if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
						{
							if ($country == 'all')
							{
										$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 order by u.name asc ".$sql);
							}
							else
							{
								if ($country != 'all')
								{ 
										$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0  and c.id_country = ".$country." order by u.name asc ".$sql);
									}  
							}                               
						}
					else
						{
							if ($country == 'all')
								{  
								$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0  and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') order by u.name asc ".$sql); 
								}
							else
								{
									if ($country != 'all')
										{
											$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0  and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and c.id_country = ".$country." order by u.name asc ".$sql);
										}
								}     
							
						}                          
				}
			else
				{
					if ($estatusreg != 'all')
						{
							if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
								{
									if ($country == 'all')
									{
												$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0  and confirmed = '".$estatusreg."' order by u.name asc ".$sql);
										}
									else
									{
										if ($country != 'all')
										{
												$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0  and confirmed = '".$estatusreg."'  and c.id_country = ".$country." order by u.name asc ".$sql);
											}
									}                               
								}
							else
								{
									if ($country == 'all')
										{
										$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0  and confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') order by u.name asc ".$sql);
										}
									else
									{
										if ($country != 'all')
											{
												$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and c.id_country = ".$country." order by u.name asc ".$sql);
											}
									}       
								}                         
						}               
          		}                   
			}
		else
			{  //el buscar tiene datos
					if ($estatusreg == 'all')
					{
						if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
							{
								if ($country == 'all')
								{
									$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE)   order by u.name asc  ".$sql);
								}
								else
								{
									if ($country != 'all')
										{
											
											$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE)  order by u.name asc  ".$sql);
										}  
								}    
							}
						else
							{
								if ($country == 'all')
								{
									$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE)   and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."')  order by u.name asc  ".$sql);
								}
								else
								{
									if ($country != 'all')
										{
											$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE)   and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."')  and c.id_country = ".$country." order by u.name asc  ".$sql);
										} 
								}      
							}                                       
					}
					else
					{
						if ($estatusreg != 'all')
							{
							if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
								{
									if ($country == 'all')
									{
										$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."'  order by u.name asc  ".$sql);
									}
									else
									{
										if ($country != 'all')
											{
												$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."'  and c.id_country = ".$country."  order by u.name asc  ".$sql);
											}
									}    
								}
							else
								{
									if ($country == 'all')
										{
										$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."')  order by u.name asc  ".$sql);
										}
									else
									{
										if ($country != 'all')
											{
												$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and c.id_country = ".$country."  order by u.name asc  ".$sql);
											}
									}      
								}                        
							}
					}
									
			}	


		$abuscar = $buscar;

		if ($pagina == 0 or $pagina == 1)
			{
				//se buscan el total de registros
				
				//$regusertotal = DB::select("select count(id) as totalregbuscar FROM user WHERE id > 1 ");

				if ($buscar == '')
			    {
						if ($estatusreg == 'all')
							{ 
								if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
								{
									if ($country == 'all')
										{
												$regusertotal = DB::select("select count(id) as totalregbuscar FROM user WHERE id > 1  ");
										}
									else
										{
											if ($country != 'all')
											{
														$regusertotal = DB::select("select count(u.id) as totalregbuscar FROM user u left join countries c on u.country = c.id_country WHERE u.id > 1 and c.id_country = ".$country."  ");
											}
										}                                        
								}
							else
								{
									if ($country == 'all')
										{
											$regusertotal = DB::select("select count(id) as totalregbuscar FROM user WHERE id > 1 and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."')  ");
										}
									else
									{
										if ($country != 'all')
											{
												$regusertotal = DB::select("select count(u.id) as totalregbuscar FROM user u left join countries c  on u.country = c.id_country WHERE u.id > 1 and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and c.id_country = ".$country."  ");
											}
									}       
								}                                                    
							}
						else
							{
								if ($estatusreg != 'all')
									{
										if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
											{
												if ($country == 'all')
												{
											$regusertotal = DB::select("select count(id) as totalregbuscar FROM user WHERE id > 1 and confirmed = '".$estatusreg."'  ");
												}
												else
												{
													if ($country != 'all')
														{
															$regusertotal = DB::select("select count(u.id) as totalregbuscar FROM user u left join countries c on u.country = c.id_country WHERE u.id > 1 and u.confirmed = '".$estatusreg."' and c.id_country = ".$country."  ");
														}
												}    
											}
										else
											{
												if ($country == 'all')
												{
													$regusertotal = DB::select("select count(id) as totalregbuscar FROM user WHERE id > 1 and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and confirmed = '".$estatusreg."'  ");
												}
												else
												{
													if ($country != 'all')
														{
															$regusertotal = DB::select("select count(u.id) as totalregbuscar FROM user u left join countries c on u.country = c.id_country WHERE u.id > 1 and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and u.confirmed = '".$estatusreg."' and c.id_country = ".$country."  ");
														}
												}
													
											}      
									}
							}                              
					}
					else
					{
						if ($estatusreg == 'all')
							{ 
								if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
									{
										if ($country == 'all')
											{
											$regusertotal = DB::select("select count(id) as totalregbuscar FROM user WHERE MATCH(name,lastname,email)  AGAINST ('+$buscar*' IN BOOLEAN MODE)  ");
											}
										else
											{
											if ($country != 'all')
												{
													$regusertotal = DB::select("select count(u.id) as totalregbuscar FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and c.id_country = ".$country."  ");
												}
											}    
									}
								else
								{
									if ($country == 'all')
										{
										$regusertotal = DB::select("select count(id) as totalregbuscar FROM user WHERE MATCH(name,lastname,email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') ");
										}
									else
									{
										if ($country != 'all')
											{
												$regusertotal = DB::select("select count(u.id) as totalregbuscar FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and c.id_country = ".$country."  ");
											}
									}     
								}      
							}
						else
							{
								if ($estatusreg != 'all')
									{
										if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
										{
											if ($country == 'all')
												{
												$regusertotal = DB::select("select count(id) as totalregbuscar FROM user WHERE MATCH(name,lastname,email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."'  ");
												}
											else
												{
													if ($country != 'all')
													{  
														$regusertotal = DB::select("select count(u.id) as totalregbuscar FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and u.confirmed = '".$estatusreg."' and c.id_country = ".$country."  ");
													}
												}  
										}
										else
										{
											if ($country == 'all')
												{
												$regusertotal = DB::select("select count(id) as totalregbuscar FROM user WHERE MATCH(name,lastname,email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."')  ");
												}
											else
												{
													if ($country != 'all')
													{ 
														$regusertotal = DB::select("select count(u.id) as totalregbuscar FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and u.confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and c.id_country = ".$country."  ");
													}
												}     
										}      
									}
							}
							
						
					} 

               																											
				$cuantosregtotal = $regusertotal[0]->totalregbuscar;

				$num_total_registros = $cuantosregtotal;
								
				$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA); 
				
				echo '<script type="text/javascript">
				$(document).ready(function() {  
				var $myGroup = $("#contentuser");
				$myGroup.on("show.bs.collapse",".collapse", function() {
				$("body").find("div.collapse").removeClass("in")
				});
				});
				</script>';
				
				if ($cuantosregtotal > 0) 
					{
						echo '<div id="msgbox" class="alert alert-success" style="width:45%!important;padding: 5px;!important;display:none;">   ';
						echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
						echo '<div class="bg-green alert-icon">';
						echo '<i class="glyph-icon icon-check"></i>';
						echo '</div>';
						echo '<div class="alert-content"> ';
						echo '<h4 id="titulomsg" class="alert-title"></h4>';
						echo '<p id="boxms"></p>';
						echo '</div>';
						echo '</div>';
						echo '<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">';
						echo '<table id="tbldashboard" class="table">';
						echo '<thead>';
						echo '<tr>';
						echo '<th scope="col"></th>';
						echo '<th scope="col">Name</th>';
						echo '<th scope="col">Last Name</th>';
						echo '<th scope="col">Email</th>';
						echo '<th scope="col">Country</th>';
						echo '<th scope="col">Created At</th>';
						echo '<th scope="col">Email Status</th>';
						echo '<th scope="col">KYC</th>';
            echo '<th scope="col">KYC Status</th>';          
						echo '</tr>';
						echo '</thead>';
						echo '<tbody id="contentuser">';
						foreach ($reguser as $dato) 
							{
								//echo $dato->confirmed;
								 echo ' <tr id="tr'.$dato->id.'">';
								echo '<th class="align-middle" width="50"><a style="border:#392068 !important; background:#392068 !important;" class="btn btn-info expa" data-toggle="collapse" href="#collapseExample'.$dato->id.'" role="button" aria-expanded="false" data-parent="contentuser" aria-controls="#collapseExample'.$dato->id.'"><i class="fas fa-angle-double-down"></i></th></a>';
								echo '<td class="align-middle colorcelda_'.$dato->id.'">'.$dato->name.'</td>';
								echo '<td class="align-middle colorcelda_'.$dato->id.'">'.$dato->lastname.'</td>';
								echo '<td class="align-middle colorcelda_'.$dato->id.'">'.$dato->email.'</td>'; 
								echo '<td class="align-middle colorcelda_'.$dato->id.'">'.$dato->namecountry.'</td>';
								echo '<td class="align-middle colorcelda_'.$dato->id.'">'.$dato->createDate.'</td>'; 
                                              
								$emailconf;
								if( $dato->emailconfirmed == 'YES' ){
									$emailconf = '<span data-feather="check-square"></span><a>&nbsp;Accepted</a>';
								}else{
									$emailconf = '<span data-feather="alert-triangle"></span><a>&nbsp;Pending</a></td>';
								}
								echo '<td>'.$emailconf.'</td>';
								echo '<td class="align-middle" width="150">';
								if ( $dato->kyc1confirmed == 'YES' && $dato->confirmedChecks == 'YES'){   //$dato->confirmedChecks
									echo '<span class="label label-success">YES</span>';
								}else{
										
									echo '<span data-feather="alert-triangle"></span><a >&nbsp;NO</a></td>';
								}				
                
                echo '<td id="elestatus_'.$dato->id.'" class="align-middle colorcelda_'.$dato->id.'" width="150">';
								if ($dato->confirmed == 'YES'){
									echo '<span class="label label-success">Accept</span>';
								}else{
									if ($dato->confirmed == 'NO'){
											echo '<span data-feather="alert-triangle"></span><a>&nbsp;Pending</a></td>';
									}else{
										if ($dato->confirmed == 'REC'){
											echo '<span class="label label-danger">Decline</span>';
										}	

									}	
								}
                					
								echo '</tr>';
								$photo;
								$document;
								if ($dato->identificationImage != ''){
									$document = '<a data-fancybox="gallery" href="https://belotto.tokennow.io/'.$dato->identificationImage.'/mostrar"><img src="https://belotto.tokennow.io/'.$dato->identificationImage.'/mostrarthumb" class="img-thumbnail" width="50" /></a>';
								}else{
									$document = '<a><img src="https://mgmt.tokennow.io/img/default-avatar.png" class="img-thumbnail" width="50" /></a>';
								}  
								if ($dato->selfie != ''){
									$photo = '<a data-fancybox="gallery" href="https://belotto.tokennow.io/'.$dato->selfie.'/mostrar"><img src="https://belotto.tokennow.io/'.$dato->selfie.'/mostrarthumb" class="img-thumbnail" width="50" /></a>';
								} else{
									$photo = '<a href="https://mgmt.tokennow.io/img/default-avatar.png"><img src="https://mgmt.tokennow.io/img/default-avatar.png" class="img-thumbnail" width="50" /></a>';
								}  
								/* Select Action */
								$select = "";
								//echo $dato->confirmed;
								if ($dato->confirmed == 'YES'){
									$select.='<option value="YES" selected="selected" >Accept</option>';	
									$select.='<option value="REC">Decline</option>';
									$select.=' <option value="NO" >Pending</option>';
								}else{
									if ($dato->confirmed == 'NO'){
										$select.='<option value="YES"  >Accept</option>';	
										$select.='<option value="REC">Decline</option>';
										$select.=' <option value="NO" selected="selected" >Pending</option>';
									}else{
										if ($dato->confirmed == 'REC'){
											$select.='<option value="YES"  >Accept</option>';	
											$select.='<option value="REC" selected="selected" >Decline</option>';
											$select.=' <option value="NO" >Pending</option>';
										}	

									}	

								}	
								echo '<tr><td colspan="8" style="padding:0px !important;"><div class="collapse" id="collapseExample'.$dato->id.'">
								  <table class="table" border="0" width="100%" style="margin-bottom:0px; background:#f5f5f5 !important; border:none !important;">
									  <tr>
										<th class="tg-yw4l">Wallet</th>
										<th class="tg-yw4l" width="180">Id Type</th>
										<th class="tg-yw4l">ID Number</th>
										<th class="tg-yw4l">Birthday</th>										
										<th class="tg-yw4l">Photo</th>
										<th class="tg-yw4l">Document</th>
									  </tr>
									  <tr>
										<td class="align-middle" style="vertical-align: middle;">'.$dato->ercWallet.'</td>
										<td class="align-middle" style="vertical-align: middle;">'.$dato->identificationType.'</td>
										<td class="align-middle" style="vertical-align: middle;">'.$dato->identification.'</td>
										<td class="align-middle" style="vertical-align: middle;">'.$dato->birthdate.'</td>										
										<td class="align-middle" style="vertical-align: middle;">'.$document.'</td>
										<td class="align-middle" style="vertical-align: middle;">'.$photo.'</td>
									  </tr>
									</table>
								</div></td></tr>';
							}
							echo  '</tbody>';
							echo  '</table> ';		
					}//fin de si hay registros

			}	
		else
			{
				echo '<script type="text/javascript">
				$(document).ready(function() {  
				var $myGroup = $("#contentuser");
				$myGroup.on("show.bs.collapse",".collapse", function() {
				$("body").find("div.collapse").removeClass("in")
				});
				});
				</script>';
				if ($pagina > 1)
					{
						$cuantosregtotal = $num_total_registros;											
															
						$num_total_registros = $cuantosregtotal;
						
						$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA); 

						if ($cuantosregtotal > 0)
							{	
								echo '<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">';
								echo '<table id="tbldashboard" class="table">';
								echo '<thead>';
								echo '<tr>';
								echo '<th scope="col"></th>';
								echo '<th scope="col">Name</th>';
								echo '<th scope="col">Last Name</th>';
								echo '<th scope="col">Email</th>';
								echo '<th scope="col">Country</th>';
								echo '<th scope="col">Created At</th>';
								echo '<th scope="col">Email Status</th>';
								echo '<th scope="col">KYC</th>';
            echo '<th scope="col">KYC Status</th>'; 
								echo '</tr>';
								echo '</thead>';
								echo '<tbody id="contentuser">';
								foreach ($reguser as $dato) 
								{
								echo ' <tr id="'.$dato->id.'">';
								echo '<th class="align-middle" width="50"><a style="border:#392068 !important; background:#392068 !important;" class="btn btn-info expa" data-toggle="collapse" href="#collapseExample'.$dato->id.'" role="button" aria-expanded="true" aria-controls="#collapseExample'.$dato->id.'"><i class="fas fa-angle-double-down"></i></th></a>';
								echo '<td class="align-middle colorcelda_'.$dato->id.'">'.$dato->name.'</td>';
								echo '<td class="align-middle colorcelda_'.$dato->id.'">'.$dato->lastname.'</td>';
								echo '<td class="align-middle colorcelda_'.$dato->id.'">'.$dato->email.'</td>'; 
								echo '<td class="align-middle colorcelda_'.$dato->id.'">'.$dato->namecountry.'</td>';
								echo '<td class="align-middle colorcelda_'.$dato->id.'">'.$dato->createDate.'</td>'; 
								$emailconf;
								if( $dato->emailconfirmed == 'YES' ){
									$emailconf = '<span data-feather="check-square"></span><a>&nbsp;Accepted</a>';
								}else{
									$emailconf = '<span data-feather="alert-triangle"></span><a>&nbsp;Pending</a></td>';
								}
								echo '<td>'.$emailconf.'</td>';
								echo '<td class="align-middle" width="150">';
								if ( $dato->kyc1confirmed == 'YES' && $dato->confirmedChecks == 'YES'){   //$dato->confirmedChecks
									echo '<span class="label label-success">YES</span>';
								}else{
										
									echo '<span data-feather="alert-triangle"></span><a >&nbsp;NO</a></td>';
								}				
                
                echo '<td id="elestatus_'.$dato->id.'" class="align-middle colorcelda_'.$dato->id.'" width="150">';
								if ($dato->confirmed == 'YES'){
									echo '<span class="label label-success">Accept</span>';
								}else{
									if ($dato->confirmed == 'NO'){
											echo '<span data-feather="alert-triangle"></span><a>&nbsp;Pending</a></td>';
									}else{
										if ($dato->confirmed == 'REC'){
											echo '<span class="label label-danger">Decline</span>';
										}	

									}	
								}								
								echo '</tr>';
								$photo;
								$document;									
								if ($dato->identificationImage != ''){
									$document = '<a data-fancybox="gallery" href="https://belotto.tokennow.io/'.$dato->identificationImage.'/mostrar"><img src="https://belotto.tokennow.io/'.$dato->identificationImage.'/mostrarthumb" class="img-thumbnail" width="50" /></a>';
								}else{
									$document = '<a data-fancybox="gallery" href="https://mgmt.tokennow.io/img/default-avatar.png"><img src="https://mgmt.tokennow.io/img/default-avatar.png" class="img-thumbnail" width="50" /></a>';
								}  
								if ($dato->selfie != ''){
									$photo = '<a data-fancybox="gallery" href="https://belotto.tokennow.io/'.$dato->selfie.'/mostrar"><img src="https://belotto.tokennow.io/'.$dato->selfie.'/mostrarthumb" class="img-thumbnail" width="50" /></a>';
								} else{
									$photo = '<a data-fancybox="gallery" href="https://belotto.tokennow.io/img/default-avatar.png"><img src="https://mgmt.tokennow.io/img/default-avatar.png" class="img-thumbnail" width="50" /></a>';
								}  
								/* Select Action */
								$select = "";
								if ($dato->confirmed == 'YES'){
									$select.='<option value="YES" selected="selected" >Accept</option>';	
									$select.='<option value="REC">Decline</option>';
									$select.=' <option value="NO" >Pending</option>';
								}else{
									if ($dato->confirmed == 'NO'){
										$select.='<option value="YES"  >Accept</option>';	
										$select.='<option value="REC">Decline</option>';
										$select.=' <option value="NO" selected="selected" >Pending</option>';
									}else{
										if ($dato->confirmed == 'REC'){
											$select.='<option value="YES"  >Accept</option>';	
											$select.='<option value="REC" selected="selected" >Decline</option>';
											$select.=' <option value="NO" >Pending</option>';
										}	

									}	

								}	
								echo '<tr><td colspan="8" style="padding:0px !important;"><div class="collapse" id="collapseExample'.$dato->id.'">
								  <table class="table" border="0" width="100%" style="margin-bottom:0px; background:#f5f5f5 !important; border:none !important;">
									  <tr>
										<th class="tg-yw4l">Wallet</th>
										<th class="tg-yw4l" width="180">ID Type</th>										
										<th class="tg-yw4l">ID Number</th>
										<th class="tg-yw4l">Birthday</th>										
										<th class="tg-yw4l">Photo</th>
										<th class="tg-yw4l">Document</th>
									  </tr>
									  <tr>
										<td class="align-middle" style="vertical-align: middle;">'.$dato->ercWallet.'</td>
										<td class="align-middle" style="vertical-align: middle;">'.$dato->identificationType.'</td>
										<td class="align-middle" style="vertical-align: middle;">'.$dato->identification.'</td>
										<td class="align-middle" style="vertical-align: middle;">'.$dato->birthdate.'</td>
										<td class="align-middle" style="vertical-align: middle;">'.$document.'</td>
										<td class="align-middle" style="vertical-align: middle;">'.$photo.'</td>										
									  </tr>
									</table>
								</div></td></tr>';										
							}
								echo  '</tbody>';
								echo  '</table> ';	

							}	//fin de si hay registros

					}	
			}	
			echo  '</div>';
            echo  '<div id="divbot" style="position:relative; left:1%!important;text-align:center;" >';
			//paginador///////
			$script = '';
			if ($total_paginas > 1)
				{
				
						if ($pagina - 1 > 0)
							{
							$antespagina = $pagina - 1;
							}	
						else
							{
							$antespagina = $total_paginas;
							}
						if ($pagina == 1)
							{
							$script .=  "<a id='pagina_atras' href='javascript:;' class='btn'  disabled='disabled' data-atras='1' style='font-size: 0.7em;padding: 3px 6px!important;color:#ffffff;background-color:#392068' onclick='verlista(".$antespagina.",&quot;".$abuscar."&quot;,".$num_total_registros.",&quot;".$estatusreg."&quot;,&quot;".$fecha."&quot;,&quot;".$country."&quot;,&quot;".$fecha2."&quot;)' >Back</a> ";  //$buscar,$estatusreg,$fecha
							}
						else
							{
							$script .=  "<a id='pagina_sig' href='javascript:;' class='btn'   style='font-size: 0.7em;padding: 3px 6px!important;color:#ffffff;background-color:#392068' data-sig='0' onclick='verlista(1,&quot;".$abuscar."&quot;,".$num_total_registros.",&quot;".$estatusreg."&quot;,&quot;".$fecha."&quot;,&quot;".$country."&quot;,&quot;".$fecha2."&quot;)' >First</a> ";

							$script .=  "<a id='pagina_atras' href='javascript:;' class='btn'  data-atras='1' style='font-size: 0.7em;padding: 3px 6px!important;color:#ffffff;background-color:#392068' onclick='verlista(".$antespagina.",&quot;".$abuscar."&quot;,".$num_total_registros.",&quot;".$estatusreg."&quot;,&quot;".$fecha."&quot;,&quot;".$country."&quot;,&quot;".$fecha2."&quot;)' >Back</a> ";
							}	
						
						for ($i=1;$i<=$total_paginas;$i++){
							
							if ($pagina == $i)
								{
									//si muestro el ÃƒÂ­ndice de la pÃƒÂ¡gina actual, no coloco enlace
									$script .=  $pagina . " ";
								} 
							else
								{
									//si el ÃƒÂ­ndice no corresponde con la pÃƒÂ¡gina mostrada actualmente, coloco el enlace para ir a esa pÃƒÂ¡gina $ruta  style='font-size: 0.7em;'
									$v1zq = $pagina - 3; 
									
									$v2zq = $pagina - 2;	
									
									$v4zq = $pagina - 1;
									
									//por el derecho
									
									$v1der = $pagina + 1;
									
									$v2der = $pagina + 2;	
									
									$v4der = $pagina + 3;
									
									if ($i >= $v1zq and $i <= $v4der )
										{
											$script .=  "<a id='pagina_".$i."' href='javascript:;' class='btn' data-pagina='".$i."' style='font-size: 0.7em;padding: 3px 6px!important;color:#ffffff;background-color:#392068' onclick='verlista(".$i.",&quot;".$abuscar."&quot;,".$num_total_registros.",&quot;".$estatusreg."&quot;,&quot;".$fecha."&quot;,&quot;".$country."&quot;,&quot;".$fecha2."&quot;)' >" . $i . "</a> ";
										}
									else
										{
											$script .=  "<a id='pagina_".$i."' href='javascript:;' class='btn' style='display:none;font-size: 0.7em;padding: 3px 6px!important;color:#ffffff;background-color:#392068' data-pagina='".$i."' onclick='verlista(".$i.",&quot;".$abuscar."&quot;,".$num_total_registros.",&quot;".$estatusreg."&quot;,&quot;".$fecha."&quot;,&quot;".$country."&quot;,&quot;".$fecha2."&quot;)' >" . $i . "</a> ";
										}
								}			
						}
				$buscar = "";	
				
				if (($pagina + 1) <  $total_paginas)
					{
					$siguientepagina = $pagina + 1;
					}	
				else
					{
					$siguientepagina = 0;
					}
				
				$script .=  "<a id='pagina_sig' href='javascript:;' class='btn'   data-sig='1' style='font-size: 0.7em;padding: 3px 6px!important;color:#ffffff;background-color:#392068' onclick='verlista(".$siguientepagina.",&quot;".$abuscar."&quot;,".$num_total_registros.",&quot;".$estatusreg."&quot;,&quot;".$fecha."&quot;,&quot;".$country."&quot;,&quot;".$fecha2."&quot;)' >Next</a> ";
				
				$script .=  "<a id='pagina_sig' href='javascript:;' class='btn'   style='font-size: 0.7em;padding: 3px 6px!important;color:#ffffff;background-color:#392068' data-sig='".$total_paginas."' onclick='verlista(".$total_paginas.",&quot;".$abuscar."&quot;,".$num_total_registros.",&quot;".$estatusreg."&quot;,&quot;".$fecha."&quot;,&quot;".$country."&quot;,&quot;".$fecha2."&quot;)' >last</a> ";									
				
				}	
		
			$tiempo_fin = microtime(true);
			
			$totaltime =  " (".($tiempo_fin - $tiempo_inicio)." segundos) "; 
				
			$script .= "<br><label style='font-size: 0.9em;'>Records found: " . number_format($num_total_registros) . "</label><br>"; //" ".$totaltime. 
			//$script .= "Se muestran pÃƒÂ¡ginas de " . $TAMANO_PAGINA . " registros cada una<br>";
			$script .= "<label style='font-size: 0.9em;'>Showing the page " . $pagina . " of " . number_format($total_paginas) . "</label>";
			$script .= "</div>";
			echo $script;
			
			/**********paginador **********************///	

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
	
	public function guardarreason(Request $request,$iduser,$reason,$valor)
  
	{
		

		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
	
		if (is_null(Session::get('id_usuario')))
			{
				return redirect('/');
			}

		@session_start();	
		
	    //se realiza la eliminacion de  o de las imagenes del usuario las cuales son la del error
		$imgaborrar =  explode("_;_", $reason);	  

		//se busca la data antes de cambiarla

		$reguserprev = DB::select("select u.* FROM user u  WHERE u.id = ".$iduser);

		$datosprev = json_encode($reguserprev);

		//se registra en la tabla de log_adm
		DB::table('log_admin')->insert(
			array(
			'id_user_admin'     => Session::get('id_usuario'), 
			'id_user'  			=> $iduser,
			'previous_data' 	=> $datosprev,
			'current_data' 		=> '..',
			'created'			=> date("Y-m-d H:m:s")
			)		
		);
		//se captura el id del registro
		$idlog= Logadmin::all();

		$idlog = $idlog->last();

		$idlog = $idlog['id'];

		if ($imgaborrar[0] == 'ID PHOTO')
			{
				//se elimina la imagen y se limpa el campo de la tabla de user para identificationImage
				$regimgid = DB::select("select u.identificationImage FROM user u  WHERE u.id = ".$iduser);
				
				if (count($regimgid) > 0)
					{
						//se elmina la imagen 
						//se limpia el campo en la tabla user
						DB::table('user')->where('id', '=',$iduser)
							->update(['identificationImage' => null,							
						
						]); 
						
						
					}//fin de if count
				
			}//fin de si se elimina la identificationImage
		else
			{
				if ($imgaborrar[0] == 'SELFIE WITH DOCUMENT')
					{
						//se elimina la imagen y se limpa el campo de la tabla de user para selfie
						$regimgid = DB::select("select u.selfie FROM user u  WHERE u.id = ".$iduser);
						
						if (count($regimgid) > 0)
							{
								//se elmina la imagen 
								//se limpia el campo en la tabla user
								DB::table('user')->where('id', '=',$iduser)
									->update(['selfie' => null,							
								
								]); 
								
								
							}//fin de if count
					}
				else
					{
						if ($imgaborrar[0] == 'BOTH PHOTOS')
							{
								//se eliminan las dos imagenes y se limpian los campos de la tabla de user para ambas imagenes
								$regimgid = DB::select("select u.identificationImage,u.selfie FROM user u  WHERE u.id = ".$iduser);
								
								if (count($regimgid) > 0)
									{
										
										//se limpian los campos en la tabla user
										DB::table('user')->where('id', '=',$iduser)
											->update(['identificationImage' => null,'selfie' =>null]);
										
										
									}//fin de if count
							}	
					}	
			}	

		//se actualiza el campo de confirmed 
		DB::table('user')->where('id', '=',$iduser)
				->update(['confirmed' => $valor,							
				
				]);  

		//se registra el campo de datos actuales
		$regusercurr = DB::select("select u.* FROM user u  WHERE u.id =".$iduser);

		$datoscurr = json_encode($regusercurr);

		//se carga el current_data luego del cambio
		DB::table('log_admin')->where('id', '=',$idlog)
				->update(['current_data' => $datoscurr,							
				
				]); 

		if ($reason == '_' )
			{
				$reason = $valor;
			}		
		//se registra en la tabla de historico de confirmed	

		DB::table('history_confirmed')->insert(
			array(
			'id_user_admin'     => Session::get('id_usuario'), 
			'id_user' 			=> $iduser,
			'reason'  			=> $reason,
			'created'			=> date("Y-m-d H:m:s")
			)		
		);				
		
   //buscamos el email del usuario
   
   $regemail = DB::select("SELECT email,name,lastname from user where id = ".$iduser);
   
   //se envian los correos
   //prinmero el rechazo
   if ($valor == 'REC')
     {
         //buscamos el porque
         
         
         //se busca el motivo por el cual fue rechazado
         $regmotivo = DB::select("select reason FROM history_confirmed WHERE id_user = ".$iduser." order by id desc limit 1");  
         
		 //$regmotivo = explode("_;_", $regmotivo[0]->reason);
		 
		 $regmotivo = $regmotivo[0]->reason;
     
         $valores = array( 'email' => strtolower($regemail[0]->email));
					
				$data = array('name'=>"Mr(s). ".$regemail[0]->name." ".$regemail[0]->lastname, 
						"body" => 'Belotto Information',
						"motivo"=>"'.$regmotivo.'"); 
						//"motivo"=>"'.$regmotivo[1].'"); 
   
				Mail::send('email.denied', $data, function($message) use ($valores){	  
					
					$message->to($valores['email'], 'Information')
								->subject('KYC');
						
					$message->from('noreply@belotto.io', 'Belotto');
					
				});	
     }
    else
      {
          if ($valor == 'YES')
             {
                 //buscamos el porque
                 
                 
                 $valores = array( 'email' => strtolower($regemail[0]->email));
        					
        				$data = array('name'=>"Mr(s). ".$regemail[0]->name." ".$regemail[0]->lastname, 
        						"body" => 'Belotto Information',
        						"motivo"=>""); 
           
        				Mail::send('email.approved', $data, function($message) use ($valores){	  
        					
        					$message->to($valores['email'], 'Information')
        								->subject('KYC');
        						
        					$message->from('noreply@belotto.io', 'Belotto');
        					
        				});	
             }
      } 
		

		return 1;		 
	
	}
	
	public function upgrade(Request $request)
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

				
				$data = array(
					"label_caption" => 'Upgrade USD Value'
				);  
				
				$regether = DB::select("select valor_usd, valor_ether, created FROM history_ether WHERE id > 0 order by id desc");
			
				if (count($regether) > 0 )
					{
						$valor_usd = $regether[0]->valor_usd;

						$valor_ether = $regether[0]->valor_ether;

						$fechareg = $regether[0]->created;

					}
				else
					{
						$valor_usd = "660";

						$valor_ether = "4140";

						$fechareg = "2018-04-28 18:05:19";

					}	


				//se toma el ultimo valor referencial de la tabla

				$regetherlast = DB::select("select valor_usd, valor_ether, created FROM history_ether WHERE id > 0 order by id desc limit 1");

				if (count($regetherlast) > 0 )
					{
						$valor_usdlast = $regetherlast[0]->valor_usd;

						$valor_etherlast = $regetherlast[0]->valor_ether;

						$fechareglast = $regetherlast[0]->created;

					}
				else
					{
						$valor_usdlast = "660";

						$valor_etherlast = "4140";

						$fechareglast = "2018-04-28 18:05:19";

					}	

						return view('dashboard.upgrade', compact('data'))->with(['valor_usdlast'=>$valor_usdlast,'valor_etherlast'=>$valor_etherlast,'fechareglast'=>$fechareglast, 'regether'=>$regether]);
			}

			public function upgradeether(Request $request)
		{
			header('Access-Control-Allow-Origin: *');
			header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
			header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
		
			if (is_null(Session::get('id_usuario')))
				{
					return redirect('/');
				}

			@session_start();	
			
			//se registran los valores del history_ether 

			DB::table('history_ether')->insert(
				array(
				'id_user_admin'     => Session::get('id_usuario'), 
				'valor_usd'  		=> $request->input('valor_usd'),
				'valor_ether' 		=> $request->input('valor_ether'),
				'created'			=> date("Y-m-d H:m:s")
				)		
			);	

							
			Session::put('mensaje',trans("The values have been updated"));
		
			return back();					
						
		
		}	
		
	public function enviaremailk(Request $request)
		{
			header('Access-Control-Allow-Origin: *');
			header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
			header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

				$valores = array( 'email' => 'jose.torres@gecko.com.co');
							
				$data = array('name'=>"Mr(s). Jose", 
						"body" => 'Belotto Information',
						"motivo"=>"prueba"); 
						//"motivo"=>"'.$regmotivo[1].'"); 

				Mail::send('email.denied', $data, function($message) use ($valores){	  
					
					$message->to($valores['email'], 'Information')
								->subject('KYC');
						
					$message->from('josetorresgarcia66@gmail.com', 'Belotto');
					
				});	
		}

		public function descargaruser(Request $request,$buscar,$estatusreg,$fecha,$country,$fecha2)
		{
			header('Access-Control-Allow-Origin: *');
			header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
			header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');	

			if (is_null(Session::get('id_usuario')))
				{
					return redirect('/');
				}

			@session_start();	
				
			//se arma el listado en base a los parametros suministrados
			if ($buscar== '_;_')
				{
					$buscar= '';
				}	
			else
				{
					$buscar= str_replace('_..._', '%', $buscar); 

					$buscar= str_replace('_...._', '|', $buscar); 
				}	
				
			
				$sql = "";
				if ($fecha > $fecha2)
					{
						$fecha2 =  $fecha;
					}
				if ($fecha == '0000-00-00' and  $fecha2 != '0000-00-00')
					{
						$fecha =  $fecha2;
					}	
				if ($fecha != '0000-00-00' and  $fecha2 == '0000-00-00')
					{
						$fecha2 =  date('Y-m-d');
					}
					
				if ($buscar == '')
					{
						if ($estatusreg == 'all')
						{
							if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
								{
									if ($country == 'all')
									{
												$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and kyc1confirmed = 'YES' and confirmedChecks = 'YES' order by u.name asc ".$sql);
									}
									else
									{
										if ($country != 'all')
											{ 
												$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and kyc1confirmed = 'YES' and confirmedChecks = 'YES' and c.id_country = ".$country." order by u.name asc ".$sql);
											}  
									}                               
								}
							else
								{
									if ($country == 'all')
										{  
										$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and kyc1confirmed = 'YES' and confirmedChecks = 'YES' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') order by u.name asc ".$sql); 
										}
									else
										{
											if ($country != 'all')
												{
													$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and kyc1confirmed = 'YES' and confirmedChecks = 'YES' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and c.id_country = ".$country." order by u.name asc ".$sql);
												}
										}     
									
								}                          
						}
					else
						{
							if ($estatusreg != 'all')
								{
									if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
										{
											if ($country == 'all')
												{
														$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and kyc1confirmed = 'YES' and confirmedChecks = 'YES' and confirmed = '".$estatusreg."' order by u.name asc ".$sql);
												}
											else
											{
												if ($country != 'all')
													{
														$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and kyc1confirmed = 'YES' and confirmedChecks = 'YES' and confirmed = '".$estatusreg."'  and c.id_country = ".$country." order by u.name asc ".$sql);
													}
											}                               
										}
									else
										{
											if ($country == 'all')
												{
												$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and kyc1confirmed = 'YES' and confirmedChecks = 'YES' and confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') order by u.name asc ".$sql);
												}
											else
											{
												if ($country != 'all')
													{
														$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and kyc1confirmed = 'YES' and confirmedChecks = 'YES' and confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and c.id_country = ".$country." order by u.name asc ".$sql);
													}
											}       
										}                         
								}               
						}                   
					}
				else
					{  //el buscar tiene datos
							if ($estatusreg == 'all')
							{
								if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
									{
										if ($country == 'all')
										{
											$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE)  and kyc1confirmed = 'YES' and confirmedChecks = 'YES' order by u.name asc  ".$sql);
										}
										else
										{
											if ($country != 'all')
												{
												$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE)  and kyc1confirmed = 'YES' and confirmedChecks = 'YES' and DATE(createDate) ='".$fecha."' order by u.name asc  ".$sql);
												}  
										}    
									}
								else
									{
										if ($country == 'all')
										{
											$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE)  and kyc1confirmed = 'YES' and confirmedChecks = 'YES' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."')  order by u.name asc  ".$sql);
										}
										else
										{
											if ($country != 'all')
												{
													$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE)  and kyc1confirmed = 'YES' and confirmedChecks = 'YES' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."')  and c.id_country = ".$country." order by u.name asc  ".$sql);
												} 
										}      
									}                                       
							}
							else
							{
								if ($estatusreg != 'all')
									{
									if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
										{
											if ($country == 'all')
											{
												$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."' and kyc1confirmed = 'YES' and confirmedChecks = 'YES' order by u.name asc  ".$sql);
											}
											else
											{
												if ($country != 'all')
													{
														$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."' and kyc1confirmed = 'YES' and c.id_country = ".$country." and confirmedChecks = 'YES' order by u.name asc  ".$sql);
													}
											}    
										}
									else
										{
											if ($country == 'all')
												{
												$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and kyc1confirmed = 'YES' and confirmedChecks = 'YES' order by u.name asc  ".$sql);
												}
											else
											{
												if ($country != 'all')
													{
														$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and c.id_country = ".$country." and kyc1confirmed = 'YES' and confirmedChecks = 'YES' order by u.name asc  ".$sql);
													}
											}      
										}                        
									}
							}
											
					}
				
			$abuscar = $buscar;		

			if(count($reguser) > 0)
				{
	
					$delimiter = ",";

					$filename = "users_" . date('Y_m_d_His') . ".csv";

					//create a file pointer
    				$f = fopen('php://memory', 'w');

					//set column headers
					$fields = array('id', 'name', 'lastname', 'tokenreferrals', 'createDate ', 'email','password','emailReferred','confirmed','confirmationCode','emailconfirmed','kyc1confirmed','ercWallet','telegramuser','country','identificationType','identification','identificationImage','selfie','birthdate','gender','confirmedChecks');

					fputcsv($f, $fields, $delimiter);

					foreach ($reguser as $dato) 
						{	
							//el nombre del pais
							$repaises = DB::select("select  name FROM countries WHERE estado = 1 and id_country = ".$dato->country);  	
							if (count($repaises) > 0)
								{
									$namecountry = $repaises[0]->name;
								}
							else
								{
									$namecountry = 'NA';
								}	
							if ($dato->confirmed == 'NO')
								{
									$nestatus = 'Pending';
								}	
							else
								{
									if ($dato->confirmed == 'YES')
										{
											$nestatus = 'Accept';
										}	
									else
										{
											if ($dato->confirmed == 'REC')
												{
													$nestatus = 'Decline';
												}
										}	
								}	
							$lineData = array($dato->id,
											$dato->name,
											$dato->lastname,
											$dato->tokenreferrals,
											$dato->createDate,
											$dato->email,
											$dato->password,
											$dato->emailReferred,
											$nestatus,
											$dato->confirmationCode,
											$dato->emailconfirmed,
											$dato->kyc1confirmed,
											$dato->ercWallet,
											$dato->telegramuser,
											$namecountry,
											$dato->identificationType,
											$dato->identification,
											$dato->identificationImage,
											$dato->selfie,
											$dato->birthdate,
											$dato->gender,
											$dato->confirmedChecks										
										);
							fputcsv($f, $lineData, $delimiter);
						}//fin del foreach
					//move back to beginning of file
				fseek($f, 0);
				
				//set headers to download file rather than displayed
				header('Content-Type: text/csv');
				header('Content-Disposition: attachment; filename="' . $filename . '";');
				
				//output all remaining data on a file pointer
				fpassthru($f);
	

				}//fin de si hayy registros		
				return 1;
			}

			public function descargaruserreg(Request $request,$buscar,$estatusreg,$fecha,$country,$fecha2)
			{
				header('Access-Control-Allow-Origin: *');
				header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
				header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');	
	
				if (is_null(Session::get('id_usuario')))
					{
						return redirect('/');
					}
	
				@session_start();	
					
				//se arma el listado en base a los parametros suministrados
				if ($buscar== '_;_')
					{
						$buscar= '';
					}	
				else
					{
						$buscar= str_replace('_..._', '%', $buscar); 
	
						$buscar= str_replace('_...._', '|', $buscar); 
					}	
					
				
					$sql = "";
					if ($fecha > $fecha2)
						{
							$fecha2 =  $fecha;
						}
					if ($fecha == '0000-00-00' and  $fecha2 != '0000-00-00')
						{
							$fecha =  $fecha2;
						}	
					if ($fecha != '0000-00-00' and  $fecha2 == '0000-00-00')
						{
							$fecha2 =  date('Y-m-d');
						}
						
					if ($buscar == '')
						{
							if ($estatusreg == 'all')
							{
								if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
									{
										if ($country == 'all')
										{
													$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 order by u.name asc ".$sql);
										}
										else
										{
											if ($country != 'all')
												{ 
													$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and c.id_country = ".$country." order by u.name asc ".$sql);
												}  
										}                               
									}
								else
									{
										if ($country == 'all')
											{  
											$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') order by u.name asc ".$sql); 
											}
										else
											{
												if ($country != 'all')
													{
														$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and c.id_country = ".$country." order by u.name asc ".$sql);
													}
											}     
										
									}                          
							}
						else
							{
								if ($estatusreg != 'all')
									{
										if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
											{
												if ($country == 'all')
													{
															$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and confirmed = '".$estatusreg."' order by u.name asc ".$sql);
													}
												else
												{
													if ($country != 'all')
														{
															$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and confirmed = '".$estatusreg."'  and c.id_country = ".$country." order by u.name asc ".$sql);
														}
												}                               
											}
										else
											{
												if ($country == 'all')
													{
													$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') order by u.name asc ".$sql);
													}
												else
												{
													if ($country != 'all')
														{
															$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and c.id_country = ".$country." order by u.name asc ".$sql);
														}
												}       
											}                         
									}               
							}                   
						}
					else
						{  //el buscar tiene datos
								if ($estatusreg == 'all')
								{
									if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
										{
											if ($country == 'all')
											{
												$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE)   order by u.name asc  ".$sql);
											}
											else
											{
												if ($country != 'all')
													{
													$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE)  and DATE(createDate) ='".$fecha."' order by u.name asc  ".$sql);
													}  
											}    
										}
									else
										{
											if ($country == 'all')
											{
												$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE)  and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."')  order by u.name asc  ".$sql);
											}
											else
											{
												if ($country != 'all')
													{
														$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE)  and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."')  and c.id_country = ".$country." order by u.name asc  ".$sql);
													} 
											}      
										}                                       
								}
								else
								{
									if ($estatusreg != 'all')
										{
										if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
											{
												if ($country == 'all')
												{
													$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."' order by u.name asc  ".$sql);
												}
												else
												{
													if ($country != 'all')
														{
															$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."' and c.id_country = ".$country."  order by u.name asc  ".$sql);
														}
												}    
											}
										else
											{
												if ($country == 'all')
													{
													$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') order by u.name asc  ".$sql);
													}
												else
												{
													if ($country != 'all')
														{
															$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and c.id_country = ".$country." order by u.name asc  ".$sql);
														}
												}      
											}                        
										}
								}
												
						}
					
				$abuscar = $buscar;		
	
				if(count($reguser) > 0)
					{
		
						$delimiter = ",";
	
						$filename = "users_" . date('Y_m_d_His') . ".csv";
	
						//create a file pointer
						$f = fopen('php://memory', 'w');
	
						//set column headers
						$fields = array('id', 'name', 'lastname', 'tokenreferrals', 'createDate ', 'email','password','emailReferred','confirmed','confirmationCode','emailconfirmed','kyc1confirmed','ercWallet','telegramuser','country','identificationType','identification','identificationImage','selfie','birthdate','gender','confirmedChecks');
	
						fputcsv($f, $fields, $delimiter);
	
						foreach ($reguser as $dato) 
							{	
								//el nombre del pais
								$repaises = DB::select("select  name FROM countries WHERE estado = 1 and id_country = ".$dato->country);  	
								if (count($repaises) > 0)
									{
										$namecountry = $repaises[0]->name;
									}
								else
									{
										$namecountry = 'NA';
									}	
								if ($dato->confirmed == 'NO')
									{
										$nestatus = 'Pending';
									}	
								else
									{
										if ($dato->confirmed == 'YES')
											{
												$nestatus = 'Accept';
											}	
										else
											{
												if ($dato->confirmed == 'REC')
													{
														$nestatus = 'Decline';
													}
											}	
									}	
								$lineData = array($dato->id,
												$dato->name,
												$dato->lastname,
												$dato->tokenreferrals,
												$dato->createDate,
												$dato->email,
												$dato->password,
												$dato->emailReferred,
												$nestatus,
												$dato->confirmationCode,
												$dato->emailconfirmed,
												$dato->kyc1confirmed,
												$dato->ercWallet,
												$dato->telegramuser,
												$namecountry,
												$dato->identificationType,
												$dato->identification,
												$dato->identificationImage,
												$dato->selfie,
												$dato->birthdate,
												$dato->gender,
												$dato->confirmedChecks										
											);
								fputcsv($f, $lineData, $delimiter);
							}//fin del foreach
						//move back to beginning of file
					fseek($f, 0);
					
					//set headers to download file rather than displayed
					header('Content-Type: text/csv');
					header('Content-Disposition: attachment; filename="' . $filename . '";');
					
					//output all remaining data on a file pointer
					fpassthru($f);
		
	
					}//fin de si hayy registros		
					return 1;
				}
				
				public function sendmailreg(Request $request,$buscar,$estatusreg,$fecha,$country,$fecha2)
				{
					header('Access-Control-Allow-Origin: *');
					header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
					header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');	
		
					if (is_null(Session::get('id_usuario')))
						{
							return redirect('/');
						}
		
					@session_start();	
						
					//se arma el listado en base a los parametros suministrados
					if ($buscar== '_;_')
						{
							$buscar= '';
						}	
					else
						{
							$buscar= str_replace('_..._', '%', $buscar); 
		
							$buscar= str_replace('_...._', '|', $buscar); 
						}	
						
					
						$sql = "";
						if ($fecha > $fecha2)
							{
								$fecha2 =  $fecha;
							}
						if ($fecha == '0000-00-00' and  $fecha2 != '0000-00-00')
							{
								$fecha =  $fecha2;
							}	
						if ($fecha != '0000-00-00' and  $fecha2 == '0000-00-00')
							{
								$fecha2 =  date('Y-m-d');
							}
							
						if ($buscar == '')
							{
								if ($estatusreg == 'all')
								{
									if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
										{
											if ($country == 'all')
											{
														$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0  order by u.name asc ".$sql);
											}
											else
											{
												if ($country != 'all')
													{ 
														$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0  and c.id_country = ".$country." order by u.name asc ".$sql);
													}  
											}                               
										}
									else
										{
											if ($country == 'all')
												{  
												$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0  and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') order by u.name asc ".$sql); 
												}
											else
												{
													if ($country != 'all')
														{
															$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0  and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and c.id_country = ".$country." order by u.name asc ".$sql);
														}
												}     
											
										}                          
								}
							else
								{
									if ($estatusreg != 'all')
										{
											if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
												{
													if ($country == 'all')
														{
																$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0  and confirmed = '".$estatusreg."' order by u.name asc ".$sql);
														}
													else
													{
														if ($country != 'all')
															{
																$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0  and confirmed = '".$estatusreg."'  and c.id_country = ".$country." order by u.name asc ".$sql);
															}
													}                               
												}
											else
												{
													if ($country == 'all')
														{
														$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') order by u.name asc ".$sql);
														}
													else
													{
														if ($country != 'all')
															{
																$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and c.id_country = ".$country." order by u.name asc ".$sql);
															}
													}       
												}                         
										}               
								}                   
							}
						else
							{  //el buscar tiene datos
									if ($estatusreg == 'all')
									{
										if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
											{
												if ($country == 'all')
												{
													$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE)  order by u.name asc  ".$sql);
												}
												else
												{
													if ($country != 'all')
														{
														$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE)  and DATE(createDate) ='".$fecha."' order by u.name asc  ".$sql);
														}  
												}    
											}
										else
											{
												if ($country == 'all')
												{
													$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE)   and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."')  order by u.name asc  ".$sql);
												}
												else
												{
													if ($country != 'all')
														{
															$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."')  and c.id_country = ".$country." order by u.name asc  ".$sql);
														} 
												}      
											}                                       
									}
									else
									{
										if ($estatusreg != 'all')
											{
											if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
												{
													if ($country == 'all')
													{
														$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."' order by u.name asc  ".$sql);
													}
													else
													{
														if ($country != 'all')
															{
																$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."' and c.id_country = ".$country."  order by u.name asc  ".$sql);
															}
													}    
												}
											else
												{
													if ($country == 'all')
														{
														$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') order by u.name asc  ".$sql);
														}
													else
													{
														if ($country != 'all')
															{
																$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and c.id_country = ".$country." order by u.name asc  ".$sql);
															}
													}      
												}                        
											}
									}
													
							}
						
					$abuscar = $buscar;		
					
					if(count($reguser) > 0)
						{
							foreach ($reguser as $dato) 
								{	
									$valores =  array( 'email' => strtolower($dato->email));

									if ($dato->confirmed == 'YES')
										{
											$data = array('name'=>"Mr(s). ".$dato->name." ".$dato->lastname, 
													"body" => 'Belotto Information',
													"motivo"=>""); 
							
											Mail::send('email.approved', $data, function($message) use ($valores){	  
												
												$message->to($valores['email'], 'Information')
															->subject('KYC');
													
												$message->from('noreply@belotto.io', 'Belotto');
												
											});	
										}
									else
										{
											if ($dato->confirmed == 'REC')
												{
														//se busca el motivo por el cual fue rechazado
														$regmotivo = DB::select("select reason FROM history_confirmed WHERE id_user = ".$dato->id." order by id desc limit 1"); 
														
														$regmotivo = $regmotivo[0]->reason;
														
														$data = array('name'=>"Mr(s). ".$dato->name." ".$dato->lastname, 
																"body" => 'Belotto Information',
																"motivo"=>"'.$regmotivo.'"); 
																//"motivo"=>"'.$regmotivo[1].'"); 
										
														Mail::send('email.denied', $data, function($message) use ($valores){	  
															
															$message->to($valores['email'], 'Information')
																		->subject('KYC');
																
															$message->from('noreply@belotto.io', 'Belotto');
															
														});	
												}
											else
												{
													if ($dato->confirmed == 'NO' and $dato->emailconfirmed == 'NO')
														{
															$data = array('name'=>"Mr(s). ".$dato->name." ".$dato->lastname, 
																	"body" => 'To validate your account, proceed to open the link...',
																	"url"=>"belotto.tokennow.io/tk/".$dato->confirmationCode); 
											
															Mail::send('email.activation', $data, function($message) use ($valores){	  
																
																$message->to($valores['email'], 'Validate email')
																			->subject('Verification Email');
																	
																$message->from('noreply@belotto.io', 'Belotto');
																
															});	
														}
												}	
										}	
									
								}//fin del foreach
						
						}//fin de si hayy registros		

						return 1;
					}	
					
		//para el kyc envio de email
		
		public function sendmailkyc(Request $request,$buscar,$estatusreg,$fecha,$country,$fecha2)
				{
					header('Access-Control-Allow-Origin: *');
					header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
					header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');	
		
					if (is_null(Session::get('id_usuario')))
						{
							return redirect('/');
						}
		
					@session_start();	
						
					//se arma el listado en base a los parametros suministrados
					if ($buscar== '_;_')
						{
							$buscar= '';
						}	
					else
						{
							$buscar= str_replace('_..._', '%', $buscar); 
		
							$buscar= str_replace('_...._', '|', $buscar); 
						}	
						
					
						$sql = "";
						if ($fecha > $fecha2)
							{
								$fecha2 =  $fecha;
							}
						if ($fecha == '0000-00-00' and  $fecha2 != '0000-00-00')
							{
								$fecha =  $fecha2;
							}	
						if ($fecha != '0000-00-00' and  $fecha2 == '0000-00-00')
							{
								$fecha2 =  date('Y-m-d');
							}
							
						if ($buscar == '')
							{
								if ($estatusreg == 'all')
								{
									if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
										{
											if ($country == 'all')
											{
														$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and kyc1confirmed = 'YES' and confirmedChecks = 'YES' order by u.name asc ".$sql);
											}
											else
											{
												if ($country != 'all')
													{ 
														$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0  and c.id_country = ".$country." and kyc1confirmed = 'YES' and confirmedChecks = 'YES' order by u.name asc ".$sql);
													}  
											}                               
										}
									else
										{
											if ($country == 'all')
												{  
												$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0  and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and kyc1confirmed = 'YES' and confirmedChecks = 'YES' order by u.name asc ".$sql); 
												}
											else
												{
													if ($country != 'all')
														{
															$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0  and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and c.id_country = ".$country." and kyc1confirmed = 'YES' and confirmedChecks = 'YES' order by u.name asc ".$sql);
														}
												}     
											
										}                          
								}
							else
								{
									if ($estatusreg != 'all')
										{
											if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
												{
													if ($country == 'all')
														{
																$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0  and confirmed = '".$estatusreg."' and kyc1confirmed = 'YES' and confirmedChecks = 'YES' order by u.name asc ".$sql);
														}
													else
													{
														if ($country != 'all')
															{
																$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0  and confirmed = '".$estatusreg."'  and c.id_country = ".$country." and kyc1confirmed = 'YES' and confirmedChecks = 'YES' order by u.name asc ".$sql);
															}
													}                               
												}
											else
												{
													if ($country == 'all')
														{
														$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and kyc1confirmed = 'YES' and confirmedChecks = 'YES' order by u.name asc ".$sql);
														}
													else
													{
														if ($country != 'all')
															{
																$reguser = DB::select("select u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE u.id > 0 and confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and c.id_country = ".$country." and kyc1confirmed = 'YES' and confirmedChecks = 'YES' order by u.name asc ".$sql);
															}
													}       
												}                         
										}               
								}                   
							}
						else
							{  //el buscar tiene datos
									if ($estatusreg == 'all')
									{
										if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
											{
												if ($country == 'all')
												{
													$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE)  and kyc1confirmed = 'YES' and confirmedChecks = 'YES' order by u.name asc  ".$sql);
												}
												else
												{
													if ($country != 'all')
														{
														$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE)  and DATE(createDate) ='".$fecha."' and kyc1confirmed = 'YES' and confirmedChecks = 'YES' order by u.name asc  ".$sql);
														}  
												}    
											}
										else
											{
												if ($country == 'all')
												{
													$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE)   and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."')  and kyc1confirmed = 'YES' and confirmedChecks = 'YES' order by u.name asc  ".$sql);
												}
												else
												{
													if ($country != 'all')
														{
															$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."')  and c.id_country = ".$country." and kyc1confirmed = 'YES' and confirmedChecks = 'YES' order by u.name asc  ".$sql);
														} 
												}      
											}                                       
									}
									else
									{
										if ($estatusreg != 'all')
											{
											if($fecha == '0000-00-00' and $fecha2 == '0000-00-00')
												{
													if ($country == 'all')
													{
														$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."' and kyc1confirmed = 'YES' and confirmedChecks = 'YES' order by u.name asc  ".$sql);
													}
													else
													{
														if ($country != 'all')
															{
																$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."' and c.id_country = ".$country."  and kyc1confirmed = 'YES' and confirmedChecks = 'YES' order by u.name asc  ".$sql);
															}
													}    
												}
											else
												{
													if ($country == 'all')
														{
														$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and kyc1confirmed = 'YES' and confirmedChecks = 'YES' order by u.name asc  ".$sql);
														}
													else
													{
														if ($country != 'all')
															{
																$reguser = DB::select("SELECT u.*,c.name as namecountry FROM user u left join countries c on u.country = c.id_country WHERE MATCH(u.name,u.lastname,u.email)  AGAINST ('+$buscar*' IN BOOLEAN MODE) and confirmed = '".$estatusreg."' and (DATE(createDate) BETWEEN '".$fecha."' AND '".$fecha2."') and c.id_country = ".$country." and kyc1confirmed = 'YES' and confirmedChecks = 'YES' order by u.name asc  ".$sql);
															}
													}      
												}                        
											}
									}
													
							}
						
					$abuscar = $buscar;		
					
					if(count($reguser) > 0)
						{
							foreach ($reguser as $dato) 
								{	
									$valores =  array( 'email' => strtolower($dato->email));

									if ($dato->confirmed == 'YES')
										{
											$data = array('name'=>"Mr(s). ".$dato->name." ".$dato->lastname, 
													"body" => 'Belotto Information',
													"motivo"=>""); 
							
											Mail::send('email.approved', $data, function($message) use ($valores){	  
												
												$message->to($valores['email'], 'Information')
															->subject('KYC');
													
												$message->from('noreply@belotto.io', 'Belotto');
												
											});	
										}
									else
										{
											if ($dato->confirmed == 'REC')
												{
														//se busca el motivo por el cual fue rechazado
														$regmotivo = DB::select("select reason FROM history_confirmed WHERE id_user = ".$dato->id." order by id desc limit 1"); 
														
														$regmotivo = $regmotivo[0]->reason;
														
														$data = array('name'=>"Mr(s). ".$dato->name." ".$dato->lastname, 
																"body" => 'Belotto Information',
																"motivo"=>"'.$regmotivo.'"); 
																//"motivo"=>"'.$regmotivo[1].'"); 
										
														Mail::send('email.denied', $data, function($message) use ($valores){	  
															
															$message->to($valores['email'], 'Information')
																		->subject('KYC');
																
															$message->from('noreply@belotto.io', 'Belotto');
															
														});	
												}
											else
												{
													if ($dato->confirmed == 'NO' and $dato->emailconfirmed == 'NO')
														{
															$data = array('name'=>"Mr(s). ".$dato->name." ".$dato->lastname, 
																	"body" => 'To validate your account, proceed to open the link...',
																	"url"=>"belotto.tokennow.io/tk/".$dato->confirmationCode); 
											
															Mail::send('email.activation', $data, function($message) use ($valores){	  
																
																$message->to($valores['email'], 'Validate email')
																			->subject('Verification Email');
																	
																$message->from('noreply@belotto.io', 'Belotto');
																
															});	
														}
												}	
										}	
									
								}//fin del foreach
						
						}//fin de si hayy registros		

						return 1;
					}

}


