@include('templates.dash_app')
  @section('main')
    <form id="formchangepassword" class="needs-validation" role="form" method="POST" action="{{ url('changepassword') }}" novalidate>
      {{ csrf_field() }}
      <input type="hidden" id="idusuario"  value="{{ $reguser[0]->id }}" name="idusuario" />
        @if ($message = Session::get('mensaje'))
          <div class="alert alert-success" style="width: 49% !important;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!! $message !!}
            {!! Session::forget('mensaje') !!}
          </div>
        @endif  
        @if ($message = Session::get('mensajeerror'))
          <div class="alert alert-danger" style="width: 49% !important;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!! $message !!}
            {!! Session::forget('mensajeerror') !!}
          </div>
        @endif
      <div class="row">
        <div class="col-md-6 col-xl-6 order-md-1">
          <h4 class="mb-3">Edit user details</h4>  
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 col-xl-6  mb-3">
          <label for="firstName">Current Password</label>
          <div class="detail" id="errorpassact" style="position:relative;top:1%!important;display:none!important;">
            <font style="color:red" id="errpassact"></font>
          </div>
          <input type="password" class="form-control" id="passwordactual" name="passwordactual" placeholder="" value="" required />
          <div class="invalid-feedback">
            Valid first name is required.
          </div>
        </div>
      </div><!-- OK -->
      <div class="row">
        <div class="col-md-6 col-xl-6  mb-3">
          <label for="firstName">New Password</label>
          <div class="detail" id="errorpassnew" style="position:relative;top:1%!important;display:none!important;">
            <font style="color:red" id="errpassnew"></font>
          </div>
          <input type="password" class="form-control" id="passwordnew" name="passwordnew" placeholder="" value="" required />
          <div class="invalid-feedback">
            Valid first name is required.
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 col-xl-6  mb-3">
          <label for="firstName">Repeat new Password</label>
          <div class="detail" id="errorpassre" style="position:relative;top:1%!important;display:none!important;">
            <font style="color:red" id="errpassre"></font>
          </div>
          <input type="password" class="form-control" id="repassword" name="repassword" placeholder="" value="" required />
          <div class="invalid-feedback">
          Valid first name is required.
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 col-xl-2  mb-3">
          <button id="btnsave" class="btn-primary btn-lg btn-block mb-5 sign_changepass" disabled="disabled" style="opacity:0.8" type="buttom">SAVE</button>
        </div>
      </div>
    </form> 
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
	  
	 
    </script>
    
  </body>
</html>
@include('templates.footer')
