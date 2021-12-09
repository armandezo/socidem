<script>
$(document).ready(function() {
 
    $.ajax({
        type: "POST",
        url: "controller/dashboard/consulPerfil.controlador.php",
        dataType: "json",
        success: function(data) {
            
          //  document.getElementById("preview").src = "views/assets/images/medicos/"+data['foto'];
            
           $('#nombre').val(data['nombre_completo']);
           $('#correo').val(data['correo']);
           
           $('#num_colegiatura').val(data['num_colegiatura']);
           $('#type_colegiatura_perfil').val(data['type_colegiatura_perfil']);
           $('#especialidad').val(data['especialidad']);
           $('#telefono').val(data['telefono']);
           $('#ubicacion').val(data['ubicacion']);
           $('#sobre_mi').val(data['sobre_mi']);
           $('#nombre_clinica').val(data['nombre_clinica']);
           $('#direccion_clinica').val(data['direccion_clinica']);
           $('#precio_consulta').val(data['precio_consulta']);
           $('#precio_online').val(data['precio_online']);
           $('#services').tagsinput('add', data['servicios']);
           $('#otros_nro_colegiatura').tagsinput('add', data['otros_nro_colegiatura']);
           $('#otras_especialidades').tagsinput('add', data['otras_especialidades']); 
           $('#idiomas').tagsinput('add', data['idiomas']); 
           $('#titulo').val(data['titulo']);
           $('#universidad').val(data['universidad']);
           $('#anio_exp').val(data['años']);
           $('#membresia').val(data['membresia']); 

           if(data['check_tel'] == 1){
            document.getElementById("check_tel").checked = true;
            
            }  else {
                document.getElementById("check_tel").checked = false;
            }

            
            if(data['check_correo'] == 1){
            document.getElementById("check_correo").checked = true; 
            }  else {
                document.getElementById("check_correo").checked = false;
            }
          

            function readURL(input) {
            if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
            $('#preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
            }

            $("#foto").change(function() {
            readURL(this);
            });

            $("#otras_especialidades_select").change(function() {

               var especialidades =  $("#otras_especialidades_select").val();

                 
                $("#otras_especialidades").tagsinput('add', especialidades);
             
            });

        }
    });

});  
$(document).ready(function() {
    $('.update-Form').submit(function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        var type = $(this).attr('method');
        var url = $(this).attr('action');
        var formType = $(this).attr('data-form');
       
        
        $.ajax({
            type: type,
            url: url,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                    $(".res-update").html('<div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: 100%">Iniciando sesion</div></div>');
                },
                error: function() {
                    $(".res-update").html("Ha ocurrido un error en el sistema");
                },
                success: function(data) {
                    
                    $(".res-update").html(data);
                }
        }); 
             
    });              
              
                    
           
    });



    function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#blah').attr('src', e.target.result)
    };
    reader.readAsDataURL(input.files[0]);
    setTimeout(initCropper, 1000);
  }
}


function initCropper(){
  console.log("Came here")
  var image = document.getElementById('blah');
  var cropper = new Cropper(image, {
    aspectRatio: 16 / 9,
    crop: function(e) {
      console.log(e.detail.x);
      console.log(e.detail.y);
    }
  });

  // On crop button clicked
  document.getElementById('crop_button').addEventListener('click', function(){
    var imgurl =  cropper.getCroppedCanvas().toDataURL();
    var img = document.createElement("img");
    img.src = imgurl;
    document.getElementById("cropped_result").appendChild(img);

    /* ---------------- SEND IMAGE TO THE SERVER-------------------------

                cropper.getCroppedCanvas().toBlob(function (blob) {
                      var formData = new FormData();
                      formData.append('croppedImage', blob);
                      // Use `jQuery.ajax` method
                      $.ajax('/path/to/upload', {
                        method: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function () {
                          console.log('Upload success');
                        },
                        error: function () {
                          console.log('Upload error');
                        }
                      });
                });
            ----------------------------------------------------*/
  })
}








</script>