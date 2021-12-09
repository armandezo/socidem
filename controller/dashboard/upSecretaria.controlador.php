<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
 
 
$codigo_referido = $codigo_referido_; 
 
$usuario_secret = $_POST['usuario-secret'];
$pass_secret = md5($_POST['pass-secret']); 
 

if($usuario_secret !='' && $pass_secret !=''){


   $BuscaAfil = ejecutarSQL::consultar("SELECT `secretarias`.*, `secretarias`.`cod_med`, `secretarias`.`usuario` FROM `secretarias` WHERE `secretarias`.`cod_med` != '$codigo_referido' AND `secretarias`.`usuario` = '$usuario_secret'");
   
   $AfilC = mysqli_num_rows($BuscaAfil);

   if ($AfilC > 0) {
      echo "duplicado";
   }else {

      consultasSQL::UpdateSQL("secretarias", "usuario='$usuario_secret', pass='$pass_secret' ", "cod_med='$codigo_referido'");

      echo "exito";
   }


  

}else {
   echo "vacio";
}