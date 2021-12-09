<?php 
if($routes[1] == "doctores"){
    echo '<div class="col-md-12 d-flex">';
}else {
    echo '<div class="col-md-12 d-flex">';
}
$fecha_lunes =  date('Y-m-d', strtotime('-1 week last monday'));

$fecha_domingo = date('Y-m-d', strtotime('-1 week next sunday'));
?> 
    <style>
    
        .inv-badge {
            color: #fff;
            display: inline-flex;
            font-size: 11px;
            justify-content: center;
            min-width: 80px;
            width: fit-content;
            margin-left: 46px;
        }

    </style>
    <!-- Recent Orders -->
    <!-- <div class="card card-table flex-fill">
        <div class="card-header" style="display: inline-flex;">
            <h4 class="card-title">Nomina de Doctores <br>  Inicia (<?=$fecha_lunes?>) Termina (<?=$fecha_domingo ?>)</h4> 
            <a class="btn btn-sm bg-info-light" style="<?= $routes[1] == "doctores" ? 'margin-left: 48%;' : 'margin-left: 48%;' ?>" href="adminP/controller/doctoresExcel.controlador.php">
            <i class="fe fe-vector"></i> Exportar
            </a> -->

            <!-- <a class="btn btn-sm bg-info-light" style="<?= $routes[1] == "doctores" ? '' : '' ?>" onclick="pagarNomina('<?=date('m/Y')?>')">
            <i class="fe fe-money"></i> Pagar
            </a> -->
            
        <!-- </div> -->
       
        <div class="card-body">
            <div class="table-responsive">
                <table class="table mb-0 table-hover table-center" id="doc-table">
                    <thead>
                        <tr>
                            <th>Nombre Doc.</th>  
                            <th>Membresia</th> 
                            <th>Acciones</th> 
                        </tr>
                    </thead>
                    <tbody>
                     <?php  
                     $count = 0;
                    while( $datos_listaMed =mysqli_fetch_assoc($listaMedConsProf )){ 
                    $nombre_completo = $datos_listaMed['nombre_completo'];  
                    $foto = $datos_listaMed['foto'];  
                    $estado = $datos_listaMed['estado'];  
                    $codigo_referido = $datos_listaMed['codigo_referido'];  
                    $periodo_membresia = $datos_listaMed['periodo_membresia'];  
                    $membresia = $datos_listaMed['membresia']; 
                    $fecha_mes_ceros = date("m");
                    $fecha_busqueda = $fecha_mes_ceros."/".date("Y");

                     $fecha_lunes =  date('Y-m-d', strtotime('-1 week last monday'));

                     $fecha_domingo = date('Y-m-d', strtotime('-1 week next sunday'));
                    
                    // $fecha_compare = strtotime($referidos_detalle['fecha']);
                    // `pagos_membresias`.`fecha` BETWEEN '$fecha_lunes' AND '$fecha_domingo'

                    $consult_agenda = ejecutarSQL::consultar("SELECT `agenda`.*, `agenda`.`cod_medico`, `agenda`.`fecha_start` BETWEEN '$fecha_lunes' AND '$fecha_domingo' FROM `agenda` WHERE `agenda`.`cod_medico` = '$codigo_referido'");
                    
                   $num_rows_agendas = mysqli_num_rows($consult_agenda);
                    
                    
                    while( $datos_consult_agenda =mysqli_fetch_assoc($consult_agenda)){   

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
                    `pagos_membresias`.`estado` = 'approved' AND `pagos_membresias`.`token_referido` = '$codigo_referido' AND `pagos_membresias`.`fecha` BETWEEN '$fecha_lunes' AND '$fecha_domingo'");

                    while( $referidos_total =mysqli_fetch_assoc($cons_total_ref)){   
                    $total_ref = $referidos_total['total'];

                    }

                    $subtotal = $monto_total + $total_ref;

                    $consult_pago = ejecutarSQL::consultar("SELECT `pagos_medicos`.`cod_med`, `pagos_medicos`.`fecha` FROM `pagos_medicos` WHERE `pagos_medicos`.`cod_med` = '$codigo_referido' AND `pagos_medicos`.`fecha` BETWEEN '$fecha_lunes' AND '$fecha_domingo'");
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
  
                              
                        </td>
                        
                        
                        
                        <td class="text-center">

                        <div class="actions">
                        
                            <a class="btn btn-sm bg-success-light"  href="adminDash-doctor-'.$codigo_referido.'"  ">
                                <i class="fe fe-eye"></i> Verificar Medico
                            </a>
                        </div>

                        </td>
                        
                        </tr>
                ';
                    
                    }
                      
                     ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /Recent Orders -->

</div>