  <?php include 'model/config.php' ?>
  <div class="breadcrumb-bar">
      <div class="container-fluid">
          <div class="row align-items-center">
              <div class="col-md-12 col-12">
                  <nav aria-label="breadcrumb" class="page-breadcrumb" style="padding-top: 13px; padding-bottom: 13px;">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="inicio">Home</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Perfil Medico</li>
                      </ol>
                  </nav> 
              </div>
          </div>
      </div>
  </div>
  <!-- /Breadcrumb -->
  <?php $codigoRef = $routes[1];

    $med_cons = ejecutarSQL::consultar("SELECT `medicos`.`nombre_completo`, `perfil`.*, `perfil`.`correo`, `medicos`.`estado` FROM `medicos` , `perfil` WHERE `perfil`.`correo` = `medicos`.`correo` AND `perfil`.`codigo_referido` = '$codigoRef'");
    while ($dato_med = mysqli_fetch_assoc($med_cons)) {

        $nombre_completo_med = $dato_med['nombre_completo'];
        $foto_med = $dato_med['foto'];
        $titulo_med = $dato_med['titulo'];
        $universidad_med = $dato_med['universidad'];
        $especialidad_med = $dato_med['especialidad'];
        $num_colegiatura_med = $dato_med['num_colegiatura'];
        $nombre_clinica_med = $dato_med['nombre_clinica'];
        $direccion_clinica_med = $dato_med['direccion_clinica'];
        $servicios_med = $dato_med['servicios'];
        $separated = explode(',', $servicios_med);
        $idiomas_med = $dato_med['idiomas'];
        $idiomas = explode(',', $idiomas_med);
        $otras_especialidades_med = $dato_med['otras_especialidades'];
        $otras_especialidades = explode(',', $otras_especialidades_med);
        $precio_consulta_med = $dato_med['precio_consulta'];
        $precio_online_med = $dato_med['precio_online'];
        $telefono_med = $dato_med['telefono'];
        $correo_med = $dato_med['correo'];
        $años_med = $dato_med['años'];
        $ubicacion_med = $dato_med['ubicacion'];
        $sobre_mi_med = $dato_med['sobre_mi'];
        $codigo_referido_C = $dato_med['codigo_referido'];
        $track = md5($codigo_referido_C);
        $objFotosVarias = json_decode($dato_med['fotos_varias'], JSON_UNESCAPED_UNICODE);
        $objCertificados = json_decode($dato_med['certificados'], JSON_UNESCAPED_UNICODE);
        $objFormacion = json_decode($dato_med['formacion'], JSON_UNESCAPED_UNICODE);
        $objPremios = json_decode($dato_med['premios'], JSON_UNESCAPED_UNICODE);
        $num_contacto = $dato_med['telefono'];
        $mail_contacto = $dato_med['correo'];
        $check_tel = $dato_med['check_tel'];
        $check_correo = $dato_med['check_correo'];
    }

    ?>
    <style>
    .doc-info-right {
    padding-top: 0px;
    width: 110%;
    flex: 0 0 601px;
    margin-right: 0!important;
    left: 82px!important;
    margin-left: -2%!important;
    }

    .move_to_tomorrow {
    position: relative;
    left: 49.5rem;
    top: 6px;
    }
    tbody {
    display: block;
    max-height: -webkit-fill-available!important;
    overflow-y: scroll;
}
.pic_var {
    position: relative;
    font-size: .875rem;
    font-weight: 500;
    color: #272b41;
    text-transform: capitalize;
} 
        .circulo {
        width: 4rem;
        height: 4rem;
        border-radius: 50%;
        background: #008298;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center; 
        padding: 3%;
        }

        .circulo>h2 {
            font-family: sans-serif;
            color: white;
            font-size: 1.4rem;
            font-weight: bold;
            margin-bottom: 0;
        }
    </style>
 
  <div class="content">
      <div class="container-fluid">

          <div class="row">
              <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar dct-dashbd-lft">

                  <!-- Profile Widget -->
                  <div class="card widget-profile pat-widget-profile">
                      <div class="card-body">
                          <div class="pro-widget-content">
                              <div class="profile-info-widget">
                                  <a href="javascript:" class="booking-doc-img">
                                  <img src="views/assets/images/medicos/<?=$foto_med ?>" class="img-fluid" alt="User Image">
                                  </a>
                                  <div class="profile-det-info">
                                      <h3>Dr. <?=$nombre_completo_med ?></h3>

                                      <div class="patient-details">
                                          <h5><b>Colegiatura ID: </b> <?=$num_colegiatura_med ?></h5>
                                          <h5><b>Especialidad: </b> <?=$especialidad_med?></h5>
                                           
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="patient-info">
                              <ul>
                                  <?php 
                                if($check_tel == 1){
                                    echo '<li>Telefono <span>'.$num_contacto.'</span></li>';
                                }else {
                                    echo ' <li>Telefono <span>Privado</span></li>';
                                }

                                if($check_correo == 1){
                                    echo '<li>Correo <span>'.$mail_contacto.'</span></li>';
                                }else {
                                    echo '  <li>Correo <span>Privado</span></li>';
                                }
                                  
                                ?> 
                                  <li>Consultorio <span> <?=$nombre_clinica_med ?></span></li>
                                  <li>Dir: <span> <?=$direccion_clinica_med  ?></span></li>
                                 
                                  <li>Consulta Online: <span>S/ <?=$precio_consulta_med  ?></span></li>
                                  <li>Consulta Presencial: <span>S/ <?=$precio_online_med  ?></span></li>
                              </ul>
                              <br> 
                                  <div class="clinic-details pic_var">
                                  Imagenes Variadas: 
                                    <ul class="clinic-gallery">
                                    <?php   
                                    if($objFotosVarias != null){  
                                        foreach ($objFotosVarias as $pictures_variadas) {
                                    echo '  
                                    <li>
                                    <a href="views/assets/images/perfil/'.$pictures_variadas['pictures'].'" data-fancybox="gallery">
                                        <img src="views/assets/images/perfil/'.$pictures_variadas['pictures'].'" alt="Feature">
                                    </a>
                                    </li>
                                    ';
                                    }
                                    } 
                                    ?> 
                                        
                                    </ul>
                            </div>
                          </div>
                      </div>
                  </div>
                  <div class="card">
                      <div class="card-header">
                          <h4 class="card-title">Especialidades</h4>
                      </div>
                      <ul class="list-group list-group-flush">
                      <?php 
                        foreach ($otras_especialidades as $items) { 
                        echo ' 
                        <li class="list-group-item">
                              <div class=" media align-items-center"> 
                                  <div class="media-body">
                                  <h5 class="mb-0 ml-2 d-block">- '.$items.'</h5> 
                                  </div>
                              </div>
                          </li>
                        ';
                        }
                        ?>
                         
                      </ul>
                    </div>
                    
                    <div class="card">
                      <div class="card-header">
                          <h4 class="card-title">Servicios</h4>
                      </div>
                      <ul class="list-group list-group-flush">

                        <?php 
                        foreach ($separated as $servicios) { 
                        echo ' 
                        <li class="list-group-item">
                              <div class=" media align-items-center"> 
                                  <div class="media-body">
                                  <h5 class="mb-0 ml-2 d-block">- '.$servicios.'</h5> 
                                  </div>
                              </div>
                          </li>
                        ';
                        }
                        ?>
                          
                         
                      </ul>
                    </div>
                  
                   

              </div>

              <div class="col-md-7 col-lg-8 col-xl-9 dct-appoinment">
                  <div class="card">
                      <div class="pt-0 card-body">
                          <div class="user-tabs">
                              <ul class="flex-wrap nav nav-tabs nav-tabs-bottom nav-justified">
                                  <li class="nav-item">
                                      <a class="nav-link active" href="#pat_appointments" data-toggle="tab">Agenda</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#pres" data-toggle="tab"><span>Experiencia</span></a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#medical" data-toggle="tab"><span class="med-records">Comentarios</span></a>
                                  </li>
                                  
                              </ul>
                          </div>
                          <div class="tab-content">

                              <!-- Appointment Tab -->
                              <div id="pat_appointments" class="tab-pane fade show active">
                                  <div class="mb-0 card card-table">
                                      <div class="card-body">
                                          <div class="table-responsive">
                                            <?php   
                                            echo ' 
                                            <div class="rescalendar" id="cal-'.$track.'"></div> 
                                            <script> cargaCalendar("cal-'.$track.'","'.$codigo_referido_C.'", 8, "paciente") </script> 
                                            ';

                                            ?>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <!-- /Appointment Tab -->

                              <!-- Prescription Tab -->
                              <div class="tab-pane fade" id="pres"> 
                                <div class="mb-0 card card-table">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                            <div class="col-md-12 col-lg-12">
										
                                        <!-- About Details -->
                                        <div class="widget about-widget">
                                            <h4 class="widget-title">Resumen sobre mi</h4>
                                            <p style="text-align: justify;"> <?=$sobre_mi_med ?> </p>
                                        </div>
                                        <!-- /About Details -->
                                    
                                        <!-- Education Details -->
                                        <div class="widget education-widget">
                                            <h4 class="widget-title">Educación</h4>
                                            <div class="experience-box">
                                                <ul class="experience-list">
                                                    <li>
                                                        <div class="experience-user">
                                                            <div class="before-circle"></div>
                                                        </div>
                                                        <div class="experience-content">
                                                            <div class="timeline-content">
                                                                <a href="javascript:" class="name"><?= $universidad_med  ?></a>
                                                                <div><?=$titulo_med ?></div>
                                                                <span class="time"> <?=$años_med ?> Años de Estudios</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                     
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- /Education Details -->
                                
                                        <!-- Experience Details -->
                                        <div class="widget experience-widget">
                                            <h4 class="widget-title">Certificados</h4>
                                            <div class="experience-box">
                                                <ul class="experience-list"> 
                                                    <?php   
                                                    if($objCertificados != null){  
                                                    foreach ($objCertificados as $pictures_certificado) {
                                                    echo ' 
                                                    <li>
                                                        <div class="experience-user">
                                                            <div class="before-circle"></div>
                                                        </div>
                                                        <div class="experience-content">
                                                            <div class="timeline-content">
                                                                <a href="views/assets/images/perfil/'.$pictures_certificado['pictures'].'" class="name" data-fancybox="gallery">
                                                                <img width="100px" height="100px" src="views/assets/images/perfil/'.$pictures_certificado['pictures'].'" alt="Feature">
                                                                </a>
                                                                 
                                                            </div>
                                                        </div>
                                                    </li>
                                                    ';
                                                    }
                                                    } 
                                                    ?> 
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        <div class="widget experience-widget">
                                            <h4 class="widget-title">Formación</h4>
                                            <div class="experience-box">
                                                <ul class="experience-list"> 
                                                    <?php   
                                                    if($objFormacion != null){  
                                                     foreach ($objFormacion as $pictures_formacion) {
                                                    echo ' 
                                                    <li>
                                                        <div class="experience-user">
                                                            <div class="before-circle"></div>
                                                        </div>
                                                        <div class="experience-content">
                                                            <div class="timeline-content">
                                                                <a href="views/assets/images/perfil/'.$pictures_formacion['pictures'].'" class="name" data-fancybox="gallery">
                                                                <img width="100px" height="100px" src="views/assets/images/perfil/'.$pictures_formacion['pictures'].'" alt="Feature">
                                                                </a>
                                                                 
                                                            </div>
                                                        </div>
                                                    </li>
                                                    ';
                                                    }
                                                    } 
                                                    ?> 
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        <div class="widget experience-widget">
                                            <h4 class="widget-title">Premios</h4>
                                            <div class="experience-box">
                                                <ul class="experience-list"> 
                                                    <?php   
                                                     if($objPremios != null){  
                                                        foreach ($objPremios as $pictures_premios) {
                                                    echo ' 
                                                    <li>
                                                        <div class="experience-user">
                                                            <div class="before-circle"></div>
                                                        </div>
                                                        <div class="experience-content">
                                                            <div class="timeline-content">
                                                                <a href="views/assets/images/perfil/'.$pictures_premios['pictures'].'" class="name" data-fancybox="gallery">
                                                                <img width="100px" height="100px" src="views/assets/images/perfil/'.$pictures_premios['pictures'].'" alt="Feature">
                                                                </a>
                                                                 
                                                            </div>
                                                        </div>
                                                    </li>
                                                    ';
                                                    }
                                                    } 
                                                    ?> 
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        <div class="service-list">
                                            <h4>Idiomas</h4>
                                            <ul class="clearfix"> 
                                                <?php 
                                                foreach ($idiomas as $idioma) { 
                                                echo ' 
                                                <li>
                                                    <strong style="text-transform: capitalize;">'.$idioma.' </strong> 
                                                </li>
                                                ';
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                        <!-- /Specializations List -->

                                    </div>
                                            </div>
                                        </div>
                                    </div>
                              </div>
                              <!-- /Prescription Tab -->

                              <!-- Medical Records Tab -->
                              <div class="tab-pane fade" id="medical">
                              <div class="mb-0 card card-table">
                                      <div class="card-body">
                                      <div class="widget review-listing">
                                      <div id="res-form-add-comentario"  ></div>
                            <ul class="comments-list"> 
                                  
                                <div id="list_comentarios"></div>

                            </ul>

                            

                        </div>
                        <!-- /Review Listing -->

                        <!-- Write Review -->
                        <div class="write-review" id="add-comentario">
                            <h4>Escribele un comentario al <strong>Dr. <?=$nombre_completo_med ?></strong></h4> 
                            <!-- Write Review Form -->
                            <?php 
                            if(isset($_SESSION['nombre']) && $rol_ != 1){  

                            ?>
                            <form >
                                <div class="form-group">

                                </div>

                                <div class="form-group">
                                    <label>Comentario</label> 
                                    <textarea id="textComent" name="textComent" maxlength="100" class="form-control"></textarea>
                                    <input type="hidden" id="medico" name="medico" value="<?=$codigoRef?>">
                                    <div class="mt-3 d-flex justify-content-between"><small class="text-muted"><span id="chars">100</span> characters
                                            remaining</small></div>
                                </div>
                                <hr>

                                <div class="submit-section">
                                    <button type="submit" class="btn btn-primary submit-btn">Enviar Comentario</button>
                                </div>
                            </form>
                            <!-- /Write Review Form -->
                            <?php }else {
                            ?>
                            <br>
                            <div class="">
                                <input type="hidden" id="medico" name="medico" value="<?=$codigoRef?>">
                                <span  >Debes Iniciar Session para comentar <a href="login"> <strong >Ir al login</strong>  </a></span>
                            </div>

                            <?php }?>
                        </div>
                                      </div>
                                  </div>
                              </div>
                              

                              
                              

                          </div>
                      </div>
                  </div>
              </div>
          </div>

      </div>

  </div>

  <script> 

   /*Envio del formulario con Ajax para añadir comentario*/
   $('#add-comentario form').submit(function(e) {
        e.preventDefault();  
        var metodo = "POST";
        var peticion = "controller/dashboard/coment.controlador.php";
        $.ajax({
            type: metodo,
            url: peticion,
            data: $('#add-comentario form').serialize(),
            beforeSend: function() {
                $("#res-form-add-comentario").html('<div class="spinner-grow text-primary" style="position: absolute; right: 6px; top: 5px;" role="status"> <span class="sr-only">Loading...</span></div>');
            },
            error: function() {
                $("#res-form-add-comentario").html("Ha ocurrido un error en el sistema");
            },
            success: function(data) {
                
                $("#res-form-add-comentario").html("");
                document.getElementById("textComent").value = "";
                UpdateComent();
            }
        });
        return false;
    });
    
    function UpdateComent() {
       var value = $('#list_comentarios').html();
        var data = document.getElementById("medico").value;
       
        $.ajax({
            type: "POST",
            data:{textShortname: data},
            url: "controller/dashboard/cargaComent.controlador.php",
            success: function(data) { 
                $('#list_comentarios').html(data);
                 
            }
        });
    }
    UpdateComent()
  </script>