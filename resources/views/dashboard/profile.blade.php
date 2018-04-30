@include('templates.dash_app')
  @section('main')
	<form id="formeditprofile" class="needs-validation"  method="POST" action="{{ url('updateprofile') }}" novalidate>
                {{ csrf_field() }}

                        <input type="hidden" id="idusuario"  value="{{ $reguser[0]->id }}" name="idusuario">

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
                          <label for="country">Name</label>
                                <div class="detail" id="errorname" style="position:relative;top:100%!important;display:none!important;">
                                        <font style="color:red" id="errname"></font>
                                </div>
                          <div class="row">
                                <div class="input-group col-sm-12 col-md-12 col-lg-8 col-xl-6 mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon1"><i class="material-icons">assignment_ind</i></span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Email" id="name" name="name" aria-describedby="basic-addon1" value="{{ $reguser[0]->name}}">
                                  </div>
                          </div>
                          <label for="country">E-mail</label>
                          <div class="row">
                                <div class="input-group col-sm-12 col-md-12 col-lg-8 col-xl-6 mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon1"><i class="material-icons">email</i></span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Email" id="email" disabled name="email" aria-describedby="basic-addon1" value="{{ $reguser[0]->email}}">
                                  </div>
                          </div>
                          <label for="country">ERC20 Wallet</label>
                          <div class="detail" id="errorvallet" style="position:relative;top:100%!important;display:none!important;">
                                        <font style="color:red" id="errvallet"> </font>
                                </div>
                          <div class="row">
                                <div class="input-group col-sm-12 col-md-12 col-lg-8 col-xl-6 mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon1"><i class="material-icons">fingerprint</i></span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Email" id="ercWallet"  name="ercWallet" aria-describedby="basic-addon1" value="{{ $reguser[0]->ercWallet}}">
                                  </div>
                          </div>
                          <label for="country">Referral</label>
                          <div class="row">
                                <div class="input-group col-sm-12 col-md-12 col-lg-8 col-xl-6 mb-3">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text" id="basic-addon1"><i class="material-icons">supervisor_account</i></span>
                                        </div>
                                        <input type="text" class="form-control" aria-label="Email" id="emailReferred" disabled name="emailReferred" aria-describedby="basic-addon1" value="{{ $reguser[0]->emailReferred}}">
                                  </div>
                          </div>
                          <div class="row">
                                <div class="col-md-6 col-xl-6 order-md-1">
                                  <hr class="mb-4">
                                </div>
                          </div>
                          <div class="row">
                            <div class="col-6 col-sm-6 col-md-4 col-xl-3 order-md-1" >
                              <a href="{{ url('dashboard') }}" style="text-decoration:none;">
                                {!! Form::button('Back',['class'=>'btn-primary btn-lg btn-block','style'=>'cursor:pointer'])!!}
                              </a>
                            </div>
                            <div class="col-6 col-sm-6 col-md-4 col-xl-3 order-md-1" >
                              <button id="btneditp" class="btn-primary btn-lg btn-block mb-5 sign_editprofile" disabled style="opacity:1" type="buttom">Edit</button>
                            </div>
                          </div>
                </form>

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
    </script>
    
  </body>
</html>
@include('templates.footer')
