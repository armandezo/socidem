<?php
session_start(); 
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../model/consulSQL.php';


if (isset($_GET['code'])){ 
  
 unset($_SESSION["asistente"]);

 $token_confirm = $_GET['code'];
 
 $verAfil = ejecutarSQL::consultar("SELECT `medicos`.*, `medicos`.`correo`, `medicos`.`token_confirm` FROM `medicos` WHERE `medicos`.`token_confirm` = '$token_confirm' ");
    
 $num_confirm = mysqli_num_rows($verAfil);

    if($num_confirm == 1){ 
 
        while($datos_usuario=mysqli_fetch_array($verAfil)){
            $rol = $datos_usuario['rol'];
            $nombre = $datos_usuario['nombre_completo'];
            $correo = $datos_usuario['correo'];
            $estado = $datos_usuario['estado']; 
            $membresia=$datos_usuario['membresia']; 
            $periodo_membresia=$datos_usuario['periodo_membresia']; 
            $last_login = $datos_usuario['last_login'];
            $mail_confirm = $datos_usuario['mail_confirm']; 
            
            $verPerfil = ejecutarSQL::consultar("SELECT `perfil`.`correo`, `perfil`.`codigo_referido`, `perfil`.`especialidad`, `perfil`.`num_colegiatura`, `perfil`.`foto`  FROM `perfil` WHERE `perfil`.`correo` = '$correo' ");

            while($perfil_usuario=mysqli_fetch_array($verPerfil)){ 

            $codigo_referido_new=$perfil_usuario['codigo_referido'];
            $especialidad=$perfil_usuario['especialidad'];
            $ubicacion=$perfil_usuario['ubicacion'];
            $foto=$perfil_usuario['foto'];
            $num_colegiatura=$perfil_usuario['num_colegiatura'];


            }
            $_SESSION["iniciarSesion"] = "ok";
             


            $_SESSION['nombre'] = $nombre;
            $_SESSION['correo'] = $correo;
            $_SESSION["codigo_referido"] = $codigo_referido_new;
            $_SESSION["especialidad"] = $especialidad;
            $_SESSION["ubicacion"] = $ubicacion;
            $_SESSION["foto"] = $foto;
            $_SESSION["num_colegiatura"] = $num_colegiatura;
            $_SESSION["rol"] = $rol;
            $_SESSION['estado'] = $estado;
            $_SESSION['membresia'] = $membresia;
            $_SESSION['periodo_membresia'] = $periodo_membresia;
            $_SESSION['last_login'] = $last_login; 

            
        } 
        
        consultasSQL::UpdateSQL("medicos", "correo='$correo', mail_confirm='1' ", "correo='$correo'");


        echo '<script> 	window.location = "../dashboard"; </script>';
    }else {
        echo '<script> 	window.location = "../inicio"; </script>';
    }

}else {
    echo '<script> 	window.location = "../inicio"; </script>';
}
    