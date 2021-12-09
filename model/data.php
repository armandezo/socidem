<?php  
date_default_timezone_set('America/Lima');
$fecha_nueva = date("d/m/Y"); 
/*=============================================
CONTADOR DE MEDICOS 
=============================================*/
     $medCons = ejecutarSQL::consultar("SELECT * FROM `medicos`");
     $medTotal = mysqli_num_rows($medCons);
/*=============================================
TODAS LAS ESPECIALIDADES 
=============================================*/
     $espeCons = ejecutarSQL::consultar("SELECT * FROM `especialidades`");
/*=============================================
MINIMO Y MAXIMO RANGO DE PRECIOS CONSULTA
=============================================*/
     $maximoCons = ejecutarSQL::consultar("SELECT `perfil`.`precio_consulta` FROM `perfil` ORDER BY `perfil`.`precio_consulta` DESC LIMIT 1");
/*=============================================
BANNER FASHION TRENDS 
=============================================*/
     $listMedicos = ejecutarSQL::consultar("SELECT `medicos`.`nombre_completo`, `perfil`.*, `perfil`.`correo`, `medicos`.`estado` FROM `medicos` , `perfil` WHERE `perfil`.`correo` = `medicos`.`correo` AND `medicos`.`estado` = '1'");
/*=============================================
LISTA DE CONSULTAS PACIENTE ONLINE
=============================================*/
     $listConsultasOnline = ejecutarSQL::consultar("SELECT `agenda`.`cod_medico`, `agenda`.`email_usuario`, `perfil`.*, `agenda`.* FROM `agenda`, `perfil` WHERE `agenda`.`cod_medico` = `perfil`.`codigo_referido` AND `agenda`.`email_usuario` = '$correo_' AND `agenda`.`tipo_cita` = 'online' ORDER BY `agenda`.`fecha_start` DESC");
/*=============================================
LISTA DE CONSULTAS PACIENTE PRESENCIAL
=============================================*/
     $listConsultasPresencial = ejecutarSQL::consultar("SELECT `agenda`.`cod_medico`, `agenda`.`email_usuario`, `perfil`.*, `agenda`.* FROM `agenda`, `perfil` WHERE `agenda`.`cod_medico` = `perfil`.`codigo_referido` AND `agenda`.`email_usuario` = '$correo_' AND `agenda`.`tipo_cita` = 'presencial' ORDER BY `agenda`.`fecha_start` DESC");
/*=============================================
TOTAL DE PACIENTES DASH MEDICO
=============================================*/
     $ConsPacientes = ejecutarSQL::consultar("SELECT DISTINCT `agenda`.`email_usuario`, `agenda`.`cod_medico`, `agenda`.`pago_estado` FROM `agenda` WHERE `agenda`.`cod_medico` = '$codigo_referido_' ");
     $totalPacientes = mysqli_num_rows($ConsPacientes);
/*=============================================
TOTAL DE PACIENTES DASH MEDICO
=============================================*/
     $ConsAgendaDia_total = ejecutarSQL::consultar("SELECT DISTINCT `agenda`.`email_usuario`, `agenda`.`cod_medico`, `agenda`.`pago_estado` FROM `agenda` WHERE `agenda`.`cod_medico` = '$codigo_referido_' AND `agenda`.`pago_estado` = 'approved';");
     $totalAgendaDia_total = mysqli_num_rows($ConsAgendaDia_total);
/*=============================================
LISTA DE CITAS DEL DIA AGENDA DEL MEDICO 
=============================================*/ 
     $consDiaAgendaMed = ejecutarSQL::consultar("SELECT `agenda`.`cod_medico`, `agenda`.`email_usuario`, `perfil`.*, `agenda`.* FROM `agenda`, `perfil` WHERE `agenda`.`cod_medico` = `perfil`.`codigo_referido` AND `agenda`.`cod_medico` = '$codigo_referido_' AND `agenda`.`fecha_start` = '$fecha_nueva' ORDER BY `agenda`.`fecha_start` DESC");
/*=============================================
LISTA DE CITAS GENERALES AGENDA MEDICO
=============================================*/
     $consGenralAgendaMed = ejecutarSQL::consultar("SELECT `agenda`.`cod_medico`, `agenda`.`email_usuario`, `perfil`.*, `agenda`.* FROM `agenda`, `perfil` WHERE `agenda`.`cod_medico` = `perfil`.`codigo_referido` AND `agenda`.`cod_medico` = '$codigo_referido_' ORDER BY `agenda`.`fecha_start` DESC");
/*=============================================
 LISTA DE OPCIONES ORIGINAL
=============================================*/
     $listPacientesMed = ejecutarSQL::consultar("SELECT DISTINCT `agenda`.`email_usuario`, `agenda`.`cod_medico` FROM `agenda` WHERE `agenda`.`cod_medico` = '$codigo_referido_'");
/*=============================================
HISTORICO DE PAGO
=============================================*/
    $historial_full_pago = ejecutarSQL::consultar("SELECT `pagos_medicos`.*, `pagos_medicos`.`cod_med` FROM `pagos_medicos` WHERE `pagos_medicos`.`cod_med` = '$codigo_referido_';");
    $monto_historico = 0;
    while($datos_med_C=mysqli_fetch_assoc($historial_full_pago)){
     $monto_historico += $datos_med_C['monto']; 
    }

/*=============================================
 HISTORIAL SEMANAL CON EXTRAS EN LA SEMANA
=============================================*/ 
     $fecha = date('Y-m-d');
     $fecha_lunes =  date('Y-m-d', strtotime($fecha." monday this week")); 
     $fecha_domingo = date('Y-m-d', strtotime($fecha." sunday this week")); 

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
     `pagos_membresias`.`estado` = 'approved' AND `pagos_membresias`.`token_referido` = '$codigo_referido_' AND `pagos_membresias`.`fecha` BETWEEN '$fecha_lunes' AND '$fecha_domingo'");

     while( $referidos_total =mysqli_fetch_assoc($cons_total_ref)){   
     $total_ref = $referidos_total['total'];

     }

     $historial_semanal_cons = ejecutarSQL::consultar("SELECT `agenda`.`cod_medico`, `agenda`.`pago_estado`, `agenda`.`fecha_start`, SUM(precio_consulta) AS sumatoria_total FROM `agenda` WHERE `agenda`.`cod_medico` = '$codigo_referido_' AND `agenda`.`pago_estado` = 'approved' AND `agenda`.`fecha_start` BETWEEN '$fecha_lunes' AND '$fecha_domingo'");
               
     while ($datos_semana = mysqli_fetch_assoc($historial_semanal_cons)) {  
          $historial_semanal = $datos_semana['sumatoria_total'] +  $total_ref; 
     } 
// /*=============================================
// LISTA DE PRODUCTOS DESTACADOS
// =============================================*/
//     $listVendID = ejecutarSQL::consultar("SELECT `usuarios`.*, `perfil`.*, `perfil`.`tipo` FROM `usuarios` LEFT JOIN `perfil` ON `perfil`.`id` = `usuarios`.`id` WHERE `perfil`.`tipo` = 'destacado';");
// /*=============================================
// LISTA DE PRODUCTOS DESTACADOS
// =============================================*/
//     $menu_orden = ejecutarSQL::consultar("SELECT * FROM `orden_menu` ");
// /*=============================================
// RANGO MAXIMO DE PRECIO ALL PROD
// =============================================*/
//     $rango_max_price = ejecutarSQL::consultar("SELECT `productos`.`precio`, `moneda`.`moneda` FROM `productos`, `moneda` WHERE `productos`.`estado` = '1' ORDER BY `precio` DESC LIMIT 1");
// /*=============================================
// PRODUCTOS COMPRAR NUEVOS SLIDE 1
// =============================================*/
//     $prodShopNew = ejecutarSQL::consultar("SELECT `productos`.*, `moneda`.`moneda`, `productos`.`id` AS idprod  FROM `productos` , `moneda` WHERE `productos`.`estado` = '1' ORDER BY `productos`.`id` DESC LIMIT 0, 3");
// /*=============================================
// PRODUCTOS COMPRAR NUEVOS SLIDE 2
// =============================================*/
//     $prodShopNew2 = ejecutarSQL::consultar("SELECT `productos`.*, `moneda`.`moneda`, `productos`.`id` AS idprod FROM `productos` , `moneda` WHERE `productos`.`estado` = '1' ORDER BY `productos`.`id` DESC LIMIT 3, 3");

   
  

?>
 