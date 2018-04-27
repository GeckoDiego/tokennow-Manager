@include('templates.app')
@section('content')
<body class="text-center">
  <form id="formrecovery" class="form-signin needs-validation" role="form" method="POST" action="{{ url('recovery') }}">
	  {{ csrf_field() }}
    <img class="mb-4" src="https://c.fastcdn.co/u/074e20eb/27994627-0-logo-purple.svg" alt="" width="300">
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
      
    <button class="btn btn-lg btn-info btn-block submitRecovery" type="submit">Submit</button>
    
    <p class="mt-5 mb-3 text-muted"><img src="http://167.114.47.35/webB/images/poweredbytokennow.svg" alt="" width="150"></p>
  </form>
  @include('templates.footer');