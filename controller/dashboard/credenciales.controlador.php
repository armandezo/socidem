<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
 

$id_cod_agenda = $_POST['id'];
 
$verAgenda = ejecutarSQL::consultar("SELECT `agenda`.`cod_consulta`, `agenda`.`pass_room` FROM `agenda` WHERE `agenda`.`cod_consulta` = '$id_cod_agenda'");

while($datos_agenda_paciente=mysqli_fetch_assoc($verAgenda)){
     
    $var_detalle = $datos_agenda_paciente['pass_room'];
} 

echo '
    <h3 style="margin-left: auto;
    margin-right: auto;
    margin-bottom: 35px;">Credenciales de Acceso</h3>
    <div class="col-md-12">
    
        <div class="clinic-booking">
        <p class="apt-btn" >'.$var_detalle.'</p>
        </div>
        <a class="apt-btn btn btn-success-light btn_pass" style="margin-left: auto; margin-right: auto; display: table; background: #007a8e; color: white;" id="btn_pass" href="javascript:"
        data-clipboard-text="'.$var_detalle.'">Copiar Password</a>
    </div>
    
';