<div class="main-wrapper">
    <?php
    include 'adminP/seguridad/session_interna.php';
    include 'adminP/componentes/header_dash.php';
    include 'adminP/componentes/sidebar.php';
    ?>

    <div class="page-wrapper">

        <div class="content container-fluid">
        <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Perfil de cita</h3>

                    </div>
                </div>
            </div>
           
                <?php

                $consult_medico_unit = ejecutarSQL::consultar("SELECT `perfil`.`codigo_referido`, `perfil`.`correo`, `perfil`.`telefono`, `medicos`.`nombre_completo`, `perfil`.`foto`, `perfil`.`ubicacion`, `medicos`.`membresia`, `medicos`.`periodo_membresia`, `medico_bank`.`cci` FROM `perfil`, `medicos`, `medico_bank` WHERE `perfil`.`codigo_referido` = '$routes[2]' AND `perfil`.`correo` = `medicos`.`correo` AND `perfil`.`codigo_referido` = `medico_bank`.`token_medico`");

                while ($datos_medico_unit = mysqli_fetch_assoc($consult_medico_unit)) {

                    $nombre_completo = $datos_medico_unit['nombre_completo'];
                    $foto = $datos_medico_unit['foto'];
                    $cci = $datos_medico_unit['cci'];
                    $correo = $datos_medico_unit['correo'];
                    $telefono = $datos_medico_unit['telefono'];
                    $ubicacion = $datos_medico_unit['ubicacion'];
                    $membresia = $datos_medico_unit['membresia'];
                    $periodo_membresia = $datos_medico_unit['periodo_membresia'];
                    
                }
                ?>
            <div class="row">
            <div class="col-md-12">
                    <div class="profile-header">
                        <div class="row align-items-center">
                            <div class="col-auto profile-image">
                                <a href="javascript:">
                                    <img class="rounded-circle" alt="User Image" src="views/assets/images/medicos/<?= $foto ?>">
                                </a>
                            </div>
                            <div class="col ml-md-n2 profile-user-info">
                                <h4 class="mb-0 user-name" style="text-transform: capitalize;"><?= $nombre_completo ?></h4>
                                <h6 class="text-muted"><?= $correo ?></h6>
                                <h6 class="text-muted"><?= $telefono ?></h6>
                                <div class="user-Location"><i class="fa fa-map-marker"></i> <?= $ubicacion ?></div> 
                                <div class="user-Location"><i class="fa fa-address-card"></i> <?= $membresia . " " . $periodo_membresia . " Meses." ?></div> 
                                <div class="user-Location"><i class="fa fa-credit-card-alt"></i> <?="CCI: ".$cci ?></div> 
                            </div>

                        </div>
                    </div>
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#per_details_tab">HISTORIAL DE PAGOS</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#password_tab">HISTORIAL DE MEMBRESIAS</a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content profile-tab-cont">

                        <!-- Personal Details Tab -->
                        <div class="tab-pane fade show active" id="per_details_tab">

                            <!-- Personal Details -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table mb-0 table-hover table-center" id="doc-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Fecha</th>
                                                            <th>Monto</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php 

                                                    $consult_medico_pago = ejecutarSQL::consultar("SELECT `pagos_medicos`.*, `pagos_medicos`.`cod_med` FROM `pagos_medicos` WHERE `pagos_medicos`.`cod_med` = '$routes[2]';");

                                                    while ($datos_medico_pago = mysqli_fetch_assoc($consult_medico_pago)) {

                                                        $fecha = $datos_medico_pago['fecha'];
                                                        $monto = $datos_medico_pago['monto'];
                                                        $fecha_mod = substr($fecha, 0, 2);
                                                        $fecha_year = substr($fecha, 3, 4);

                                                        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                                                        $fecha_mes = $meses[$fecha_mod-1];


                                                        echo '
                                                            <tr >
                                                                 <td>Pago del mes de '.$fecha_mes.' del '.$fecha_year.'</td>
                                                                 <td>S/. '. $monto .'</td>
                                                            </tr>
                                                        ';
                                                    }


                                                    ?>
                                                    </tbody>

                                                </table>

                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>
                            <!-- /Personal Details -->

                        </div>
                        <!-- /Personal Details Tab -->

                        <!-- Change Password Tab -->
                        <div id="password_tab" class="tab-pane fade">

                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table mb-0 table-hover table-center" id="doc-table2">
                                            <thead>
                                                <tr>
                                                    <th>Cod. Pago</th>
                                                    <th>Fecha de pago</th>  
                                                    <th>Monto Membresia</th>
                                                    <th>Token Descuento</th>
                                                    <th>Descuento</th>
                                                    <th>Total Pagado</th>
                                                    <th>Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 

                                            $consult_medico_membresia = ejecutarSQL::consultar("SELECT `pagos_membresias`.`token_medico`, `pagos_membresias`.*, `pagos_membresias`.`estado`, `membresias`.`precio` FROM `pagos_membresias`, `membresias` WHERE `pagos_membresias`.`token_medico` = '$routes[2]';");

                                            while ($datos_medico_membresia = mysqli_fetch_assoc($consult_medico_membresia)) {

                                            $cod_pago = $datos_medico_membresia['cod_pago'];
                                            $monto_pago = $datos_medico_membresia['monto_pago'];
                                            $token_referido = $datos_medico_membresia['token_referido'];
                                            $monto_reducido_token = $datos_medico_membresia['monto_reducido_token'];
                                            $estado = $datos_medico_membresia['estado'];
                                            $precio_membresia = $datos_medico_membresia['precio'];
                                            $pagoMembresia = $datos_medico_membresia['pagoMembresia'];

                                            if($token_referido == NULL){
                                                $token_ref_resp = "Sin Token";
                                            }else{
                                                $token_ref_resp = $token_referido;
                                            } 

                                            if($monto_reducido_token == NULL){
                                                $token_reducido_resp = "Sin Descuento";
                                            }else{
                                                $token_reducido_resp = $monto_reducido_token;
                                            } 



                                            $objPago = json_decode($pagoMembresia, true);

                                            foreach( $objPago as $key => $val){ 
                                
                                                if($key == "fecha_created"){
                                                    $fecha_cons = strtotime($val);
                                                    $fecha_created = date('d/m/Y', $fecha_cons);

                                                   
                                                } 
                                                
                                            
                                            } 
                                            // $fecha_mod = substr($fecha, 0, 2);
                                            // $fecha_year = substr($fecha, 3, 4);

                                            // $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                                            // $fecha_mes = $meses[$fecha_mod-1];


                                            echo '
                                            <tr >
                                             
                                                <td> '. $cod_pago .'</td>
                                                <td> '. $fecha_created .'</td>
                                                <td> '. $precio_membresia .'</td>
                                                <td> '. $token_ref_resp .'</td>
                                                <td> '. $token_reducido_resp .'</td>
                                                <td> '. $monto_pago .'</td>
                                                <td> '. $estado .'</td>
                                            </tr>
                                            ';
                                            }


                                            ?>
                                            </tbody>

                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Change Password Tab -->

                    </div>
                </div>
            </div>


        </div>
    </div>


</div>