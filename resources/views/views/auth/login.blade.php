@include('layout.loginApp')

@section('content')
  <body class="text-center">
    <form class="form-signin" method="POST" id="frmlogin" action="{{ url('login') }}">
    {{ csrf_field() }}
      <img class="mb-4" src="https://c.fastcdn.co/u/074e20eb/27994627-0-logo-purple.svg" alt="" width="300">
      <p>Welcome to Belotto's public sale admin</p>
      
      <div class="detail" id="errormail" style="position:relative;top:100%!important;display:none!important;">
                <font style="color:red" id="errmail"></font>
          </div>


      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1"><i class="material-icons">mail_outline</i></span>
        </div>
        <input id="emaillogin" type="email" class="form-control{{ $errors->has('emaillogin') ? ' is-invalid' : '' }}" placeholder="E-mail" name="emaillogin" value="{{ old('emaillogin') }}" required autofocus>
        @if ($errors->has('email'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>

      <div class="detail" id="errorpass" style="position:relative;top:100%!important;display:none!important;">
            <font style="color:red" id="errpass"></font>
        </div>

      <div class="input-group mb-3">
        <div class="input-group-prepend txc">
          <span class="input-group-text" id="basic-addon"><i class="material-icons">https</i></span>
        </div>
        <input id="passwordlogin" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control" placeholder="Password" class="form-control{{ $errors->has('passwordlogin') ? ' is-invalid' : '' }}" name="passwordlogin" data-toggle="popover" data-trigger="hover" title="Password rules" data-content="<ul><li>The password must have at least 8 characters</li><li>at least one digit</li><li> at least one lowercase</li><li> at least one uppercase and at least one non-alphanumeric character</li></ul>" data-placement="bottom" required />
        @if ($errors->has('passwordlogin'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('passwordlogin') }}</strong>
            </span>
        @endif
      </div>  
  
      <!--div class="checkbox mb-3 forgot">
        <a href="{{ route('password.request') }}" class="selcol">Forgot your password?</a>
      </div-->
      <button class="btn btn-lg btn-info btn-block sign_in" type="button">Sign In</button>
      <!--div class="checkbox mb-3 register">
        <p>Don't have an account? <a href="{{ url('register') }}">Register Now</a></p>
      </div-->  
      <input type="hidden" name="_token" value="{{ csrf_token() }}">    
      <p class="mt-5 mb-3 text-muted"><img src="{{ asset('dist/img/poweredbytokennow.svg') }}" alt="" width="150"></p>
    </form>
  </body>
</html>
@include('layout.loginFooter')