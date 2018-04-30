<?php

@session_start ();
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

use Illuminate\Support\Facades\Route;


Auth::routes ();

Route::get('/', function () {
    return view ( 'auth.login' );
});

Route::get('login', function () {
    return view ( 'auth.login' );
});

Route::get ('logout','Auth\LoginController@logout' );

Route::get('recovery', function () {
    return view('auth.recovery');
});

Route::get('register', function () {
    return view('auth.register');
});

//Route::get('mail','SemdEmail@index');

Route::get('mailview', function () {
    return view('email.activation');
});
Route::get('complete', function () {
    return view('complete');
});

Route::group(['prefix' => '/'], function(){

	
	Route::post ('login','Auth\LoginController@login' );

	Route::post ('register','Auth\RegisterController@store' );
	
	Route::resource ( 'kyc', 'UsuarioController' );
	
	Route::post ('kycconfirmed','UsuarioController@kycconfirmed' );	
	
	Route::get ( 'dashboard', [

		'uses' => 'DashboardController@dashboard',		

	]);
	
	Route::get ( 'purchase', [

		'uses' => 'PurchaseController@purchase'

	] );
	
	Route::get ( 'referrals', [

		'uses' => 'ReferralsController@referrals'

	] );
	
	Route::get ( 'history', [

		'uses' => 'HistoryController@history'

	] );	
	
	Route::get ( 'kyc', [

		'uses' => 'UsuarioController@kyc'

	] );
	
	Route::get ( 'kyc_confirmation', [

		'uses' => 'UsuarioController@kyc_confirmation'

	] );

	Route::get ( 'kyc_process', [

		'uses' => 'UsuarioController@kyc_process'

	] ); 	
	
	Route::get ( 'profile', [

		'uses' => 'UsuarioController@profile'

	] );
	
	Route::post ( 'updateprofile', [

		'uses' => 'UsuarioController@updateprofile'

	] );
	
	Route::post ( 'recovery', [

		'uses' => 'UsuarioController@recovery'

	] );
	
 Route::get ( 'change_password', [

		'uses' => 'UsuarioController@change_password'

	] );	
	Route::post ( 'changepassword', [

		'uses' => 'UsuarioController@changepassword'

	] );	
	

	Route::get ( '{filename}/mostrar', [

		'uses' => 'UsuarioController@mostrar'

	] );
	
	
	//para verificar cuenta email
	Route::get ( 'tk/{token}', [

		'uses' => 'UsuarioController@tk'

	] );
	
	//para validar el email referido
	Route::get ( 'cper/{email}', [

		'uses' => 'UsuarioController@cper'

	] );
	
	//para validar el password actual
	Route::get ( 'verificapass/{pass}', [

		'uses' => 'UsuarioController@verificapass'

	] );	
	
	Route::get('readyemail', function () {
        return view('readyemail');
    });
	
    
});



























/*
Route::get('recovery', function () {
    return view('auth.recovery');
});

Route::get('register', function () {
    return view('auth.register');
});

Route::get('mail','SemdEmail@index');

Route::get('mailview', function () {
    return view('email.activation');
});

Route::get('validated', function () {
    return view('email.activation');
});
*/



