<?php
session_start();
// error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php'; 


// header('Content-Type: application/json'); 

    $respuesta = array(
        'Payment' => $_GET['payment_id'],
        'Status' => $_GET['status'],
        'MerchantOrder' => $_GET['merchant_order_id']        
    ); 

    
   $ch = curl_init();
//    
   curl_setopt($ch, CURLOPT_URL, 'https://api.mercadopago.com/v1/payments/'.$respuesta['Payment'] );
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
   
   
   $headers = array();
   $headers[] = 'Authorization: Bearer TEST-1333418562298877-020706-8f12270a97bdd77d30bbc6afe10c909c-314858826';
   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
   
   $result = curl_exec($ch);

   if (curl_errno($ch)) { 
       echo 'Error:' . curl_error($ch);
   }
//    var_dump($result);
   curl_close($ch);
    
$obj_json =(json_decode($result, true));

$membresia_array= array(
    'pagoID' => $obj_json['id'],
    'status' => $obj_json['status'],
    'status_detail' => $obj_json['status_detail'],
    'identificacion_number' => $obj_json['card']['cardholder']['identification']['number'],
    'identificacion_type' => $obj_json['card']['cardholder']['identification']['type'],
    'identificacion_nombre' => $obj_json['card']['cardholder']['name'],
    'fecha_created' => $obj_json['card']['date_created'],
    'fecha_aproved' => $obj_json['date_approved'],
    'order_number' => $obj_json['order']['id'],
    'order_type' => $obj_json['order']['type']

); 

$membresia_obj = (json_encode($membresia_array, true));

 
 
 
$get_pago_id = $obj_json['id'];
$estado = $obj_json['status'];
$tipo_membresia = "Profesional";
 
 switch ($obj_json['status']) {
     case "approved":
        $fecha = date('Y-m-d');
        $monto = $obj_json['transaction_amount'];
        $codigo_promocion = $_SESSION["cod_promocion"];
        $monto_reducido = 750 - $obj_json['transaction_amount'];


    $varInsert = consultasSQL::InsertSQL("pagos_membresias", "pagoMembresia, token_medico, cod_pago, monto_pago, token_referido, monto_reducido_token, fecha, estado ", " '$membresia_obj', '$codigo_referido_', '$get_pago_id', '$monto', '$codigo_promocion', '$monto_reducido', '$fecha', '$estado' "); 
    consultasSQL::UpdateSQL("secretarias", "estado='1'", "cod_med='$codigo_referido_'");
    if($membresia_ == "Gratuito"){
        $tiempo_membresia = $periodo_membresia_ + 14;
    }else {
        $tiempo_membresia = $periodo_membresia_ + 12;
    } 
    
    $codigo_promocion = $_SESSION["cod_promocion"];
    consultasSQL::UpdateSQL("medicos", "membresia='$tipo_membresia', estado=3, periodo_membresia='$tiempo_membresia' ", "correo='$correo_'");
    
    $cantidad_codigo_ref = ejecutarSQL::consultar("SELECT `codigos_promo`.*, `codigos_promo`.`codigo` FROM `codigos_promo` WHERE `codigos_promo`.`codigo` = '$codigo_promocion';");

    while($datos_cod_promo=mysqli_fetch_assoc($cantidad_codigo_ref)){ 
        
         $tipo_cod = $datos_cod_promo['tipo'];
         $cantidad_cod = $datos_cod_promo['cantidad'];

    }

    $total_cantidad = $cantidad_cod + 1;

    consultasSQL::UpdateSQL("codigos_promo", "cantidad='$total_cantidad', usado=1 ", "codigo='$codigo_promocion'"); 

    session_reset(); 
    $_SESSION["cod_promocion"];
    $_SESSION["estado"] = 3;
    $_SESSION["membresia"] = $tipo_membresia;  
    $_SESSION["periodo_membresia"] = $tiempo_membresia;





    break;
    case "pending":

        $varInsert = consultasSQL::InsertSQL("pagos_membresias", "pagoMembresia, token_medico, cod_pago, estado ", " '$membresia_obj', '$cod_medico', '$get_pago_id', '$estado' "); 
        // $tiempo_membresia = $periodo_membresia_ + 12;
        
        // consultasSQL::UpdateSQL("medicos", "membresia='Profesional', periodo_membresia='$tiempo_membresia' ", "correo='$correo_'");
         
 
    break;

    case "404":
        $varInsert = consultasSQL::InsertSQL("pagos_membresias", "pagoMembresia, token_medico, cod_pago, estado ", " '$membresia_obj', '$cod_medico', '$get_pago_id', '$estado' "); 
      
    break;

} 

header('Location: ../../dashboard');
exit;
   