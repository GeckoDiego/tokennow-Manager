@extends('layout.app')
@section('stylesheet')
<!-- CSRF Token -->
@stop
@section('title', 'Upgrade USD Value')
@section('content')
<?php
  $fechalast = explode(" ",$fechareglast); 

  $fecha = new DateTime($fechalast[0]);

  $calculo =  round($valor_usdlast/$valor_etherlast, 8);  
?>


          <!--{{ csrf_field() }}  -->
          
         
<section class="content">  
  <form id="formupgrade" class="needs-validation"  method="POST" action="{{ url('upgradeether') }}" novalidate>
   @csrf
  <div class="row">
   
    <div class="col-lg-4">
      <div class="row">
        @if ($message = Session::get('mensaje'))
          <div class="alert alert-success" style="width:45%!important;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {!! $message !!}        
            {!! Session::forget('mensaje') !!}
          </div>
        @endif  
        @if ($message = Session::get('mensajeerror'))
          <div class="alert alert-danger" style="width:45%!important;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        
            {!! $message !!}
        
            {!! Session::forget('mensajeerror') !!}
          </div> 
        @endif
      </div>
      <div class="row">
        <div class="col-md-12 col-lg-10 order-md-1">
            <h4 class="mb-3">Latest Ether price, updated on: {{ $fecha->format('F d, Y') }}</h4>  
        </div> 
      </div>            
      
      <div class="row">
        <div class="col-md-12 col-lg-10">
          <label for="firstName"> ETH Value</label>
          <div class="detail" id="errorusd" style="position:relative;top:1%!important;display:none!important;">
            <font style="color:red" id="errusd"> </font>
          </div>
          <input type="number" class="form-control" id="valor_usd" name="valor_usd" placeholder="0" value="" required onchange="belCalculation(event)" onkeyup="belCalculation(event)" />
          <div class="invalid-feedback">
            Valid first name is required.
          </div>
        </div> 
      </div>
      <div class="row">
        <div class="col-md-12 col-lg-10">
          <label for="firstName">Token Value</label>
          <div class="detail" id="erroreth" style="position:relative;top:1%!important;display:none!important;">
            <font style="color:red" id="erreth"> </font>
          </div>
          <input type="number" class="form-control" id="valor_ether" name="valor_ether" placeholder="0" value="" required onchange="belCalculation(event)" onkeyup="belCalculation(event)" />
          <div class="invalid-feedback">
            Valid first name is required.
          </div>
        </div> 
      </div>
      <div class="row">
        <div class="col-md-12 col-lg-10">
          <label for="firstName">Token Amount</label>
          <input type="text" readonly class="form-control" id="valor_token" name="valor_token" placeholder="0" value="" required>
          <div class="invalid-feedback">               
          </div>
        </div>
      </div>
      <div class="row" style="margin-top:10px;">
        <div class="col-md-12 col-lg-10">
          {!! Form::button('Update Values',['class'=>'btn btn-info sendupgrade','style'=>'cursor:pointer;background: #392068 !important; border: #392068 !important;'])!!}
        </div> 
      </div>
    </div>
    <div class="col-lg-4">
      <div class="row">
        <div class="col-md-12 col-lg-10 order-md-1">
            <h4 style="margin-top: 0px;">&nbsp;</h4>  
        </div> 
      </div>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Date</th>
            <th scope="col">ETH Value (USD)</th>
            <th scope="col">BEL Quantity</th>
          </tr>
        </thead>
        <tbody>
          <?php
            foreach ($regether as $dato) 
            {
            $calculo =  round($dato->valor_usd/$dato->valor_ether, 8);  
              echo '<tr>';
              echo '<td>'.$dato->created.'</td>';
              echo '<td>'.$dato->valor_usd.'</td>';                 
              echo '<td>'.number_format($calculo, 2, '.', ',').' BEL</td>';
              echo '</tr>';
            }
          ?>
        </tbody>
      </table>
     
    </div>
  </div>
  </form>
</section>

@stop
@section('script')
<script type="text/javascript">

	function belCalculation(val){       
        var ETHValue = $('#valor_ether').val();
        var value = $('#valor_usd').val();
        if (ETHValue > 0 && value > 0)
          {
            var calculo = value / ETHValue;
          }
        else
          {
            var calculo = 0;
          }  


        
		    $("#valor_token").val(calculo);
      }  
      
      
      	$('#valor_usd').bind('change', function () { 
						
			if ($('#valor_usd').val() < 0)
				{
					$('#valor_usd').val(0);

				}
			else
				{
					
					
					
				}	
		});

		$('#valor_ether').bind('change', function () { 
						
			if ($('#valor_ether').val() < 0)
				{
					$('#valor_ether').val(0);

				}
			else
				{
					
					
					
				}	
		});



		/****** validacion de valor_usd *****////
			$('#valor_usd').bind('blur', function () { 
					
				if ($('#valor_usd').val() == '')
					{
						$('#errusd').html('This field can not be empty');
						
						$('#errorusd').show(); 
					}
				else
					{
						$('#errorusd').hide(); 
						
						
					}	
			});
		/*******************************///		

		/****** validacion de valor_usd *****////
		$('#valor_ether').bind('blur', function () { 
					
			if ($('#valor_ether').val() == '')
				{
					$('#erreth').html('This field can not be empty');
					
					$('#erroreth').show(); 
				}
			else
				{
					$('#erroreth').hide(); 
					
					
				}	
		});
   
   $(".sendupgrade").on('click', function(){
			console.log("OKOKO");
			var registra = 0;
			
			if ($('#valor_usd').val() == '')
					{
						$('#errusd').html('This field can not be empty');
						
						$('#errorusd').show(); 

						registra = registra + 1;
					}
				else
					{
						$('#errorusd').hide(); 
						
						
					}	

				if ($('#valor_ether').val() == '')
					{
						$('#erreth').html('This field can not be empty');
						
						$('#erroreth').show(); 

						registra = registra + 1;
					}
				else
					{
						$('#erroreth').hide(); 
						
						
					}		
		   
			if (registra == 0 || registra == '0')
				{
					$('form#formupgrade').submit();
				}
		});
		
   $('div.alert').delay(15000).slideUp(300); 

</script>
@stop