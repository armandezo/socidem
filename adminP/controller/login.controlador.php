<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
include '../../model/consulSQL.php';
 
    $usuario_admin = $_POST['email-log'];
    $clave_admin = md5($_POST['pass-log']);
 

if (!$usuario_admin == "" && !$clave_admin == "") {
     
    $verAfil = ejecutarSQL::consultar("SELECT `admin`.*, `admin`.`user`, `admin`.`role`, `admin`.`pass` FROM `admin` WHERE `admin`.`user` = '$usuario_admin' AND `admin`.`pass` = '$clave_admin';");
    
    while($datos_admin=mysqli_fetch_assoc($verAfil)){
         
        $user_admin=$datos_admin['user']; 
        $user_role =$datos_admin['role']; 
    } 
    
    $AfilC = mysqli_num_rows($verAfil);
        if ($AfilC > 0) {
         
        $_SESSION['user_admin'] = $user_admin; 
        $_SESSION['user_role'] = $user_role;
        $_SESSION["iniciarSesion"] = "estable";
       
        date_default_timezone_set('America/Lima');
        setlocale(LC_TIME, 'es_ES.UTF-8');
        setlocale(LC_TIME, 'spanish');
        $last_login_up = date('l jS F Y h:i:s A');
             
             
        consultasSQL::UpdateSQL("admin", "last_login='$last_login_up' ", "user='$user_admin'");
         
        echo '<script> 	window.location = "adminDash-inicio"; </script>';
           
        } else {
            echo '<div class="progress"><div class="progress-bar progress-bar-danger" style="width: 100%">Usuario Incorrecto </div> </div>';
        }
    
            
        } else {
            echo '<div class="progress"><div class="progress-bar progress-bar-danger" style="width: 100%">Campos Vacios</div> </div>';
        }