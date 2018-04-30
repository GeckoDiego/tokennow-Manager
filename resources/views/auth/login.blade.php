@include('templates.app')
@section('content')
  <body class="text-center">
   <form class="form-signin" method="post" id="frmlogin" action="{{ url('login') }}">
   {{ csrf_field() }}
      <img class="mb-4" src="{{ asset('logo-fondoblanco.png') }}" alt="" width="300">
      <p>Welcome to Belotto  public sale</p>
      
      	<div class="detail" id="errormail" style="position:relative;top:100%!important;display:none!important;">
			<font style="color:red" id="errmail"></font>
		</div>
      
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="material-icons">mail_outline</i></span>
        </div>
        <input type="text" class="form-control" id="emaillogin" placeholder="Email" name="emaillogin" aria-label="Email" aria-describedby="basic-addon1">
      </div>

      <div class="input-group mb-3">
        <div class="input-group-prepend" style="height: 2.85em !important;">
          <span class="input-group-text" id="basic-addon1"><i class="material-icons">https</i></span>
        </div>
        <input type="password" class="form-control" id="passwordlogin" name="passwordlogin" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1">
      </div>  
  
      <div class="checkbox mb-3 forgot">
        <a href="{{ url('recovery') }}" class="selcol">Forgot your password?</a>
      </div>
      <button class="btn btn-lg btn-info btn-block sign_in" type="button" >Sign In</button>
      <div class="checkbox mb-3 register">
        <p>Don't have an account? <a href="{{ url('register') }}">Register Now</a></p>
		
		@if ($message = Session::get('mensaje'))
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				 
				{!! $message !!}
				
				{!! Session::forget('mensaje') !!}
			</div>
		@endif	
		
			
		@if ($message = Session::get('mensajeerror'))
			<div class="alert alert-danger">
				<!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
				
		
				{!! $message !!}
		
				{!! Session::forget('mensajeerror') !!}
			</div>
		@endif
		
      </div>      
      <p class="mt-5 mb-3 text-muted"><img src="{{ asset('poweredbytokennow.svg') }}" alt="" width="150"></p>
    </form>
  </body>
</html>
@include('templates.footer')
