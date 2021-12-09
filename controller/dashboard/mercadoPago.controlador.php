<?php

MercadoPago\SDK::setAccessToken('TEST-1333418562298877-020706-8f12270a97bdd77d30bbc6afe10c909c-314858826');
// consultasSQL::InsertSQL("notificaciones", "id, status", " '', '$estado'"); 
$preference = new MercadoPago\Preference();

// $preference->payment_methods = array(
//     "excluded_payment_methods" => array(
//       array("id" => "pagoefectivo_atm")
//     ),
//     "installments" => 1
// );  
   
$item = new MercadoPago\Item();
$item->title = 'Agenda de Cita';
$item->quantity = 1;
$item->unit_price = $_SESSION['precio_final'];

$preference->payment_methods = array( 
    "excluded_payment_types" => array(
      array("id" => "ticket")
    ),       
    "installments" => 1
  );
  
$preference->items = array($item);
 
 
$type = 'MP_AGENDA';
include 'model/config.php';

$preference->auto_return = "approved"; 

$preference->save();
 
echo "<a style='width: 100%;' onclick='return proPat()'  href='$preference->init_point' class='btn btn-primary submit-btn'  >Confirmar y Pagar</a>";