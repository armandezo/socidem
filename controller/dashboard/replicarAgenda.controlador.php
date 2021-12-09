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
$dia_track = $_POST['dia_track']; 
$dias_obj = $_POST['dias_replica']; 
$tipo = $_POST['tipoCita'];

$dia_array = explode("," , $dias_obj); 

if ($horario_init != null) {
    $count_horarios = count($horario_init);
    
    for ($u = 0; $u < $count_horarios; $u++) { 
            $horario_init_val[] = $horario_init[$u]; //fecha inicial
            $horario_end_val[] = $horario_end[$u]; //fecha inicial 
    }

    foreach ($horario_init_val as $key => $val) {

        if (isset($horario_init_val[$key])) {
            if (
                $horario_init_val[$key + 1] < $horario_end_val[$key] &&
                $horario_init_val[$key + 1] >= $horario_init_val[$key] ||

                $horario_end_val[$key + 1] < $horario_end_val[$key] &&
                $horario_end_val[$key + 1] >= $horario_init_val[$key]

            ) {

                echo "El horario de " . $horario_init_val[$key + 1] . " a " . $horario_end_val[$key + 1] . " es intervalo de " . $horario_init_val[$key] . " a " . $horario_end_val[$key] . " del dia " . $dia[$key] . "<br>";
                $state = "close";
                break;
            } else {
                $state = "open";
            }
        } else {
            $state = "vacio";
        }

    }
} else {
    echo "false";
}

  
if ($state == "open") {
    $verAgendaMedica = ejecutarSQL::consultar("SELECT `agenda_medica`.`agenda`, `agenda_medica`.`cod_medico`, `agenda_medica`.`estado` FROM `agenda_medica` WHERE `agenda_medica`.`cod_medico` = '$token'");

    while ($datos_agenda_medica = mysqli_fetch_assoc($verAgendaMedica)) {

        $objAgenda = $datos_agenda_medica['agenda'];

        $agenda_full = json_decode($objAgenda, true);

        foreach ($agenda_full as $key => $entry) {

            if(in_array($entry['dia'], $dia_array) ){ 
                unset($agenda_full[$key]);  
           }
           
          
        }
       
         $valor = json_encode($agenda_full);
      
        if($_POST['horario_end'] != NULL){

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

                if ($horario_rango == "") {

                    echo 'false'.$horario_rango;

                    break;
                } else {

                    $rango_dividido_horario = $minutes / $horario_rango;

                    $nuevaHora_init = strtotime($horario_init[$i]);

                    $saltos = 0;

                    for ($j = 0; $j < $rango_dividido_horario; $j++) {

                        $nuevaHora_format = strtotime('+' . $saltos . ' minutes', $nuevaHora_init);
                        $nuevaHora_saltos = date('H:i', $nuevaHora_format);

                        if ($nuevaHora_saltos < $horario_end[$i]) {

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

                        }

                        $saltos_sum = $saltos += $horario_rango;

                    }

                }

            }
            if ($horario_rango != "") {

                $resultado = array_merge($agenda_full, $arreglo_horas);

                $id_count = 0;
                foreach ($dia_array as $key1) {

                    foreach ($resultado as $key2 => $val) {

                        $id_count = $id_count + 1;

                        $arreglo_replica[] = array(
                            'id' => $id_count,
                            'token' => $token,
                            'name' => $val['startHour'],
                            'dia' => $key1,
                            'startHour' => $val['startHour'],
                            'endHour' => $val['endHour'],
                            'time' => $val['time'],
                            'customClass' => 'blueClass',
                            'estado' => 'libre',
                            'tipo' => $val['tipo'],
                        );

                    }

                }

                
                echo 'ok';
                $resultado = array_merge($agenda_full, $arreglo_replica);
                $insertar_data = json_encode($resultado, JSON_UNESCAPED_UNICODE);
                consultasSQL::UpdateSQL("agenda_medica", "agenda='$insertar_data'", "cod_medico='$token'");
           
            }
        }else {

            echo "vacio";
        }
 

    }
}
