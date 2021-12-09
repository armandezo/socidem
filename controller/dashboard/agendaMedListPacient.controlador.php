<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
 

$id_cod_agenda = $_POST['id'];

$verAgenda = ejecutarSQL::consultar("SELECT `agenda`.`cod_consulta`, `agenda`.`cod_medico`, `agenda`.`fecha_hora`, `agenda`.`fecha_start`, `agenda`.`paciente` FROM `agenda` WHERE `agenda`.`cod_consulta` = '$id_cod_agenda'");

while($datos_agenda_paciente=mysqli_fetch_assoc($verAgenda)){
    $objPaciente=$datos_agenda_paciente['paciente'];
    $fecha_hora_f =$datos_agenda_paciente['fecha_hora'];
    $fecha_start_f = $datos_agenda_paciente['fecha_start'];
    
    $paciente = json_decode($objPaciente, true); 
    $var_nombre = $paciente['nombre_paciente'];
    $var_apellido = $paciente['apellido_paciente'];
    $var_email = $paciente['email_paciente'];
    $var_telefono = $paciente['telefono_paciente'];
    $var_detalle = $paciente['detalles_paciente'];
    $cod_medico = $datos_agenda_paciente['cod_medico'];
    
    $namePac2 = ejecutarSQL::consultar("SELECT `perfil`.`codigo_referido`, `medicos`.`nombre_completo`, `medicos`.`correo` FROM `perfil` , `medicos` WHERE `perfil`.`codigo_referido` = '$cod_medico' AND `medicos`.`correo` = '$correo_'");
    while($dato_medico_dash=mysqli_fetch_assoc($namePac2)){ 
        $nombre_medico = $dato_medico_dash['nombre_completo']; 
    } 
       $eow = mysqli_num_rows($namePac2 );

    $nombre_medico_format = str_replace(' ', '%20', $nombre_medico);
    
    $texto_medico = "*%0A%0A*Medico:*%20".$nombre_medico_format;
    $fecha_hora = "%0A%0A*Fecha:*%20".$fecha_start_f."%0A%0A*Hora:*%20".$fecha_hora_f."";
    // $datos_sala = "%0A%0A*Password:*%20".$pass_room_paciente."";
    $datos_sala = "";
    $link_sala = "%0A%0A*LINK:*%20http://localhost/socidem/lobby-".$id_cod_agenda."";
    $nota_sala = "%0A%0A*Nota:*%20Debera+ser+puntual+en+la+hora+de+la+cita.";
    $final_sala = "%0A%0A*Atentamente+Medicos+en+Directo.*";
    
    $texto_saludo = "&amp;text=*HOLA+SU+CITA+HA+SIDO+APROBADA.".$texto_medico.$fecha_hora.$datos_sala.$link_sala.$nota_sala.$final_sala;
    
    $base = "https://api.whatsapp.com/send?phone=51".$var_telefono.$texto_saludo;
} 




echo '
  
<div class="row form-row">
    <div class="col-12 col-sm-6">
        <div class="form-group">
            <label>Nombre Paciente</label>
            <input type="text" class="form-control" value="'.$var_nombre.'">
        </div>
    </div>
    <div class="col-12 col-sm-6">
        <div class="form-group">
            <label>Apellido Paciente</label>
            <input type="text"  class="form-control" value="'.$var_apellido.'">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Email Paciente</label>
           
                <input type="text" class="form-control" value="'.$var_email.'">
            
        </div>
        <button type="button" onclick="enviarCorreo(&apos;'.$id_cod_agenda.'&apos;)" class="btn btn-primary btn-block" >
            <i class="far fa-envelope" ></i> 
             Enviar Correo</button>
    </div>
    <div class="col-12 col-sm-6">
        <div class="form-group">
            <label>Telefono Paciente</label>
            <input type="email" class="form-control" value="'.$var_telefono.'">
        </div>
        <a href="'.$base.'" target="_blank"  class="btn btn-primary btn-block"  style="background: green; color:white;"  >
            <i class="fab fa-whatsapp"></i>
            Enviar WhatsApp</a>
    </div>
    
    <div class="col-12 ">
    <br>
        <div class="form-group">
            <label>Detalles</label>
            <textarea  class="form-control">'.$var_detalle.'</textarea>
        </div>
    </div>
    
</div>
 
    
';

