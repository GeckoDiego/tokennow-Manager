<?php
	@session_start();   
  $abuscar = $buscar;
 ?> 		
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ Session::get('name') }}</title>

    <!-- Bootstrap core CSS -->    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ asset('css/sticky-footer-navbar.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
  </head>
<body> 

      

      <div class="modal fade" id="modaldecline" role="dialog" style="z-index:9999999 !important;">
		    <div class="modal-dialog modal-lg" style="width: 100%;overflow-y:auto;overflow-x:none;max-heigth:30%;z-index:99999999 !important;">		    		    
		      <!-- Modal content-->
		      <div class="modal-content">
			        <div class="modal-header" style="background-color: #f5f5f5 !important;">
              
			          <!--h4 id="titulocorreo" class="modal-title">Reason for rejection</h4--> 
                <button type="button" class="close" data-dismiss="modal">&times;</button>
			        </div>
			        <div class="modal-body"> 
			       
                    <input id="iduser" type="hidden" class="form-control" value="">  

                    <input id="idaccion" type="hidden" class="form-control" value=""> 

                     <div class="row">
                      <div >  <!-- col-md-12 mb-3-->
                        <div class="custom-control">
                          <input type="checkbox" class="loschecks" id="foto1" name="foto1" onclick="verificareason(this.id)" value="ID PHOTO">   <!-- custom-control-input-->
                          <label  for="customCheck1">ID PHOTO</label>
                        </div> 
                            <div id="opcfoto1" style="position:relative;left:3%;display:none;" >
                                  <div class="custom-control">
                                    <input type="checkbox" class="checkfoto1" id="foto1_1" name="foto1_1" value="Blurry-illegible document">   <!-- custom-control-input-->
                                    <label  for="customCheck1">Blurry-illegible document</label>
                                  </div> 
                                  
                                   <div class="custom-control">
                                    <input type="checkbox" class="checkfoto1" id="foto1_2" name="foto1_2" value="Invalid document">   <!-- custom-control-input-->
                                    <label  for="customCheck1">Invalid document</label>
                                  </div> 
                                  
                                  <div class="custom-control">
                                    <input type="checkbox" class="checkfoto1" id="foto1_3" name="foto1_3" value="Corners of the document must be visible">   <!-- custom-control-input-->
                                    <label  for="customCheck1">Corners of the document must be visible</label>
                                  </div> 
                                  
                            </div>
                            
                            
                        
                      </div>           
                    </div>   

                    <div class="row">
                      <div >
                        <div class="custom-control ">   <!-- custom-checkbox-->
                          <input type="checkbox" class="loschecks" id="foto2" name="foto2" onclick="verificareason(this.id)" value="SELFIE WITH DOCUMENT">
                          <label  for="customCheck1">SELFIE WITH DOCUMENT</label>   <!-- custom-control-label-->
                        </div> 
                          <div id="opcfoto2" style="position:relative;left:3%;display:none;" >
                                  <div class="custom-control">
                                    <input type="checkbox" class="checkfoto1" id="foto2_1" name="foto2_1" value="Blurry-illegible document">   <!-- custom-control-input-->
                                    <label  for="customCheck1">Blurry-illegible document</label>
                                  </div> 
                                  
                                   <div class="custom-control">
                                    <input type="checkbox" class="checkfoto1" id="foto2_2" name="foto2_2" value="Invalid document">  <!-- custom-control-input-->
                                    <label  for="customCheck1">Invalid document</label>
                                  </div> 
                                  
                                  <div class="custom-control">
                                    <input type="checkbox" class="checkfoto1" id="foto2_3" name="foto2_3" value="Corners of the document must be visible">  <!-- custom-control-input-->
                                    <label  for="customCheck1">Corners of the document must be visible</label>
                                  </div> 
                                  
                                  <div class="custom-control">
                                    <input type="checkbox" class="checkfoto1" id="foto2_4" name="foto2_4" value="You used a different document than the previous photo"> <!-- custom-control-input-->
                                    <label  for="customCheck1">You used a different document than the previous photo</label>
                                  </div>
                                  
                                  <div class="custom-control">
                                    <input type="checkbox" class="checkfoto1" id="foto2_5" name="foto2_5" value="The person holding the document must be the same that appears in its photo">   <!-- custom-control-input-->
                                    <label  for="customCheck1">The person holding the document must be the same that appears in its photo</label>
                                  </div>
                                  
                            </div>
                      </div>           
                    </div> 

                    <div class="row">
                      <div >
                        <div class="custom-control">
                          <input type="checkbox" class="loschecks" id="ambas" name="ambas" onclick="verificareason(this.id)" value="BOTH PHOTOS">
                          <label  for="customCheck1">BOTH PHOTOS</label>
                        </div> 
                        <div id="opcfoto3" style="position:relative;left:3%;display:none;" >
                                  <div class="custom-control">
                                    <input type="checkbox" class="checkfoto1" id="foto3_1" name="foto3_1" value="Blurry-illegible document">    <!-- custom-control-input-->
                                    <label  for="customCheck1">Blurry-illegible document</label>
                                  </div> 
                                  
                                   <div class="custom-control">
                                    <input type="checkbox" class="checkfoto1" id="foto3_2" name="foto3_2" value="Invalid document">   <!-- custom-control-input-->
                                    <label  for="customCheck1">Invalid document</label>
                                  </div> 
                                  
                                  <div class="custom-control">
                                    <input type="checkbox" class="checkfoto1" id="foto3_3" name="foto3_3" value="Corners of the document must be visible">   <!-- custom-control-input-->
                                    <label  for="customCheck1">Corners of the document must be visible</label>
                                  </div> 
                                  
                                  <div class="custom-control">
                                    <input type="checkbox" class="checkfoto1" id="foto3_4" name="foto3_4" value="You used a different document than the previous photo">   <!-- custom-control-input-->
                                    <label  for="customCheck1">You used a different document than the previous photo</label>
                                  </div>
                                  
                                  <div class="custom-control">
                                    <input type="checkbox" class="checkfoto1" id="foto3_5" name="foto3_5" value="The person holding the document must be the same that appears in its photo">   <!-- custom-control-input-->
                                    <label  for="customCheck1">The person holding the document must be the same that appears in its photo</label>
                                  </div>
                                  
                            </div>
                        
                        
                      </div>           
                    </div> 
				   
									   
			        	
		      		</div>
		      <div class="modal-footer">
		          <!--button type="button" class="btn btn-default" data-dismiss="modal">Close</button-->
		      </div>
		      
		      <div class="form-group" style="text-align: center !important;"> 
					<button id="guardaraccion" type="button" onclick="saveaccion()" class="btn btn-info" style="background: #392068; border:#392068; height:38px !important;" >Save</button>  
					<button id="cancelaraccion" type="button" class="btn btn-danger btn-close" data-dismiss="modal">Cancel</button>
			 </div>
		    </div>
		  </div>
		</div>


    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="col-sm-3 col-md-3 col-lg-3 col-xl-2 d-none d-md-block d-xl-block d-lg-block"><img src="https://c.fastcdn.co/u/074e20eb/27994387-0-logo.svg" alt="" width="90%"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
          	<li class="nav-item text-nowrap ml-4">
				<a>{{ Session::get('email') }}</a><br>
			</li>
          </ul> 
          <ul class="navbar-nav px-3">           
            <li class="nav-item text-nowrap">
			<a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
			</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            </li>
          </ul>                 
        </div>
      </nav>
    </header>
    <!-- Begin page content -->
    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-3 col-lg-3 col-xl-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">                      
              <li class="nav-item">
                <a class="nav-link" href="{{ url('dashboard') }}">
                  <span data-feather="menu"></span>
                  Management Users
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="{{ url('kyc_mgmt') }}">
                  <span data-feather="thumbs-up"></span>
                  Management KYC
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('upgrade') }}">
                  <span data-feather="dollar-sign"></span>
                  ETH Upgrade
                </a>
              </li>           
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Support</span>            
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="mailto:support@belotto.io">
                  
                  support@belotto.io
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Users management</h1> 
            <div class="btn-toolbar mb-2 mb-md-0">
            	<div class="btn-toolbar mb-2 mb-md-0">
			  		<input type="text" class="form-control" id="datepicker" name="datepicker" placeholder="Date" data-date-format="yyyy-mm-dd"/>
				</div>

      <div class="btn-group mr-2 ml-2">
					<select id="countriesreg">
						<option class="form-control" value="all">All</option>
						<?php
                  foreach($repaises as $pais)
                    {?>
                        <option value="<?php echo $pais->id_country;?>"><?php echo $pais->name;?></option><?php
                    }   
                  ?>                 
					</select>
				</div>

				<div class="btn-group mr-2 ml-2">
					<select id="estatusreg">
						<option class="form-control" value="all">All</option>
						<option class="form-control" value="NO">Pending</option>
						<option class="form-control" value="YES">Accept</option>
						<option class="form-control" value="REC">Denied</option>
					</select>
				</div>
				<div class="btn-toolbar mb-2 mb-md-0">
				  <input type="text" class="form-control" id="search" name="search" placeholder="Search" />
				</div>
				<div class="btn-toolbar mb-2 mb-md-0 ml-2">
				  <a id="searchbtn" class="btn btn-info" href="#" role="button" style="background: #392068 !important; border: #392068 !important;">Search</a>
				</div>   
		  	</div>
            
                  
          </div>
        </main>
        
        <main id="contmain" role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
              

        </main>
      </div>
    </div>
    
    <footer class="footer">
      <div class="container" align="center">
        <span class="text-muted"><img src="{{ asset('poweredbytokennow.svg') }}" alt="" width="150"></span>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"><\/script>')</script-->

    <script type="text/javascript" charset="utf8" src="{{ asset('js/jquery/jquery-1.9.1.js') }}"></script>
    <script type="text/javascript" charset="utf8" src="{{ asset('js/jquery/jquery-ui.js') }}"></script>

    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>    

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>

    <script type="text/javascript">
    
      $(document).ready(function() {
        verlista(1,'',0,'all','','all');    //pagina,buscar,numeroregistros,estatusreg,datepicker,country

     // $( "#datepicker" ).datepicker();	
      $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            
        });
      
      });

      

      feather.replace();

      function register(id){

          var selector = $('#gec'+id+'');

          var idaccion = selector.val();

          
            
          
          if( selector.val() == "REC" )
              {
            
                $('#iduser').val(id);

                $('#modaldecline').modal('show');  

              }
          else
              {
                if( selector.val() == "YES" || selector.val() == "NO" )
                   {
                      //se envia a grabar
                      //var iduser = id;

                      var reason = "_";

                      var valor = selector.val()

                      var pathname = window.location.host; 

                      var urltemp = 'https://'+pathname+'/guardarreason/'+id+'/'+reason+'/'+valor;
                      
                      //$('#modaldecline').modal('hide');  

                      $.ajax({
                            url: urltemp,
                            async:false, 
                            type: "get",
                            success: function(data){  
                                  
                                 // $('#titulomsg').html('Status change');

                                  $('#boxms').html('It was done successfully');

                                  $('#msgbox').show();    

                                  $('#msgbox').delay(7000).slideUp(300);	

                              },
                            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                                  alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                              }         
                          });  

                   } 
              }    
                
          
      }

      function  saveaccion(){
      
        var iduser = $('#iduser').val();
        
        //se carga el valor del item ppal
        var valoresitemp = '';
        $(".loschecks").each(function(){
      				var id = $(this).attr('id');   
      				if ($('#'+id).prop('checked') == true)
      					{
      						valoresitemp += $('#'+id).val()+",";
      					}
      			});
            
            valoresitemp = valoresitemp.slice(0,-1);
        //se cargan los datos del resto de los items internos
        
         var valoresitensec = '';
         $(".checkfoto1").each(function(){
      				var id = $(this).attr('id');   
      				if ($('#'+id).prop('checked') == true)
      					{
      						valoresitensec += $('#'+id).val()+",";
      					}
      			});
         valoresitensec = valoresitensec.slice(0,-1);
                
        //var reason = $('#reason').val(); 

        //se envia a grabar

        var pathname = window.location.host; 
        
        var reason = valoresitemp+'_;_'+valoresitensec;

        var urltemp = 'https://'+pathname+'/guardarreason/'+iduser+'/'+reason+'/REC';
      
       if (valoresitemp != '' && valoresitensec != '')
          {
               
              $('#modaldecline').modal('hide');  
      
              $.ajax({
                    url: urltemp,
                    async:false, 
                    type: "get",
                  success: function(data){   
                   
                    $('#boxms').html('It was done successfully');

                    $('#msgbox').show();    

                    $('#msgbox').delay(7000).slideUp(300);		
      
                    },
                  error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                    }         
                });  
          }
      }

  function verlista(pagina,buscar,numregistros,estatusreg,fecha,country){ 

      if (buscar == '')
        {
          buscar = '_;_';
        }
        
      buscar = buscar.replace(/%/g, '_..._');
    
      buscar = buscar.replace(/\/|\)/g, "_...._");
      
      var num_total_registros = numregistros;  
        
      var pathname = window.location.host; 

      if (fecha == '')
        {
          fecha = '0000-00-00';
        }
      else
        {
          if (fecha != '0000-00-00')
            {

              fecha = fecha.split('/');

              fecha = fecha[2]+'-'+fecha[1]+'-'+fecha[0];
            }
              

        }  


      var urltemp = 'https://'+pathname+'/buscardatospaginaUsers/'+pagina+'/'+num_total_registros+'/'+buscar+'/'+estatusreg+'/'+fecha+'/'+country;  	
      //alert(urltemp);

      $.ajax({
          url: urltemp,
          type: "get",
          success: function(data){  
            $("#contmain").html(data);
            feather.replace();
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }         
		  });  
    }

    function activarregister(id){
        $("#register"+id).attr('style','opacity:1!important;filter: alpha(opacity=100)!important;'); 

    }
    
    function verificareason(id){
      $('.loschecks').prop('checked',false);
      
      $('#opcfoto1').hide();
      
      $('#opcfoto2').hide();
      
      $('#'+id).prop('checked',true);
      
      $('.checkfoto1').prop('checked',false);
      
      $('.checkfoto2').prop('checked',false);

      $('.checkfoto3').prop('checked',false);
            
      if (id=="foto1")
        {
          $('#opcfoto1').show('slow');
        }
       if (id=="foto2")
        {
          $('#opcfoto2').show('slow');
        } 
      if (id=="ambas")
        {
          $('#opcfoto3').show('slow');
        } 
        
      
    }

    $('#searchbtn').bind('click', function () { 

        var estatusreg = $('#estatusreg').val();

       var textobsucar = $('#search').val();

       var datepicker = $('#datepicker').val(); 

       var countriesreg = $('#countriesreg').val();
				
        if (textobsucar != '')
          {
              

               verlista(1,textobsucar,0,estatusreg,datepicker,countriesreg);   


          }
        else
          {
            verlista(1,'',0,estatusreg,datepicker,countriesreg);   
            
          }
      });
    
    
	</script>
  </body>
</html>

