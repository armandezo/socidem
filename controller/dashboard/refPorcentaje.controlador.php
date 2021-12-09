<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
 
$cod_promo = $_SESSION["cod_promocion"];
 

    $membresia_array= array(
        'pagoID' =>  'NULL',
        'status' =>  'approved',
        'status_detail' =>  'NULL',
        'identificacion_number' =>  'NULL',
        'identificacion_type' =>  'NULL',
        'identificacion_nombre' =>  'NULL',
        'fecha_created' =>  'NULL',
        'fecha_aproved' =>  'NULL',
        'order_number' =>  'NULL',
        'order_type' => 'NULL'

    ); 

    $membresia_obj = (json_encode($membresia_array, true));

    $fecha = date('Y-m-d');
    $varInsert = consultasSQL::InsertSQL("pagos_membresias", "pagoMembresia, token_medico, cod_pago, monto_pago, token_referido, monto_reducido_token, fecha, estado ", " '$membresia_obj', '$codigo_referido_', '0000000', '0', '$cod_promo', '750', '$fecha', 'approved' ");


    $BuscaCantidad = ejecutarSQL::consultar("SELECT `codigos_promo`.`codigo`, `codigos_promo`.`cantidad` FROM `codigos_promo` WHERE `codigos_promo`.`codigo` = 'MVOkZ1ZN'");

    while ($datos_promo = mysqli_fetch_assoc($BuscaCantidad)) { 

        $cantidad_base = $datos_promo['cantidad'] + 1;

    }

    consultasSQL::UpdateSQL("codigos_promo", "cantidad='$cantidad_base' , usado=1", "codigo='$cod_promo'");

    $tipo_membresia = "Profesional";
    if($membresia_ == "Gratuito"){
        $tiempo_membresia = $periodo_membresia_ + 14;
    }else {
        $tiempo_membresia = $periodo_membresia_ + 12;
    } 

    
    consultasSQL::UpdateSQL("medicos", "membresia='$tipo_membresia', estado=3, periodo_membresia='$tiempo_membresia' ", "correo='$correo_'");


    session_reset(); 
    $_SESSION["cod_promocion"];
    $_SESSION["estado"] = 3;
    $_SESSION["membresia"] = $tipo_membresia;  
    $_SESSION["periodo_membresia"] = $tiempo_membresia;

header('Location: ../../dashboard'); exit();