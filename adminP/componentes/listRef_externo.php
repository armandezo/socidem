<?php 
if($routes[1] == "referidosExt"){
    echo '<div class="col-md-12 d-flex">';
}else {
    echo '<div class="col-md-6 d-flex">';
}

?> 

     <!-- Feed Activity -->
     <div class="card card-table flex-fill">
         <div class="card-header">
             <h4 class="card-title">Lista de Referidos Externos
             <a class="btn btn-sm bg-info-light" style="<?= $routes[1] == "referidoExt" ? 'margin-left: 70%;' : 'margin-left: 63%;' ?>" href="adminP/controller/refExternoExcel.controlador.php">
            <i class="fe fe-vector"></i> Exportar
            </a>
             </h4>
         </div>
         <div class="card-body">
             <div class="table-responsive">
                 <table class="table mb-0 table-hover table-center" id="referidos-table">
                     <thead>
                         <tr>
                             <th>Tipo</th>
                             <th>Documento</th>
                             <th>Codigo</th>
                             <th>Correo</th>
                             <th>Razon Soc.</th>
                             <th>CCI</th>
                             
                         </tr>
                     </thead>
                     <tbody>
                     <?php  
                    while( $datos_listaRefExternos =mysqli_fetch_assoc($refExternosConsProf)){
                    $tipo = $datos_listaRefExternos['tipo']; 
                    $documento = $datos_listaRefExternos['documento'];
                    $correo = $datos_listaRefExternos['correo'];  
                    $codigo = $datos_listaRefExternos['codigo'];  
                    $razon = $datos_listaRefExternos['razon'];
                    $cci = $datos_listaRefExternos['cci'];    
                    $status = $datos_listaRefExternos['status'];  
                     
                    echo '
                    <tr>
                    <td> '.$tipo.' </td> 
                    <td> '.$documento.' </td> 
                    <td> '.$codigo.' </td> 
                    <td>'. $correo.'</td>
                    <td>'. $razon.'</td>
                    <td>'. $cci.'</td>
                    
                    
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