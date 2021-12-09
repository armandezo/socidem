<?php
session_start(); 
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../model/consulSQL.php';
 

$token_confirm = $_POST['sms_code'];
 
 $verAfil = ejecutarSQL::consultar("SELECT `pacientes`.*, `pacientes`.`correo`, `pacientes`.`token_confirm`  FROM `pacientes` WHERE `pacientes`.`token_confirm` = '$token_confirm' AND  `pacientes`.`mail_confirm` = 0 ");
    
 $num_confirm = mysqli_num_rows($verAfil);

    if($num_confirm == 1){ 

        while($datos_usuario=mysqli_fetch_assoc($verAfil)){
            $id_usuario=$datos_usuario['id'];
            $nombre=$datos_usuario['nombre'];
            $correo=$datos_usuario['correo'];
            $rol=$datos_usuario['rol'];
            $telefono=$datos_usuario['telefono'];
            $estado=$datos_usuario['estado']; 
            $last_login=$datos_usuario['last_login'];

            $_SESSION["iniciarSesion"] = "ok";
            $_SESSION['id'] = $id_usuario;
            $_SESSION['nombre'] = $nombre;
            $_SESSION['correo'] = $correo;
            $_SESSION["rol"] = $rol;
            $_SESSION['telefono'] = $telefono;
            $_SESSION['estado'] = $estado;
            $_SESSION['last_login'] = $last_login;
        } 
        
        consultasSQL::UpdateSQL("pacientes", "correo='$correo', mail_confirm='1' ", "correo='$correo'");

        if(isset($_SESSION['fecha'])){
            echo '<script> 	window.location = "checkout"; </script>';
        }else {
            echo '<script> 	window.location = "dashboard"; </script>';
        }
       
    }else {
        echo '<script> 	Swal.fire("TOKEN INVALIDO", "", "info"); </script>';
       
    }