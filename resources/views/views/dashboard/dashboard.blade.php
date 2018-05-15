@extends('layout.app')
@section('stylesheet')
@stop
@section('title', 'Users management')
@section('content')

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
          <input type="text" class="form-control hasDatepicker" id="datepicker" name="datepickerFrom" placeholder="Date From" data-date-format="yyyy-mm-dd" />
        </div>
        <div class="col-lg-1 col-xs-6">
          <input type="text" class="form-control hasDatepicker" id="datepicker2" name="datepickerTo" placeholder="Date To" data-date-format="yyyy-mm-dd" />                
        </div>
        <div class="col-lg-1 col-xs-6">
          <select id="estatusreg" class="form-control">
            <option class="form-control" value="all">All</option>
            <option class="form-control" value="NO">Pending</option>
            <option class="form-control" value="YES">Accept</option>
            <option class="form-control" value="REC">Denied</option>
          </select>
        </div>
        <div class="col-lg-2 col-xs-6">
          <select class="form-control" id="countriesreg">
            <option class="form-control" value="all">All</option>
            @foreach( $repaises as $pais )
              <option value="{{ $pais->id_country }}">{{ $pais->name }}</option>
            @endforeach   
          </select>
        </div>
        <div class="col-lg-2 col-xs-6">
          <input type="text" class="form-control" id="search" name="search" placeholder="Search" />      
        </div>
        <div class="col-lg-3 col-xs-6">
          <a id="searchbtn" class="btn btn-info" href="#" role="button" style="background: #392068 !important; border: #392068 !important;">Search</a>
          <a id="exportar" class="btn btn-info" href="#" role="button" style="background: #392068 !important; border: #392068 !important;">Download</a>
          <a id="sendemail" class="btn btn-info" href="#" role="button" style="background: #392068 !important; border: #392068 !important;">Email</a>
        </div>
      </div>
    </div>    
  </div>
  <div class="row">
     @php
     @endphp
    <div id="relleno" class="col-xs-12"> </div>
  </div>
</section>
@stop
@section('script')
<script type="text/javascript">    
  $(document).ready(function() {
      verlista(1,'',0,'all','','all','');    //pagina,buscar,numeroregistros,estatusreg,datepicker,country

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
                  
		    $('#fondomodal').show();	

                    //var urltemp = 'https://'+pathname+'/guardarreason/'+id+'/'+reason+'/'+valor;
                    var urltemp = urldir+'/guardarreason/'+id+'/'+reason+'/'+valor;
                 
                    $.ajax({
                          url: urltemp,
                          async:false, 
                          type: "get",
                          success: function(data){  
                                
                                $('#fondomodal').hide();	

                                $('#msgbox').html('It was done successfully'); 

                                $('#boxmskyc').show();    

                                $('#boxmskyc').delay(7000).slideUp(300);	

                            },
                          error: function(XMLHttpRequest, textStatus, errorThrown) { 
                                $('#fondomodal').hide(); console.log("Status: " + textStatus);$('#fondomodal').hide();	 console.log("Error: " + errorThrown); 
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

     // var pathname = window.location.host; 
      
      var reason = valoresitemp+'_;_'+valoresitensec;

      //var urltemp = 'https://'+pathname+'/guardarreason/'+iduser+'/'+reason+'/REC';
      var urltemp = urldir+'/guardarreason/'+iduser+'/'+reason+'/REC';
      
      $('#fondomodal').show();	

     if (valoresitemp != '' && valoresitensec != '')
        {
             
            $('#modaldecline').modal('hide');  
    
            $.ajax({
                  url: urltemp,
                  async:false, 
                  type: "get",
                success: function(data){   
                  $('#fondomodal').hide();	           
                  $('#msgbox').html('It was done successfully'); 

                                $('#boxmskyc').show();    

                                $('#boxmskyc').delay(7000).slideUp(300);			
    
                  },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                      $('#fondomodal').hide();	console.log("Status: " + textStatus);$('#fondomodal').hide();	 console.log("Error: " + errorThrown); 
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
    var urltemp = urldir+'/buscardatospagina/'+pagina+'/'+num_total_registros+'/'+buscar+'/'+estatusreg+'/'+fecha+'/'+country+'/'+fecha2;  
        
    $.ajax({
        url: urltemp,
        type: "get",
        async: false,
        success: function(data){    
          $("#relleno").html(data);
           $('#fondomodal').hide();	
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) { 
          $('#fondomodal').hide(); console.log("Status: " + textStatus); $('#fondomodal').hide(); console.log("Error: " + errorThrown); 
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
        
           var urltemp = urldir+'/descargaruserreg/'+buscar+'/'+estatusreg+'/'+fecha+'/'+country+'/'+fecha2;  
          
            window.open(urltemp, '_blank');


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
        var urltemp = urldir+'/sendmailreg/'+buscar+'/'+estatusreg+'/'+fecha+'/'+country+'/'+fecha2;  
           
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
                  $('#fondomodal').hide(); console.log("Status: " + textStatus);$('#fondomodal').hide();  console.log("Error: " + errorThrown); 
                  }         
            });   



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
     if(e.which == 13) {
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
</script>
@stop

