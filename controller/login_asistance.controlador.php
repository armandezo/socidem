<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../model/consulSQL.php';
require_once '../vendor/autoload.php';
require_once '../model/credencialesLogMed.php';
  

    $user_login = $_POST['user-login'];
    $clave = md5($_POST['clave-login']);

  
  

if (!$user_login == "" && !$clave == "") {

    $secretariaCons = ejecutarSQL::consultar("SELECT `secretarias`.*, `secretarias`.`usuario`, `secretarias`.`pass` FROM `secretarias` WHERE `secretarias`.`usuario` = '$user_login' AND `secretarias`.`pass` = '$clave' AND `secretarias`.`estado` = '1'");
     
    
    while($datos_medicos=mysqli_fetch_assoc($secretariaCons)){
        $cod_med =$datos_medicos['cod_med'];  
   
    }
    
     $verAfil = ejecutarSQL::consultar("SELECT `perfil`.*, `medicos`.*, `perfil`.`codigo_referido`, `perfil`.`correo`, `medicos`.`mail_confirm`
     FROM `perfil`
         , `medicos`
     WHERE `perfil`.`codigo_referido` = '$cod_med' AND `perfil`.`correo` = `medicos`.`correo` AND `medicos`.`mail_confirm` = '1';");
     
   
    
    while($datos_usuario=mysqli_fetch_assoc($verAfil)){
        $id_usuario=$datos_usuario['id'];
        $nombre=$datos_usuario['nombre_completo'];
        $correo=$datos_usuario['correo'];
        $rol=$datos_usuario['rol'];
        $codigo_referido=$datos_usuario['codigo_referido'];
        $especialidad=$datos_usuario['especialidad'];
        $ubicacion=$datos_usuario['ubicacion'];
        $foto=$datos_usuario['foto'];
        $num_colegiatura=$datos_usuario['num_colegiatura'];
        $estado=$datos_usuario['estado']; 
        $membresia=$datos_usuario['membresia']; 
        $periodo_membresia=$datos_usuario['periodo_membresia']; 
        $last_login=$datos_usuario['last_login'];
 
       
    } 
    
    $AfilC = mysqli_num_rows($secretariaCons);
    
        if ($AfilC > 0) {
        $_SESSION['id'] = $id_usuario;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['correo'] = $correo;
        $_SESSION["rol"] = $rol;
        $_SESSION["codigo_referido"] = $codigo_referido;
        $_SESSION["especialidad"] = $especialidad;
        $_SESSION["ubicacion"] = $ubicacion;
        $_SESSION["foto"] = $foto;
        $_SESSION["num_colegiatura"] = $num_colegiatura;
        $_SESSION['estado'] = $estado;
        $_SESSION['membresia'] = $membresia;
        $_SESSION['periodo_membresia'] = $periodo_membresia;
        $_SESSION['last_login'] = $last_login;
         
        $verBankCCI = ejecutarSQL::consultar("SELECT `medico_bank`.*, `medico_bank`.`token_medico`  FROM `medico_bank` WHERE `medico_bank`.`token_medico` = '$codigo_referido';");

        $Active_CCI = mysqli_num_rows($verBankCCI);
        
        if($Active_CCI >= 1){
            $_SESSION["reg_token_bank"] = "registrado"; 
        }else {
            $_SESSION["reg_token_bank"] = ""; 
        }


        
        $_SESSION["iniciarSesion"] = "ok";
        
        $_SESSION["asistente"] = "ok";
       
        date_default_timezone_set('America/Lima');
        setlocale(LC_TIME, 'es_ES.UTF-8');
        setlocale(LC_TIME, 'spanish');
        $last_login_up = date('l jS F Y h:i:s A');
             
             
            consultasSQL::UpdateSQL("medicos", "correo='$correo', last_login='$last_login_up' ", "correo='$correo'");
           
                echo '<script> 	window.location = "dashboard"; </script>';
          
           
        } else {
            echo '<script> alert("Asistente no registrado"); 	window.location = "loginAsistance"; </script>';
            // echo '<div class="progress"><div class="progress-bar progress-bar-danger" style="width: 100%">Usuario Incorrecto </div> </div>';
        }
    
    
} else {
    echo '<div class="progress"><div class="progress-bar progress-bar-danger" style="width: 100%">Campos Vacios</div> </div>';
}