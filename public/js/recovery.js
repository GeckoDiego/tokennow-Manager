(function() {
		
			
		
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
		
		$(".submitRecovery").on('click', function(){
			
			var registra = 0;
			
			if ($('#email').val() == '')
					{
						$('#errmail').html('This field can not be empty');
						
						$('#errormail').show(); 
						
						registra = registra + 1;
					}
				else
					{
						$('#errormail').hide(); 
						
						var correctemail =  isEmail($('#email').val());  
						
						if (correctemail == false)
							{
								$('#errmail').html('It is not a valid email');
						
								$('#errormail').show(); 
								
								registra = registra + 1;
							}
						else
							{
								$('#errormail').hide(); 
							}
					}	
			
			if (registra == 0)
				{
					formrecovery.submit();
				}
		});
		

})();
//$('div.alert').delay(15000).slideUp(300); 
function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}
