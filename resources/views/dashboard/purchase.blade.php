@include('templates.dash_app')
  @section('main')
    <div class="row">
      <div class="col-md-12 col-lg-10 col-xl-6 order-md-1">
        <h4 class="mb-3">Last Dollar / Ether value update: {{ date('F d, Y') }}</h4>  
      </div>
    </div>
    <div class="row mt-5" align="center">
      <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 order-md-1">
        <div class="card mb-3"> 
          <div class="card-header"><h4>1 ETH</h4></div>
            <div class="card-body text-primary">
              <h5 class="card-title selcol">$660 USD</h5>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 order-md-1">
          <div class="card mb-3">
            <div class="card-header"><h4>1 ETH</h4></div>
            <div class="card-body text-primary">
              <h5 class="card-title selcol">4,740 BEL</h5>
            </div>
          </div>
        </div>
      </div> 
      <div class="row mt-3">
        <div class="col-md-12 col-lg-10 col-xl-4 order-md-1">
          <h4 class="mb-3">How much you want to buy?</h4>  
        </div>
      </div>     
      <div class="row mt-3">
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 order-md-1">
          <div class="input-group mb-3">          
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><b>ETH</b></span>
            </div> 
            <input type="number" min="0.1" step="0.1" class="form-control" onfocusout="belCalculation(event)" />
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><i class="material-icons">view_agenda</i></span>
            </div>            
          </div> 
          <small id="emailHelp" style="color:red !important; font-weight: bold !important;" class="form-text text-muted">With this purchase you win <a class="creditsVal">0</a> credits</small>          
        </div>        
        <div class="col-sm-6 col-md-6 col-lg-6 col-xl-4 order-md-1">
          <div class="input-group mb-3">          
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon1"><b>BEL</b></span>
            </div> 
            <input type="text" id="BELVAL" class="form-control" aria-label="Email" aria-describedby="basic-addon1" readonly>
          </div>             
        </div>
      </div>
      <div class="row mt-4" align="center">
          <div class="col-md-12 col-lg-12 col-xl-8 order-md-1">
            <div class="alert alert-secondary" role="alert">
               <!-- <b>Your Address Wallet :</b><br>
                <span>5JWZD4tYheDQ5EAHHsZL2ypyhMK5QMBn4rV8M6JJLP</span>-->
                <span><b>To address Contract :</b></span><br><br>
                <img src="http://tokennow.belotto.io/QR-contract.png" width="100"><br>
                <span>0x1D54064456965c1dA3B95241aAfe9218f22F48D8</span>
              </div>
          </div>
      </div>
      <div class="row mt-2">
        <div class="col-sm-12 col-md-12 order-md-1">
          <h4 class="mb-3" style="color: #392068 ;"><b>BONUS</b> =  30% Included    <b>EXTRA BONUS</b> +5 ETH = 10% / +10 ETH = 25%</h4>  
      <h4>MIN. PURCHASE= 0.1 ETH</h4>
  <h4>MAX. PURCHASE PER TRANSACTION = 200 ETH</h4>
        </div>
      </div>
      <div class="row mt-2 mb-3">
        <div class="col-md-9 order-md-1">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">- Your wallet must be ERC-20 Compatible</li>
            <li class="list-group-item">- Do not enter wallet hosted on exchanges</li>
            <li class="list-group-item">- Please ensure you have enough funds in your wallet to cover the gas cost, otherwise the transaction will fail</li>
          </ul>
        </div>
      </div>
      <div class="row mt-1">
        <div class="col-md-9 order-md-1">
          <h6 style="color: red ;" class="mb-5">The dollar / ether value can be updated at least every 24 hours, if there are large changes in the ether price, you can check the dollar price in USD History in the menu.</h6>  
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
      function addCommas(nStr){
          nStr += '';
          x = nStr.split('.');
          x1 = x[0];
          x2 = x.length > 1 ? '.' + x[1] : '';
          var rgx = /(\d+)(\d{3})/;
          while (rgx.test(x1)) {
              x1 = x1.replace(rgx, '$1' + ',' + '$2');
          }
          return x1 + x2;
      }
      function belCalculation(val){        
        var ETHValue = 4740;
        var value = val.target.value;
        $("#BELVAL").val(addCommas(value*ETHValue));
 	 $(".creditsVal").text(addCommas(value*ETHValue));
      }
    </script>
    
  </body>
</html>
