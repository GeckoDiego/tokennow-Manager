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
							/*//se verifica si ese password es el correcto para el usuario que esta logueado
							
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
								  });*/
							
							
							
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
							//var reg= /^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/;

							var reg= /(?=^.{8,}$).*$/   ;

							if(!reg.test(this.value))
								{
									$('#errpassnew').html('the password is not valid (must have at least 8 characters) ');
							
									$('#errorpassnew').show();  

									$('#passwordnew').val('');
								}
							else
								{

									var reg1= /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[\u0021-\u002b\u003c-\u0040]).*$/   ;

									if(!reg1.test(this.value))
										{
											$('#errpassnew').html('the password is not valid (must have a symbol) ');
									
											$('#errorpassnew').show();  

											$('#passwordnew').val('');
										}
									else
										{
											var reg2= /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z]).*$/   ;

											if(!reg2.test(this.value))
												{
													$('#errpassnew').html('the password is not valid (must have a capital letter) ');
											
													$('#errorpassnew').show();  

													$('#passwordnew').val('');
												}	
											else
												{
													var reg3= /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/   ;

													if(!reg3.test(this.value))
														{
															$('#errpassnew').html('the password is not valid (must have a lowercase letter) ');
													
															$('#errorpassnew').show();  

															$('#passwordnew').val('');
														}	
													else
														{
															$('#errpassnew').html('');
							
															$('#errorpassnew').hide();		
														}		

													
												}	

											
										}	

									 
								}
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

							//var reg= /^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/;

							var reg= /(?=^.{8,}$).*$/   ;

							if(!reg.test(this.value))
								{
									$('#errpassre').html('the password is not valid (must have at least 8 characters) ');
							
									$('#errorpassre').show();  

									$('#repassword').val('');
								}
							else
								{

									var reg1= /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[\u0021-\u002b\u003c-\u0040]).*$/   ;

									if(!reg1.test(this.value))
										{
											$('#errpassre').html('the password is not valid (must have a symbol) ');
									
											$('#errorpassre').show();  

											$('#repassword').val('');
										}
									else
										{
											var reg2= /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z]).*$/   ;

											if(!reg2.test(this.value))
												{
													$('#errpassre').html('the password is not valid (must have a capital letter) ');
											
													$('#errorpassre').show();  

													$('#repassword').val('');
												}	
											else
												{
													var reg3= /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/   ;

													if(!reg3.test(this.value))
														{
															$('#errpassre').html('the password is not valid (must have a lowercase letter) ');
													
															$('#errorpassre').show();  

															$('#repassword').val('');
														}	
													else
														{
															$('#errpassre').html('');
							
															$('#errorpassnew').hide();		
														}		

													
												}	

											
										}	

									 
								}

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
							
							//var reg= /^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/;

							var reg= /(?=^.{8,}$).*$/   ;

							if(!reg.test(this.value))
								{
									$('#errpassnew').html('the password is not valid (must have at least 8 characters) ');
							
									$('#errorpassnew').show();  

									$('#passwordnew').val('');

									$('#btnsave').attr('style','opacity:0.8;cursor:default');
							
									$('#btnsave').attr('disabled',true);
								}
							else
								{

									var reg1= /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[\u0021-\u002b\u003c-\u0040]).*$/   ;

									if(!reg1.test(this.value))
										{
											$('#errpassnew').html('the password is not valid (must have a symbol) ');
									
											$('#errorpassnew').show();  
										}
									else
										{
											var reg2= /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z]).*$/   ;

											if(!reg2.test(this.value))
												{
													$('#errpassnew').html('the password is not valid (must have a capital letter) ');
											
													$('#errorpassnew').show();  
												}	
											else
												{
													var reg3= /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/   ;

													if(!reg3.test(this.value))
														{
															$('#errpassnew').html('the password is not valid (must have a lowercase letter) ');
													
															$('#errorpassnew').show();  
														}	
													else
														{
															$('#errpassnew').html('');
							
															$('#errorpassnew').hide();		

															$('#btnsave').attr('style','opacity:1;cursor:pointer');
							
															$('#btnsave').attr('disabled',false);
														}		

													
												}	

											
										}	

									 
								}						
							
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
						//var reg= /^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/;

						var reg= /(?=^.{8,}$).*$/   ;

							if(!reg.test(this.value))
								{
									$('#errpassre').html('the password is not valid (must have at least 8 characters) ');
							
									$('#errorpassre').show();  

									$('#repassword').val('');

									$('#btnsave').attr('style','opacity:0.8;cursor:default');
							
									$('#btnsave').attr('disabled',true);	
								}
							else
								{

									var reg1= /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[\u0021-\u002b\u003c-\u0040]).*$/   ;

									if(!reg1.test(this.value))
										{
											$('#errpassre').html('the password is not valid (must have a symbol) ');
									
											$('#errorpassre').show();  

											$('#repassword').val('');

											$('#btnsave').attr('style','opacity:0.8;cursor:default');
							
											$('#btnsave').attr('disabled',true);	
										}
									else
										{
											var reg2= /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z]).*$/   ;

											if(!reg2.test(this.value))
												{
													$('#errpassre').html('the password is not valid (must have a capital letter) ');
											
													$('#errorpassre').show();  

													$('#repassword').val('');

													$('#btnsave').attr('style','opacity:0.8;cursor:default');
							
													$('#btnsave').attr('disabled',true);	
												}	
											else
												{
													var reg3= /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/   ;

													if(!reg3.test(this.value))
														{
															$('#errpassre').html('the password is not valid (must have a lowercase letter) ');
													
															$('#errorpassre').show();  

															$('#repassword').val('');

															$('#btnsave').attr('style','opacity:0.8;cursor:default');
							
															$('#btnsave').attr('disabled',true);	
														}	
													else
														{
															$('#errpassre').html('');
							
															$('#errorpassnew').hide();		

															$('#btnsave').attr('style','opacity:1;cursor:pointer');
							
															$('#btnsave').attr('disabled',false);
														}		

													
												}	

											
										}	

									 
								}
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
					
					//var reg= /^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/;

					var reg= /(?=^.{8,}$).*$/   ;

							if(!reg.test($('#passwordnew').val()))
								{
									$('#errpassnew').html('the password is not valid (must have at least 8 characters) ');
							
									$('#errorpassnew').show();  

									$('#passwordnew').val('');

									registra = registra + 1;
								}
							else
								{

									var reg1= /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[\u0021-\u002b\u003c-\u0040]).*$/   ;

									if(!reg1.test($('#passwordnew').val()))
										{
											$('#errpassnew').html('the password is not valid (must have a symbol) ');
									
											$('#errorpassnew').show();  

											$('#passwordnew').val('');

											registra = registra + 1;
										}
									else
										{
											var reg2= /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z]).*$/   ;

											if(!reg2.test($('#passwordnew').val()))
												{
													$('#errpassnew').html('the password is not valid (must have a capital letter) ');
											
													$('#errorpassnew').show();  

													$('#passwordnew').val('');

													registra = registra + 1;
												}	
											else
												{
													var reg3= /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/   ;

													if(!reg3.test($('#passwordnew').val()))
														{
															$('#errpassnew').html('the password is not valid (must have a lowercase letter) ');
													
															$('#errorpassnew').show();  

															$('#passwordnew').val('');

															registra = registra + 1;
														}	
													else
														{
															$('#errpassnew').html('');
							
															$('#errorpassnew').hide();		
														}		

													
												}	

											
										}	

									 
								}
					
				}
			if ($('#repassword').val() == '')
				{
					$('#errpassre').html('This field can not be empty');
					
					$('#errorpassre').show(); 

					registra = registra + 1;
					
				}
			else
				{
					var reg= /^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/;

					if(!reg.test($('#repassword').val()))
						{
							$('#errpassre').html('the password is not valid');
					
							$('#errorpassre').show();  

							$('#repassword').val('');

							registra = registra + 1;
						}
					else
						{

							$('#errpassre').html('');
					
							$('#errorpassre').hide();  
						}						
					
				}
		
		
			if ( registra == 0 )
				{
							
					$('#formchangepassword').submit();
				}
				
		});
		
})();

//$('div.alert').delay(5000).slideUp(300);



function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}		
