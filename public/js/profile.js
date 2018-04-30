
(function() {
		
		/****** validacion de name *****////
				$('#name').bind('blur', function () { 
				
					if ($('#name').val() == '')
						{
							$('#errname').html('This field can not be empty');
							
							$('#errorname').show(); 							
							
							$('#btneditp').attr('style','opacity:0.8;cursor:default');
							
						    $('#btneditp').attr('disabled',true);
						}
					else
						{
							$('#errorname').hide(); 
							
							if ($('#ercWallet').val() != '')
								{
							
									$('#btneditp').attr('style','opacity:1;cursor:pointer');
									
									$('#btneditp').attr('disabled',false);
								}	
						}
				});
		/*******************************///		
			
		
		/****** validacion de ercWallet *****////
				$('#ercWallet').bind('blur', function () { 
				
					if ($('#ercWallet').val() == '')
						{
							$('#errvallet').html('This field can not be empty');
							
							$('#errorvallet').show(); 
						}
					else
						{
							//se valida la longitud que no debe ser menor de 20
							
							if($("#ercWallet").val().length < 20) 
								{
									$('#errvallet').html('Vallet invalid');
							
									$('#errorvallet').show(); 
									
									$('#btneditp').attr('style','opacity:0.8;cursor:default');
							
									$('#btneditp').attr('disabled',true);
								}
							else
								{	
									$('#errorvallet').hide(); 
									
									if ($('#name').val() != '')
										{
									
											$('#btneditp').attr('style','opacity:1;cursor:pointer');
											
											$('#btneditp').attr('disabled',false);
										}	
								}	
						}
				});
		/*******************************///		
		
		$(".sign_editprofile").on('click', function(){
			
			
			var registra = 0;
				
			if ($('#name').val() == '')
				{
					$('#errname').html('This field can not be empty');
					
					$('#errorname').show(); 
					registra = registra + 1;
				}
			else
				{
					$('#errorname').hide(); 
					
				}		

			if ($('#ercWallet').val() == '')
				{
					$('#errvallet').html('This field can not be empty');
					
					$('#errorvallet').show(); 
					registra = registra + 1;
					
				}
			else
				{
					//se valida la longitud que no debe ser menor de 20
					
					$('#errorvallet').hide(); 
							
					
				}
		
			if (registra == 0)
				{
							
					$('#formeditprofile').submit();
				}
				
		});		
		
		
		$("#irdashboard").on('click', function(){
				return false;
		});		
})();

$('div.alert').delay(5000).slideUp(300);


function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}