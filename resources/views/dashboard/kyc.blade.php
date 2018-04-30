@include('templates.dash_app')
  @section('main')
  <?php
    $confirmed = $reguser[0]->confirmed; 
    $hoy = date('Y-m-d');
    $birthdate = $reguser[0]->birthdate;   
    if ($birthdate == '0000-00-00')
    {
        $birthdate = $hoy;
    }     
  ?>
  @if ($message = Session::get('mensaje'))
                <div class="alert alert-success" style="width: 49% !important;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                     
                    {!! $message !!}
                    
                    {!! Session::forget('mensaje') !!}
                </div>
            @endif  
            
            @if ($message = Session::get('mensajeerror'))
            <div class="alert alert-danger" style="width: 49% !important;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        
                {!! $message !!}
        
                {!! Session::forget('mensajeerror') !!}
            </div>
        @endif
    
            <div id="boxmsgmal" class="alert alert-danger" style="display:none">
                <div class="bg-red alert-icon">
                    <i class="glyph-icon icon-check"></i>
                </div>
                <div class="alert-content"> 
                    <h4 id="titulomsgnegative" class="alert-title"></h4>
                    <p id="msgboxnegative"></p>
                </div>
            </div>
    
          <div class="col-md-12 order-md-1">

          <?php

          if ($reguser[0]->confirmed == 'NO' and $reguser[0]->emailconfirmed == 'YES' and $reguser[0]->confirmedChecks == 'YES')
              {?>

                <h4 class="mb-3"><font style="color:#FF0000">-Ups! Something in your information is not correct, please complete the KYC again to continue enjoying Belotto<br>
                - Remenber that if the KYC is not verified the purchases are NOT valid, and tokens will NOT be delivered 
                </h4><?php
              }
          else
              {?>
                <h4 class="mb-3">Personal Information</h4><?php
              }    ?>

          
          <!--form id="formkyc" class="needs-validation" action="{{ url('kycprofile') }}" method="post" enctype="multipart/form-data"-->
          {!! Form::open(['method' => 'PATH','route' => ['kyc.store'], 'file' => true,'enctype' => 'multipart/form-data','id' =>'formkyc']) !!}
        
            <input type="hidden" id="idusuario"  value="{{ $reguser[0]->id }}" name="idusuario">
            <div class="row">
                            
              <div class="col-md-6 mb-3">
                 
                <label for="name">Name</label>
                <div class="detail" id="errorname" style="position:relative;top:1%!important;display:none!important;">
                    <font style="color:red" id="errname"></font>
                </div>
                <input type="text" class="form-control" id="name" placeholder="Name" value="{{ $reguser[0]->name }}" name="name" required>
                <div class="invalid-feedback">
                  Valid first name is required.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="email">Email</label>
                <div class="detail" id="errormail" style="position:relative;top:1%!important;display:none!important;">
            <font style="color:red" id="errmail"></font>
        </div>
                <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="{{ $reguser[0]->email }}" required>
                <div class="invalid-feedback">
                  Valid last name is required.
                </div>
              </div>
            </div>                  

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="country">Country</label>
                <div class="detail" id="errorcountry" style="position:relative;top:1%!important;display:none!important;">
                    <font style="color:red" id="errcountry"></font>
                </div>
                <select class="custom-select d-block w-100" id="country" name="country" required>
                  <option value="0">Choose...</option><?php
                  foreach($paises as $pais)
                    {?>
                        <option value="<?php echo $pais->id_country;?>"><?php echo $pais->name;?></option><?php
                    }   
                  ?>
                 
                </select>
                <div class="invalid-feedback">
                  Please select a valid country.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="identificationType">ID Type</label>
                <div class="detail" id="errortype" style="position:relative;top:1%!important;display:none!important;">
                    <font style="color:red" id="errtype"></font>
                </div>
                <select class="custom-select d-block w-100" id="identificationType" name="identificationType" required>
                  <option value="">Choose...</option>
                  <option value="ID">ID</option>
                  <option value="Driverlicense">Driver's license</option>
                  <option value="Passport">Passport</option>
                  <option value="CertificateofCitizenship">Certificate of Citizenship</option>
                  <option value="ArmyIdentificationCard">Army Identification Card</option>
                  <option value="DHS">DHS</option>
                   <option value="foreignpassportvisa">Foreign Passport Visa</option>
                  
                  
                </select>
                <div class="invalid-feedback">
                  Please select a valid country.
                </div>
              </div>
            </div>  

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="identification">ID Number</label>
                <div class="detail" id="errorid" style="position:relative;top:1%!important;display:none!important;">
                    <font style="color:red" id="errid"></font>
                </div>
                <input type="text" class="form-control" id="identification" name="identification" placeholder="" value="{{ $reguser[0]->identification }}" required>
                <div class="invalid-feedback">
                  Valid last name is required.
                </div>
              </div>
              
              
              
                <div class="form-group">
                    <label for="" class="col-sm-4 control-label">Birthday</label>
                    <div class="detail" id="errorbirth" style="position:relative;top:1%!important;display:none!important;">
                        <font style="color:red" id="errbirth"></font>
                    </div>
                    <div class="col-sm-8">
                        <div class="input-prepend input-group">
                            <span class="add-on input-group-addon">
                                <i class="glyph-icon icon-calendar"></i>
                            </span>
                            <input type="text" id="birthdate" name="birthdate" class="bootstrap-datepicker form-control" value="{{ $birthdate }}" data-date-format="yyyy-mm-dd">
                        </div>
                    </div>
                </div>
                      
              
            </div>  

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="country">Genere</label>
                <div class="detail" id="errorgend" style="position:relative;top:1%!important;display:none!important;">
                        <font style="color:red" id="errgen"></font>
                    </div>
                <select class="custom-select d-block w-100" id="gender" name="gender" required>
                  <option value="" disabled selected>Choose...</option>
                  <option value="M">Male</option>
                  <option value="F">Female</option>
                </select>
                <div class="invalid-feedback">
                  Please select a valid country.
                </div>
              </div>              
            </div>  
            
            <hr class="mb-4">
            <!-- avatar-->      
            <div class="input-group mb-3">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="identificationImage" name="identificationImage"> 
                <label class="custom-file-label" for="inputGroupFile02">Upload a Photo of your ID</label>
                <div class="detail" id="errorfoto1" style="position:relative;top:1%!important;display:none!important;">
                        <font style="color:red" id="errfoto1"></font>
                    </div>
              </div>
              <!--div class="input-group-append">
                <span class="input-group-text" id="">Upload</span>
              </div-->
            </div>
            
            
            <div class="fileinput fileinput-new" data-provides="fileinput">
                    
                <a href="javascript:;"  class="fileinput-exists glyphicon glyphicon-remove icoremover" id="resetear" data-dismiss="fileinput" style="position:relative;float:right"></a>
                <div>
                                    
                </div>
            </div>
            
            <div class="row">
              <div class="col-md-8 mb-3">
                <label for="firstName">&nbsp;</label>
                <div class="alert alert-secondary" role="alert">
                  The imagen should be right and clear, and all corners of your document must be visible. Document must be a PDF, PNG or JPEG and the maximum file size must not exceed 2MB.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="firstName">&nbsp;</label> 
                <div class="card" align="center">
                     @if ($reguser[0]->identificationImage != '') 
                        <img class="card-img-top" id="vistaprevia" src="{{ url($reguser[0]->identificationImage) }}/mostrar" style="display: block;margin-left: auto;margin-right: auto;  border:none;" alt="">  
                    @else   
                        <img class="card-img-top" id="vistaprevia" src="{{ asset('default-avatar.png') }}" style="display: block;margin-left: auto;margin-right: auto;  border:none;" alt="Card image cap">  
                    @endif
                             
                </div>
              </div>
            </div>          

            <div class="input-group mb-3">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="selfie" name="selfie"> 
                <label class="custom-file-label" for="inputGroupFile02">Upload a recent photo of yourself</label>
                <div class="detail" id="errorfoto2" style="position:relative;top:1%!important;display:none!important;">
                        <font style="color:red" id="errfoto2"></font>
                    </div>
              </div>
              <!--div class="input-group-append">
                <span class="input-group-text" id="">Upload</span>
              </div-->
            </div>

            <div class="row">
              <div class="col-md-8 mb-3">
                <label for="firstName">&nbsp;</label>
                <div class="alert alert-secondary" role="alert">
                  The imagen should be right and clear, and all corners of your document must be visible. Document must be a PDF, PNG or JPEG and the maximum file size must not exceed 2MB.
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="firstName">&nbsp;</label>
                <div class="card" align="center">
                    @if ($reguser[0]->selfie != '') 

                        <img class="card-img-top imgcenter" height="110" id="vistapreviaselfie" src="{{ url($reguser[0]->identificationImage) }}/mostrar"  alt="Card image cap">       
                    @else
                        <img class="card-img-top imgcenter" height="110" id="vistapreviaselfie" src="{{ asset('default-avatar.png') }}"  alt="Card image cap">         
                    @endif  
                </div>
              </div>
            </div>                    
            
            <button id="btncontinua" class="w btn-lg btn-block mb-4 btnbelotto submitkyc" type="buttom" disabled style="opacity:0.8">Continue</button>
         {!! Form::close() !!}
        </div>
      </div>
          </div>
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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"><\/script>')</script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    
    <script src="{{ asset('js/datepicker/datepicker.js') }}" type="text/javascript" charset="utf-8" async defer></script>  
    
    <script>
      feather.replace()
    </script>
    
  </body>
</html>

<script>

/* Datepicker bootstrap */

    $(function() { "use strict";
        $('#birthdate').bsdatepicker({
            format: 'yyyy-mm-dd'
        });
    });


if (window.FileReader) {
            function seleccionArchivo(evt) {
                var files = evt.target.files;
                var f = files[0];
                var leerArchivo = new FileReader();
                document.getElementById('resetear').style.display= 'block';
                leerArchivo.onload = (function(elArchivo) {
                    return function(e) {
                        
                        $("#vistaprevia").attr('src',e.target.result);
                        
                        if ($('#name').val() != '' && $('#country').val() > 0 && $('#identificationType').val() != '' && $('#identification').val() != '' &&  $('#birthdate').val() != '' && $('#gender').val() != ''  && $('#email').val()!= '' &&  $('#selfie').val() != '')
                            {
                                                    
                                $('#btncontinua').attr('style','opacity:1;cursor:pointer');
                                        
                                $('#btncontinua').attr('disabled',false);
                            }
                        
                    };
                })(f);
             
                leerArchivo.readAsDataURL(f);
            }
            
            function seleccionArchivoselfie(evt) {
                var files = evt.target.files;
                var f = files[0];
                var leerArchivo = new FileReader();
                document.getElementById('resetear').style.display= 'block';
                leerArchivo.onload = (function(elArchivo) {
                    return function(e) {
                        
                        $("#vistapreviaselfie").attr('src',e.target.result);
                        
                                            
                        if ($('#name').val() != '' && $('#country').val() > 0 && $('#identificationType').val() != '' && $('#identification').val() != '' &&  $('#birthdate').val() != '' && $('#gender').val() != ''  && $('#identificationImage').val()!= '' &&  $('#email').val() != '')
                            {
                                                    
                                $('#btncontinua').attr('style','opacity:1;cursor:pointer');
                                        
                                $('#btncontinua').attr('disabled',false);
                            }
                        
                    };
                })(f);
             
                leerArchivo.readAsDataURL(f);
            }
        }
    else
        {
            $("#vistaprevia").html(''); 
            
            $("#vistapreviaselfie").html(''); 
        }

        document.getElementById('identificationImage').addEventListener('change', seleccionArchivo, false);  
        
        document.getElementById('selfie').addEventListener('change', seleccionArchivoselfie, false);
        
    //se recorre el select para seleccionar el q le corresponda el valor previamente guardado
    //the country
    var id_pais = '{{ $reguser[0]->country }}'; 
    $("#country option").each(function(){
        if ($(this).val() == id_pais )
            {        
                $(this).prop('selected', true);
            }
     });    
     
     //the type id
    var tpy = '{{ $reguser[0]->identificationType }}'; 
    $("#identificationType option").each(function(){
        if ($(this).val() == tpy )
            {        
                $(this).prop('selected', true);
            }
     });    
     
     //the gender
     
    var gend = '{{ $reguser[0]->gender }}'; 
    $("#gender option").each(function(){
        if ($(this).val() == gend )
            {        
                $(this).prop('selected', true);
            }
     });         
     
     //las imagenes
     
     
     
</script>
