@include('templates.app')
@section('content')
<body class="text-center">

    	
   <form id="formregistrer" class="form-signin needs-validation" role="form" method="POST" action="{{ url('register') }}">
	  {{ csrf_field() }}
      <img class="mb-4" src="{{ asset('logo-fondoblanco.png') }}" alt="" width="300">
      <p>Please complete all fields to join</p>
      
      <div class="detail" id="errorname" style="position:relative;top:100%!important;display:none!important;">
			<font style="color:red" id="errname"></font>
		</div>
		
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="material-icons">person</i></span>
        </div>
        <input type="text" class="form-control" placeholder="Name" id="name" name="name" aria-label="Name" aria-describedby="basic-addon1" required />
      </div>      

	  
		<div class="detail" id="errormail" style="position:relative;top:100%!important;display:none!important;">
			<font style="color:red" id="errmail"></font>
		</div>
		
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="material-icons">mail_outline</i></span>
        </div>
        <input type="email" class="form-control" placeholder="Email" id="email" name="email" aria-label="Email" aria-describedby="basic-addon1">
      </div>

		<div class="detail" id="errorpass" style="position:relative;top:100%!important;display:none!important;">
			<font style="color:red" id="errpass"></font>
		</div>
		
      <div class="input-group mb-3">
        <div class="input-group-prepend" style="height: 2.85em !important;">
          <span class="input-group-text" id="basic-addon1"><i class="material-icons">vpn_key</i></span>
        </div>  <!--pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain 8 characters, one symbol at least and one number" -->
        <input type="password"  data-toggle="tooltip"  class="form-control" placeholder="Password" id="password" name="password"   aria-label="Password" aria-describedby="basic-addon1" title="must have at least 8 characters"  required />
      </div>

		<div class="detail" id="errorclave" style="position:relative;top:100%!important;display:none!important;">
			<font style="color:red" id="errclave"> </font>
		</div>
		
      <div class="input-group mb-3">
        <div class="input-group-prepend" style="height: 2.85em !important;">
          <span class="input-group-text" id="basic-addon1"><i class="material-icons">security</i></span>
        </div>
        <input type="password" class="form-control" placeholder="Repeat Password" id="password_confirm" aria-label="Repeat Password" aria-describedby="basic-addon1">
		
      </div>
      
      
      
      <div class="detail">
        Enter the email address of the person who referred you
      </div>

	  
		<div class="detail" id="erroremref" style="position:relative;top:100%!important;display:none!important;">
			<font style="color:red" id="erremref"> </font>
		</div>
		
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="material-icons">supervisor_account</i></span>
        </div>
        <input type="email" class="form-control" placeholder="referral Email" id="emailrefered" name="emailrefered" aria-label="referral Email" aria-describedby="basic-addon1">
      </div>

      <div class="detail">
        Please enter an ERC20 compatible wallet in your profile to receive the tokens. If you do not know how to create an ERC20 wallet <a href="">Click here</a>
      </div>

		<div class="detail" id="errorvallet" style="position:relative;top:100%!important;display:none!important;">
			<font style="color:red" id="errvallet"> </font>
		</div>
		
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="material-icons">fingerprint</i></span>
        </div>
        <input type="text" class="form-control" placeholder="Wallet ERC20" aria-label="Wallet ERC20"  id="ercWallet" name="ercWallet"  aria-describedby="basic-addon1">
      </div>

      <!--<button class="btn btn-lg btn-info btn-block sign_register" type="buttom" >Sign Up </button>-->
      {!! Form::button('Sign Up',['class'=>'btn btn-info mb-3  btn-lg btn-block sign_register','style'=>'cursor:pointer'])!!}
      <a href="{{ url('/') }}" class="selcol">Back to Login</a>      
      @if ($message = Session::get('mensaje'))
			<div class="alert alert-success" >
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				 
				{!! $message !!}
				
				{!! Session::forget('mensaje') !!}
			</div>
		@endif	
		
			
		@if ($message = Session::get('mensajeerror'))
			<div class="alert alert-danger" >
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		
				{!! $message !!}
		
				{!! Session::forget('mensajeerror') !!}
			</div>
		@endif
      <div class="detail last">
        By submitting this information you confirm that you agree with Terms and Conditions. Please be aware that we don’t register clients from US, China, Singapore, Iran, North Korea and Syria.        
      </div>
      
      <p class="mt-5 mb-3 text-muted"><img src="{{ asset('poweredbytokennow.svg') }}" alt="" width="150"></p>
    </form>

	@include('templates.footer');