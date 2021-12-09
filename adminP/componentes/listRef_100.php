<?php 
if($routes[1] == "referidos100"){
    echo '<div class="col-md-12 d-flex">';
}else {
    echo '<div class="col-md-6 d-flex">';
}
$count = 0;
?> 

     <!-- Feed Activity -->
     <div class="card card-table flex-fill">
         <div class="card-header">
             <h4 class="card-title">Lista de Referidos al 100%
             <a href="adminP/controller/ref100Excel.controlador.php"  class="float-right mt-2 ml-3 btn btn-primary"><i class="fe fe-vector"></i> Exportar</a>
             <a href="#add_ref" data-toggle="modal" class="float-right mt-2 btn btn-primary"><i class="fe fe-plus"></i> Crear Nuevo</a>
             <!-- <a class="btn btn-sm bg-info-light" style="<?= $routes[1] == "referido100" ? 'margin-left: 70%;' : 'margin-left: 63%;' ?>" > -->
             
             </h4>
         </div>
         <div class="card-body">
             <div class="table-responsive">
                 <table class="table mb-0 table-hover table-center" id="referidos-100">
                     <thead>
                         <tr> 
                             <th style="width: 26px!important;">Nro</th>
                             <th>Codigo</th>   
                             <th>Porcentaje</th>
                             <th>Caducidad</th>
                             <th>Estado</th>
                             <th>Acciones</th>
                         </tr>
                     </thead>
                     <tbody>
                     <?php  
                    while( $datos_listaRefInterno =mysqli_fetch_assoc($refPorcentajeConsProf)){ 
                    $codigo = $datos_listaRefInterno['codigo'];
                    $tipo = $datos_listaRefInterno['tipo'];  
                    $cantidad = $datos_listaRefInterno['cantidad'];  
                    $porcentaje = $datos_listaRefInterno['porcentaje']; 
                    $status = $datos_listaRefInterno['status']; 
                    $usado_status = $datos_listaRefInterno['usado']; 
                    $caducidad_codigo = $datos_listaRefInterno['caducidad'];
                    $count++;
                    if($status == 1){
                        $estado_ = ""; 
                    }else {
                        $estado_ = "checked"; 
                    }

                    if($usado_status == 1){ 
                        $usado_ =" <span class='badge badge-pill bg-danger inv-badge'>Usado</span>";
                        
                    }else { 
                        $usado_ ="<span class='badge badge-pill bg-success inv-badge'>Libre</span>";
                        
                    }
                     
                    
                    echo '
                    <tr> 
                    <td >'.$count.'</td>
                    <td> '.$codigo.' </td>  
                    <td>'.$caducidad_codigo.'</td>
                    <td> '.$porcentaje.' % </td>  
                    <td> '.$usado_.' </td> 
                    <td  > 

                        <div class="status-toggle">
                            <input type="checkbox" value="'.$codigo.'" id="status_'.$count.'" class="check" '.$estado_.' >
                            <label for="status_'.$count.'" class="checktoggle" onclick=" cambioEstado('.$count.') " >checkbox</label>
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
     <!-- /Feed Activity -->

 </div>