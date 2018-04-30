@include('templates.dash_app')
@section('main')
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
              <a class="nav-link" href="{{ url('logout') }}">Logout</a>
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
                  <span data-feather="dollar-sign"></span>
                  USD History
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
              <span>Purchase</span>            
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
            <h1 class="h2">Purchase</h1>            
          </div>
        </main>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <div class="col-md-6 col-xl-6 order-md-1">
          <h4 class="mb-3">Last Dollar / Ether value update: {{ date('F d, Y') }}</h4>  
        </div>
      </div>
      <div class="row mt-5" align="center">
        <div class="col-md-3 col-xl-3 order-md-1">
          <div class="card mb-3" style="max-width: 18rem;">
            <div class="card-header"><h4>1 ETH</h4></div>
            <div class="card-body text-primary">
              <h5 class="card-title selcol">$660 USD</h5>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-xl-3 order-md-1">
          <div class="card mb-3" style="max-width: 18rem;">
            <div class="card-header"><h4>1 ETH</h4></div>
            <div class="card-body text-primary">
              <h5 class="card-title selcol">4,740 BEL</h5>
            </div>
          </div>
        </div>
      </div> 
      <div class="row mt-3">
        <div class="col-md-6 col-xl-6 order-md-1">
          <h4 class="mb-3">How much you want to buy?</h4>  
        </div>
      </div>     
      <div class="row mt-3">
        <div class="col-md-4 order-md-1">
          <div class="input-group mb-3">          
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><b>ETH</b></span>
            </div> 
            <input type="number" min="0.1" step="0.1" class="form-control" onfocusout="belCalculation(event)" />
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><i class="material-icons">view_agenda</i></span>
            </div>            
          </div> 
          <small id="emailHelp" style="color:red !important; font-weight: bold !important;" class="form-text text-muted">With this purchase you win <a class="creditsVal">0</a> credits</small>          
        </div>        
        <div class="col-md-2 order-md-1">
          <div class="input-group mb-3">          
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><b>BEL</b></span>
            </div> 
            <input type="text" id="BELVAL" class="form-control" aria-label="Email" aria-describedby="basic-addon1" readonly>
          </div>             
        </div>
      </div>
      <div class="row mt-4">
          <div class="col-md-6 col-xl-6 order-md-1">
            <div class="alert alert-secondary" role="alert">
               <!-- <b>Your Address Wallet :</b><br>
                <span>5JWZD4tYheDQ5EAHHsZL2ypyhMK5QMBn4rV8M6JJLP</span>-->
                <br><span><br><b>To address Contract :</b></span><br><br>
                <img src="http://tokennow.belotto.io/QR-contract.png" width="100">
                <span>0x1D54064456965c1dA3B95241aAfe9218f22F48D8</span>
              </div>
          </div>
      </div>
      <div class="row mt-2">
        <div class="col-md-9 order-md-1">
          <h4 class="mb-3" style="color: #392068 ;"><b>BONUS</b> =  30% Included    <b>EXTRA BONUS</b> +5 ETH = 10% / +10 ETH = 25%</h4>  
    	<h4>MIN. PURCHASE= 0.1 ETH</h4>
	<h4>MAX. PURCHASE PER TRANSACTION = 200 ETH</h4>
        </div>
      </div>
      <div class="row mt-2 mb-3">
        <div class="col-md-9 order-md-1">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">- Your wallet must be ERC-20 Compatible</li>
            <li class="list-group-item">- Do not enter wallet hosted on exchanges</li>
            <li class="list-group-item">- Please ensure you have enough funds in your wallet to cover the gas cost, otherwise the transaction will fail</li>
          </ul>
        </div>
      </div>
      <div class="row mt-1">
        <div class="col-md-9 order-md-1">
          <h6 style="color: red ;" class="mb-5">The dollar / ether value can be updated at least every 24 hours, if there are large changes in the ether price, you can check the dollar price in USD History in the menu.</h6>  
        </div>
          </div>
        </main>

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
        var ETHValue = 4740;
        var value = val.target.value;
        $("#BELVAL").val(addCommas(value*ETHValue));
 	 $(".creditsVal").text(addCommas(value*ETHValue));
      }
    </script>
    
  </body>
4</html>
