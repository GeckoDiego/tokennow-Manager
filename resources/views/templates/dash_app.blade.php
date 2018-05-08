<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <title>Belotto</title>

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/fileinput.css') }}">
	
	<link href="{{ asset('css/btn_img.css') }}" rel="stylesheet">
	
	<link href="{{ asset('css/datepicker/datepicker.css') }}" rel="stylesheet">
	
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
	
	<script type="text/javascript" charset="utf8" src="{{ asset('js/jquery/jquery-1.8.2.min.js') }}"></script>
	
	<script type="text/javascript" charset="utf8" src="{{ asset('js/fileinput/fileinput.js') }}"></script>
	
	<script src="{{ asset('js/kyc.js') }}" type="text/javascript" charset="utf-8" async defer></script>  
	
	
	
	

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sticky-footer-navbar.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
  </head>

@yield('main')