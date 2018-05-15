<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tokennow Manager</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="{{ asset('dist/img/favicon.png') }}">
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
  <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/fontawesome-all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/skins/skin-purple.css') }}">
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/cargando.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sticky-footer-navbar.css') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style rel="stylesheet">
    body.modal-open .modal {
      display: flex !important;
      height: 100%;
    } 
    body.modal-open .modal .modal-dialog {
      margin: auto;
    }
  </style>
  @yield('stylesheet')
</head>
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a class="logo">
        <span class="logo-mini">
          <b>BEL</b>
        </span>
        <span class="logo-lg">
          <img src="https://c.fastcdn.co/u/074e20eb/27994387-0-logo.svg" width="200" alt="">
        </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span><i class="fas fa-align-justify"></i>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="{{ route('logout') }}" id="modalZi"
                class="dropdown-toggle modalZi" 
                data-toggle="dropdown"
                onclick="logoutConfirm(event)">
                {{ __('Logout') }}
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
                </form>
              <span class="hidden-xs"></span>
            </a>            
          </li>          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <?php $currentRoute = Route::getCurrentRoute(); ?>
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="user-panel" style="padding: 20px 0px 45px 0px;">        
        <div class="info">
          <p>{{ Session::get('email')}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      </div>      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="{{ $currentRoute->uri() ==  'dashboard' ? 'active' : ''  }}">
          <a href="{{ url('/dashboard') }}">
            <i class="fa fa-address-book"></i> <span>Management Users</span>
          </a>          
        </li>
        <li class="{{ $currentRoute->uri() ==  'kyc_mgmt' ? 'active' : ''  }}">
          <a href="{{ url('kyc_mgmt') }}">
            <i class="fas fa-certificate"></i></i> <span>Management KYC</span>
          </a>          
        </li>
        <li class="{{ $currentRoute->uri() ==  'upgrade' ? 'active' : ''  }}">
          <a href="{{ url('upgrade') }}">
            <i class="fab fa-ethereum"></i> <span>ETH Upgrade</span>
          </a>          
        </li>
        <li class="header">SUPPORT</li>
        <li>
          <a href="#">
            <i class="far fa-envelope-open"></i> <span>support@belotto.io</span>
          </a>          
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header mb-2 border-bottom">
      <h1>
        @yield('title')
        <small>Control panel</small>
      </h1>
    </section>
    @yield('content')
  </div>
  <!-- Modal Logout -->
  <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="logout-modal">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Are you sure you want to continue?</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default purple" id="modal-btn-yes" onclick='event.preventDefault(); document.getElementById("logout-form").submit();'>Continue</button>
          <button type="button" class="btn btn-primary purple" id="modal-btn-no" onclick='$("#logout-modal").modal("hide");'>Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <!-- End Logout Modal-->
  <!-- /.content-wrapper -->
  <footer class="main-footer text-center">    
    <span class="text-muted"><img src="{{ asset('dist/img/poweredbytokennow.svg') }}" alt="" width="150"></span>
  </footer>  
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
@yield('script')
</body>
</html>