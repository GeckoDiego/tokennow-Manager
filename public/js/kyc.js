(function() {
		
			
		/****** validacion de name *****////
				$('#name').bind('blur', function () { 
				
					if ($('#name').val() == '')
						{
							$('#errname').html('This field can not be empty');
							
							$('#errorname').show(); 
							
							$('#btncontinua').attr('style','opacity:0.8;cursor:default');
											
							$('#btncontinua').attr('disabled',true);
						}
					else
						{
							$('#errorname').hide(); 							
							
							if ($('#email').val() != '' && $('#country').val() > 0 && $('#identificationType').val() != '' && $('#identification').val() != '' &&  $('#birthdate').val() != '' && $('#gender').val() != ''  && $('#identificationImage').val()!= '' &&  $('#selfie').val() != '')

								{
														
									$('#btncontinua').attr('style','opacity:1;cursor:pointer');
											
									$('#btncontinua').attr('disabled',false);
								}
							
							
						}
				});
		/*******************************///	
		
		/****** validacion de email *****////
			$('#email').bind('blur', function () { 
					
				if ($('#email').val() == '')
					{
						$('#errmail').html('This field can not be empty');
						
						$('#errormail').show(); 
						
						$('#btncontinua').attr('style','opacity:0.8;cursor:default');
											
						$('#btncontinua').attr('disabled',true);
							
					}
				else
					{
						//$('#errormail').hide(); 
						
						var correctemail =  isEmail($('#email').val());  
						
						if (correctemail == false)
							{
								$('#errmail').html('It is not a valid email');
						
								$('#errormail').show(); 
								
								$('#email').val('');
								
								$('#btncontinua').attr('style','opacity:0.8;cursor:default');
											
								$('#btncontinua').attr('disabled',true);
								
							}
						else
							{
								$('#errormail').hide(); 
								
								if ($('#name').val() != '' && $('#country').val() > 0 && $('#identificationType').val() != '' && $('#identification').val() != '' &&  $('#birthdate').val() != '' && $('#gender').val() != ''  && $('#identificationImage').val()!= '' &&  $('#selfie').val() != '')
										{
																
											$('#btncontinua').attr('style','opacity:1;cursor:pointer');
													
											$('#btncontinua').attr('disabled',false);
										}
								
							}
					}	
			});
		/*******************************///		
		
		
		/****** validacion de country *****////
				$('#country').bind('change', function () { 
				
					if ($('#country').val() == 0)
						{
							$('#errcountry').html('This field can not be empty'); 
							
							$('#errorcountry').show(); 
							
							$('#btncontinua').attr('style','opacity:0.8;cursor:default');
											
							$('#btncontinua').attr('disabled',true);
						}
					else
						{
							$('#errorcountry').hide(); 
							
							if ($('#name').val() != '' && $('#email').val() != '' && $('#identificationType').val() != '' && $('#identification').val() != '' &&  $('#birthdate').val() != '' && $('#gender').val() != ''  && $('#identificationImage').val()!= '' &&  $('#selfie').val() != '')
								{
														
									$('#btncontinua').attr('style','opacity:1;cursor:pointer');
											
									$('#btncontinua').attr('disabled',false);
								}
						}
				});
		/*******************************///	
		
		/****** validacion de type *****////
				$('#identificationType').bind('change', function () { 
				
					if ($('#identificationType').val() == '')
						{
							$('#errtype').html('This field can not be empty');
							
							$('#errortype').show(); 
							
							$('#btncontinua').attr('style','opacity:0.8;cursor:default');
											
							$('#btncontinua').attr('disabled',true);
						}
					else
						{
							$('#errortype').hide(); 
							
							if ($('#name').val() != '' && $('#country').val() > 0 && $('#email').val() != '' && $('#identification').val() != '' &&  $('#birthdate').val() != '' && $('#gender').val() != ''  && $('#identificationImage').val()!= '' &&  $('#selfie').val() != '')
								{
														
									$('#btncontinua').attr('style','opacity:1;cursor:pointer');
											
									$('#btncontinua').attr('disabled',false);
								}
						}
				});
		/*******************************///	
		
		/****** validacion de id number *****////
				$('#identification').bind('blur', function () { 
				
					if ($('#identification').val() == '')
						{
							$('#errid').html('This field can not be empty');
							
							$('#errorid').show(); 
							
							$('#btncontinua').attr('style','opacity:0.8;cursor:default');
											
							$('#btncontinua').attr('disabled',true);
						}
					else
						{
							$('#errorid').hide(); 
							
							if ($('#name').val() != '' && $('#country').val() > 0 && $('#identificationType').val() != '' && $('#email').val() != '' &&  $('#birthdate').val() != '' && $('#gender').val() != ''  && $('#identificationImage').val()!= '' &&  $('#selfie').val() != '')
								{
														
									$('#btncontinua').attr('style','opacity:1;cursor:pointer');
											
									$('#btncontinua').attr('disabled',false);
								}
						}
				});
		/*******************************///	
		
		/****** validacion de id birthdate *****////
				/*$('#birthdate').bind('blur', function () { 
				
					if ($('#birthdate').val() == '')
						{
							$('#errbirth').html('This field can not be empty');
							
							$('#errorbirth').show(); 
						}
					else
						{
							$('#errorbirth').hide(); 
						}
				});*/
		/*******************************///	
		
		/****** validacion de gender *****////
				$('#gender').bind('change', function () { 
				
					if ($('#gender').val() == '')  
						{
							$('#errgen').html('This field can not be empty');
							
							$('#errorgend').show(); 
							
							$('#btncontinua').attr('style','opacity:0.8;cursor:default');
											
							$('#btncontinua').attr('disabled',true);
						}
					else
						{
							$('#errorgend').hide(); 
							
							if ($('#name').val() != '' && $('#country').val() > 0 && $('#identificationType').val() != '' && $('#identification').val() != '' &&  $('#birthdate').val() != '' && $('#email').val() != ''  && $('#identificationImage').val()!= '' &&  $('#selfie').val() != '')
								{
														
									$('#btncontinua').attr('style','opacity:1;cursor:pointer');
											
									$('#btncontinua').attr('disabled',false);
								}
							
						}
				});
		/*******************************///	
		
		/****** validacion de id number *****////
				$('#identificationImage').bind('blur', function () { 
				
					if ($('#identificationImage').val() == '')
						{
							$('#errfoto1').html('This field can not be empty');
							
							$('#errorfoto1').show(); 
							
							$('#btncontinua').attr('style','opacity:0.8;cursor:default');
											
							$('#btncontinua').attr('disabled',true);
						}
					else
						{
							$('#errorfoto1').hide(); 
							
							if ($('#name').val() != '' && $('#country').val() > 0 && $('#identificationType').val() != '' && $('#identification').val() != '' &&  $('#birthdate').val() != '' && $('#gender').val() != ''  && $('#email').val()!= '' &&  $('#selfie').val() != '')
								{
														
									$('#btncontinua').attr('style','opacity:1;cursor:pointer');
											
									$('#btncontinua').attr('disabled',false);
								}
							
							
						}
				});
		/*******************************///	
		
		/****** validacion de id number *****////
				$('#selfie').bind('blur', function () { 
				
					if ($('#selfie').val() == '')
						{
							$('#errfoto2').html('This field can not be empty');
							
							$('#errorfoto2').show(); 
							
							$('#btncontinua').attr('style','opacity:0.8;cursor:default');
											
							$('#btncontinua').attr('disabled',true);
						}
					else
						{
							$('#errorfoto2').hide(); 
							
							if ($('#name').val() != '' && $('#country').val() > 0 && $('#identificationType').val() != '' && $('#identification').val() != '' &&  $('#birthdate').val() != '' && $('#gender').val() != ''  && $('#identificationImage').val()!= '' &&  $('#email').val() != '')
										{
																
											$('#btncontinua').attr('style','opacity:1;cursor:pointer');
													
											$('#btncontinua').attr('disabled',false);
										}
							
							
						}
				});
		/*******************************///	
		
		
		
		
		$(".submitkyc").on('click', function(){
			
			var registra = 0;
			
			if ($('#name').val() == '')
				{
					$('#errname').html('This field can not be empty');
					
					registra = registra + 1;
				}
			else
				{
					
				}
			
			
			if ($('#email').val() == '')
					{
						
						$('#errmail').html('This field can not be empty');
						
						$('#errormail').show(); 
						
						registra = registra + 1;
					}
				else
					{
						var correctemail =  isEmail($('#email').val());  
						
						if (correctemail == false)
							{
								$('#errmail').html('It is not a valid email');
						
								$('#errormail').show(); 
								
								registra = registra + 1;
							}
						else
							{
								
							}
					}	
					
			if ($('#country').val() == 0)
				{ 	
					$('#errcountry').html('This field can not be empty');  
							
					$('#errorcountry').show(); 
					
					registra = registra + 1;
				}	
			else
				{

				}
			
			if ($('#identificationType').val() == 0)
				{ 	
				
					$('#errtype').html('This field can not be empty');
							
					$('#errortype').show();
					
					registra = registra + 1;
				}	
			else
				{

				}	
			if ($('#identification').val() == 0)
				{ 	
					
					$('#errid').html('This field can not be empty');
							
					$('#errorid').show(); 
					
					registra = registra + 1;
				}	
			else
				{

				}
				
		if ($('#birthdate').val() == 0)
				{ 	
					
					$('#errbirth').html('This field can not be empty');
							
					$('#errorbirth').show(); 
					
					registra = registra + 1;
				}	
			else
				{

				}
				
			if ($('#identificationImage').val() == '')
				{
					$('#errfoto1').html('This field can not be empty');
					
					$('#errorfoto1').show(); 
					
					registra = registra + 1;
				}
			else
				{
					
				}	
				
			if ($('#gender').val() == '')
						{
							$('#errgen').html('This field can not be empty');
							
							$('#errorgend').show(); 
							
							registra = registra + 1;
						}
					else
						{
							
						}	
				
			if ($('#selfie').val() == '')
				{
					$('#errfoto2').html('This field can not be empty');
					
					$('#errorfoto2').show(); 
					
					registra = registra + 1;
				}
			else
				{
					
				}	
		
			if (registra == 0)
				{
					
					$('#formkyc').submit(); 
				}
			else
				{
					/*$('#msgboxnegative').html('missing data to fill');
					
					$('#boxmsgmal').show();
					
					$('div.alert').delay(5000).slideUp(300);*/
				}
		});
		
		$(".submitkyc_confirmed").on('click', function(){
			
			var registra = 0;
			
			//se verifican los check para que esten todos confirmados
			
			
			$(".loschecks").each(function(){
				var id = $(this).attr('id');   
				if ($('#'+id).prop('checked') == true)
					{
						registra = registra + 1;
					}
			});
			
			if (registra == 4)
				{
					$('#formkycconfirmed').submit(); 
				}	
			else
				{
					alert('faltan');
				}
			
		});	
		
		$(".loschecks").on('click', function(){
			
			var seve = 0;
			
			$(".loschecks").each(function(){
				var id = $(this).attr('id');   
				if ($('#'+id).prop('checked') == true)
					{
						seve = seve + 1;
					}
			});
			
			if (seve == 4)
				{
					$('.submitkyc_confirmed').attr('disabled',false);
				}	
		});		
		

})();

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}