<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../model/consulSQL.php';

require_once '../vendor/autoload.php';
 

 if (isset($_GET['code'])){
   
      $type = 'LOGIN';
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
      // redirect the user to the profile page if it has "code" GET variable
      

        try {

          $profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
          $profile = $profile_request->getGraphUser();
                   
          $correo  = $profile->getEmail('email');    
          $clave = md5($profile->getEmail('email'));  
          
          
          if (!$correo == "" && !$clave == "") {
          if (isset($_GET['code'])){  
            $verAfil = ejecutarSQL::consultar("SELECT `pacientes`.*, `pacientes`.`correo` FROM `pacientes` WHERE `pacientes`.`correo` = '$correo' ");
          } 
        
          while($datos_usuario=mysqli_fetch_assoc($verAfil)){
                  $id_usuario=$datos_usuario['id'];
                  $nombre=$datos_usuario['nombre'];
                  $correo=$datos_usuario['correo'];
                  $rol=$datos_usuario['rol'];
                  $estado=$datos_usuario['estado']; 
                  $last_login=$datos_usuario['last_login'];
                
              } 
              
              $AfilC = mysqli_num_rows($verAfil);
                  if ($AfilC > 0) {
                  $_SESSION['id'] = $id_usuario;
                  $_SESSION['nombre'] = $nombre;
                  $_SESSION['correo'] = $correo;
                  $_SESSION["rol"] = $rol;
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
                      echo '<script> alert("Usuario no registrado"); 	window.location = "../registro"; </script>';
                      // echo '<div class="progress"><div class="progress-bar progress-bar-danger" style="width: 100%">Usuario Incorrecto </div> </div>';
                  }
              
              
          } else {
              echo '<script> alert("Campos  Vacios"); 	window.location = "../registro"; </script>';
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
 
  