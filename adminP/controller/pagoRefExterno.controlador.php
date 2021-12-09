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
        <th>Codigo</th>
        <th>Razon Social</th>  
        <th>Tipo Doc.</th>
        <th>Num Doc.</th> 
        <th>Correo</th> 
        <th>Total</th> 
        <th>Estado</th> 
        <th>Acciones</th> 
            
        </tr>
    </thead>
    <tbody > 
';
 

  $listaMedConsProf = ejecutarSQL::consultar("SELECT `referidos_externos`.*, `referidos_externos`.`status` FROM `referidos_externos` WHERE `referidos_externos`.`status` = '1';");

  $count = 0;
 
  while( $datos_listaMed =mysqli_fetch_assoc($listaMedConsProf)){ 
  $razon = $datos_listaMed['razon'];  
  $tipo = $datos_listaMed['tipo'];  
  $documento = $datos_listaMed['documento']; 
  $status = $datos_listaMed['status'];  
  $codigo = $datos_listaMed['codigo'];  
  $correo = $datos_listaMed['correo'];  
  $cci = $datos_listaMed['cci']; 
  $count++;

 
  $consult_pago = ejecutarSQL::consultar("SELECT `pagos_externos`.*, `pagos_externos`.`cod_externo`, `pagos_externos`.`fecha` FROM `pagos_externos` WHERE `pagos_externos`.`cod_externo` = '$codigo' AND `pagos_externos`.`fecha` BETWEEN '$fecha_lunes' AND '$fecha_domingo';");
  $consult_pago_num = mysqli_num_rows($consult_pago);

  if($consult_pago_num > 0){
      $estado_pago = "Pagado";
      $switch_estado = "checked"; 
  }else {
      $estado_pago = "No pagado";
      $switch_estado = ""; 
  }
  
  $cons_total_ref = ejecutarSQL::consultar(" SELECT `pagos_membresias`.`estado`, `pagos_membresias`.`token_referido`, `pagos_membresias`.`monto_reducido_token`, `pagos_membresias`.`token_referido`, `pagos_membresias`.`fecha`, `pagos_membresias`.`token_medico` FROM `pagos_membresias` WHERE `pagos_membresias`.`estado` = 'approved' AND `pagos_membresias`.`token_referido` = '$codigo' AND `pagos_membresias`.`fecha` BETWEEN '$fecha_lunes' AND '$fecha_domingo' ");

  $consult_num_membresias = mysqli_num_rows($cons_total_ref);
  
  $total_pago = $consult_num_membresias * 250;


  
    echo '
    <tr >     
            <td>'.$codigo.'</td>
            <td>'.$razon.'</td>
            <td>'.$tipo.'</td>
            <td>'.$documento.'</td>
            <td>'.$correo.'</td>
            <td>S/.'.$total_pago.'</td>
            <td  class="text-left">
            ';
            if($estado_pago != "Pagado"){
                echo '<span class="badge badge-pill bg-danger inv-badge">No Pagado</span>';
            }else {
                echo '<span class="badge badge-pill bg-info inv-badge">Pagado</span>';
            }
            echo '
            </td>
            
            <td>

            
            <div class="status-toggle">
                <input type="checkbox" value="'.$codigo.'" id="status_'.$count.'" class="check" '.$switch_estado.' >
                <label for="status_'.$count.'" class="checktoggle"  onclick="pagarRefUnit(&quot;'.$codigo.'&quot; , &quot;'.$fecha_martes.'&quot; , &quot;'.$count.'&quot; )" >checkbox</label>
                </div> 
            </td>
    </tr>
    
    ';
  }

  echo '
  </tbody>
  </table>
  ';
