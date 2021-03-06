<header>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="col-sm-3 col-md-2 col-1 d-none d-xl-none d-lg-block"><img src="https://c.fastcdn.co/u/074e20eb/27994387-0-logo.svg" alt="" width="200"></a>
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
            <a class="nav-link active" href="{{ url('dashboard') }}">
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
        <h1 class="h2">Dashboard</h1>
      </div>
    </main>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-3 px-4">
      @yield('content')      
    </main>
  </div>
</div>