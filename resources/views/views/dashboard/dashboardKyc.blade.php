@extends('layout.app')
@section('stylesheet')
@stop



@section('title', 'Users management')
@section('content')
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modaldecline" style="z-index: 99999;">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
		<div class="modal-header" style="background-color: #f5f5f5 !important;">
              
		<button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 id="titulocorreo" class="modal-title">Reason for rejection</h4>
			        </div>
			        <div class="modal-body"> 
			       
                    <input id="iduser" type="hidden" class="form-control" value="">  

                    <input id="idaccion" type="hidden" class="form-control" value=""> 

                     <div class="row" style="position:relative;left:3%!important;">
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

                   <div class="row" style="position:relative;left:3%!important;">
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

                   <div class="row" style="position:relative;left:3%!important;">
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
                                    <br>
                                  </div>
                                  
                            </div>
                        
                        
                      </div>           
                    </div> 
				   
									   
			        	
		      		</div>
		      <div class="modal-footer">
		          <!--button type="button" class="btn btn-default" data-dismiss="modal">Close</button-->
		      </div>
		        <div class="form-group" style="text-align: center !important;"> 
                            <button id="guardaraccion" type="button" onclick="saveaccion()" class="btn btn-info" style="background: #392068; border:#392068; height:32px !important;" >Save</button>  
                            <button id="cancelaraccion" type="button" class="btn btn-danger btn-close" data-dismiss="modal" style="background: #392068; border:#392068;">Cancel</button>
             
			    </div>
                         &nbsp;
		    </div>
		  </div>
		</div>
<div id="fondomodal" class="fondomodal">
	<div id="cargando" class="cargando">
		<img src="{{{ asset('spinner/loader-dark.gif') }}}" width="100" height="100" alt=""/>
	</div>
</div>

<section class="content">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="col-lg-1 col-xs-6">
          <input type="text" class="form-control hasDatepicker" id="datepicker" name="datepickerFrom" placeholder="Date From">
        </div>
        <div class="col-lg-1 col-xs-6">
          <input type="text" class="form-control hasDatepicker" id="datepicker2" name="datepickerTo" placeholder="Date To">                
		</div>
		<div class="col-lg-1 col-xs-6">
          <select id="estatusreg" class="form-control">
            <option class="form-control" value="all">All</option>
            <option class="form-control" value="NO" >Pending</option>
            <option class="form-control" value="YES" >Accept</option>
            <option class="form-control" value="REC" >Denied</option>
          </select>
        </div>
         <div class="col-lg-2 col-xs-6">
		  <select id="countriesreg" class="form-control">
			<option class="form-control" value="all">All</option>
				  @foreach( $repaises as $pais )
						<option value="{{ $pais->id_country }}">{{ $pais->name }}</option>
				  @endforeach
		  </select>
		 </div>        
        <div class="col-lg-2 col-xs-6">
          <input type="text" class="form-control" id="search" name="search" placeholder="Search">
        </div>
        <div class="col-lg-3 col-xs-6">
          <a class="btn btn-info" id="searchbtn" role="button" style="background: #392068 !important; border: #392068 !important;">Search</a>
          <a class="btn btn-info" id="exportar" role="button" style="background: #392068 !important; border: #392068 !important;">Download</a>
          <a class="btn btn-info" id="sendemail" role="button" style="background: #392068 !important; border: #392068 !important;">Email</a>
        </div>
      </div>
    </div>    
  </div>
  <div class="row">
    <main id="contmain" role="main" class="col-xs-12"></main>
  </div>
</section>
@stop
@section('script')
<script type="text/javascript">    
$(document).ready(function() {


	verlista(1,'',0,'all','','all',''); //pagina,buscar,numeroregistros,estatusreg,datepicker,country

	$('#datepicker').datepicker({
		format: 'yyyy-mm-dd',
		autoclose: true,
		endDate:'0d'
		})
		.on('changeDate', function(e) {
		var estatusreg = $('#estatusreg').val();
		var textobsucar = $('#search').val();              
		var datepicker = $('#datepicker').val(); 
		var datepicker2 = $('#datepicker2').val();               
		var countriesreg = $('#countriesreg').val();                      
		if (textobsucar != ''){                                    
			verlista(1,textobsucar,0,estatusreg,datepicker,countriesreg,datepicker2);                                     
		}else{
			verlista(1,'',0,estatusreg,datepicker,countriesreg,datepicker2);                   
		}
	});
    $('#datepicker2').datepicker({
		format: 'yyyy-mm-dd',
		autoclose: true,
		endDate:'0d'
		})
		.on('changeDate', function(e) {
		var estatusreg = $('#estatusreg').val();
		var textobsucar = $('#search').val();
		var datepicker = $('#datepicker').val(); 
		var datepicker2 = $('#datepicker2').val(); 
		var countriesreg = $('#countriesreg').val();
		if (textobsucar != ''){
			verlista(1,textobsucar,0,estatusreg,datepicker,countriesreg,datepicker2); 
		}else{
			verlista(1,'',0,estatusreg,datepicker,countriesreg,datepicker2); 
		}
	});
 
 });

 //se captura la url para el envio de solicitudes al server via ajax

  var pathname =  document.location + '';

if (pathname.indexOf("public") > -1)
    {
        var nurl = pathname.split("public");

        var urldir = nurl[0]+'public';

    }
else
    {
      var urldir = '//'+window.location.host;
    }
//***************************************//

  function register(id){

    var selector = $('#gec'+id+'');

    var idaccion = selector.val();


    if( selector.val() == "REC" )
        {
        
        $('#iduser').val(id);

        $("#modaldecline").attr('style','z-index: 99999;');
        
        $("#logout-modal").attr('style','z-index: 1;');
        
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

                  $('#fondomodal').show();

                  //var urltemp = 'https://'+pathname+'/guardarreason/'+id+'/'+reason+'/'+valor;
                  var urltemp = urldir+'/guardarreason/'+id+'/'+reason+'/'+valor;
               

                  $.ajax({
                        url: urltemp,
                        async:false, 
                        type: "get",
                        success: function(data){ 
                        
                               $('#fondomodal').hide();

                              $('#gec'+id).attr('disabled',true);

                               $('#register'+id).attr('style','opacity:0.5!important;filter: alpha(opacity=50)!important;background: #392068!important;border: #392068 !important;'); 

                                $('.colorcelda_'+id).attr('style','border: 2px solid green!important;border-top: 3px solid green!important;'); 

                              //se cambia el elemento de estatus en tiempo real
                              
                              
                                     var script =  '<span data-feather="check-square" style="color:green !important; font-weight:bold !important;"></span><a style="color:green !important; font-weight:bold !important;">&nbsp;Accept </a></td>';
					
                               $('#elestatus_'+id).html(script);

                               $('#register'+id).attr('disabled',true);

                              $('#boxms').html('It was done successfully'); 

                              $('#msgbox').show(); 

                              $('#msgbox').delay(7000).slideUp(300);  

                              },
                              error: function(XMLHttpRequest, textStatus, errorThrown) { 
                               $('#fondomodal').hide(); console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
                              } 
                        }); 

                  } 
          } 
    
 
 }

 function saveaccion(){
 
          var iduser = $('#iduser').val();

	  $('#fondomodal').show();

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

          //se envia a grabar

          //var pathname = window.location.host; 
          
          var reason = valoresitemp+'_;_'+valoresitensec;

          //var urltemp = 'https://'+pathname+'/guardarreason/'+iduser+'/'+reason+'/REC';
          var urltemp = urldir+'/guardarreason/'+iduser+'/'+reason+'/REC';

          if (valoresitemp != '' && valoresitensec != '')
                  {
                  
                  $('#modaldecline').modal('hide'); 
                  
                  $.ajax({
                        url: urltemp,
                        async:false, 
                        type: "get",
                        success: function(data){ 
                          
		          $('#fondomodal').hide();

                          $('#gec'+iduser).attr('disabled',true);
                          
			  $('.colorcelda_'+iduser).attr('style','border: 2px solid red!important;border-top: 3px solid red!important;');

                           //se cambia el valor del estatus en tiempo real

                          var script =  '<span data-feather="x-square"></span><a>&nbsp;Decline</a></td>';

                          $('#elestatus_'+iduser).html(script);

                          $("#register"+iduser).attr('style','opacity:1!important;filter: alpha(opacity=50)!important;background: #392068!important;border: #392068 !important;');

			  $("#register"+iduser).attr('disabled',true);

                          $('#boxms').html('It was done successfully'); 

                          $('#msgbox').show(); 

                          $('#msgbox').delay(7000).slideUp(300);      
                        
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        $('#fondomodal').hide(); console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
                        } 
                        }); 
                  }
    }

 function verlista(pagina,buscar,numregistros,estatusreg,fecha,country,fecha2){ 

      if (buscar == '')
        {
          buscar = '_;_';
        }
        
      buscar = buscar.replace(/%/g, '_..._');
    
      buscar = buscar.replace(/\/|\)/g, "_...._");
      
      var num_total_registros = numregistros;  

      if (fecha == '')
        {
          fecha = '0000-00-00';
        }
      else
        {
          if (fecha != '0000-00-00')
            {
              if (fecha.indexOf("/") > -1)
                {
                  fecha = fecha.split('/');

                  fecha = fecha[2]+'-'+fecha[1]+'-'+fecha[0];
                }
              
            }      
        }  

      if (fecha2 == '')
        {
          fecha2 = '0000-00-00';
        }
      else
        {
          if (fecha2 != '0000-00-00')
            {

              if (fecha2.indexOf("/") > -1)
                {
                  fecha2 = fecha2.split('/');

                  fecha2 = fecha2[2]+'-'+fecha2[1]+'-'+fecha2[0];
                }  
            }      

        }    
       
      if (country != 'all')
        {
            country = country * 1;
        }

      $('#fondomodal').show();

      //var urltemp = 'http://'+pathname+'/buscardatospaginaUsers/'+pagina+'/'+num_total_registros+'/'+buscar+'/'+estatusreg+'/'+fecha+'/'+country+'/'+fecha2;  
    
      var urltemp = urldir+'/buscardatospaginaUsers/'+pagina+'/'+num_total_registros+'/'+buscar+'/'+estatusreg+'/'+fecha+'/'+country+'/'+fecha2;
    
      
      $.ajax({
          url: urltemp,
          async: false,
          type: "get",
          success: function(data){     
		  $("#contmain").html(data);
		  $('#fondomodal').hide();
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
            $('#fondomodal').hide(); console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
            }         
      });  
    }

 function activarregister(id){
  $("#register"+id).attr('style','opacity:1!important;filter: alpha(opacity=100)!important;background: #392068!important;border: #392068 !important;');
  $("#register"+id).attr('disabled',false);
 }
 
 
        
 function verificareason(id){
        $('.loschecks').prop('checked',false);
        
        $('#opcfoto1').hide();
        
        $('#opcfoto2').hide();

        $('#opcfoto3').hide();
        
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

 $('#exportar').bind('click', function () { 
    var estatusreg = $('#estatusreg').val();

    var buscar = $('#search').val();

    var fecha = $('#datepicker').val(); 

    var fecha2 = $('#datepicker2').val(); 

    var country = $('#countriesreg').val();

    if (buscar == '')
      {
        buscar = '_;_';
      }
 
 buscar = buscar.replace(/%/g, '_..._');
 
 buscar = buscar.replace(/\/|\)/g, "_...._");

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

 if (fecha2 == '')
    {
        fecha2 = '0000-00-00';
    }
 else
    {
       if (fecha2 != '0000-00-00')
          {

              fecha2 = fecha2.split('/');

              fecha2 = fecha2[2]+'-'+fecha2[1]+'-'+fecha2[0];
          } 

 } 
 
 if (country != 'all')
    {
    country = country * 1;
    } 
 
      var urltemp = urldir+'/descargaruser/'+buscar+'/'+estatusreg+'/'+fecha+'/'+country+'/'+fecha2; 
      
      window.open(urltemp, '_blank');


 }); 



 $('#estatusreg').bind('change', function () { 
 var estatusreg = $('#estatusreg').val();

 var textobsucar = $('#search').val();
 
 var datepicker = $('#datepicker').val(); 

 var datepicker2 = $('#datepicker2').val(); 
 
 var countriesreg = $('#countriesreg').val();
         
 if (textobsucar != '')
    { 
    
        verlista(1,textobsucar,0,estatusreg,datepicker,countriesreg,datepicker2); 
    
    
    }
 else
      {
          verlista(1,'',0,estatusreg,datepicker,countriesreg,datepicker2); 
      
      }
 
 });
 
 $('#countriesreg').bind('change', function () { 
      var estatusreg = $('#estatusreg').val();

      var textobsucar = $('#search').val();
      
      var datepicker = $('#datepicker').val(); 

      var datepicker2 = $('#datepicker2').val(); 
      
      var countriesreg = $('#countriesreg').val();
         
 if (textobsucar != '')
    {
    
    
    verlista(1,textobsucar,0,estatusreg,datepicker,countriesreg,datepicker2); 
    
    
    }
 else
    {
    verlista(1,'',0,estatusreg,datepicker,countriesreg,datepicker2); 
    
    }
 
 });
 
 
 

 $('#searchbtn').bind('click', function () { 

 var estatusreg = $('#estatusreg').val();

 var textobsucar = $('#search').val();

 var datepicker = $('#datepicker').val(); 

 var datepicker2 = $('#datepicker2').val(); 

 var countriesreg = $('#countriesreg').val();
        
 if (textobsucar != '')
      {
      

      verlista(1,textobsucar,0,estatusreg,datepicker,countriesreg,datepicker2); 


      }
 else
      {
      verlista(1,'',0,estatusreg,datepicker,countriesreg,datepicker2); 
      
      }
 });
 
  $("#search").keyup(function(e) {
      if(e.which == 13) 
        {
            var estatusreg = $('#estatusreg').val();

            var textobsucar = $('#search').val();
            
            var datepicker = $('#datepicker').val(); 

            var datepicker2 = $('#datepicker2').val(); 
            
            var countriesreg = $('#countriesreg').val();
                    
            if (textobsucar != '')
                {
                
                
                verlista(1,textobsucar,0,estatusreg,datepicker,countriesreg,datepicker2); 
                
                
                }
            else
                {
                verlista(1,'',0,estatusreg,datepicker,countriesreg,datepicker2); 
                
                }
      }
  });

  $('#sendemail').bind('click', function () { 
        var estatusreg = $('#estatusreg').val();

        var buscar = $('#search').val();

        var fecha = $('#datepicker').val(); 

        var fecha2 = $('#datepicker2').val(); 

        var country = $('#countriesreg').val();

        if (buscar == '')
          {
            buscar = '_;_';
          }
          
        buscar = buscar.replace(/%/g, '_..._');
      
        buscar = buscar.replace(/\/|\)/g, "_...._");

        var pathname = window.location.host; 

        if (fecha == '')
          {
            fecha = '0000-00-00';
          }
        else
          {
            if (fecha != '0000-00-00')
              {
                if (fecha.indexOf("/") > -1)
                  {
                    fecha = fecha.split('/');

                    fecha = fecha[2]+'-'+fecha[1]+'-'+fecha[0];
                  }  
              }      

          }  

         if (fecha2 == '')
          {
            fecha2 = '0000-00-00';
          }
        else
          {
            if (fecha2 != '0000-00-00')
              {

                fecha2 = fecha2.split('/');

                fecha2 = fecha2[2]+'-'+fecha2[1]+'-'+fecha2[0];
              }      

          }    
        
        if (country != 'all')
          {
              country = country * 1;
          }    
	
	$('#fondomodal').show();

        var urltemp = urldir+'/sendmailkyc/'+buscar+'/'+estatusreg+'/'+fecha+'/'+country+'/'+fecha2;  
           
            $.ajax({
                url: urltemp,
                type: "get",
                async: false,
                success: function(data){    
                  
		  $('#fondomodal').hide();

                  $('#boxms').html('The email has been sent'); 

                  $('#msgbox').show(); 

                  $('#msgbox').delay(7000).slideUp(300);  

                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                  $('#fondomodal').hide(); console.log("Status: " + textStatus); console.log("Error: " + errorThrown); 
                  }         
            });   



    }); 
</script>
@stop



