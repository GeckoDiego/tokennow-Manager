(function() {
    
    
    $("#emaillogin").keypress(function(e) {
        if(e.which == 13) 
          {
             var email = $('#emaillogin').val();
  
             var password = $('#passwordlogin').val();
      
             if ($.trim(email) != '' && $(password) != '' )
                  {
                      $('#frmlogin').submit(); 
  		        	  }
        }
    });
    
    $("#passwordlogin").keypress(function(e) {
        if(e.which == 13) 
          {
             var email = $('#emaillogin').val();
  
             var password = $('#passwordlogin').val();
      
             if ($.trim(email) != '' && $(password) != '' )
                  {
                      $('#frmlogin').submit(); 
  		        	  }
        }
    });
    
    
    
    $('#emaillogin').bind('blur', function () { 
        
			
		if ($('#emaillogin').val() == '')
			{
				$('#errmail').html('This field can not be empty');
				
				$('#errormail').show(); 
			}
		else
			{
				$('#errormail').hide(); 
				
				var correctemail =  isEmail($('#emaillogin').val());  
				
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
	
  $('#passwordlogin').bind('blur', function () { 
	  
		if ($('#passwordlogin').val() == '')
		{
			$('#errpass').html('This field can not be empty');
			
			$('#errorpass').show(); 
		}
	else
		{
			//var reg= /^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/;

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






  $(".sign_in").on('click', function(){

		var email = $('#emaillogin').val();  
		
        var password = $('#passwordlogin').val();

        if ($.trim(email) != '' && $(password) != '' )
            {
                $('#frmlogin').submit(); 
			}
        
        
        });
})();


function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
  }