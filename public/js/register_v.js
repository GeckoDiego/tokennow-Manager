
(function() {
		
		/****** validacion de name *****////
				$('#name').bind('blur', function () { 
				
					if ($('#name').val() == '')
						{
							$('#errname').html('This field can not be empty');
							
							$('#errorname').show(); 
						}
					else
						{
							$('#errorname').hide(); 
						}
				});
		/*******************************///		
		
		/****** validacion de email *****////
			$('#email').bind('blur', function () { 
			
				if ($('#email').val() == '')
					{
						$('#errmail').html('This field can not be empty');
						
						$('#errormail').show(); 
					}
				else
					{
						$('#errormail').hide(); 
						
						var correctemail =  isEmail($('#email').val());  
						
						if (correctemail == false)
							{
								$('#errmail').html('It is not a valid email');
						
								$('#errormail').show(); 
							}
						else
							{
								$('#errormail').hide(); 
							}
					}	
			});
		/*******************************///		
		
		
		/****** validacion de password *****////
		
			$('#password').bind('blur', function () { 
				
					if ($('#password').val() == '')
						{
							$('#errpass').html('This field can not be empty');
							
							$('#errorpass').show(); 
						}
					else
						{
							if($("#password").val().length < 8) 
								{
									$('#errpass').html('Password invalid');
							
									$('#errorpass').show(); 
                                                                
                  $('#password').val('');                                              
								}
							else
								{	
									$('#errorpass').hide(); 
								}	  
						}
				});
		
		
		/*******************************///	

		/****** validacion de password verificacion (password) *****////

				$('#password').bind('blur', function () { 
					//se valida con su confirmacion           
				   
				  if ($('#password').val() != '' && $('#password_confirm').val() != '')
					{
					 
					  if ($('#password').val() != $('#password_confirm').val() )
						{
							
							$('#errpass').html('the keys do not match');
							
							$('#errorpass').show(); 

							$('#password').val('');
							
							$('#password_confirm').val('');
								   
						}
					  else
						{                       
							if($("#password").val().length < 8) 
								{
									$('#errpass').html('Password invalid');
							
									$('#errorpass').show(); 
								}
							else
								{	
									$('#errorpass').hide(); 
								}	  
							
							
						}  
					}
				});
		
		/*******************************///	


		/****** validacion de password confirm  *****////
			$('#password_confirm').bind('blur', function () { 
				//se valida con su confirmacion           
			   
			  if ($('#password').val() != '' && $('#password_confirm').val() != '')
				{
				 
				  if ($('#password').val() != $('#password_confirm').val() )
					{
						
						$('#errclave').html('the keys do not match2');
						
						$('#errorclave').show();

						$('#password').val('');
						
						$('#password_confirm').val('');
							   
								   
					}
				  else
					{
						   $('#errorpass').hide(); 
						   
						   $('#errorclave').hide();
					}  
				}
			});
		
		
		/****** validacion de email referencial  *****////
		
			$('#emailrefered').bind('blur', function () { 
				
					if ($('#emailrefered').val() == '')
						{
							
						}
					else
						{
							$('#erroremref').hide(); 
							
							var correctemailref =  isEmail($('#emailrefered').val());  
							
							if (correctemailref == false)
								{
									$('#erremref').html('It is not a valid email');
							
									$('#erroremref').show(); 
								}
							else
								{
									$('#erroremref').hide(); 
									
									//se verifica que el correo referido exista y que este comporbado
									
									var enlacerecep = '/cper/'+$('#emailrefered').val();  
									
									$.ajax({
										   type: "GET",
										   async:false, 
										   url: enlacerecep,
										   success: function(msg){   
												if (msg == 2)
													{
														$('#erremref').html('The reference email is not verified');
												
														$('#erroremref').show(); 
														
														$('#emailrefered').val('');
													}
												else
													{
														
														if (msg == 3)
															{
																$('#erremref').html('The reference email does not exist');
														
																$('#erroremref').show(); 
																
																$('#emailrefered').val('');
															}
													}
												   
												   
										   },
											error: function(x,err,msj){$('#fondomodal').show();  $('#fondomodal').hide(); alert(msj); }
										  });
									
									
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
								}
							else
								{	
									$('#errorvallet').hide(); 
								}	
						}
				});
		/*******************************///		
		
		
		
		$(".sign_register").on('click', function(){
			
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
				 
			
			if ($('#email').val() == '')
				{
					$('#errmail').html('This field can not be empty');
					
					$('#errormail').show(); 
					
					registra = registra + 1;
				}
			else
				{
					$('#errormail').hide(); 
					
				}	
			
			if ($('#password').val() == '')
				{
					$('#errpass').html('This field can not be empty');
					
					$('#errorpass').show(); 
					
					registra = registra + 1;
				}
			else
				{
          if($("#password").val().length < 8) 
								{
									$('#errpass').html('Password invalid');
							
									$('#errorpass').show(); 
                                                            
                  $('#password').val('');                                          
								}
							else
								{	
									$('#errorpass').hide(); 
								}	  
					
				}
			
			/*if ($('#emailrefered').val() == '')
				{
					$('#erremref').html('This field can not be empty');
					
					$('#erroremref').show(); 
					registra = registra + 1;
					
				}
			else
				{
					$('#erroremref').hide(); 
					
					
				}	*/			
				
			if ($('#ercWallet').val() == '')
				{
					$('#errvallet').html('This field can not be empty');
					
					$('#errorvallet').show(); 
					registra = registra + 1;
					
				}
			else
				{
					//se valida la longitud que no debe ser menor de 20
					
          if($("#ercWallet").val().length < 20) 
								{
									$('#errvallet').html('Vallet invalid');
							
									$('#errorvallet').show(); 
								}
							else
								{	
									$('#errorvallet').hide(); 
								}	     
				
					
				}
			
			
			if (registra == 0)
				{
									
					$('#formregistrer').submit();
				}	
			
		});
		
		
		
				

})();

//$('div.alert').delay(50000).slideUp(300); 

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}