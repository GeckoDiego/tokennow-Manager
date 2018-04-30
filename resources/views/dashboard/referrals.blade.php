@include('templates.dash_app')
  @section('main')    
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-12 col-xl-6 order-md-1">
        <h4 class="mb-3">Your Referral ID : {{ $reguser[0]->email}}</h4>
      </div>
    </div>
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-5 order-md-1">
          <div class="alert alert-secondary" role="alert">
              <div class="row">
                <div class="col-md-5 order-md-1">
                  <table style="height: 100%;">
                    <tbody>
                      <tr>                      
                        <td class="align-middle"><h6>Referral Bonus:</h6></td>                  
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-md-6 col-xl-6 order-md-1">
                  <h1>5%</h1>
                </div>
              </div>                          
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-5 order-md-1">
          <div class="alert alert-secondary" role="alert">
              <div class="row">
                <div class="col-md-5 order-md-1">
                  <table style="height: 100%;">
                    <tbody>
                      <tr>                      
                        <td class="align-middle"><h6>Current Balance:</h6></td>                  
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-md-6 col-xl-6 order-md-1">
                  <h1>0 Bel</h1>
                </div>
              </div>                          
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-8 col-xl-5 order-md-1">
          <div class="alert alert-secondary" role="alert">
              <div class="row">
                <div class="col-md-5 order-md-1">
                  <table style="height: 100%;">
                    <tbody>
                      <tr>                      
                        <td class="align-middle"><h6>People Invited:</h6></td>                  
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="col-md-6 col-xl-6 order-md-1">
                  <h1>{{ $regreferr }}</h1>
                </div>
              </div>                          
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
    <script>
      feather.replace()
    </script>
    
  </body>
</html>
