<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
include '../../model/consulSQL.php';

$status = $_POST['status'];
$cod = $_POST['cod'];

if($status == "true"){
    $estado = 1;
}else {
    $estado = 0;
}

consultasSQL::UpdateSQL("codigos_promo", "status='$estado' ", "codigo='$cod'");