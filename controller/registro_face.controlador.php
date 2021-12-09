<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../model/consulSQL.php';
require_once '../vendor/autoload.php';
require_once '../model/credencialesReg.php';

if (isset($_GET['code'])){
    
        $type = 'REGISTER';
        include '../model/config.php';
        
        
        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email']; // optional
        try {
        if (isset($_SESSION['facebook_access_token'])) { 
        $accessToken = $_SESSION['facebook_access_token'];
        } else {
          $accessToken = $helper->getAccessToken();
        }
        } catch(Facebook\Exceptions\facebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
          exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
        }
        if (isset($accessToken)) {
        if (isset($_SESSION['facebook_access_token'])) {
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
        } else {
        // getting short-lived access token
        $_SESSION['facebook_access_token'] = (string) $accessToken;
          // OAuth 2.0 client handler
        $oAuth2Client = $fb->getOAuth2Client();
        // Exchanges a short-lived access token for a long-lived one
        $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['facebook_access_token']);
        $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
        // setting default access token to be used in script
        $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
        }

        
        try {

            $profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
            $profile = $profile_request->getGraphUser();

            $nombre = $profile->getName('name');
            $correo =  $profile->getEmail('email');
            $tel = "----";
            $pass =  md5($correo);
            $rol= "2";
            $estado= 1;
            date_default_timezone_set('America/Lima');
            setlocale(LC_TIME, 'es_ES.UTF-8');
            setlocale(LC_TIME, 'spanish');       
            $last_login = date('l jS F Y h:i:s A');
            
            if (!$correo == "" && !$pass == "" &&  !$nombre == ""  && !$tel == "" && !$rol == "" && !$last_login == "") {
     
                $BuscaAfil = ejecutarSQL::consultar("select * from pacientes where correo='$correo' ");
               
                $AfilC = mysqli_num_rows($BuscaAfil);
                     
                    if ($AfilC > 0 ) {
                        echo '<script> alert("Este correo ya esta registrado"); 	window.location = "../registro"; </script>';
                    }
                     
                    else {
            
                        $regAfil = consultasSQL::InsertSQL("pacientes", "correo, pass, nombre, telefono, rol, last_login, estado", "'$correo', '$pass', '$nombre', '$tel', '$rol', '$last_login', '$estado' "); 
                        $correo_md5 = md5($correo);
                        $regHistorial = consultasSQL::InsertSQL("historial_medico", "correo, historia_clinica, analisis_lab, img_digitales, recetas_med", "'$correo_md5', '[]', '[]', '[]', '[]' "); 
 


                        $verAfil = ejecutarSQL::consultar("SELECT `pacientes`.*, `pacientes`.`correo`, `pacientes`.`pass` FROM `pacientes` WHERE `pacientes`.`correo` = '$correo' AND `pacientes`.`pass` = '$pass';");
                
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
                        
                       
                        if (isset($_GET['code'])){ 
                            echo '<script> 	window.location = "../inicio"; </script>';
                        }else{
                            echo '<script> 	window.location = "inicio"; </script>';
                        }
                        
                    }
                } else {
                echo '<script> alert("Campos Vacios"); 	window.location = "registro"; </script>';
            }
            
            
            
          } catch(Facebook\Exceptions\FacebookResponseException $e) {
          // When Graph returns an error
          echo 'Graph returned an error: ' . $e->getMessage();
          session_destroy();
          // redirecting user back to app login page
          header("Location: ./");
          exit;
          } catch(Facebook\Exceptions\FacebookSDKException $e) {
          // When validation fails or other local issues
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
          exit;
          }
  
  
        }
} 

 