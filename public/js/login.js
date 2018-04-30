(function() {
	
  $(".sign_in").on('click', function(){
        /*var email = $('#emaillogin').val();

        var password = $('#passwordlogin').val();

        if ($.trim(email) != '' && $(password) != '' )
            {
                $('#frmlogin').submit(); 
		        	}
        else
          {                                 
                 // alert('ddddd');                         
          }*/
        $('#frmlogin').submit(); 
        });
        
       /* $('#email').bind('blur', function () { 
			alert('sami');
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
			});*/
        
})();


function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}