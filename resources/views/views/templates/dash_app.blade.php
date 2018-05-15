<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Belotto</title>

    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/fileinput.css') }}">
	
	<link href="{{ asset('css/btn_img.css') }}" rel="stylesheet">
	
	<link href="{{ asset('css/datepicker/datepicker.css') }}" rel="stylesheet">
	
	<script type="text/javascript" charset="utf8" src="{{ asset('js/jquery/jquery-1.8.2.min.js') }}"></script>
	
	<script type="text/javascript" charset="utf8" src="{{ asset('js/fileinput/fileinput.js') }}"></script>
	
	<script src="{{ asset('js/kyc.js') }}" type="text/javascript" charset="utf-8" async defer></script>  
	
	
	
	

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sticky-footer-navbar.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
  </head>

@yield('main')