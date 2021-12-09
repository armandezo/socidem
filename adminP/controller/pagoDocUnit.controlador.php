<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
include '../../model/consulSQL.php';

$cod_med = $_POST['cod'];
$fecha = $_POST['date'];
$status = $_POST['status'];
 
$consult = ejecutarSQL::consultar("SELECT `pagos_medicos`.*, `pagos_medicos`.`cod_med`, `pagos_medicos`.`fecha` FROM `pagos_medicos` WHERE `pagos_medicos`.`cod_med` = '$cod_med' AND `pagos_medicos`.`fecha` = '$fecha'");

$count_fecha_pago = mysqli_num_rows($consult);


if ($count_fecha_pago > 0) {
    if($status == "true"){
        $reg = consultasSQL::DeleteSQL("pagos_medicos", "cod_med='".$cod_med."' AND fecha='".$fecha."'");
        echo "revertido";
    }else {
        echo "existe";
    }
} else {

    $consult_medicos = ejecutarSQL::consultar("SELECT `medicos`.`nombre_completo`, `medicos`.`correo`, `medicos`.`estado`, `medicos`.`periodo_membresia`, `medicos`.`membresia`, `perfil`.`telefono`, `perfil`.`codigo_referido`, `medico_bank`.`cci` FROM `medicos`, `perfil`, `medico_bank` WHERE `medicos`.`correo` = `perfil`.`correo` AND `medicos`.`membresia` = 'Profesional' AND `medicos`.`estado` = '1' AND `perfil`.`codigo_referido` = '$cod_med' AND `perfil`.`codigo_referido` = `medico_bank`.`token_medico` ");

    $count_veri = mysqli_num_rows($consult_medicos);

    

    if($count_veri != 0){
        while ($datos_consult_medicos = mysqli_fetch_assoc($consult_medicos)) {

            $medico_activo = $datos_consult_medicos['codigo_referido']; 
            $estado = $datos_consult_medicos['estado']; 

            $fecha_lunes =  date('Y-m-d', strtotime($fecha." monday this week")); 
            $fecha_domingo = date('Y-m-d', strtotime($fecha." sunday this week")); 
         
            $cons_total_ref = ejecutarSQL::consultar("SELECT
            `pagos_membresias`.`estado`,
            `pagos_membresias`.`token_referido`, 
            `pagos_membresias`.`monto_reducido_token`,
            `pagos_membresias`.`token_referido`,
            `pagos_membresias`.`fecha`,
            `pagos_membresias`.`token_medico`,
            SUM(monto_reducido_token) AS total
        FROM
            `pagos_membresias`
        WHERE
            `pagos_membresias`.`estado` = 'approved' AND `pagos_membresias`.`token_referido` = '$cod_med' AND `pagos_membresias`.`fecha` BETWEEN '$fecha_lunes' AND '$fecha_domingo'");
    
        while( $referidos_total =mysqli_fetch_assoc($cons_total_ref)){   
            $total_ref = $referidos_total['total'];
            
        }
             
                $consult_agenda = ejecutarSQL::consultar("SELECT `agenda`.`cod_medico`, `agenda`.`pago_estado`, `agenda`.`fecha_start`, SUM(precio_consulta) AS sumatoria_total FROM `agenda` WHERE `agenda`.`cod_medico` = '$medico_activo' AND `agenda`.`pago_estado` = 'approved' AND `agenda`.`fecha_start` BETWEEN '$fecha_lunes' AND '$fecha_domingo'");
           
                while ($datos_consult_agenda = mysqli_fetch_assoc($consult_agenda)) {
                    
                    $cod_medico = $datos_consult_agenda['cod_medico'];
                    $sumatoria_total = $datos_consult_agenda['sumatoria_total'] +  $total_ref; 
        
                    if($cod_medico != NULL){  
                        $regPagoMed = consultasSQL::InsertSQL("pagos_medicos", "cod_med, fecha, monto", "'$cod_medico', '$fecha', '$sumatoria_total' "); 
                        echo "exito";
                    } else {
                        echo "no_saldo";
                    }
                }
    
              
            
               
          
        }
    }else {
        echo "no_veri"; 
    }


  
   
     
 }
