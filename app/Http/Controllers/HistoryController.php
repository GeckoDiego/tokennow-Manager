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

class HistoryController extends Controller
{
	
	
	

	public function history(Request $request)
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

		//se buscan los datos del historico del ether

		$regether = DB::select("select valor_usd, valor_ether, created FROM history_ether WHERE id > 0 order by id desc");	

		//se toma el ultimo valor referencial de la tabla

		$regetherlast = DB::select("select valor_usd, valor_ether, created FROM history_ether WHERE id > 0 order by id desc limit 1");

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
	
		  		
		return view('dashboard.history',compact('reguser'))->with(['regether'=>$regether,'valor_usdlast'=>$valor_usd,'valor_etherlast'=>$valor_ether,'fechareg'=>$fechareg]);
		
			
	}
	
	
	
}
