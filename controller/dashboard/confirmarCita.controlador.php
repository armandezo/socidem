<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
 
 
$id_cod_agenda = $_POST['id'];

$verAgenda = ejecutarSQL::consultar("SELECT `agenda`.`cod_consulta`, `agenda`.`fecha_start`, `agenda`.`fecha_hora`,  `agenda`.`cod_medico`,  `agenda`.`nombre_room`, `agenda`.`pass_room`, `agenda`.`tipo_cita`, `agenda`.`paciente` FROM `agenda` WHERE `agenda`.`cod_consulta` = '$id_cod_agenda'");

while($datos_agenda_paciente=mysqli_fetch_assoc($verAgenda)){
    $objPaciente=$datos_agenda_paciente['paciente'];
    $tipo_cita_paciente=$datos_agenda_paciente['tipo_cita'];
    $cod_medico =$datos_agenda_paciente['cod_medico'];

    $fecha_start =$datos_agenda_paciente['fecha_start'];
    $fecha_end =$datos_agenda_paciente['fecha_hora'];
    
    $nombre_room_paciente=$datos_agenda_paciente['nombre_room'];
    $pass_room_paciente=$datos_agenda_paciente['pass_room'];
    $paciente = json_decode($objPaciente, true); 
    $var_nombre = $paciente['nombre_paciente'];
    $var_apellido = $paciente['apellido_paciente'];
    $var_email = $paciente['email_paciente'];
    $var_telefono = $paciente['telefono_paciente'];
    $var_detalle = $paciente['detalles_paciente'];
 
    $namePac2 = ejecutarSQL::consultar("SELECT `perfil`.`codigo_referido`, `medicos`.`nombre_completo`, `medicos`.`correo` FROM `perfil` , `medicos` WHERE `perfil`.`codigo_referido` = '$cod_medico' AND `medicos`.`correo` = '$correo_'");
    while($dato_medico_dash=mysqli_fetch_assoc($namePac2)){ 
        $nombre_medico = $dato_medico_dash['nombre_completo']; 
    } 
     
    $fechaEntera = strtotime($fecha_start);
    $fecha_anual_format = date("Y/m/d", $fechaEntera);
    $fecha_init = strtotime($fecha_start);
    $fecha_fin = strtotime($fecha_end);

    $init = date("g:ia", $fecha_init);
    $end = date("g:ia", $fecha_fin);
    
    $nombre_medico_format = str_replace(' ', '%20', $nombre_medico);
    
    $texto_medico = "*%0A%0A*Medico:*%20".$nombre_medico_format;
    $fecha_hora = "%0A%0A*Fecha:*%".$fecha_anual_format."%0A%0A*Hora:*%20".$init."%20".$end."";
    $datos_sala = "%0A%0A*Nombre+de+la+Sala:*%20".$nombre_room_paciente."%0A%0A*Password:*%20".$pass_room_paciente."";
    $link_sala = "%0A%0A*LINK:*%20https://medicos.stampiza2.com/lobby-".$id_cod_agenda."";
    $nota_sala = "%0A%0A*Nota:*%20Debera+ser+puntual+en+la+hora+de+la+cita.";
    $final_sala = "%0A%0A*Atentamente+Medicos+en+Directo.*";
    
    $texto_saludo = "&amp;text=*HOLA+SU+CITA+HA+SIDO+APROBADA.".$texto_medico.$fecha_hora.$datos_sala.$link_sala.$nota_sala.$final_sala;
    
    $base = "https://api.whatsapp.com/send?phone=51".$var_telefono.$texto_saludo;
}     
 
// <span class="form-text text-danger">No Notificado</span>
// <span class="form-text text-danger">No Notificado</span>
// <span class="mr-2 spinner-border spinner-border-sm" role="status" style="position: relative; top: -3px;"></span>

switch ($tipo_cita_paciente) {
    case "online":
      echo '
      <form class="theme-form" id="update-video-conf" action="controller/dashboard/upVideoConf.controlador.php" method="post"
      role="form"  >
      <div class="res-update animated fadeInDown"></div>
     
        
             <span style="margin-left: auto; margin-right: auto; font-weight: 600;">Datos de Contacto</span><br><br>
            <div class="row form-row">
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label>Telefono Paciente  </label>
                    <input type="text"  class="form-control" value="'.$var_telefono.'" readonly>
                   
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="form-group">
                    <label>Correo Paciente </label>
                    <input type="text"  class="form-control" value="'.$var_email.'" readonly>
                   
                </div>
            </div>
            <div class="col-12 col-sm-6">
 

            
        
            <a href="'.$base.'" target="_blank"  class="btn btn-primary btn-block"  style="background: green; color:white;"  >
            <i class="fab fa-whatsapp"></i>
            Enviar WhatsApp</a>
            </div>
            <div class="col-12 col-sm-6">
            <button type="button" onclick="enviarCorreo(&apos;'.$id_cod_agenda.'&apos;)" class="btn btn-primary btn-block" >
            <i class="far fa-envelope" ></i> 
             Enviar Correo</button>
            </div>
            <br><br><br>
            <span class=""><strong >Nota: </strong>Al cerrar la cita se dara por terminado la sala de videoconferencia; De lo contrario podra seguir accediendo a dicha sala!</span><br 
            <br><br>
            </div>
       
        </div>
        
        <button type="button" onclick="updateRoom(&apos;'.$id_cod_agenda.'&apos;)" class="btn btn-block" style="background: #0d3355; color: white;" >Cerrar Cita</button>
        </form>
      ';
        break;
    
    case "presencial":

        echo '
        <form class="theme-form" id="update-presencial-cita" action="controller/dashboard/upPresencialCita.controlador.php" method="post"
        role="form"  >
        <div class="res-update animated fadeInDown"></div>
         <span style="margin-left: auto; margin-right: auto; font-weight: 600;">Datos de Confirmación</span><br><br>
              <div class="row form-row">
              <div class="col-12 col-sm-6">
                  <div class="form-group">
                      <label>Telefono Paciente  </label>
                      <input type="hidden" name="id_presencial"  value="'.$id_cod_agenda.'">
                      <input type="text"  class="form-control" value="'.$var_telefono.'" readonly>
                     
                  </div>
              </div>
              <div class="col-12 col-sm-6">
                  <div class="form-group">
                      <label>Correo Paciente </label>
                      <input type="text"  class="form-control" value="'.$var_email.'" readonly>
                     
                  </div>
              </div>
              <div class="col-12 col-sm-6">
   
  
              
          
              <a href="'.$base.'" target="_blank"  class="btn btn-primary btn-block"  style="background: green; color:white;"  >
              <i class="fab fa-whatsapp"></i>
              Enviar WhatsApp</a>
              </div>
              <div class="col-12 col-sm-6">
              <button type="button" onclick="enviarCorreo(&apos;'.$id_cod_agenda.'&apos;)" class="btn btn-primary btn-block" >
              <i class="far fa-envelope" ></i> 
               Enviar Correo</button>
              </div>
              <br><br><br>
              <span class=""><strong >Nota: </strong>si no tiene un nombre y contraseña la sala no podrá ser accedida por el paciente.</span><br 
          </div>
         
          </div>
          
          <button type="button" onclick="updatePresencialCita()" class="btn btn-block" style="background: #0d3355; color: white;" >Aprobar Cita</button>
          </form>
        ';
        break;
}



// echo '
  
// <div class="row form-row">
//     <div class="col-12 col-sm-6">
//         <div class="form-group">
//             <label>Nombre Paciente</label>
//             <input type="text" class="form-control" value="'.$tipo_cita_paciente.'">
//         </div>
//     </div>
//     <div class="col-12 col-sm-6">
//         <div class="form-group">
//             <label>Apellido Paciente</label>
//             <input type="text"  class="form-control" value="'.$var_apellido.'">
//         </div>
//     </div>
//     <div class="col-sm-6">
//         <div class="form-group">
//             <label>Email Paciente</label>
//             <div class="cal-icon">
//                 <input type="text" class="form-control" value="'.$var_email.'">
//             </div>
//         </div>
//     </div>
//     <div class="col-12 col-sm-6">
//         <div class="form-group">
//             <label>Telefono Paciente</label>
//             <input type="email" class="form-control" value="'.$var_telefono.'">
//         </div>
//     </div>
//     <div class="col-12 ">
//         <div class="form-group">
//             <label>Detalles</label>
//             <textarea  class="form-control">'.$var_detalle.'</textarea>
//         </div>
//     </div>
    
// </div>
 
    
// ';

