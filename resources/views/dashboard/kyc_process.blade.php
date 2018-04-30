@include('templates.dash_app')
  @section('main')

<?php
  $confirmed = $reguser[0]->confirmed ;
  $hoy = date('Y-m-d');
  $birthdate = $reguser[0]->birthdate;   
  if ($birthdate == '0000-00-00')
    {
      $birthdate = $hoy;
    } 
?>
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
  
      <div id="boxmsgmal" class="alert alert-danger" style="display:none"> 
        <div class="bg-red alert-icon">
          <i class="glyph-icon icon-check"></i>
        </div>
        <div class="alert-content"> 
          <h4 id="titulomsgnegative" class="alert-title"></h4>
          <p id="msgboxnegative"></p>
        </div>
      </div>
          <h3 class="mb-3"><font style="color:#A4A4A4">The information is in the process of verfication... </font></h3>
          <div class="col-md-6 order-md-1">
          
      
        </div>
      </div>
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
  
  <script src="{{ asset('js/datepicker/datepicker.js') }}" type="text/javascript" charset="utf-8" async defer></script>  
  
    <script>
      feather.replace()
    </script>
    
  </body>
</html>

