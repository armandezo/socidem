<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../model/consulSQL.php';
require_once '../vendor/autoload.php';
require_once '../model/credencialesLog.php';
 

if (isset($_GET['code'])){
    
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // get profile info
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $correo =  $google_account_info->email;
    $clave =  md5($correo);
    $name_test  =  $google_account_info->name;

      
}else {

    $correo = $_POST['correo-login'];
    $clave = md5($_POST['clave-login']);

}
  

if (!$correo == "" && !$clave == "") {
    if (isset($_GET['code'])){  
        
        $verAfil = ejecutarSQL::consultar("SELECT `pacientes`.*, `pacientes`.`correo` FROM `pacientes` WHERE `pacientes`.`correo` = '$correo' ");
    }else {
    
        $verAfil = ejecutarSQL::consultar("SELECT `pacientes`.*, `pacientes`.`correo`, `pacientes`.`pass`, `pacientes`.`mail_confirm` FROM `pacientes` WHERE `pacientes`.`correo` = '$correo' AND `pacientes`.`pass` = '$clave' AND `pacientes`.`mail_confirm` = 1");
    
    }
    
    
   
    
    while($datos_usuario=mysqli_fetch_assoc($verAfil)){
        $id_usuario=$datos_usuario['id'];
        $nombre=$datos_usuario['nombre'];
        $correo=$datos_usuario['correo'];
        $rol=$datos_usuario['rol'];
        $telefono=$datos_usuario['telefono'];
        $estado=$datos_usuario['estado']; 
        $last_login=$datos_usuario['last_login'];
       
    } 
    
    $AfilC = mysqli_num_rows($verAfil);
        if ($AfilC > 0) {
        $_SESSION['id'] = $id_usuario;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['correo'] = $correo;
        $_SESSION["rol"] = $rol;
        $_SESSION['telefono'] = $telefono;
        $_SESSION['estado'] = $estado;
        $_SESSION['last_login'] = $last_login;
         

        
        
        $_SESSION["iniciarSesion"] = "ok";
       
        date_default_timezone_set('America/Lima');
        setlocale(LC_TIME, 'es_ES.UTF-8');
        setlocale(LC_TIME, 'spanish');
        $last_login_up = date('l jS F Y h:i:s A');
             
             
            consultasSQL::UpdateSQL("pacientes", "correo='$correo', last_login='$last_login_up' ", "correo='$correo'");
            if (isset($_GET['code'])){ 
                
                if(isset($_SESSION['fecha'])){
                    echo '<script> 	window.location = "../checkout"; </script>';
                }else {
                    echo '<script> 	window.location = "../dashboard"; </script>';
                }
               
            }else{

                if(isset($_SESSION['fecha'])){
                    echo '<script> 	window.location = "checkout"; </script>';
                }else {
                    echo '<script> 	window.location = "dashboard"; </script>';
                }
               
            }
           
           
           
        } else {
            echo '<script> alert("Usuario no registrado"); 	window.location = "../login"; </script>';
            // echo '<div class="progress"><div class="progress-bar progress-bar-danger" style="width: 100%">Usuario Incorrecto </div> </div>';
        }
    
    
} else {
    echo '<div class="progress"><div class="progress-bar progress-bar-danger" style="width: 100%">Campos Vacios</div> </div>';
}