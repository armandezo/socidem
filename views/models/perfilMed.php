<?php include 'views/admin/breadcrumb_med.php';
?>

 <!-- CSS -->
    <link rel="stylesheet" href="views/assets/plugins/imagepicker/demo.css"> 
    <link rel="stylesheet" href="views/assets/plugins/imagepicker/imgpicker.css">
 
    <script src="views/assets/plugins/imagepicker/jquery.Jcrop.min.js"></script>
    <script src="views/assets/plugins/imagepicker/jquery.imgpicker.js"></script>
<style>
    label.cabinet {
        /* display: block; */
        cursor: pointer;
        width: 40%;
    }

    label.cabinet input.file {
        position: relative;
        height: 100%;
        width: auto;
        opacity: 0;
        -moz-opacity: 0;
        filter: progid:DXImageTransform.Microsoft.Alpha(opacity=0);
        margin-top: -30px;
    }

    #upload-demo {
        width: 100%;
        height: 300px;
        padding-bottom: 25px;
    }
</style>


<div class="content">
    <div class="container-fluid">

        <div class="row">
            <?php require_once 'views/admin/sidebar.php';?>
            <div class="col-md-7 col-lg-8 col-xl-9">
                <?php include 'views/admin/promo.php';?>
                <form class="theme-form update-Form" action="controller/dashboard/upPerfil.controlador.php" method="post" role="form"
                    data-form="updatePerfil" enctype="multipart/form-data">

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Información Basica </h4>
                            <div class="row form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="change-avatar">

                                            <div class="clearfix content">
                                                <?php 
                                                 if($foto_ == ""){
                                                    $foto_ = "//gravatar.com/avatar/0?d=mm&s=200";
                                                    $url_img_med = "";
                                                }else {
                                                    $url_img_med = "views/assets/images/medicos/";
                                                } 
                                                 
                                                ?>
                                                <img src="<?=$url_img_med.$foto_?>" alt="User Image" id="avatar2" width="200"> <br>

                                                <button type="button" class="btn-sm btn-primary submit-btn" data-ip-modal="#avatarModal" style="margin-left: 26px; margin-top: 15px;">Elige una Imagen</button>
                                            </div>
                                             

                                        </div>
                                    </div>
                                </div>
                                <div class=" col-md-6">
                                    <div class="form-group">
                                        <label>Nombre Completo </label>
                                        <input type="text" name="nombre" id="nombre" class="form-control " style="text-transform: capitalize;"
                                            disabled readonly>
                                    </div>
                                </div>


                                <div class=" col-md-6">
                                    <div class="form-group">
                                        <label>Especialidad Principal </label>
                                        <input type="text" name="especialidad" id="especialidad" class="form-control "
                                            style="text-transform: capitalize;" readonly>

                                    </div>
                                    <div class="form-group">
                                        <label>Otras Especialidades</label>

                                        <input type="text" data-role="tagsinput" name="otras_especialidades" id="otras_especialidades">

                                        <select multipledata-role="tagsinput" class="input-tags form-control" id="otras_especialidades_select">

                                            <?php
while ($datos_especia = mysqli_fetch_assoc($espeCons)) {

    $nombre_especia = $datos_especia['nombre'];

    echo ' <option value="' . $nombre_especia . '">' . $nombre_especia . '</option>';

}
?>

                                        </select>


                                    </div>
                                </div>

                                <div class=" col-md-6">
                                    <div class="form-group">
                                        <label>Numero de Colegiatura </label>
                                        <div style="display: inline-flex;">
                                            <input type="text" class="form-control " id="type_colegiatura_perfil" name="type_colegiatura_perfil"
                                                style="text-transform: capitalize; width: 65%; margin-right: 18px;" readonly autocomplete="off">
                                            <input type="text" name="num_colegiatura" id="num_colegiatura" class="form-control "
                                                style="text-transform: capitalize; width: 30%" readonly>

                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label>Otros Numeros de Colegiatura </label>
                                        <input type="text" data-role="tagsinput" class="input-tags form-control" placeholder="Agregar mas"
                                            name="otros_nro_colegiatura" id="otros_nro_colegiatura">
                                    </div>
                                </div>


                            </div>
                            <h4 class="card-title">Publicar </h4>
                            <div class="row form-row">

                                <div class=" col-md-6">
                                    <div class="form-group">
                                        <label>Telefono</label>
                                        <input type="text" name="telefono" id="telefono" class="form-control " style="text-transform: capitalize;"
                                            readonly>
                                        <input type="checkbox" name="check_tel" id="check_tel">
                                        <label for="check_tel">Publicar</label>
                                    </div>
                                </div>

                                <div class=" col-md-6">
                                    <div class="form-group">
                                        <label>Correo</label>
                                        <input type="text" name="correo" id="correo" class="form-control " readonly>
                                        <input type="checkbox" name="check_correo" id="check_correo">
                                        <label for="check_correo">Publicar</label>
                                    </div>
                                </div>
                            </div>
                            <h4 class="card-title">Precio de tus consultas</h4>
                            <div class="row form-row">
                                <div class="col-md-6">


                                    <div class="row custom_price_cont" id="custom_price_cont">
                                        <div class="col-md-10">
                                            <label>Consulta Online <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="precio_online" name="precio_online" placeholder="20.00"
                                                autocomplete="off">
                                            <small class="form-text text-muted">Precio Expresado en Soles ( 000.00 )</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">


                                    <div class="row custom_price_cont" id="custom_price_cont">
                                        <div class="col-md-10">
                                            <label>Consulta Presencial <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="precio_consulta" name="precio_consulta" placeholder="20.00"
                                                autocomplete="off">
                                            <small class="form-text text-muted">Precio Expresado en Soles ( 000.00 )</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <br>

                            <?php

if ($_SESSION["reg_token_bank"] != "registrado") {
    echo '
                                    <div class="row form-row">
                                    <div class="col-md-6">
                                        <div class="ajust_div "  >

                                        <br>
                                        <h4 class="card-title" style="    width: 168%;">Si desea que nos encarguemos de la cobranza a sus pacientes Ingrese su CCI </h4>
                                        <br>
                                        <div class="centrar">

                                            <input class="form-control input_ref" type="text" id="cci_perfil" placeholder="Codigo CCI min 20 Digitos">
                                            <br>
                                            <button class="btn btn-info btn_ref " type="button" onclick="enviarCCI()"> Aceptar</button>
                                        <br>
                                            <small>Código de Cuenta Interbancario</small>
                                            <br><br>
                                            <h5>Nota: esta acción es obligatoria si desea registrar una membresia </h5>
                                        </div>
                                        <br>
                                    </div>

                                    </div>
                                </div>
                                    ';
}

?>
                            <br>
                            <br>

                            <h4 class="card-title">Fotos </h4>
                            <div class="membership-info">
                                <div class="row form-row membership-cont">
                                    <div class="col-12 col-md-10 col-lg-5">
                                        <button type="button" class="btn med_row" onclick="addPic2('fotos')"><i class="fa fa-plus"></i> Agregar Fotos
                                        </button>
                                        <br>
                                        <div id="preview_fotos" style="display: inline-flex;"></div>
                                    </div>

                                    <span class=""> <br>Una imagen vale mas que mil palabras. Añada fotos para mostrar las ventajas de su consultorio,
                                        modernos
                                        equipos o comodidad de su sala de espera.</span>
                                </div>
                            </div>
                            <br>
                            <br>


                            <h4 class="card-title">Certificados </h4>
                            <div class="membership-info">
                                <div class="row form-row membership-cont">
                                    <div class="col-12 col-md-10 col-lg-5">
                                        <button type="button" class="btn med_row" onclick="addPic2('cert')"><i class="fa fa-plus"></i> Agregar Fotos
                                        </button>
                                        <br>
                                        <div id="preview_cert" style="display: inline-flex;"></div>
                                    </div>
                                    <span class=""> <br>La experiencia del especialista es uno de los factores mas importantes para 7 de cada 10
                                        pacientes. Al subir sus
                                        certificado que confirmen sus conocimientos y habilidades confirmara la confianza de sus pacientes.</span>
                                </div>
                            </div>

                            <br>
                            <br>

                            <h4 class="card-title">Formación </h4>
                            <div class="membership-info">
                                <div class="row form-row membership-cont">
                                    <div class="col-12 col-md-10 col-lg-5">
                                        <button type="button" class="btn med_row" onclick="addPic2('form')"><i class="fa fa-plus"></i> Agregar Fotos
                                        </button>
                                        <br>
                                        <div id="preview_form" style="display: inline-flex;"></div>
                                    </div>
                                    <span class=""> <br>Para muchos pacientes la formación del medico es tan importante como la experiencia
                                        profesional. Asegúrese de
                                        subir información de los estudios universitarios realizados.</span>
                                    </span>
                                </div>
                            </div>

                            <br>
                            <br>



                            <h4 class="card-title">Sobre Mi </h4>
                            <div class="mb-0 form-group">
                                <label>Biografia <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="sobre_mi" id="sobre_mi" rows="5"></textarea>
                            </div>

                            <br>
                            <br>



                            <h4 class="card-title">Educación <span class="text-danger">*</span></h4>
                            <div class="education-info">
                                <div class="row form-row education-cont">
                                    <div class="col-12 col-md-10 col-lg-11">
                                        <div class="row form-row">
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label>Titulo</label>
                                                    <input type="text" name="titulo" id="titulo" class="form-control" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label>Universidad / Colegio</label>
                                                    <input type="text" name="universidad" id="universidad" class="form-control" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label>Años de Estudios</label>
                                                    <input type="text" name="anio_exp" id="anio_exp" class="form-control" autocomplete="off">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <br>
                            <br>

                            <h4 class="card-title">Información del Consultorio</h4>
                            <div class="row form-row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nombre de la Clinica <span class="text-danger">*</span></label>
                                        <input type="text" name="nombre_clinica" id="nombre_clinica" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Departamento <span class="text-danger">*</span></label>
                                    <div class="">
                                        <select name="departamento" class="form-control" id="departamento" onchange="cargaProvincias();">
                                            <option default hidden>Elige una opcion</option>

                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label>Provincia <span class="text-danger">*</span></label>
                                    <div class="">

                                        <select name="provincia" class="form-control" id="provincia" onchange="cargaDistritos();">
                                            <option default hidden>Elige una opcion</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label>Distrito <span class="text-danger">*</span></label>
                                    <div class="">

                                        <select name="distrito" class="form-control" id="distrito">
                                            <option default hidden>Elige una opcion</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="pt-4 col-md-12">
                                    <div class="form-group">
                                        <label>Dirección de la Clinica <span class="text-danger">*</span></label>
                                        <input type="text" name="direccion_clinica" id="direccion_clinica" class="form-control" autocomplete="off">
                                    </div>
                                </div>
                            </div>



                            <br>
                            <br>


                            <h4 class="card-title">Servicios <span class="text-danger">*</span></h4>
                            <div class="form-group">

                                <input type="text" data-role="tagsinput" class="input-tags form-control" placeholder="Tipea tus Servicios"
                                    name="services" id="services">
                                <small class="form-text text-muted">Nota: Recomendamos un maximo de 3 servicios.</small>
                            </div>
                            <br>
                            <br>



                            <h4 class="card-title">Premios y Distinciones </h4>
                            <div class="membership-info">
                                <div class="row form-row membership-cont">
                                    <div class="col-12 col-md-10 col-lg-5">
                                        <button type="button" class="btn med_row" onclick="addPic2('premios')"><i class="fa fa-plus"></i> Agregar
                                            Fotos </button>
                                        <br>
                                        <div id="preview_premios" style="display: inline-flex;"></div>
                                    </div>
                                    <span class=""> <br>¿Ha ganado algún premio o distinción?. Sus pacientes estarán encantados de saberlo </span>
                                </div>
                            </div>

                            <br>
                            <br>


                            <br>
                            <br>




                            <h4 class="card-title">Idiomas </h4>
                            <div class="membership-info">
                                <div class="row form-row membership-cont">
                                    <div class="col-md-6 ">
                                        <div class="form-group">

                                            <input type="text" data-role="tagsinput" class="input-tags form-control" placeholder="Tipea tus Idiomas"
                                                name="idiomas" id="idiomas">

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <br>
                            <br>

                            <h4 class="card-title">Tipo de Membresía <span class="text-danger">*</span></h4>
                            <div class="membership-info">
                                <div class="row form-row membership-cont">
                                    <div class="col-12 col-md-10 col-lg-5">
                                        <div class="form-group">

                                            <input type="text" value="<?=$membresia_?>" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>











                            <div class="res-update animated fadeInDown"> </div>
                            <div class="submit-section submit-btn-bottom">
                                <button type="submit" class="btn btn-primary submit-btn">Guardar Cambios</button>
                            </div>





                </form>
            </div>
        </div>

    </div>

</div>

</div>
</div>


    <div class="ip-modal" id="avatarModal">
    <div class="ip-modal-dialog">
    <div class="ip-modal-content">
    <div class="ip-modal-header">
    <a class="ip-close" title="Close">&times;</a>
    <h4 class="ip-modal-title">Sube una Imagen</h4>
    </div>
    <div class="ip-modal-body">
    <div class="btn btn-primary ip-upload">Buscar Imagen <input type="file" name="file"
            class="ip-file"></div>
    <button type="button" class="btn btn-primary ip-webcam">Webcam</button>
    <button type="button" class="btn btn-info ip-edit">Editar</button>
    <button type="button" class="btn btn-danger ip-delete">Eliminar</button>

    <div class="alert ip-alert"></div>
    <div class="ip-info">Para cortar y ajustar la imagen debe arrastrar el cuadro y luego click en guardar imagen   </div>
    <div class="ip-preview"></div>
    <div class="ip-rotate">
        <button type="button" class="btn btn-default ip-rotate-ccw"
            title="Rotate counter-clockwise"><i class="icon-ccw"></i></button>
        <button type="button" class="btn btn-default ip-rotate-cw" title="Rotate clockwise"><i
                class="icon-cw"></i></button>
    </div>
    <div class="ip-progress">
        <div class="text">Subiendo</div>
        <div class="progress progress-striped active">
            <div class="progress-bar"></div>
        </div>
    </div>
    </div>
    <div class="ip-modal-footer">
    <div class="ip-actions">
        <button type="button" class="btn btn-primary submit-btn ip-save">Guardar Imagen</button>
        <button type="button" class="btn btn-primary submit-btn ip-capture">Capture</button>
        <button type="button" class="btn btn-danger submit-btn ip-cancel">Cancel</button>
    </div>
    <button type="button" class="btn btn-default ip-close">Close</button>
    </div>
    </div>
    </div>
    </div>



    <script>
        $(function() {
            var time = function() {
                return '?' + new Date().getTime()
            };

            // Avatar setup
            $('#avatarModal').imgPicker({
                url: 'model/upload_avatar.php',
                aspectRatio: 1,
                deleteComplete: function() {
                    $('#avatar2').attr('src', '//gravatar.com/avatar/0?d=mm&s=150');
                    this.modal('hide');
                },
                uploadSuccess: function(image) {
                    // Calculate the default selection for the cropper
                    var select = (image.width > image.height) ? [(image.width - image.height) / 2, 0, image.height, image.height] : [0, (image.height - image.width) / 2, image.width, image.width];

                    this.options.setSelect = select;
                },
                cropSuccess: function(image) {
                     
                    $('#avatar2').attr('src', image.versions.avatar.url + time());
                    this.modal('hide');
                    $.ajax({
                    type: 'POST',
                    url: 'model/save_avatar.php',
                    data: {'image_name' : image.name},
                    success: function(data) {
                  
                }
                    });
                     
                }
            });

            // Demo only
            $('.navbar-toggle').on('click', function() {
                $('.navbar-nav').toggleClass('navbar-collapse')
            });
            $(window).resize(function(e) {
                if ($(document).width() >= 430) $('.navbar-nav').removeClass('navbar-collapse')
            });
        });
    </script>