<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
 

$codigoRef = $_POST['ref'];
            
$med_cons = ejecutarSQL::consultar("SELECT `medicos`.`nombre_completo`, `perfil`.*, `perfil`.`correo`, `medicos`.`estado` FROM `medicos` , `perfil` WHERE `perfil`.`correo` = `medicos`.`correo` AND `perfil`.`codigo_referido` = '$codigoRef'");


while($datos_servicios=mysqli_fetch_assoc($med_cons)){
    $objServicios=$datos_servicios['servicios'];
    
 
    $separated = explode(',',  $objServicios);
    
} 
// 
 echo '
 <h4 class="modal-title" style="margin-bottom: 18px;">Selecciona el motivo de la visita </h4>
 <ul class="" style="list-style: none; width: 100%; padding-left: 1px;">
 ';
    foreach ($separated as $servicios) { 
        echo '<li   style="text-transform: capitalize; padding-bottom: 9px; padding-top: 9px; border: solid 1px #999;  padding-left: 7px; border-radius: 6px; margin-bottom: 8px;">'.$servicios.' 
        <button class="btn btn-sm btn-primary" style="float: right; position: relative; top: -4px; right: 5px;" onclick="nombreServ(&apos;'.$servicios.'&apos;)" outline="true" type="button"> 
      Seleccionar
      </button>
        </li>';
    }
echo '
</ul>
';    
                                   
