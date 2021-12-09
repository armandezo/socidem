<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../model/consulSQL.php';
require_once '../vendor/autoload.php';
require_once '../model/credencialesLogMed.php';
  
if (isset($_GET['code'])){
    
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // get profile info
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $correo =  $google_account_info->email;
    $clave =  md5($correo);
   

      
}else {

    $correo = $_POST['correo-login'];
    $clave = md5($_POST['clave-login']);

}
  

if (!$correo == "" && !$clave == "") {
    if (isset($_GET['code'])){  
        $verAfil = ejecutarSQL::consultar("SELECT `medicos`.*, `perfil`.*, `medicos`.`correo`, `medicos`.`pass` FROM `medicos` LEFT JOIN `perfil` ON `perfil`.`correo` = `medicos`.`correo` WHERE `medicos`.`correo` = '$correo' ");
    }else {
        $verAfil = ejecutarSQL::consultar("SELECT `medicos`.*, `perfil`.*, `medicos`.`correo`, `medicos`.`mail_confirm`, `medicos`.`pass` FROM `medicos` LEFT JOIN `perfil` ON `perfil`.`correo` = `medicos`.`correo` WHERE `medicos`.`correo` = '$correo' AND `medicos`.`pass` = '$clave' AND `medicos`.`mail_confirm` = 1");
    }
    
    
   
    
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
    
    $AfilC = mysqli_num_rows($verAfil);
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
       
        date_default_timezone_set('America/Lima');
        setlocale(LC_TIME, 'es_ES.UTF-8');
        setlocale(LC_TIME, 'spanish');
        $last_login_up = date('l jS F Y h:i:s A');
             
             
            consultasSQL::UpdateSQL("medicos", "correo='$correo', last_login='$last_login_up' ", "correo='$correo'");
            if (isset($_GET['code'])){ 
                echo '<script> 	window.location = "../dashboard"; </script>';
            }else{
                echo '<script> 	window.location = "dashboard"; </script>';
            }
           
           
           
        } else {
            echo '<script> alert("Usuario no registrado"); 	window.location = "../loginMed"; </script>';
            // echo '<div class="progress"><div class="progress-bar progress-bar-danger" style="width: 100%">Usuario Incorrecto </div> </div>';
        }
    
    
} else {
    echo '<div class="progress"><div class="progress-bar progress-bar-danger" style="width: 100%">Campos Vacios</div> </div>';
}