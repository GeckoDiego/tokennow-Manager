@include('templates.dash_app')
@section('main')

<?php
	$confirmed = $reguser[0]->confirmed ;  
	
	$hoy = date('Y-m-d');
	
	$birthdate = $reguser[0]->birthdate;   

	if ($birthdate == '0000-00-00')
		{
			$birthdate = $hoy;
		}
		
?>
  <body>

	
    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="col-sm-3 col-md-3 col-lg-3 col-xl-2 d-none d-md-block d-xl-block d-lg-block" href="https://www.belotto.io/" target="_blank"><img src="https://c.fastcdn.co/u/074e20eb/27994387-0-logo.svg" alt="" width="90%"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
              <li class="nav-item text-nowrap ml-4">
                <a>{{ $reguser[0]->email}}</a><br>
                <a>Balance (<b>BEL= 0  -  CREDITS = 0</b>)</a>
              </li>
          </ul>  
          <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap d-block d-sm-none d-sm-block d-md-none">
              <a class="nav-link" href="{{ url('dashboard') }}">Dashboard</a>
            </li>
            <li class="nav-item text-nowrap d-block d-sm-none d-sm-block d-md-none">
              <a class="nav-link" href="{{ url('purchase') }}">Purchase</a>
            </li>
            <li class="nav-item text-nowrap d-block d-sm-none d-sm-block d-md-none">
              <a class="nav-link" href="{{ url('referrals') }}">Referrals</a>
            </li>
            <li class="nav-item text-nowrap d-block d-sm-none d-sm-block d-md-none">
              <a class="nav-link" href="{{ url('history') }}">ETH History</a>
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
              <a class="nav-link" href="{{ url('logout') }}">Logout</a>
            </li>
          </ul>                   
        </div>
      </nav>
    </header>

    <!-- Begin page content -->
    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-3 col-lg-3 col-xl-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
          <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="{{ url('dashboard') }}">
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('purchase') }}">
                  <span data-feather="file"></span>
                  Purchase
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('referrals') }}">
                  <span data-feather="users"></span>
                  Referrals
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('history') }}">
                  <i class="fab fa-ethereum mr-2" style="padding-left: 3px;"></i>
                  ETH History
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="{{ url('kyc') }}">
                  <span data-feather="alert-octagon"></span>
                  KYC
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('profile') }}">
                  <span data-feather="monitor"></span>
                  Profile
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('change_password') }}">
                  <span data-feather="shield"></span>
                  Change Password
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Support</span>            
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="mailto:support@belotto.io">
                  <span data-feather="mail"></span>
                  support@belotto.io
                </a>
              </li>              
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 border-bottom">
            <h1 class="h2">Know Your Customer</h1>            
          </div>          
        </main> 
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3">
        		<div class="row">
			@if ($message = Session::get('mensaje'))
				<div class="alert alert-success" style="width: 49% !important;">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					 
					{!! $message !!}
					
					{!! Session::forget('mensaje') !!}
				</div>
			@endif	
			
			@if ($message = Session::get('mensajeerror'))
			<div class="alert alert-danger" style="width: 49% !important;">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		
				{!! $message !!}
		
				{!! Session::forget('mensajeerror') !!}
			</div>
		@endif
	
			<div id="boxmsgmal" class="alert alert-danger" style="display:none"> 
				<div class="bg-red alert-icon">
					<i class="glyph-icon icon-check"></i>
				</div>
				<div class="alert-content"> 
					<h4 id="titulomsgnegative" class="alert-title"></h4>
					<p id="msgboxnegative"></p>
				</div>
			</div>          
          
      </div>
        	</div>
        	<div class="justify-content-between flex-wrap flex-md-nowrap align-items-center">
				<div class="col-sm-9 col-md-12 col-xl-6 order-md-1">
					<h4 class="mb-3"><font style="color:#088A08">Successfully verified</font></h4>
				</div>
			</div>
        </main>       
      </div>
    </div>
    </div>      

    <footer class="footer">
      <div class="container" align="center">
        <span class="text-muted"><img src="{{ asset('poweredbytokennow.svg') }}" alt="" width="150"></span>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"><\/script>')</script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
	
	<script src="{{ asset('js/datepicker/datepicker.js') }}" type="text/javascript" charset="utf-8" async defer></script>  
	
    <script>
      feather.replace()
	  $("#navbarCollapse > ul.navbar-nav.px-3 > li:nth-child(8) > a").on('click', function(){
			var txt;
			if ( !confirm("Are you sure to Logout?") ) {
				return false;
			}
		});
    </script>
    
  </body>
</html>
