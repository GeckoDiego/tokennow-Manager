@include('templates.dash_app')
  @section('main')
  <div clasS="row">
    <div class="col-sm-12 col-md-12 col-lg-10 col-xl-6 order-md-1">
      <h4 class="mb-3">Last Dollar / Ether value update: {{ date('F d, Y') }}</h4>  
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-sm-12 col-md-12 col-lg-10 col-xl-6 order-md-1">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Date</th>
                <th scope="col">ETH Value (USD)</th>
                <th scope="col">BEL Quantity</th>
              </tr>
            </thead>
            <tbody>
              <tr>
              </tr>
              <tr>
              </tr>
              <tr></tr>
            </tbody>
          </table>
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
