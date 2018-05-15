<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('login', function () {
    return view ( 'auth.login' );
});

Route::get ('logout','Auth\LoginController@logout' );

Auth::routes();

Route::group ( [ 

    'middleware' => [ 

            'web' 

    ] 

    ], function () {

    @session_start ();

} );


Route::group(['prefix' => '/'], function(){

    Route::post ('login','Auth\LoginController@login' );

    Route::post ('register','Auth\RegisterController@store' );

    Route::get ( 'dashboard', [

		'uses' => 'DashboardController@dashboard'

    ] );
	
	Route::get ( 'kyc_mgmt', [

		'uses' => 'DashboardController@dashboardKyc'

    ] );

    Route::get ( '{filename}/mostrar', [

		'uses' => 'DashboardController@mostrar'

    ] );

    Route::get ( '{filename}/mostrarthumb', [

		'uses' => 'DashboardController@mostrarthumb'

    ] );
    
    Route::get ( 'buscardatospagina/{pagina}/{num_total_registros}/{buscar}/{estatusreg}/{fecha}/{country}/{fecha2}', [

		'uses' => 'DashboardController@buscardatospaginaUsers'

    ] );
	
	Route::get ( 'buscardatospaginaUsers/{pagina}/{num_total_registros}/{buscar}/{estatusreg}/{fecha}/{country}/{fecha2}', [

		'uses' => 'DashboardController@buscardatospagina'

    ] );
    
    Route::get ( 'guardarreason/{iduser}/{reason}/{valor}', [

		'uses' => 'DashboardController@guardarreason'

    ] );

    Route::get ( 'upgrade', [

		'uses' => 'DashboardController@upgrade'

    ] );
    
    Route::post ( 'upgradeether', [

		'uses' => 'DashboardController@upgradeether'

	] );

    
  Route::get ( 'descargaruser/{buscar}/{estatusreg}/{fecha}/{country}/{fecha2}', [

		'uses' => 'DashboardController@descargaruser'

  ] );

  Route::get ( 'descargaruserreg/{buscar}/{estatusreg}/{fecha}/{country}/{fecha2}', [

		'uses' => 'DashboardController@descargaruserreg'

  ] );  
  
  Route::get ( 'sendmailreg/{buscar}/{estatusreg}/{fecha}/{country}/{fecha2}', [

		'uses' => 'DashboardController@sendmailreg'

  ] );
  
  Route::get ( 'sendmailkyc/{buscar}/{estatusreg}/{fecha}/{country}/{fecha2}', [

		'uses' => 'DashboardController@sendmailkyc'

	] );

  
	Route::get('decline', function(){
		return view('modal.modal');
	});
  
    
});























/*//Route::get('/home', 'DashController@index')->name('home');
  
Route::group(['prefix' => '/admin', 'middleware' => 'auth'], function(){         
    Route::get('dashboard', 'DashController@index');
    Route::get('upgrade', function(){
        $data = array(
            "label_caption" => 'Upgrade USD Value'
        );  
        return view('dashboard.upgrade', compact('data'));
    });
});*/



