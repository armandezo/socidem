<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
include '../../model/consulSQL.php';

$fecha = $_POST['date'];
 
$consult = ejecutarSQL::consultar("SELECT `pagos_medicos`.*, `pagos_medicos`.`fecha` FROM `pagos_medicos` WHERE `pagos_medicos`.`fecha` = '$fecha';");

$count_fecha_pago = mysqli_num_rows($consult);


if ($count_fecha_pago > 0) {
    echo "existe";
} else {

    $consult_medicos = ejecutarSQL::consultar("SELECT `medicos`.`nombre_completo`, `medicos`.`correo`, `medicos`.`periodo_membresia`, `medicos`.`membresia`, `perfil`.`telefono`, `perfil`.`codigo_referido`, `medico_bank`.`cci` FROM `medicos`, `perfil`, `medico_bank` WHERE `medicos`.`correo` = `perfil`.`correo` AND `medicos`.`membresia` = 'Profesional' AND `perfil`.`codigo_referido` = `medico_bank`.`token_medico` ");

    while ($datos_consult_medicos = mysqli_fetch_assoc($consult_medicos)) {

        $medico_activo = $datos_consult_medicos['codigo_referido']; 

        $consult_agenda = ejecutarSQL::consultar("SELECT `agenda`.`cod_medico`, `agenda`.`pago_estado`, `agenda`.`fecha_start`, SUM(precio_consulta) AS sumatoria_total FROM `agenda` WHERE `agenda`.`cod_medico` = '$medico_activo' AND `agenda`.`pago_estado` = 'approved' AND `agenda`.`fecha_start` LIKE '%$fecha%';");
       
        while ($datos_consult_agenda = mysqli_fetch_assoc($consult_agenda)) {
            
            $cod_medico = $datos_consult_agenda['cod_medico'];
            $sumatoria_total = $datos_consult_agenda['sumatoria_total']; 

            if($cod_medico != NULL){ 
                $regPagoMed = consultasSQL::InsertSQL("pagos_medicos", "cod_med, fecha, monto", "'$cod_medico', '$fecha', '$sumatoria_total' "); 
            }

            
        }
      
    }
   
    echo "registro";
 }
