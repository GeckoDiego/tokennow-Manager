@include('templates.dash_app')
    @section('main')        
        <div class="row">
          <div class="col-md-6 col-xl-6 order-md-1">
            <h2 class="mb-3"><b>ICO STAGE: PRE-SALE</b></h2>  
            <small id="emailHelp" style="font-size: 20px; font-weight: bold !important; margin-top: -10px;" class="form-text text-muted">PRE-SALE END: 26th May 2018</small>
          </div>
        </div>
        <div class="row mt-5">
          <div class="col-md-6 col-xl-6 order-md-1">
            <h5 class="mb-3"><b>TOTAL TOKEN PRE-SALE: 120.000.000 BEL</b></h5>  
          </div>
        </div>
        <!--<div class="row">
        <div class="col-md-9 col-xl-9 order-md-1">
        <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: 25%; background-color:#392068 ;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>            
        </div>
        <small id="emailHelp" style="font-size: 12px; !important; font-weight: bold !important;" class="form-text text-muted">SOLD: 180.000 BEL</small>
        <small id="emailHelp" style="font-size: 12px; !important; font-weight: bold !important;" class="form-text text-muted">SOLD: 180.000 BEL</small>   
        </div>
        </div>-->
        <div class="row mt-5 mb-3">
          <div class="col-md-9 order-md-1">
            <ul class="list-group list-group-flush">
              <li class="list-group-item shli"><b>TOKEN SUPPLY: 1.200.000.000 BEL</b></li>
              <li class="list-group-item shli"><b>PRE-SALE: 10%</b></li>
              <li class="list-group-item shli"><b>SALE: 50%</b></li>
              <li class="list-group-item shli"><b>TEAM & ADVISOR: 15%</b></li>
              <li class="list-group-item shli"><b>BOUNTY: 5%</b></li>
              <li class="list-group-item shli"><b>RESERVE: 20%</b></li>
              <li class="list-group-item shli"><b>HARDCARP: $10'000.000 USD</b></li>
            </ul>
          </div>
        </div>
        <div class="row mb-3">
          <div class="col-md-3 col-xl-2 order-md-1">
            <a href="https://belotto.io/download/belotto-wp-english/?wpdmdl=14" class="btn btn-primary btn-lg mb-5" role="button" target="_blank">WHITEPAPER</a>
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