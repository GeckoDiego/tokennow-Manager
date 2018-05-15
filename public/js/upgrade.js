(function() {
		
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
	/*******************************///	

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
		
		$(".sendupgrade").on('click', function(){
			
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
			
			if (registra == 0)
				{
					formupgrade.submit();
				}
		});
		

})();

$('div.alert').delay(15000).slideUp(300); 
