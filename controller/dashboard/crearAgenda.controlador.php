<?php
session_start();
error_reporting(0);
ini_set('display_errors', 0);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';

$token = $codigo_referido_;
$horario_init = $_POST['horario_init'];
$horario_end = $_POST['horario_end'];
$horario_rango_presencial = $_POST['rango_gen_presencial'];
$horario_rango_online = $_POST['rango_gen_online'];
$dia = $_POST['dia_name'];
$check_date = $_POST['check_date'];
$tipo = $_POST['tipoCita']; 

 if($horario_init != NULL){

    $count_horarios = count($horario_init);
 
    
    for ($u = 0; $u < $count_horarios; $u++) {
    
        $hora_inicial_val[] = $horario_init[$u]; //fecha inicial
        $hora_final_val[] = $horario_end[$u]; //fecha inicial
        
    } 

    foreach ($hora_inicial_val as $key => $value) {

        $filtro_dia = count(array_keys($dia, $check_date[$key])); 

        if($filtro_dia > 1){ 

            if (
                $hora_inicial_val[$key + 1] < $hora_final_val[$key] &&
                $hora_inicial_val[$key + 1] >= $hora_inicial_val[$key] ||

                $hora_final_val[$key + 1] < $hora_final_val[$key] &&
                $hora_final_val[$key + 1] >= $hora_inicial_val[$key] 
            ) { 
                echo "El horario de " . $hora_inicial_val[$key + 1] . " a " . $hora_final_val[$key + 1] . " es intervalo de " . $hora_inicial_val[$key] . " a " . $hora_final_val[$key] . " del dia " . $dia[$key] . "<br>";
                $state = "close";
                break;
            }else { 

                if ($dia != "") {

                    foreach ($horario_init as $value_1) {
                        $value_1 == "" ? $estado_init = "vacio" : '';
                    }

                    foreach ($horario_end as $value_2) {
                        $value_2 == "" ? $estado_end = "vacio" : '';
                    }

                    foreach ($tipo as $value_3) {

                        $value_3 == "" ? $estado_tipo = "vacio" : '';
                        $value_3 == "Presencial" ? $var_horario_tipo = $horario_rango_presencial : $var_horario_tipo = $horario_rango_online;

                        $var_horario_tipo == "" ? $estado_horario_tipo = "vacio" : '';
                    }
                    $state = "open";
                } else {

                    $estado_dia = "vacio";
                }
                
            }

        } else {
            if ($dia != "") {

                foreach ($horario_init as $value_1) {
                    $value_1 == "" ? $estado_init = "vacio" : '';
                }

                foreach ($horario_end as $value_2) {
                    $value_2 == "" ? $estado_end = "vacio" : '';
                }

                foreach ($tipo as $value_3) {

                    $value_3 == "" ? $estado_tipo = "vacio" : '';
                    $value_3 == "Presencial" ? $var_horario_tipo = $horario_rango_presencial : $var_horario_tipo = $horario_rango_online;

                    $var_horario_tipo == "" ? $estado_horario_tipo = "vacio" : '';
                }
                $state = "open";
            } else {

                $estado_dia = "vacio";
            }
        }
        
    }
    
    
} else {
    echo "vacio";
}

if ($state == "open") {
    if ($check_date == "" || $estado_init == "vacio" || $estado_end == "vacio" || $estado_tipo == "vacio" || $estado_horario_tipo == "vacio") {
        echo "vacio";
    } else {
        $verAgendaMedica = ejecutarSQL::consultar("SELECT `agenda_medica`.`agenda`, `agenda_medica`.`cod_medico`, `agenda_medica`.`estado` FROM `agenda_medica` WHERE `agenda_medica`.`cod_medico` = '$token'");

        while ($datos_agenda_medica = mysqli_fetch_assoc($verAgendaMedica)) {

            $objAgenda = $datos_agenda_medica['agenda'];

            $agenda_full = json_decode($objAgenda, true);

            $conta_dia = count($dia);

            foreach ($agenda_full as $key => $entry) {

                for ($q = 0; $q < $conta_dia; $q++) {

                    if ($entry['dia'] == $dia[$q]) {

                        unset($agenda_full[$key]);
                    }
                }
            }

            $valor = json_encode($agenda_full);
            $nuevo_ID = $entry['id'];
            $count_horarios = count($horario_init);

            for ($i = 0; $i < $count_horarios; $i++) {

                $fecha1 = new DateTime($horario_init[$i]); //fecha inicial
                $fecha2 = new DateTime($horario_end[$i]); //fecha de cierre

                $intervalo = $fecha1->diff($fecha2);

                $minutes += $intervalo->h * 60;
                $minutes += $intervalo->i;

                switch ($tipo[$i]) {

                    case 'Presencial':
                        $tipo_filtrado = 'Presencial';
                        $horario_rango = $horario_rango_presencial;

                        break;
                    case 'Online':
                        $tipo_filtrado = 'Online';
                        $horario_rango = $horario_rango_online;
                        break;
                }

                $rango_dividido_horario = $minutes / $horario_rango;

                $nuevaHora_init = strtotime($horario_init[$i]);
                $nuevaHora_final = strtotime($horario_end[$i]);

                $saltos = 0;

                for ($j = 0; $j < $rango_dividido_horario; $j++) {

                    $nuevaHora_format = strtotime('+' . $saltos . ' minutes', $nuevaHora_init);
                    $nuevaHora_saltos = date('H:i', $nuevaHora_format);

                    if ($horario_rango == "45") {

                        $nuevaHora_format_45 = strtotime('-45 minutes', $nuevaHora_final);
                        $nuevaHora_saltos_formato = date('H:i', $nuevaHora_format_45);
                    } else {
                        $nuevaHora_saltos_formato = $horario_end[$i];
                    }

                    if ($nuevaHora_saltos < $nuevaHora_saltos_formato) {

                        $nuevo_ID = $nuevo_ID + 1;

                        $arreglo_horas[] = array(
                            'id' => $nuevo_ID,
                            'token' => $token,
                            'name' => $nuevaHora_saltos,
                            'dia' => $dia[$i],
                            'startHour' => $nuevaHora_saltos,
                            'endHour' => $horario_end[$i],
                            'time' => $horario_rango,
                            'customClass' => 'blueClass',
                            'estado' => 'libre',
                            'tipo' => $tipo[$i],
                        );

                        $saltos_sum = $saltos += $horario_rango;
                    }
                }
            }

            $resultado = array_merge($agenda_full, $arreglo_horas);
            $insertar_data = json_encode($resultado, JSON_UNESCAPED_UNICODE);

            if ($insertar_data == null || $resultado == null) {
                echo "error";

            } else {
                echo "ok";
                consultasSQL::UpdateSQL("agenda_medica", "agenda='$insertar_data'", "cod_medico='$token'");
            }
        }
    }
}