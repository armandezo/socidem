<?php
session_start(); 
date_default_timezone_set('America/Lima'); 
error_reporting(E_ALL ^ E_NOTICE);
include '../../model/consulSQL.php';
 
$cod = $_POST['cod'];

$consult = ejecutarSQL::consultar("SELECT `agenda`.`cod_consulta`, `agenda`.`cita` FROM `agenda` WHERE `agenda`.`cod_consulta` = '$cod';");

while( $datos_consult =mysqli_fetch_assoc($consult)){  
     
    $objAgenda = json_decode($datos_consult['cita'], true);

    foreach( $objAgenda as $key => $val){ 

        if($key == "pagoID"){  $pagoID = $val; } 
        if($key == "order_number"){  $order_number = $val; } 
        if($key == "fecha_created"){ 
            $fecha_cons1 = strtotime($val);
            $fecha_created = date('d/m/Y G:i', $fecha_cons1);  } 
        if($key == "fecha_aproved"){ 
            $fecha_cons2 = strtotime($val);
            $fecha_aproved = date('d/m/Y G:i ', $fecha_cons2);  } 

        
    } 
}

echo '
<div class="col-12 col-sm-6">
<div class="form-group">
    <label>PAGO ID</label>
    <input type="text" class="form-control" placeholder="'.$pagoID.'" disabled>
</div>
</div>
<div class="col-12 col-sm-6">
<div class="form-group">
    <label>ORDEN ID</label>
    <input type="text" class="form-control" placeholder="'.$order_number.'" disabled>
</div>
</div>
<div class="col-12 col-sm-6">
<div class="form-group">
    <label>FECHA CREADO</label>
    <input type="text" class="form-control" placeholder="'.$fecha_created.'" disabled>
</div>
</div>
<div class="col-12 col-sm-6">
<div class="form-group">
    <label>FECHA APROBADO</label>
    <input type="text" class="form-control" placeholder="'.$fecha_aproved.'" disabled>
</div>
</div>

';










?>