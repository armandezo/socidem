<?php 
session_start(); 
date_default_timezone_set('America/Lima'); 
error_reporting(E_ALL ^ E_NOTICE);
include '../../model/consulSQL.php';

    $searchByFromdate =  $_POST['fecha'];

    $fecha_martes =  $searchByFromdate; 

    
    $fecha_lunes =  date('Y-m-d', strtotime($searchByFromdate." monday this week")); 
    $fecha_domingo = date('Y-m-d', strtotime($searchByFromdate." sunday this week")); 

    
echo '
<div class="">
Semana desde el Lunes '.$fecha_lunes.' hasta el Domingo '.$fecha_domingo.'
</div>
<table class="table mb-0 table-hover table-center" id="table_hist">
    <thead>
        <tr>
        <th>Nombre Doc.</th>  
        <th>Membresia</th>
        <th>Monto</th> 
        <th>Estado</th> 
        <th>Acciones</th> 
            
        </tr>
    </thead>
    <tbody > 
';
 

  $listaMedConsProf = ejecutarSQL::consultar("SELECT `medicos`.`nombre_completo`, `medicos`.`correo`,  `medicos`.`estado`, `medicos`.`periodo_membresia`, `medicos`.`membresia`, `perfil`.`foto`, `perfil`.`codigo_referido` FROM `medicos` , `perfil` WHERE `medicos`.`correo` = `perfil`.`correo`");

  $count = 0;
 
  while( $datos_listaMed =mysqli_fetch_assoc($listaMedConsProf)){ 
  $nombre_completo = $datos_listaMed['nombre_completo'];  
  $foto = $datos_listaMed['foto'];  
  $estado = $datos_listaMed['estado'];  
  $codigo_referido = $datos_listaMed['codigo_referido'];  
  $periodo_membresia = $datos_listaMed['periodo_membresia'];  
  $membresia = $datos_listaMed['membresia']; 
 
  
  // $fecha_compare = strtotime($referidos_detalle['fecha']);
  // `pagos_membresias`.`fecha` BETWEEN '$fecha_lunes' AND '$fecha_domingo'
  $consult_agenda_2 = ejecutarSQL::consultar("SELECT `agenda`.*, `agenda`.`cod_medico`, `agenda`.`fecha_start` FROM `agenda` WHERE `agenda`.`cod_medico` = '$codigo_referido' AND `agenda`.`fecha_start` BETWEEN '$fecha_lunes' AND '$fecha_domingo'");
  
  $num_rows_agendas = mysqli_num_rows($consult_agenda_2);
  
  
  while( $datos_consult_agenda =mysqli_fetch_assoc($consult_agenda_2)){   

          $objAgenda = json_decode($datos_consult_agenda['cita'], true);

          foreach( $objAgenda as $key => $val){ 

              if($key == "status"){

                  if($val == "approved"){  
                     $monto_total += $datos_consult_agenda['precio_consulta']; 
                     
                  }
                   
              } 

             
          } 

       

     

  }
  
  if($num_rows_agendas == 0)
  {
      $monto_total = 0.00;
  }

  $cons_total_ref = ejecutarSQL::consultar("SELECT
  `pagos_membresias`.`estado`,
  `pagos_membresias`.`token_referido`, 
  `pagos_membresias`.`monto_reducido_token`,
  `pagos_membresias`.`token_referido`,
  `pagos_membresias`.`fecha`,
  `pagos_membresias`.`token_medico`,
  SUM(monto_reducido_token) AS total
  FROM
  `pagos_membresias`
  WHERE
  `pagos_membresias`.`estado` = 'approved' AND `pagos_membresias`.`token_referido` = '$codigo_referido' AND `pagos_membresias`.`fecha` BETWEEN '$fecha_lunes' AND '$fecha_domingo' ");

  while( $referidos_total =mysqli_fetch_assoc($cons_total_ref)){   
  $total_ref = $referidos_total['total'];

  }

  $subtotal = $monto_total + $total_ref ;

  $consult_pago = ejecutarSQL::consultar("SELECT `pagos_medicos`.`cod_med`, `pagos_medicos`.`fecha` FROM `pagos_medicos` WHERE `pagos_medicos`.`cod_med` = '$codigo_referido' AND `pagos_medicos`.`fecha` BETWEEN '$fecha_lunes' AND '$fecha_domingo' ");
  $consult_pago_num = mysqli_num_rows($consult_pago);



  if($consult_pago_num > 0){
      $estado_pago = "Pagado";
      $switch_estado = "checked"; 
  }else {
      $estado_pago = "No pagado";
      $switch_estado = ""; 
  }
  echo '
      <tr > 
      <td style="display: inline-grid;">
          <h2 class="table-avatar">
              <a href="adminDash-doctor-'.$codigo_referido.'" class="mr-2 avatar avatar-sm">
              <img class="avatar-img rounded-circle" style="margin-top: 15px;"  src="views/assets/images/medicos/'.$foto.'" alt="User Image"></a>
              <a href="adminDash-doctor-'.$codigo_referido.'" style="text-transform: capitalize;">'.$nombre_completo.'</a>   
          </h2>  
          ';
          if($membresia != "Profesional"){
              echo '<span class="badge badge-pill bg-danger inv-badge"> ';
          }else {
              if($estado == 1){
                  echo '<span class="badge badge-pill bg-success inv-badge"> ';
              }else {
                  echo '<span class="badge badge-pill bg-info inv-badge"> ';
              }
             
          } 
          echo '   
          '.$periodo_membresia.' Meses</span>
      </td> 
      <td class="text-left">
      ';
          if($membresia != "Profesional"){
              echo '<span class="badge badge-pill bg-danger inv-badge"> Gratuita </span>';
          }else {
              if($estado == 1){
                  echo '<span class="badge badge-pill bg-success inv-badge">Profesional verificado </span>';
              }else {
                  echo '<span class="badge badge-pill bg-info inv-badge">Profesional no verificado </span>';
              }
             
          } 
      echo '
      
       </td>

      <td class="text-left">S/. '.$subtotal.' </td>
      
      <td class="text-left">
      ';
          if($estado_pago != "Pagado"){
              echo '<span class="badge badge-pill bg-danger inv-badge">No Pagado</span>';
          }else {
              echo '<span class="badge badge-pill bg-info inv-badge">Pagado</span>';
          } 


      
      $count++;
      echo '   
            
      </td>
      
      
      
      <td class="text-left">
          <div class="status-toggle">
          <input type="checkbox" value="'.$codigo_referido.'" id="status_'.$count.'" class="check" '.$switch_estado.' >
          <label for="status_'.$count.'" class="checktoggle"  onclick="pagarNominaUnit(&quot;'.$codigo_referido.'&quot; , &quot;'.$fecha_martes.'&quot; , &quot;'.$count.'&quot; )" >checkbox</label>
          </div>
      </td>
      
      </tr>
';
  
  }

  echo '
  </tbody>
  </table>
  ';
