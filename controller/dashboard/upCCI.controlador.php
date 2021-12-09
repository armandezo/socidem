<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';

$cci = $_POST['cci'];
 
   
if (!$cci  == "" ) {
     
    $BuscaAfil = ejecutarSQL::consultar("select * from medico_bank where token_medico='$codigo_referido_' ");
   
    $AfilC = mysqli_num_rows($BuscaAfil);
         
        if ($AfilC == 0) {

             
         $varInsert = consultasSQL::InsertSQL("medico_bank", "token_medico, cci", "'$codigo_referido_', '$cci' "); 
        
         session_reset(); 
         $_SESSION["reg_token_bank"] = "registrado"; 

         echo '<script> window.location = "../../membresias";  </script>';
           
        }elseif ($AfilC >= 1) { 
                echo "Este CCI ya se encuentra registrado ";    
                  
        }
         
        
    } else {
             echo 'Campos Vacios';
}