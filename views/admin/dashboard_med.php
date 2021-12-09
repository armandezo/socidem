<?php include 'views/admin/breadcrumb_med.php'; ?>

<!-- Page Content -->
<div class="content">
    <div class="container-fluid">

        <div class="row">

            <?php include 'views/admin/sidebar.php'; ?>

            <div class="col-md-7 col-lg-8 col-xl-9">

                <div class="row">
                    <div class="col-md-12">
                        <?php include 'views/admin/promo.php'; ?>
                        <?php
                        if ($membresia_ == "Gratuito") {
                            echo '<img src="views/assets/images/dashboard.png" >';
                        } else {
                            ?>

                            <div class="card dash-card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-4">
                                            <div class="dash-widget dct-border-rht">
                                                <div class="circle-bar circle-bar3">
                                                    <div class="circle-graph3" data-percent="100">
                                                        <img src="views/assets/img/icon-01.png" class="img-fluid" alt="patient">
                                                    </div>
                                                </div>
                                                <div class="dash-widget-info">
                                                    <h6>Total Pacientes</h6>
                                                    <h3><?= $totalPacientes ?></h3>
                                                    <p class="text-muted">Lista General</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-lg-4">
                                            <div class="dash-widget dct-border-rht">
                                                <div class="circle-bar circle-bar3">
                                                    <div class="circle-graph3" data-percent="100">
                                                        <img src="views/assets/img/icon-02.png" class="img-fluid" alt="Patient">
                                                    </div>
                                                </div>
                                                <div class="dash-widget-info">
                                                    <h6>Agenda del Dia</h6>
                                                    <h3><?= $totalAgendaDia_total ?></h3>
                                                    <p class="text-muted">14 Mar. 2021</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-lg-4">
                                            <div class="dash-widget">
                                                <div class="circle-bar circle-bar3">
                                                    <div class="circle-graph3" data-percent="100">
                                                        <img src="views/assets/img/icon-03.png" class="img-fluid" alt="Patient">
                                                    </div>
                                                </div>
                                                <div class="dash-widget-info">
                                                    <h6>Agenda total</h6>
                                                    <h3><?= $totalAgendaDia_total ?></h3>
                                                    <p class="text-muted">Marzo 2021</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <br><br><br>
                                    <div class="row">
                                        <div class="col-md-6 ">
                                            <div class="dash-widget">
                                                <div class="circle-bar circle-bar3">
                                                    <div class="circle-graph3" data-percent="100">
                                                        <img src="views/assets/img/doctor.png" style="width: 42px; height: auto;"  class="img-fluid" alt="Patient">
                                                    </div>
                                                </div>
                                                <div class="dash-widget-success">
                                                    <h6>Historico Cobrado</h6>
                                                    <h3>S/. <?= $monto_historico ?></h3>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="dash-widget">
                                                <div class="circle-bar circle-bar3">
                                                    <div class="circle-graph3" data-percent="100">
                                                        <img src="views/assets/img/especial.png" style="width: 49px; height: auto;" class="img-fluid" alt="Patient">
                                                    </div>
                                                </div>
                                                <div class="dash-widget-info">
                                                    <h6>Acumulado de la Semana</h6>
                                                    <h3>S/. <?= $historial_semanal ?></h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <style>
                        .doc-info-right {
                            margin-left: 0 !important;
                            -ms-flex: 0 0 200px;
                            flex: 0 0 400px;
                            max-width: 100%;
                            margin-right: 3.6% !important;
                            padding-top: 15px;
                        }

                        .move_to_tomorrow {
                            position: relative;
                            left: 50.3rem !important;
                            top: 6px; 
                        }

                        .blueClass {

                            width: 10.3%;

                        }

                        tbody {
                            display: block;
                            max-height: 398px !important;
                            overflow-y: none !important;
                        }

                        .firstColumn {
                            display: table-cell !important;
                        }

                        .rescalendar_table .firstColumn {
                            width: 80px;
                            text-align: center;
                            background: white;
                            border: none;
                        }

                        .move_to_yesterday {
                            position: relative;
                            left: -28px;
                            top: 6px;
                        }

                        .ajust_indice {
                            background: #15558d !important;
                            color: white;
                            padding-left: 5px;
                            font-weight: 600;
                        }

                        .tipo_cita_ul {
                            list-style: none;
                            display: contents;
                        }

                        .tipo_cita_ul li {
                            padding-right: 96px;
                            display: -webkit-inline-box;
                        }

                        .ajust_tipo_cita {
                            margin-left: 25px;
                            width: 85%;
                            height: 9px;
                            border-radius: 4px;
                            margin-top: 7px;
                        }
                    </style>
                    <div class="row">
                        <div class="col-md-12">

                            <!-- <h4 class="mb-4">Agenda de Pacientes</h4> -->
                            <nav class="mb-4 user-tabs">
                                <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#upcoming-appointments" data-toggle="tab">Agenda Tipo Calendario</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="#today-appointments" data-toggle="tab">Agenda Tipo Lista</a>
                                    </li>
                                </ul>
                            </nav>
                            <div class="appointment-tab">



                                <div class="tab-content">

                                    <!-- Upcoming Appointment Tab -->
                                    <div class="tab-pane show active" id="upcoming-appointments">
                                        <div class="mb-0 card card-table">
                                            <div class="card-body">
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-4" style="text-align: center;">Cita Online
                                                        <div class="progress-bar ajust_tipo_cita" style="background: #008292;" role="progressbar"
                                                             aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div class="col-md-4" style="text-align: center;">Cita Presencial
                                                        <div class="progress-bar ajust_tipo_cita" style="background: #ff7c00;" role="progressbar"
                                                             aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div class="col-md-4" style="text-align: center;">Cita Agendada
                                                        <div class="progress-bar ajust_tipo_cita" style="background: #a0a0a0;" role="progressbar"
                                                             aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <br>
                                                <?php
                                                $track = $codigo_referido_;
                                                echo '
                                            <div class="doc-info-right "wrapper">
                                            <div class="rescalendar" id="cal-' . $track . '"></div>
                                            </div>
 
                                            <script> cargaCalendar("cal-' . $track . '","' . $codigo_referido_ . '", 8, "dash_med") </script>
                                            ';
                                                ?>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- /Upcoming Appointment Tab -->

                                    <!-- Today Appointment Tab -->
                                    <div class="tab-pane" id="today-appointments">
                                        <div class="mb-0 card card-table">
                                            <div class="card-body">
                                                <div class="table-responsive">

                                                    <table id="datatable_med_general" class="table mt-0 mb-0 table-hover table-center">
                                                        <thead>
                                                            <tr>
                                                                <th style="padding: 11px;">Usuario</th>
                                                                <th >Detalles Cita</th> 
                                                                <th>Info Paciente</th>
                                                                <th style="padding-right: 6px;">Estados</th>
                                                                <th style="padding-right: 10px;">Acciones </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody style="max-height: fit-content;">

                                                            <?php
                                                            while ($datos_agenda_paciente = mysqli_fetch_assoc($consGenralAgendaMed)) {

                                                                $cod_medico = $datos_agenda_paciente['cod_medico'];
                                                                $especialidad = $datos_agenda_paciente['especialidad'];
                                                                $tipo_cita = $datos_agenda_paciente['tipo_cita'];
                                                                $precio_cita = $datos_agenda_paciente['precio_consulta'];
                                                                $estado = $datos_agenda_paciente['estado'];
                                                                $objCita_de = json_decode($datos_agenda_paciente['cita'], true);
                                                                $email_usuario = $datos_agenda_paciente['email_usuario'];
                                                                $foto_medico = $datos_agenda_paciente['foto'];
                                                                $cod_consulta = $datos_agenda_paciente['cod_consulta'];
                                                                $fecha_start = $datos_agenda_paciente['fecha_start'];
                                                                $fecha_hora = $datos_agenda_paciente['fecha_hora'];
                                                                $namePac = ejecutarSQL::consultar("SELECT `pacientes`.`id`,`pacientes`.`correo`,`pacientes`.`telefono`, `pacientes`.`nombre` FROM `pacientes` WHERE `pacientes`.`correo` = '$email_usuario';");
                                                                while ($dato_paciente_dash = mysqli_fetch_assoc($namePac)) {
                                                                    $nombre_paciente = $dato_paciente_dash['nombre'];
                                                                    @$telefono_paciente = @$dato_paciente_dash['telefono'];
                                                                    @$id_paciente = @$dato_paciente_dash['id'];
                                                                }


                                                                $fecha_format = $fecha_start;
                                                                ?>

                                                                <tr>
                                                                    <td style="text-transform: capitalize">

                                                                        <h2 class="table-avatar">

                                                                            <?= $nombre_paciente ?>

                                                                        </h2>
                                                                    </td>
                                                                    <td style="text-transform: capitalize;     width: 139px;">
                                                                        <?= $tipo_cita ?>
                                                                        <span class="d-block"><?= $fecha_format ?>  </span>  
                                                                        <span class="d-block text-info"><?= $fecha_hora ?> </span> 
                                                                    </td>

                                                                    <td style="width: 155px;" align="center">  
                                                                        <a href="javascript:" onclick="modalDetalle('<?= $cod_consulta ?>')"
                                                                           class="btn btn-sm bg-success-light">
                                                                            <i class="fas fa-id-card-alt"></i> Ver Info
                                                                        </a>
                                                                    </td>

                                                                    <td  align="center" >
                                                                        <div class="d-block">
                                                                            <?php
                                                                            switch ($objCita_de['status']) {
                                                                                case "pending":
                                                                                    echo "<span class='badge badge-pill bg-warning-light'>NO PAGADO ";
                                                                                    break;

                                                                                case "approved":
                                                                                    echo "<span class='badge badge-pill bg-success-light'>PAGADO";

                                                                                    break;
                                                                                case "404":
                                                                                    echo "<span class='badge badge-pill bg-danger-light'>RECHAZADO";
                                                                                    break;
                                                                            }
                                                                            ?>

                                                                            </span>
                                                                        </div>
                                                                        <div class="d-block">
                                                                            <?php
                                                                            if ($estado == 2) {
                                                                                echo "<span class='badge badge-pill bg-success-light'>ATENDIDO</span>";
                                                                            } else {
                                                                                echo "<span class='badge badge-pill bg-danger-light'>NO ATENDIDO</span>";
                                                                            }
                                                                            ?>

                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center" style="white-space: nowrap;">
                                                                        <div class="table-action">
                                                                            <div class='d-block' style="padding-bottom: 6px;">
                                                                                <?php
                                                                                switch ($tipo_cita) {
                                                                                    case 'Online':
                                                                                        if ($estado == 2) {
                                                                                            echo "
                                                                   
                                                                    <a href='javascript:' class='btn btn-sm bg-danger-light'>
                                                                    <i class='fa fa-eye-slash' aria-hidden='true'></i> Sala Cerrada  </a>
                                                                   
                                                                    ";
                                                                                        } else {

                                                                                            $nuevafecha_init = strtotime('- 5 minutes', strtotime($fecha_hora));
                                                                                            $hora_actual_f = date("H:i", $nuevafecha_init);
                                                                                            $hora_actual = date("H:i");
                                                                                            $nuevafecha_end = strtotime($hora_actual);
                   
                                                                                            if ($nuevafecha_end >= $nuevafecha_init) {
                                                                                                echo " <a href='javascript:'  onclick='guardarInformaciondelPaciente(" . intval(@$id_paciente) . ",\"" . @$nombre_paciente . "\",\"" . @$telefono_paciente . "\",\"" . $tipo_cita . "\",\"" . $fecha_hora . "\",\"" . $fecha_start . "\",\"lobby-" .$cod_consulta . "\");' class='btn btn-sm bg-info-light'>
                                                                    <i class='far fa-eye'></i> Sala Abierta  </a>
                                                                    ";
                                                                                            } else {
                                                                                                echo " <a href='javascript:' onclick='' class='btn btn-sm bg-warning-light'>
                                                                    <i class='far fa-eye-slash'></i> Sala en Espera </a>
                                                                    ";
                                                                                            }
                                                                                        }

                                                                                        if ($estado != 2) {
                                                                                            echo "<br><a href='javascript:' onclick='modalReAsignarCita(&quot;" . $cod_consulta . "&quot;)' class='btn btn-sm bg-warning-light'>
                                                                        <i class='fa fa-calendar-plus'></i> Re Asignar </a>";
                                                                                        }

                                                                                        break;

                                                                                    case 'Presencial':
                                                                                        // echo "
                                                                                        // <a href='factura-".$cod_consulta."' target='_blank' class='btn btn-sm bg-info-light'>
                                                                                        // <i class='fas fa-print'></i> Imprimir </a>";
                                                                                        break;
                                                                                }
                                                                                ?>
                                                                            </div>
                                                                            <div class="d-block">
                                                                                <a href='javascript:' onclick="atenderPaciente('<?= $cod_consulta ?>')" class='btn btn-sm bg-primary-light'>
                                                                                    <i class='fas fa-handshake' aria-hidden='true'></i> Atendido </a>  
                                                                            </div>

                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            ?>
                                                        <br>

                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Today Appointment Tab -->

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            <?php } ?>
        </div>
    </div>
</div>  </div>

</div>


<div class="modal fade" id="reasignar_horario" aria-hidden="true" role="dialog">
    <div class="modal-dialog  modal-xl" role="document">
        <div class="modal-content">

            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="container">
                    <input type="hidden" id="id_cita_val" >
                    <div class="row">


                        <?php
                        $track = $codigo_referido_;
                        echo ' 
                        <div class="rescalendar" id="rea-' . $track . '"></div> 
                        <script> cargaCalendar("rea-' . $track . '","' . $codigo_referido_ . '", 8, "paciente") </script> 
                        ';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    function guardarInformaciondelPaciente(idpaciente, NombrePaciente, Celular, TipodeCita, Hora, Fecha, lobby) {
        var url_filtrada = 'controller/dashboard/guardarInformaciondelPaciente.controlador.php';
        $.post(url_filtrada,
                {
                    idpaciente: idpaciente,
                    nombrepaciente: NombrePaciente,
                    celular: Celular,
                    tipodecita: TipodeCita,
                    hora: Hora,
                    fecha: Fecha
                },
                function (result) {
                    console.log("ID: " + idpaciente + " | Nombre: " + NombrePaciente + " | Celular: " + Celular + " | Tipo de cita: " + TipodeCita+ " | Hora: " + Hora+ " | Fecha: " + Fecha + " | URL: " + lobby);
                    window.location.href = lobby;

                });
    }
</script>