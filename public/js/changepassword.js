(function() {


		/*******************************para el change password  ************/
		
		/****** validacion de password *****////
		
			$('#passwordactual').bind('blur', function () { 
				
					if ($('#passwordactual').val() == '')
						{
							$('#errpassact').html('This field can not be empty');
							
							$('#errorpassact').show(); 
						}
					else
						{
							$('#errorpassact').hide(); 
							//se verifica si ese password es el correcto para el usuario que esta logueado
							
							var enlacerecep = '/verificapass/'+$('#passwordactual').val();   
									
							$.ajax({
								   type: "GET",
								   async:false, 
								   url: enlacerecep,
								   success: function(msg){   
										if (msg == 0)
											{
												$('#passwordactual').val('');
												
												$('#errpassact').html('The key entered does not belong to you or is wrong, check');
							
												$('#errorpassact').show(); 
												
											}
										   
								   },
									error: function(x,err,msj){$('#fondomodal').show();  $('#fondomodal').hide(); alert(msj); }
								  });
							
							
							
						}
				});
				
			$('#passwordnew').bind('blur', function () { 
				
					if ($('#passwordnew').val() == '')
						{
							$('#errpassnew').html('This field can not be empty');
							
							$('#errorpassnew').show(); 
						}
					else
						{
							$('#errorpassnew').hide(); 
						}
				});	
				
			$('#repassword').bind('blur', function () { 
				
					if ($('#repassword').val() == '')
						{
							$('#errpassre').html('This field can not be empty');
							
							$('#errorpassre').show(); 
						}
					else
						{
							$('#errorpassre').hide(); 
						}
				});		
		
		
		/*******************************///	

		/****** validacion de password verificacion (password) *****////

				$('#passwordnew').bind('blur', function () { 
					//se valida con su confirmacion           
				  
				  if ($('#passwordnew').val() != '' && $('#repassword').val() != '')
					{
					 
					  if ($('#passwordnew').val() != $('#repassword').val() )
						{
							
							$('#errpassnew').html('the keys do not match');
							
							$('#errorpassnew').show(); 

							$('#passwordnew').val('');
							
							$('#repassword').val('');
							
							$('#btnsave').attr('style','opacity:0.8;cursor:default');
							
							$('#btnsave').attr('disabled',true);
							

								   
						}
					  else
						{                       
							$('#errorpassnew').hide(); 
							
							$('#btnsave').attr('style','opacity:1;cursor:pointer');
							
							$('#btnsave').attr('disabled',false);
							
							
						}  
					}
				});
		
		/*******************************///	


		/****** validacion de password confirm  *****////
			$('#repassword').bind('blur', function () { 
				//se valida con su confirmacion           
			   
			  if ($('#passwordnew').val() != '' && $('#repassword').val() != '')
				{
				 
				  if ($('#passwordnew').val() != $('#repassword').val() )
					{
						
						$('#errpassre').html('the keys do not match');
						
						$('#errorpassre').show();

						$('#passwordnew').val('');
						
						$('#repassword').val('');
							   
						$('#btnsave').attr('style','opacity:0.8;cursor:default');
							
						$('#btnsave').attr('disabled',true);	   
								   
					}
				  else
					{
						   $('#errorpass').hide(); 
						   
						   $('#errorpassre').hide();
						   
						   $('#btnsave').attr('style','opacity:1;cursor:pointer');
							
						   $('#btnsave').attr('disabled',false);
					}  
				}
			});
		
		
		$(".sign_changepass").on('click', function(){
			
			
			var registra = 0;
				
			if ($('#passwordactual').val() == '')
				{
					$('#errpassact').html('This field can not be empty');
					
					$('#errorpassact').show(); 
					registra = registra + 1;
				}
			else
				{
					$('#errorpassact').hide(); 
					
				}		

			if ($('#passwordnew').val() == '')
				{
					$('#errpassnew').html('This field can not be empty');
					
					$('#errorpassnew').show(); 
					registra = registra + 1;
					
				}
			else
				{
					//se valida la longitud que no debe ser menor de 20
					
					$('#errorpassnew').hide(); 
							
					
				}
			if ($('#repassword').val() == '')
				{
					$('#errpassre').html('This field can not be empty');
					
					$('#errorpassre').show(); 
					registra = registra + 1;
					
				}
			else
				{
					//se valida la longitud que no debe ser menor de 20
					
					$('#errorpassre').hide(); 
							
					
				}
		
		
			if (registra == 0)
				{
							
					$('#formchangepassword').submit();
				}
				
		});
		
})();

$('div.alert').delay(5000).slideUp(300);

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}		