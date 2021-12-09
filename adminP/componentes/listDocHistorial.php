<?php
if ($routes[1] == "historial") {
    echo '<div class="col-md-12 d-flex">';
} else {
    echo '<div class="col-md-12 d-flex">';
}
$fecha_lunes =  date('Y-m-d', strtotime($searchByFromdate." monday this week")); 
$fecha_domingo = date('Y-m-d', strtotime($searchByFromdate." sunday this week")); 
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

        .bootstrap-datetimepicker-widget tr:hover {
        background-color: #00d0f1;
        color: black;
       
        }

    </style>
    <!-- Recent Orders -->
    <div class="card card-table flex-fill">
        <div class="card-header" style="display: inline-flex;">
            <h4 class="card-title" >Historial de Doctores <br>  Semana Actual (<?=$fecha_lunes?>) <br> Semana Termina (<?=$fecha_domingo?>)</h4>
            <!-- <a class="btn btn-sm bg-info-light" style="<?=$routes[1] == "doctores" ? 'margin-left: 48%;' : 'margin-left: 48%;'?>" href="adminP/controller/doctoresExcel.controlador.php">
            <i class="fe fe-vector"></i> Exportar
            </a> -->

            <!-- <a class="btn btn-sm bg-info-light" style="<?=$routes[1] == "doctores" ? '' : ''?>" onclick="pagarNomina('<?=date('m/Y')?>')">
            <i class="fe fe-money"></i> Pagar
            </a> -->

        </div> 
        <div class="col-md-12" style="margin-bottom: -80px;">
                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3 input-group">
                            <div class="input-group-prepend">
                                <span class="text-white input-group-text bg-info" id="basic-addon1"><i
                                        class="fa fa-calendar"></i></span>
                            </div>
                            <input type="text" class="form-control"  id="weeklyDatePicker" >
                        </div>
                    </div>
                    <div class="col-md-3" style="padding-top: 4px;">
                    <button class="btn btn-success btn-sm" onclick="table_row()">Buscar</button>
                    <button onclick="table_export()" class="btn btn-info btn-sm">Exportar</button>
                    <button  onclick="remove_table()" class="btn btn-danger btn-sm">Limpiar</button>
                    </div>
                    <div id="tabla_exp"></div>
                </div>
                
                <br>
                <br>
        
            </div>
        </div>

        
    </div>
    <!-- /Recent Orders -->
   

    <div class="card-body">
             <div class="table-responsive" id="tabla_ref">
                 
             </div>
         </div>
                     
</div>
