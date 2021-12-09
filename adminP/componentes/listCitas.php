
 
<div class="col-md-12">

    <!-- Recent Orders -->
    <div class="card card-table" style="    margin-left: 44px;
    margin-right: 44px;">
        <div class="card-header">
            <h4 class="card-title">Historial de citas
                <a class="btn btn-sm bg-info-light" style="<?= $routes[1] == "citas" ? 'margin-left: 70%;' : 'margin-left: 72%;' ?>" href="adminP/controller/citasExcel.controlador.php">
                    <i class="fe fe-vector"></i> Exportar
                </a>
            </h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table mb-0 table-hover table-center" id="citas-table">
                    <thead>
                        <tr>
                            <th>Nombre Doc.</th>
                            <th>Paciente</th>
                            <th>Cita</th>
                            <th>Estatus Pago</th>
                            <th>Monto</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($datos_agenda_citas = mysqli_fetch_assoc($agendaConsProf)) {

                            $cod_medico = $datos_agenda_citas['cod_medico'];
                            $fecha_start = $datos_agenda_citas['fecha_start'];
                            $precio_consulta = $datos_agenda_citas['precio_consulta'];
                            $fecha_hora = $datos_agenda_citas['fecha_hora'];
                            $fecha_hora_end = $datos_agenda_citas['fecha_hora_end'];
                            $pago_estado = $datos_agenda_citas['pago_estado'];
                            $cod_consulta = $datos_agenda_citas['cod_consulta'];

                            if ($pago_estado == "approved") {
                                $estado_final = '<span class="badge badge-pill bg-success inv-badge" style="margin-left: 0px!important;">Aprovado</span>';
                            } elseif ($pago_estado == "pending") {
                                $estado_final = '<span class="badge badge-pill bg-warning inv-badge" style="margin-left: 0px!important;">Pendiente</span>';
                            } elseif ($pago_estado == "404") {
                                $estado_final = '<span class="badge badge-pill bg-error inv-badge" style="margin-left: 0px!important;">Error 404</span>';
                            }

                            $objPaciente = json_decode($datos_agenda_citas['paciente'], true);

                            $consult_medico_cita = ejecutarSQL::consultar("SELECT `perfil`.`codigo_referido`, `perfil`.`correo`,  `perfil`.`foto`, `medicos`.`nombre_completo` FROM `perfil` , `medicos` WHERE `perfil`.`codigo_referido` = '$cod_medico' AND `perfil`.`correo` = `medicos`.`correo` ");

                            while ($datos_consult_medico_cita = mysqli_fetch_assoc($consult_medico_cita)) {

                                $nombre_completo = $datos_consult_medico_cita['nombre_completo'];
                                $foto = $datos_consult_medico_cita['foto'];
                            }

                            foreach ($objPaciente as $key => $val) {

                                if ($key == "nombre_paciente") {
                                    $nombre_paciente = $val;
                                }

                                if ($key == "apellido_paciente") {
                                    $apellido_paciente = $val;
                                }

                                $nombre_paciente_completo = $nombre_paciente . " " . $apellido_paciente;
                            }

                            echo '
                        
                        <tr>
                            <td>
                                <h2 class="table-avatar">
                                    <a href="adminDash-doctor-' . $cod_medico . '" class="mr-2 avatar avatar-sm">
                                    <img class="avatar-img rounded-circle" src="views/assets/images/medicos/' . $foto . '" alt="User Image"></a>
                                    <a href="adminDash-doctor-' . $cod_medico . '">' . $nombre_completo . '</a>
                                </h2>
                            </td>

                            <td>
                                <h2 class="table-avatar"> 
                                    ' . $nombre_paciente_completo . '  
                                </h2>
                            </td>
                            <td>' . $fecha_start . ' <span class="text-primary d-block">' . $fecha_hora . ' - ' . $fecha_hora_end . '</span>
                            </td>
                            <td class="text-left">
                                ' . $estado_final . '
                            </td>
                            <td class="">
                                S/. ' . $precio_consulta . '
                            </td>
                            <td class="text-center">

                                <div class="actions">
                                
                                    <a class="btn btn-sm bg-success-light" data-toggle="modal" href="#edit_personal_details" onclick="verPago(&quot;'.$cod_consulta.'&quot;) " ">
                                        <i class="fe fe-eye"></i> Ver pago
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

<div class="modal fade" id="edit_personal_details" aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles del pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                    <div class="row form-row" id="print_pago">
                      
                    </div>
                    
                 
            </div>
        </div>
    </div>
</div>