<?php require_once 'views/models/seguridad/payment.php'; ?>
<style>
    @media only screen and (max-width: 575.98px) {
        .call-window {
            display: table;
            height: 40%;
            table-layout: fixed;
            width: 100%;
            background-color: #fff;
            border: 1px solid #f0f0f0;
        }

        .call-wrapper {
            height: calc(100vh - 115px);
        }


    }

    @media only screen and (max-width: 767.98px) {
        .call-content-wrap {
            height: 100%;
            position: relative;
            width: 100%;
            top: -5px;
        }

        .call-wrapper {
            height: calc(100vh - 150px);
        }

    }

    @media (orientation: landscape) {
        .call-wrapper {
            height: calc(100vh - 145px)
        }
    }

    .ajust_height {
        height: 77vh;
        margin-bottom: 7vh;
    }
</style>

<?php $codigoRef = $routes[1]; ?>
<div class="content">
    <section style="float: right;
             margin-right: 84px;">



    </section>
    <div class="container-fluid" style="text-align: -webkit-center; " id="meet">
        <button class="btn btn-dark" style="border: 1px solid #017789;background-color: #008298;color: #ffffff;float: left; position: absolute;margin-left: 26px;margin-top: 26px;" data-toggle="modal" data-target="#modalinfocliente">
            VER INFO
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalinfocliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #008298;color: #ffffff;">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: #ffffff;">HISTORIAL DEL PACIENTE</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: #ffffff;">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="container">
                        <div class="row">
                            <div class="col-4">
                                <label>Nombre del Paciente:</label><br>
                                <small><?php echo ucwords(@$_SESSION['temp_nombrepaciente']); ?></small>
                            </div>
                            <div class="col-4">
                                <label>Número de Celular:</label><br>
                                <small><?php echo @$_SESSION['temp_celular']; ?></small>
                            </div>
                            <div class="col-4">
                                <div class="col">
                                    <label>Tipo de Reunion:</label><br>
                                    <small>Cita <?php echo @$_SESSION['temp_tipodecita']; ?></small>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <label>Hora de Reunion:</label><br>
                                <small><?php echo @$_SESSION['temp_hora']; ?></small>
                            </div>
                            <div class="col-4">
                                <label>Fecha de Reunion:</label><br>
                                <small>                                    
                                    <?php echo date("d/m/Y", strtotime(@$_SESSION['temp_fecha'])); ?>
                                </small>
                            </div>
                            <div class="col-4">

                            </div>
                        </div>
                        <hr>
                    </div>



                    <nav class="mb-4 user-tabs">

                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" href="#historial" data-toggle="tab" style="font-size: 14px;padding: 5px;">Historia Clínica</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="#analisis_lab" data-toggle="tab" style="font-size: 14px;padding: 5px;">Análisis de Laboratorio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="#imagenes_digitales" data-toggle="tab" style="font-size: 14px;padding: 5px;">Imágenes Digitales</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="#imagenes_recetas" data-toggle="tab" style="font-size: 14px;padding: 5px;">Recetas Medicas</a>
                            </li>
                        </ul>
                    </nav>

                    <div class="tab-content " id="elemento_1">
                        <?php
                        $ConsEmailUser = ejecutarSQL::consultar("SELECT `agenda`.`cod_consulta`, `agenda`.`email_usuario` FROM `agenda` WHERE `agenda`.`cod_consulta` = '$codigoRef';");
                        while ($datos_email_pac = mysqli_fetch_assoc($ConsEmailUser)) {
                            $cod_correo_usuario = $datos_email_pac['email_usuario'];
                        }

                        $get_mail = md5($cod_correo_usuario);

                        $ConsHistorial = ejecutarSQL::consultar("SELECT `historial_medico`.*, `historial_medico`.`correo` FROM `historial_medico` WHERE `historial_medico`.`correo` = '$get_mail';");
                        while ($datos_historial_med = mysqli_fetch_assoc($ConsHistorial)) {

                            $cod_correo = $datos_historial_med['correo'];

                            $objHistoria_clinica = $datos_historial_med['historia_clinica'];
                            $objAnalisis_lab = $datos_historial_med['analisis_lab'];
                            $objImg_digitales = $datos_historial_med['img_digitales'];
                            $objRecetas = $datos_historial_med['recetas_med'];
                            ?>

                            <div class="tab-pane show active" id="historial">
                               <button type="button" class="btn med_row " onclick="addHC('<?=$get_mail?>')"><i class="fa fa-plus"></i> AGREGAR HISTORIA
                            CLINICA</button>
                                <?php
                                $historia_clinica = json_decode($objHistoria_clinica, true);
                                $count = 0;

                                foreach ($historia_clinica as $key => $entry) {
                                    $count = $count + 1;

                                    echo '
                                            <button type="button" class="btn btn-block" style="margin-bottom: 15px; background:#008298; color:white;" data-toggle="collapse" data-target="#h' . $count . '">' . $entry['fecha'] . '</button>
                                            <div id="h' . $count . '" class="collapse" style="margin-top: 15px; margin-bottom: 15px;">
                                                 ' . $entry['texto'] . '
                                                 <br><br> 
                                            </div>
                                        ';
                                }
                                ?>
                            </div>

                            <div class="tab-pane" id="analisis_lab">
                                 <button type="button" class="btn med_row" onclick="addLab('<?= $get_mail ?>')"><i class="fa fa-plus"></i>
                            AGREGAR ANALISIS DE LABORATORIO</button>
                                <?php
                                $analisis_lab = json_decode($objAnalisis_lab, true);
                                $count = 0;

                                foreach ($analisis_lab as $key => $entry) {
                                    $count = $count + 1;

                                    echo '
                                        <button type="button" class="btn btn-block" style="margin-bottom: 15px; background:#008298; color:white;" data-toggle="collapse" data-target="#a' . $count . '">' . $entry['fecha'] . '</button>
                                        <div id="a' . $count . '" class="collapse" style="margin-top: 15px; margin-bottom: 15px;">
                                        ';

                                    foreach ($entry['analisis'] as $key => $entry) {

                                        echo '
                                              <img class="img_data" src="views/assets/images/historial/analisis_lab/' . $entry['pictures'] . '" alt="" >
                                             ';
                                    }
                                    echo ' 
                                         </div>
                                         ';
                                }
                                ?>
                            </div>

                            <div class="tab-pane" id="imagenes_digitales">
                                   <button type="button" onclick="addImgDig('<?= $get_mail ?>')" class="btn med_row "><i class="fa fa-plus"></i> AGREGAR IMAGENES
                            DIGITALES</button>
                                <?php
                                $img_digitales = json_decode($objImg_digitales, true);
                                $count = 0;

                                foreach ($img_digitales as $key => $entry) {
                                    $count = $count + 1;

                                    echo '
                           <button type="button" class="btn btn-block" style="margin-bottom: 15px; background:#008298; color:white;" data-toggle="collapse" data-target="#i' . $count . '">' . $entry['fecha'] . '</button>
                           <div id="i' . $count . '" class="collapse" style="margin-top: 15px; margin-bottom: 15px;">
                           ';

                                    foreach ($entry['digitales'] as $key => $entry) {

                                        echo '
                               <img class="img_data" src="views/assets/images/historial/img_digitales/' . $entry['pictures'] . '" alt="" >
                               ';
                                    }

                                    echo '
                           </div>
                           ';
                                }
                                ?>
                            </div>

                            <div class="tab-pane" id="imagenes_recetas">
                                 <button type="button" class="btn med_row " onclick="addRecetas('<?= $get_mail ?>')"><i class="fa fa-plus"></i>
                            AGREGAR RECETAS MEDICAS</button>
                                <?php
                                $recetas = json_decode($objRecetas, true);
                                $count = 0;

                                foreach ($recetas as $key => $entry) {
                                    $count = $count + 1;

                                    echo '
                           <button type="button" class="btn btn-block" style="margin-bottom: 15px; background:#008298; color:white;" data-toggle="collapse" data-target="#r' . $count . '">' . $entry['fecha'] . '</button>
                           <div id="r' . $count . '" class="collapse" style="margin-top: 15px; margin-bottom: 15px;">
                           ';

                                    foreach ($entry['recetas'] as $key => $entry) {

                                        echo '
                               <img class="img_data" src="views/assets/images/historial/recetas_med/' . $entry['pictures'] . '" alt="" >
                               ';
                                    }

                                    echo '
                           
                           </div>
                           
                           ';
                                }
                                ?>
                            </div>


                        <?php } ?>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">CERRAR VENTANA</button>
                </div>
            </div>
        </div>
    </div>

</div>


<script src="views/assets/js/scripts/dash.js"></script>
<script src="views/assets/js/scripts/conference.js"></script>
<script>
    lobby('<?= $codigoRef ?>', '<?= $rol_ ?>');
</script>