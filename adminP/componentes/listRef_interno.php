<?php 
if($routes[1] == "referidosInt"){
    echo '<div class="col-md-12 d-flex">';
}else {
    echo '<div class="col-md-6 d-flex">';
}

?> 

     <!-- Feed Activity -->
     <div class="card card-table flex-fill">
         <div class="card-header">
             <h4 class="card-title">Lista de Referidos Internos
             <a class="btn btn-sm bg-info-light" style="<?= $routes[1] == "referidoInt" ? 'margin-left: 70%;' : 'margin-left: 63%;' ?>" href="adminP/controller/refInternoExcel.controlador.php">
            <i class="fe fe-vector"></i> Exportar
            </a>
             </h4>
         </div>
         <div class="card-body">
             <div class="table-responsive">
                 <table class="table mb-0 table-hover table-center" id="referidos-interno-table">
                     <thead>
                         <tr> 
                             <th>Codigo</th>
                             <th>Tipo</th>
                             <th>Porcentaje</th>
                             <th>Cantidad</th>
                             <th>Estado</th>
                         </tr>
                     </thead>
                     <tbody>
                     <?php  
                    while( $datos_listaRefInterno =mysqli_fetch_assoc($refInternoConsProf)){ 
                    $codigo = $datos_listaRefInterno['codigo'];
                    $tipo = $datos_listaRefInterno['tipo'];  
                    $cantidad = $datos_listaRefInterno['cantidad'];  
                    $porcentaje = $datos_listaRefInterno['porcentaje']; 
                    $status = $datos_listaRefInterno['status']; 
                    
                    if($status == 1){
                        $estado_ = "<span class='badge badge-pill bg-danger inv-badge'>Usado</span>";
                    }else {
                        $estado_ = "<span class='badge badge-pill bg-success inv-badge'>Libre</span>";
                    }
                     
                    echo '
                    <tr> 
                    <td> '.$codigo.' </td> 
                    <td>'. $tipo.'</td> 
                    <td>'. $porcentaje.' %</td>
                    <td>'. $cantidad.'</td>
                    <td>'. $estado_ .'</td>
                    
                    </tr>
                    
                    ';

                    }
                    ?> 
                         
                     </tbody>
                 </table>
             </div>
         </div>
     </div>
     <!-- /Feed Activity -->

 </div>