<?php 
error_reporting(E_ALL ^ E_NOTICE); 
 
  
    $id_ = $_SESSION['id'];
    $nombre_ = $_SESSION['nombre'];
    $correo_ = $_SESSION['correo'];
    $rol_ = $_SESSION["rol"]; 
    $codigo_referido_ = $_SESSION["codigo_referido"]; 
    $especialidad_ =  $_SESSION["especialidad"];
    $ubicacion_ = $_SESSION["ubicacion"];
    $foto_ =  $_SESSION["foto"];
    $num_colegiatura_ = $_SESSION["num_colegiatura"];
    $telefono_  = $_SESSION["telefono"]; 
    $estado_ = $_SESSION["estado"]; 
    $membresia_ = $_SESSION["membresia"]; 
    $periodo_membresia_ = $_SESSION["periodo_membresia"]; 
    $last_login_ = $_SESSION["last_login"];

    $asist_ = $_SESSION["asistente"];
 

?>