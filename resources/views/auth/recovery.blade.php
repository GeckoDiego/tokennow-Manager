@include('templates.app')
@section('content')
<body class="text-center">
  <form id="formrecovery" class="form-signin needs-validation" role="form" method="POST" action="{{ url('recovery') }}">
	  {{ csrf_field() }}
    <a href="https://www.belotto.io/" target="_blank"><img class="mb-4" src="{{ asset('logo-fondoblanco.png') }}" alt="" width="300"></a>
    <p class="mb-6">Insert your email to recover your password</p>
    
	
	 <div class="detail" id="errormail" style="position:relative;top:100%!important;display:none!important;">
			<font style="color:red" id="errmail"></font>
		</div>
		
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1"><i class="material-icons">mail_outline</i></span>
      </div>
      <input type="email" class="form-control" placeholder="Email" aria-label="Email" id="email" name="email"  aria-describedby="basic-addon1">
    </div> 
      
   <!--<button class="btn btn-lg btn-info btn-block sign_register" type="buttom" >Sign Up </button>-->
{!! Form::button('Submit',['class'=>'btn btn-lg btn-info btn-block mb-3  submitRecovery','style'=>'cursor:pointer'])!!}
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
 
    <p class="mt-5 mb-3 text-muted"><img src="{{ asset('poweredbytokennow.svg') }}" alt="" width="150"></p>
  </form>
  @include('templates.footer');
