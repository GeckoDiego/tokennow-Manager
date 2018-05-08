@include('templates.dash_app')
@section('main')

<?php
  /*$fecha = explode(" ",$fechareg);

  $date = new DateTime($fecha[0]); 

  $fechahistoryether = $date->format('F d, Y');  */
  
  


  $fechalast = explode(" ",$fechareg); 

  $fecha = new DateTime($fechalast[0]);

  $calculo =  round($valor_usd/$valor_ether, 8);  


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
                <a class="nav-link active" href="{{ url('purchase') }}">
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
                <a class="nav-link" href="{{ url('kyc') }}">
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
              <span>SUPPORT</span>            
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

        <main role="main" class="col-md-9 ml-sm-auto col-lg-9 col-xl-10 px-4">
          <div class="justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Purchase</h1>            
          </div>
        </main>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-9 col-xl-10 px-4">
          	<div class="justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3">
				<div class="col-sm-9 col-md-12 col-xl-6 order-md-1">
					<h4 class="mb-3">Latest Ether price, updated on: {{ $fecha->format('F d, Y') }}</h4>  
				</div>
			</div>
	  		<div class="justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
				<div class="col-sm-9 col-md-12 col-xl-6 order-md-1">
					<div class="row mt-5" align="center">
						<div class="col-sm-6 col-md-3 col-xl-6 order-md-1">
							<div class="card mb-3" style="max-width: 18rem;">
								<div class="card-header"><h4>1 ETH</h4></div>
								<div class="card-body text-primary">
									<h5 class="card-title selcol">${{ $valor_usd }} USD</h5>
                 

								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3 col-xl-6 order-md-1">
						  <div class="card mb-3" style="max-width: 18rem;">
							<div class="card-header"><h4>1 ETH</h4></div>
							<div class="card-body text-primary">
							  <h5 class="card-title selcol">{{  number_format($calculo, 2, '.', ',') }} BEL</h5> 
							</div>
						  </div>
						</div>
		  			</div>
				</div>
			</div>
		  	<div class="justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3">
				<div class="col-sm-9 col-md-12 col-xl-6 order-md-1">
					<h4 class="mb-3">How much do you want to buy?</h4>  
				</div>
			</div>
			<div class="justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
				<div class="col-sm-9 col-md-12 col-xl-12 order-md-1">
					<div class="row mt-3">
						<div class="col-md-2 col-lg-3 col-xl-3 order-md-1">
							<div class="input-group mb-3">          
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><b>ETH</b></span>
								</div> 
								<input type="number" id="myText" min="0.1" step="0.1" maxlength="3" max="200" class="form-control" onchange="belCalculation(event)" onkeyup="belCalculation(event)" />
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><i class="material-icons">view_agenda</i></span>
								</div>            
							</div> 				  	
						</div>
						<div class="col-md-2 col-lg-3 col-xl-3 order-md-1">
							<div class="input-group mb-3">          
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><b>BEL</b></span>
								</div> 
								<input type="text" id="BELVAL" class="form-control" aria-label="Email" aria-describedby="basic-addon1" disabled>
							</div> 						
						</div>
						<div class="col-md-2 col-lg-3 col-xl-3 order-md-1">
							<div class="input-group mb-3">          
								<div class="input-group-prepend">
									<span class="input-group-text" id="basic-addon1"><b>CREDITS</b></span>
								</div> 
								<input type="text" id="CREVAL" class="form-control" aria-label="Email" aria-describedby="basic-addon1" readonly>
							</div> 
						</div>
					</div>
					<div class="row">
						<div class="col-md-9 col-lg-9 order-md-1">
							<small id="emailHelp" style="color:#392068 !important; font-weight: bold !important;" class="form-text text-muted text-center">
							With this purchase you receive: <a class="creditsVal">0</a> BEL and <a class="creditsVal">0</a> Credits.</small> 
						</div>				
					</div>
				</div>
			</div>	
		  	<div class="justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3">
				<div class="col-sm-9 col-md-12 col-xl-9 order-md-1">
					<div class="row mt-4" align="center">
					  <div class="col-md-6 col-lg-9 col-xl-12 order-md-1">
						<div class="alert alert-secondary" role="alert">
						   <table border="0" width="60%">
							<tr>
								<td align="left"><h4><b>PURCHASE DETAILS:</b></h4></b><br></td>
								<td rowspan="3" align="right"><img src="{{ asset('QR-contract.png') }}" width="100" /> </td>
						   </tr>
						   <tr>
								<td align="left"><span><b>Send to contract address:</b></span></td>
						   </tr>
						   <tr>		
								<td align="left"><span>0x1D54064456965c1dA3B95241aAfe9218f22F48D8</span></td>
							</tr>               	
						   </table>                                                              
						  </div>
					  </div>
				  </div>
				</div>
			</div>
		  	<div class="row">
				<div class="col-md-9 col-lg-9 order-md-1">
					<small id="emailHelp" style="color:#392068 !important; font-weight: bold !important;" class="form-text text-muted text-center">
					MIN. purchase = 0.1ETH MAX. purchase per transaction = 200ETH</small> 
					<small id="emailHelp" style="color:#392068 !important; font-weight: bold !important; margin-top: -3px;" class="form-text text-muted text-center">
					You may perform unlimited transactions.</small> 
				</div>
			</div>
		  	<div class="justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3">
				<div class="col-sm-9 col-md-12 col-xl-12 order-md-1">
					<div class="row mt-4">
						<div class="col-md-9 order-md-1">
						  <h5 class="mb-3" style="color: #392068 ;">BONUS = 30% Included.<br>
							EXTRA BONUS= Over 5ETH=10% - 
							Over 10ETH=25%
							</h5>
						</div>
					  </div>
					  <div class="row mt-2 mb-3">
						<div class="col-md-9 order-md-1">
						  <ul class="list-group list-group-flush">
							<li class="list-group-item">&#9679; Your wallet must be ERC-20 Compatible</li>
							<li class="list-group-item">&#9679; Do not use exchange - hosted wallets.</li>
							<li class="list-group-item">&#9679; Please ensure you have enough funds in your wallet to cover the gas cost, otherwise the transaction will fail</li>
							<li class="list-group-item">&#9679; If you wish to make your
contributions in BTC please contact us
directly at: <a href="mailto:support@belotto.io">support@belotto.io</a></li>
						  </ul>
						</div>
					  </div>
					  <div class="row mt-1">
						<div class="col-md-9 order-md-1">
						  <h6 style="color: #392068 ;" class="mb-5">Ether price can be updated at least every 24 hours. You may check price history at
ETH history menu tab.</h6>  
						</div>
					  </div>
				</div>
			</div>			  
        </main>

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
    <script>
      feather.replace()
	  $("#navbarCollapse > ul.navbar-nav.px-3 > li:nth-child(8) > a").on('click', function(){
			var txt;
			if ( !confirm("Are you sure to Logout?") ) {
				return false;
			}
		});

		$('input#myText').keypress(function() {			
			 if($(this).val().length >= 20) {
				$(this).val($(this).val().slice(0, 20));
				return false;
			}
		});
      function addCommas(nStr){
          nStr += '';
          x = nStr.split('.');
          x1 = x[0];
          x2 = x.length > 1 ? '.' + x[1] : '';
          var rgx = /(\d+)(\d{3})/;
          while (rgx.test(x1)) {
              x1 = x1.replace(rgx, '$1' + ',' + '$2');
          }
          return x1 + x2;
      }
      function belCalculation(val){       
        var ETHValue = '{{  $calculo }}';
        var value = val.target.value;
		  if( value > 200 ){
			  val.target.value = "";
			  $("#BELVAL").val(null);
				$("#CREVAL").val(null);
				$(".creditsVal").text("");
			  alert('MAX. purchase per transaction = 200ETH');
			  return false;
		  }
        $("#BELVAL").val(addCommas(value*ETHValue));
		$("#CREVAL").val(addCommas(value*ETHValue));
 	 	$(".creditsVal").text(addCommas(value*ETHValue));
      }
    </script>
    
  </body>
</html>
