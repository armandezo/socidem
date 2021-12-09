<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
date_default_timezone_set('America/Lima');

$id = $_POST['id'];
$cod_agenda = $_POST['cod_agenda'];

$verAgenda = ejecutarSQL::consultar("SELECT `agenda`.*, `agenda`.`cod_consulta` FROM `agenda` WHERE `agenda`.`cod_consulta` = '$cod_agenda'; ");

$numCons = mysqli_num_rows($verAgenda);

while ($datos_agenda_paciente = mysqli_fetch_assoc($verAgenda)) {

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

    setlocale(LC_TIME, 'es_ES.UTF-8');
    setlocale(LC_TIME, 'spanish');

    $dia = date("d", strtotime($fecha_start));
    $anio = strftime("%Y", strtotime($fecha_start));
    $init_hora_min = date('h:i A', strtotime($fecha_start));

    $mes_texto = strftime("%B", strtotime($fecha_start));

    $fecha_format = $fecha_start;
    $hora_format = $init_hora_min . " - " . $end_hora_min;
}

if ($numCons >= 1) {

    echo '
    <div class="table-responsive">
        <table class="table mb-0 table-hover table-center">
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
            <tr>
            <td style="text-transform: capitalize"> 
            <h2 class="table-avatar"> ' . $nombre_paciente . '</h2>
            </td>
            <td style="text-transform: capitalize; ">
            ' . $tipo_cita . '
            <span class="d-block">' . $fecha_format . '  </span>  
            <span class="d-block text-info">' . $fecha_hora . ' </span> 
            </td> 
            <td> <a href="javascript:" onclick="modalDetalle(&quot;' . $cod_consulta . '&quot;)"
                    class="btn btn-sm bg-success-light">
                    <i class="fas fa-id-card-alt"></i> Ver Info
                </a></td>

                <td  align="left" >
                <div class="d-block">
                ';
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
    echo ' 
                    </span>
                </div>
                <div class="d-block"> 
                ';
    if ($estado == 2) {
        echo "<span class='badge badge-pill bg-success-light'>ATENDIDO</span>";
    } else {
        echo "<span class='badge badge-pill bg-danger-light'>NO ATENDIDO</span>";
    }

    echo '   
                </div>
                </td>
              
                <td class="text-center" style="white-space: nowrap;">
                <div class="table-action">
                <div class="d-block" style="padding-bottom: 6px;">
                ';
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
                    echo " <a href='lobby-$cod_consulta' onclick='guardarInformaciondelPaciente(" . intval(@$id_paciente) . ",\"" . @$nombre_paciente . "\",\"" . @$telefono_paciente . "\",\"" . $tipo_cita . "\",\"" . $fecha_hora . "\",\"" . $fecha_start . "\",\"lobby-" .$cod_consulta . "\");' class='btn btn-sm bg-info-light'>
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
            echo "<br><a href='javascript:' onclick='modalReAsignarCita(&quot;" . $cod_consulta . "&quot;)' class='btn btn-sm bg-warning-light'>
                        <i class='fa fa-calendar-plus'></i> Re Asignar </a>";
            break;
    }

    echo '
                     </div>
                    <div class="d-block"> 
                    <a href="javascript:" onclick="atenderPaciente(&quot;' . $cod_consulta . '&quot;)" class="btn btn-sm bg-primary-light">
                    <i class="fas fa-handshake" aria-hidden="true"></i> Atendido </a>  
                    </div> 
                </div>
            </td>
            </tr>
            </tbody>
        </table>
     </div> 
';
} else {

    echo " 
 

<div class='error-box ' style='  margin: 0 auto;
max-width: 480px;
padding: 1.875rem 0;
text-align: center;
width: 100%;  margin-right: auto;
margin-left: auto;'>
    <h1 style='color: #00d0f1;
    font-size: 10em;'>404</h1>
    <h3 class='mb-3 h2'><i class='fa fa-exclamation-triangle'></i> Cita no Agendada!</h3>
    <p class='h4 font-weight-normal'>Este Horario se encuentra Libre.</p>
    <a href='javascript:'   data-dismiss='modal' aria-label='Close'  class='btn btn-primary'>Regresar al Dashboard</a>
</div>

 
   
   
   
   ";
}
?>