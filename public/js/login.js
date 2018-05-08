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
    
    
 
 
  $(".sign_in").on('click', function(){
       
        $('#frmlogin').submit(); 
        });
        
      
        
})();


function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}