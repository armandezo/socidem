<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
date_default_timezone_set('America/Lima');

$fecha_hoy = $_POST['fecha'];
$id_obj = $_POST['id'];
$correo_cod = $_POST['cod_correo'];


$verHistorialMed = ejecutarSQL::consultar("SELECT `historial_medico`.*, `historial_medico`.`correo` FROM `historial_medico` WHERE `historial_medico`.`correo` = '$correo_cod';");

while($datos_historia_medica=mysqli_fetch_assoc($verHistorialMed)){

    $objHC=$datos_historia_medica['historia_clinica'];
    
    $historia_med = json_decode($objHC, true); 
    

    foreach ($historia_med as $key => $entry) { 
        
        if($entry['id'] == $id_obj){
             
            echo '
            <h4 class="modal-title" style="margin-left: auto; margin-right: auto;">Agregar Historia Clinica </h4>

            <div class="col-md-12">
            <br>
            <form id="form_HC">
            <input type="hidden" name="fecha_actual" value="'.$entry['fecha'].'">
            <input type="hidden" name="cod_correo" value="'.$correo_cod.'">
            <textarea rows="15" name="texto_HC" id="texto_HC" cols="5" class="form-control" placeholder="Ingresa tu texto aqui....">'.$entry['texto'].'</textarea>
            <br>
            <button type="button"  class="btn med_row " onclick="GuardarEditHC(&quot;'.$entry['id'].'&quot;);"><i class="fas fa-edit"></i> EDITAR </button>
            </form>
            </div> 
            ';     
        } 
        ;


    }  
       
           
}     
 
