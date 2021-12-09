<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
include '../../model/consulSQL.php';

$cod_externo = $_POST['cod'];
$fecha = $_POST['date'];
$status = $_POST['status'];

$fecha_lunes =  date('Y-m-d', strtotime($fecha." monday this week")); 
$fecha_domingo = date('Y-m-d', strtotime($fecha." sunday this week")); 
 
$consult = ejecutarSQL::consultar("SELECT `pagos_externos`.*, `pagos_externos`.`cod_externo`, `pagos_externos`.`fecha` FROM `pagos_externos` WHERE `pagos_externos`.`cod_externo` = '$cod_externo' AND `pagos_externos`.`fecha` = '$fecha'");

$count_fecha_pago = mysqli_num_rows($consult);


if ($count_fecha_pago > 0) {
    if($status == "true"){
        $reg = consultasSQL::DeleteSQL("pagos_externos", "cod_externo='".$cod_externo."' AND fecha='".$fecha."'");
        echo "revertido";
    }else {
        echo "existe";
    }
} else {

    $cons_total_ref = ejecutarSQL::consultar("SELECT `pagos_membresias`.`estado`, `pagos_membresias`.`token_referido`, `pagos_membresias`.`monto_reducido_token`, `pagos_membresias`.`token_referido`, `pagos_membresias`.`fecha`, `pagos_membresias`.`token_medico` FROM `pagos_membresias` WHERE `pagos_membresias`.`estado` = 'approved' AND `pagos_membresias`.`token_referido` = '$cod_externo' AND `pagos_membresias`.`fecha` BETWEEN '$fecha_lunes' AND '$fecha_domingo' ");

    $consult_num_membresias = mysqli_num_rows($cons_total_ref);
  
    

    

    if($consult_num_membresias != 0){
        
             
        $consult_pago = ejecutarSQL::consultar("SELECT `pagos_externos`.*, `pagos_externos`.`cod_externo`, `pagos_externos`.`fecha` FROM `pagos_externos` WHERE `pagos_externos`.`cod_externo` = '$cod_externo' AND `pagos_externos`.`fecha` BETWEEN '$fecha_lunes' AND '$fecha_domingo';");
        $consult_pago_num = mysqli_num_rows($consult_pago);
        $sumatoria_total = $consult_num_membresias * 250;
               
        if($consult_pago_num == 0){  
            $regPagoMed = consultasSQL::InsertSQL("pagos_externos", "cod_externo, fecha, monto", "'$cod_externo', '$fecha', '$sumatoria_total' "); 
            echo "exito";
        } else {
            echo "existe";
        }
                
     
        
    }else {
        echo "no_saldo"; 
    }


  
   
     
 }
