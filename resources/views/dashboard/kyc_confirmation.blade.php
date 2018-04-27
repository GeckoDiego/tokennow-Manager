@include('templates.dash_app')
@section('main')
<?php
	$confirmed = $reguser[0]->confirmed ;  
	
	$hoy = date('Y-m-d');
		
?>
  <body>

    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="col-sm-3 col-md-2 col-1"><img src="https://c.fastcdn.co/u/074e20eb/27994387-0-logo.svg" alt="" width="200"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
	
		
		
			<div class="collapse navbar-collapse" id="navbarCollapse">
			  <ul class="navbar-nav mr-auto">
              <li class="nav-item text-nowrap ml-4">
                <a>{{ $reguser[0]->email}}</a><br>
                <a>Balance (<b>BEL: 0  -  CREDITS = 0</b>)</a>
              </li>
			  </ul>  
			  <ul class="navbar-nav px-3">
				<li class="nav-item text-nowrap d-block d-sm-none d-sm-block d-md-none">
					@if ($confirmed == 'YES')
						<a class="nav-link" href="{{ url('dashboard') }}">Dashboard</a>
					@else
						<a class="nav-link colorinactivotexto" href="javascript:;">Dashboard</a>
					@endif
						
				</li>
				<li class="nav-item text-nowrap d-block d-sm-none d-sm-block d-md-none">
					@if ($confirmed == 'YES')
						<a class="nav-link" href="{{ url('purchase') }}">Purchase</a>
					@else
						<a class="nav-link colorinactivotexto" href="javascript:;">Purchase</a>
					@endif
				</li>
				<li class="nav-item text-nowrap d-block d-sm-none d-sm-block d-md-none">
					@if ($confirmed == 'YES')
						<a class="nav-link" href="{{ url('referrals') }}">Referrals</a>
					@else
						<a class="nav-link colorinactivotexto" href="javascript:;">Referrals</a>
					@endif
				</li>
				<li class="nav-item text-nowrap d-block d-sm-none d-sm-block d-md-none">
					@if ($confirmed == 'YES')
						<a class="nav-link" href="{{ url('history') }}">USD History</a>
					@else
						<a class="nav-link colorinactivotexto" href="javascript:;">USD History</a>
					@endif
				</li>
				<li class="nav-item text-nowrap d-block d-sm-none d-sm-block d-md-none">
					@if ($confirmed == 'YES')
						<a class="nav-link" href="{{ url('kyc') }}">KYC</a>
					@else
						<a class="nav-link colorinactivotexto" href="javascript:;">KYC</a>
					@endif
				</li>
				<li class="nav-item text-nowrap d-block d-sm-none d-sm-block d-md-none">
					@if ($confirmed == 'YES')
						<a class="nav-link" href="{{ url('profile') }}">Profile</a>	
					@else
						<a class="nav-link colorinactivotexto" href="javascript:;">Profile</a>	
					@endif
				</li>
				<li class="nav-item text-nowrap d-block d-sm-none d-sm-block d-md-none">
					@if ($confirmed == 'YES')
						<a class="nav-link" href="{{ url('change_password') }}">Change Password</a>
					@else
						<a class="nav-link colorinactivotexto" href="javascript:;">Change Password</a>
					@endif
				</li>
				<li class="nav-item text-nowrap">
				  <a class="nav-link colorinactivotexto" href="{{ url('logout') }}">Logout</a>
				</li>
			  </ul>                 
			</div>
		
      </nav>
    </header>

    <!-- Begin page content -->
    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
			    @if ($confirmed == 'YES')
					<a class="nav-link" href="{{ url('dashboard') }}">
				@else
					<a class="nav-link colorinactivotexto" href="javascript:;">
				@endif
                  <span data-feather="home"></span>
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
			    @if ($confirmed == 'YES')
					<a class="nav-link" href="{{ url('purchase') }}">
				@else
					<a class="nav-link colorinactivotexto" href="javascript:;">
				@endif	
                  <span data-feather="file"></span>
                  Purchase
                </a>
              </li>
              <li class="nav-item">
			     @if ($confirmed == 'YES')
					<a class="nav-link" href="{{ url('referrals') }}">
				 @else
					 <a class="nav-link colorinactivotexto" href="javascript:;">
				 @endif
                  <span data-feather="users"></span>
                  Referrals
                </a>
              </li>
              <li class="nav-item">
			    @if ($confirmed == 'YES')
					<a class="nav-link" href="{{ url('history') }}">
				@else
					<a class="nav-link colorinactivotexto" href="javascript:;">
				@endif
                  <span data-feather="dollar-sign"></span>
                  USD History
                </a>
              </li>
              <li class="nav-item">
			     @if ($confirmed == 'YES')
					<a class="nav-link active" href="javascript:;">
				@else
					<a class="nav-link active" href="javascript:;">
				@endif
                  <span data-feather="alert-octagon"></span>
                  KYC
                </a>
              </li>
              <li class="nav-item">
			     @if ($confirmed == 'YES')
					<a class="nav-link" href="{{ url('profile') }}">
				 @else
					 <a class="nav-link colorinactivotexto" href="javascript:;">
				 @endif
                  <span data-feather="monitor"></span>
                  Profile
                </a>
              </li>
              <li class="nav-item">
			     @if ($confirmed == 'YES')
					<a class="nav-link" href="{{ url('change_password') }}">
				@else
					<a class="nav-link colorinactivotexto" href="javascript:;">
				@endif
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
                  <span data-feather="at-sign"></span>
                  support@belotto.io
                </a>
              </li>              
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Know Your Customer</h1>            
          </div>          
        </main>        
      </div>
    </div>

    <div class="container">
      <div class="row">
          <div class="col-md-6 col-xl-6 order-md-1">
          <h4 class="mb-3">Terms & Conditions</h4>
          <form id="formkycconfirmed" class="needs-validation" role="form" method="POST" action="{{ url('kycconfirmed') }}" novalidate>
			{{ csrf_field() }}
			
			<input type="hidden" id="idusuario"  value="{{ $reguser[0]->id }}" name="idusuario">
            <div class="row">
              <div class="col-md-12 mb-3">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input loschecks" id="customCheck1" name="customCheck1">
                  <label class="custom-control-label" for="customCheck1">Check here to confirm you are NOT a citizen or resident of Cuba, Iran, Lebanon, Libya, North Korea, Somalia, Sudan, Colombia, Belize or Syria and that you are NOT purchasing tokens on behalf of any of these citizens or residents.</label>
                </div> 
              </div>           
            </div> 
            <div class="row">
              <div class="col-md-12 mb-3">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input loschecks" id="customCheck2" name="customCheck2">
                  <label class="custom-control-label" for="customCheck2">Check here to confirm that you have read, understand and agree to the terms of the Belotto.</label>
                </div> 
              </div>           
            </div> 
            <div class="row">
              <div class="col-md-12 mb-3">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input loschecks" id="customCheck3" name="customCheck3">
                  <label class="custom-control-label" for="customCheck3">Check here to confirm that you have read, understand and agree with the Belotto's whitepaper and all conditions of sale.</label>
                </div> 
              </div>           
            </div> 
            <div class="row">
              <div class="col-md-12 mb-3">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input loschecks" id="customCheck4" name="customCheck4">
                  <label class="custom-control-label" for="customCheck4">Check here to confirm you understand and agree that you are obtaining utility tokens and not is a security token.</label>
                </div> 
              </div>           
            </div> 
            <div class="row">
              <div class="col-md-12 mb-3">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input loschecks" id="customCheck5" name="customCheck5">
                  <label class="custom-control-label" for="customCheck5">Check here to confirm that you have read, understand and agree to the privacy policy</label>
                </div> 
              </div>           
            </div> 
            <div class="row">
              <div class="col-md-12 mb-3">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input loschecks" id="customCheck6" name="customCheck6">
                  <label class="custom-control-label" for="customCheck6">Check here to confirm that you understand and agree that your are purchasing credits and the token are a gift for a purchase of these.</label>
                </div> 
              </div>           
            </div> 
                                              
            
            <button class="btn btn-primary btn-lg btn-block mb-4 submitkyc_confirmed" disabled type="button">Continue</button>
          </form>
        </div>
      </div>
      </div>
    </div>      

    <footer class="footer">
      <div class="container" align="center">
        <span class="text-muted"><img src="http://167.114.47.35/webB/images/poweredbytokennow.svg" alt="" width="150"></span>
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
    <script>
      feather.replace()
    </script>
    
  </body>
</html>