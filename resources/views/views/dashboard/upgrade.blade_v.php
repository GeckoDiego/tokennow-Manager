<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ Session::get('name') }}</title>

    <!-- Bootstrap core CSS -->    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
  </head>
<body>

    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="col-sm-3 col-md-3 col-lg-3 col-xl-2 d-none d-md-block d-xl-block d-lg-block"><img src="https://c.fastcdn.co/u/074e20eb/27994387-0-logo.svg" alt="" width="90%"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
          	<li class="nav-item text-nowrap ml-4">
				<a>{{ Session::get('email') }}</a><br>
			</li>
          </ul>  
          <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap d-block d-sm-none d-sm-block d-md-none">
              <a class="nav-link" href="#">{{ Session::get('name') }}</a>
            </li>
            <li class="nav-item text-nowrap d-block d-sm-none d-sm-block d-md-none">
              <a class="nav-link" href="{{ url('purchase') }}">Purchase</a>
            </li>
            <li class="nav-item text-nowrap d-block d-sm-none d-sm-block d-md-none">
              <a class="nav-link" href="{{ url('referrals') }}">Referrals</a>
            </li>
            <li class="nav-item text-nowrap d-block d-sm-none d-sm-block d-md-none">
              <a class="nav-link" href="{{ url('history') }}">USD History</a>
            </li>
            <li class="nav-item text-nowrap d-block d-sm-none d-sm-block d-md-none">
              <a class="nav-link" href="{{ url('kyc') }}">KYC</a>
            </li>
            <li class="nav-item text-nowrap d-block d-sm-none d-sm-block d-md-none">
              <a class="nav-link" href="{{ url('profile') }}">Profile</a>
            </li>
            <li class="nav-item text-nowrap d-block d-sm-none d-sm-block d-md-none">
              <a class="nav-link" href="{{ url('change_password') }}">Change Password</a>
            </li>
            <li class="nav-item text-nowrap">
              <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            </li>
          </ul>                 
        </div>
      </nav>
    </header>
   
    <!-- Begin page content -->
    <div class="container-fluid">
    
    <form id="formupgrade" class="needs-validation"  method="POST" action="{{ url('upgradeether') }}" novalidate>
          {{ csrf_field() }}
      <div class="row">
      
        <nav class="col-md-3 col-lg-3 col-xl-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">                      
              <li class="nav-item">
                <a class="nav-link" href="{{ url('dashboard') }}">
                  <span data-feather="menu"></span>
                  Management Users
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('kyc_mgmt') }}">
                  <span data-feather="thumbs-up"></span>
                  Management KYC
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="{{ url('upgrade') }}">
                  <span data-feather="dollar-sign"></span>
                   ETH Upgrade
                </a>
              </li>           
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Support</span>            
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="mailto:support@belotto.io">
                  support@belotto.io
                </a>
              </li>
            </ul>
          </div>
        </nav>

         
  
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">{{ $data['label_caption'] }}</h1>  
                
          </div>
          @if ($message = Session::get('mensaje'))
          <div class="alert alert-success" style="width:45%!important;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            
            {!! $message !!}
            
            {!! Session::forget('mensaje') !!}
          </div>
        @endif	
        
          
        @if ($message = Session::get('mensajeerror'))
          <div class="alert alert-danger" style="width:45%!important;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        
            {!! $message !!}
        
            {!! Session::forget('mensajeerror') !!}
          </div> 
        @endif
        </main>

        

        <!--main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <div class="col-md-6 col-xl-6 order-md-1">
              <h2>Actualización diaria de USD / ETH</h2>
            </div>           
          </div>
        </main-->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
       
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">                  
            <div class="col-md-4 col-xl-4">
              <label for="firstName">USD Value</label>
             
              <div class="detail" id="errorusd" style="position:relative;top:1%!important;display:none!important;">
                <font style="color:red" id="errusd"> </font>
              </div> 
             
              <input type="number" class="form-control" id="valor_usd" name="valor_usd" placeholder="0" value="" required>
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <div class="col-md-4 col-xl-4">
              <label for="firstName">ETH Value</label>

              <div class="detail" id="erroreth" style="position:relative;top:1%!important;display:none!important;">
                <font style="color:red" id="erreth"> </font>
              </div>

              <input type="number" class="form-control" id="valor_ether" name="valor_ether" placeholder="0" value="" required>
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>
          </div>
        </main>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
            <div class="col-md-2 order-md-1">
              <!--button class="btn-info btn-sm btn-block sendupgrade" style="background-color: #392068; border-color: #392068; " type="button">Update Values</button-->
              {!! Form::button('Update Values',['class'=>'btn-info btn-sm btn-block sendupgrade','style'=>'cursor:pointer;background-color: #392068; border-color: #392068;'])!!}


            </div> 
          </div>
        </main>
      </div>
    </div>
  </form>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"><\/script>')</script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
    <script>
      feather.replace()
    </script>
    
  </body>
</html>
@include('templates.footer')
