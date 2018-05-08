
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
   
   /****** validacion de name *****////
				$('#lastname').bind('blur', function () { 
				
					if ($('#lastname').val() == '')
						{
							$('#errlastname').html('This field can not be empty');
							
							$('#errorlastname').show(); 
						}
					else
						{
							$('#errorlastname').hide(); 
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

							//var reg= /^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/;

							//var reg= /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/   ;
							//se usan las expresiones regulares para evitar errores humanos de ingreso de la clave
							var reg= /(?=^.{8,}$).*$/   ;

							if(!reg.test(this.value))
								{
									$('#errpass').html('the password is not valid (must have at least 8 characters) ');
							
									$('#errorpass').show();  
								}
							else
								{

									var reg1= /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[\u0021-\u002b\u003c-\u0040]).*$/   ;

									if(!reg1.test(this.value))
										{
											$('#errpass').html('the password is not valid (must have a symbol) ');
									
											$('#errorpass').show();  
										}
									else
										{
											var reg2= /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z]).*$/   ;

											if(!reg2.test(this.value))
												{
													$('#errpass').html('the password is not valid (must have a capital letter) ');
											
													$('#errorpass').show();  
												}	
											else
												{
													var reg3= /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/   ;

													if(!reg3.test(this.value))
														{
															$('#errpass').html('the password is not valid (must have a lowercase letter) ');
													
															$('#errorpass').show();  
														}	
													else
														{
															$('#errpass').html('');
							
															$('#errorpass').hide();		
														}		

													
												}	

											
										}	

									 
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
							var reg= /(?=^.{8,}$).*$/   ;

							if(!reg.test(this.value))
								{
									$('#errpass').html('the password is not valid (must have at least 8 characters) ');
							
									$('#errorpass').show();  
								}
							else
								{

									var reg1= /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[\u0021-\u002b\u003c-\u0040]).*$/   ;

									if(!reg1.test(this.value))
										{
											$('#errpass').html('the password is not valid (must have a symbol) ');
									
											$('#errorpass').show();  
										}
									else
										{
											var reg2= /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z]).*$/   ;

											if(!reg2.test(this.value))
												{
													$('#errpass').html('the password is not valid (must have a capital letter) ');
											
													$('#errorpass').show();  
												}	
											else
												{
													var reg3= /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/   ;

													if(!reg3.test(this.value))
														{
															$('#errpass').html('the password is not valid (must have a lowercase letter) ');
													
															$('#errorpass').show();  
														}	
													else
														{
															$('#errpass').html('');
							
															$('#errorpass').hide();		
														}		

													
												}	

											
										}	

									 
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
							
							var reg= /(?=^.{20,}$).*$/   ;

							if(!reg.test(this.value))
								{
									$('#errvallet').html('Invalid Wallet');
							
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
				 
      if ($('#lastname').val() == '')
						{
							$('#errlastname').html('This field can not be empty');
							
							$('#errorlastname').show(); 
             registra = registra + 1;     
						}
					else
						{
							$('#errorlastname').hide(); 
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
					  
					var reg= /(?=^.{8,}$).*$/   ;

							if(!reg.test($('#password').val()))
								{
									$('#errpass').html('the password is not valid (must have at least 8 characters) ');
							
									$('#errorpass').show();  

									registra = registra + 1;
								}
							else
								{

									var reg1= /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[\u0021-\u002b\u003c-\u0040]).*$/   ;

									if(!reg1.test($('#password').val()))
										{
											$('#errpass').html('the password is not valid (must have a symbol) ');
									
											$('#errorpass').show();  

											registra = registra + 1;
										}
									else
										{
											var reg2= /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z]).*$/   ;

											if(!reg2.test($('#password').val()))
												{
													$('#errpass').html('the password is not valid (must have a capital letter) ');
											
													$('#errorpass').show();  

													registra = registra + 1;
												}	
											else
												{
													var reg3= /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/   ;

													if(!reg3.test($('#password').val()))
														{
															$('#errpass').html('the password is not valid (must have a lowercase letter) ');
													
															$('#errorpass').show();  

															registra = registra + 1;
														}	
													else
														{
															$('#errpass').html('');
							
															$('#errorpass').hide();		
														}		

													
												}	

											
										}	

									 
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
					var reg= /(?=^.{20,}$).*$/   ;

					if(!reg.test($('#ercWallet').val()))
						{
							$('#errvallet').html('Vallet invalid ');
					
							$('#errorvallet').show();  

							registra = registra + 1;
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

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}