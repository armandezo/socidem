<?php 
if( $_SESSION['user_role'] == 2){ 
    header("Location: adminDash-inicio",  TRUE, 301);  
    exit();
} 

?>
<div class="main-wrapper">
    <?php
    include 'adminP/seguridad/session_interna.php';
    include 'adminP/componentes/header_dash.php';
    include 'adminP/componentes/sidebar.php';
    ?>

    <div class="page-wrapper">

        <div class="content container-fluid">
       
        
            <div class="row">
           
                <?php

                include 'adminP/componentes/listRef_100.php';

                ?>
            </div>


        </div>
    </div>
    <div class="modal fade" id="add_ref" aria-hidden="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear Codigo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row form-row">
                        
                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label>Cantidad</label>
                                    <input type="number" id="num_ref" class="form-control" placeholder="0">
                                </div>
                            </div>

                            <div class="col-12 col-sm-12">
                                <div class="form-group">
                                    <label>Caducidad</label>
                                    <input type="date" min="2021-06-30" id="caducidad_ref" class="form-control" >
                                </div>
                            </div>
                             

                        </div>
                        <button type="button" onclick="newRef()" class="btn btn-primary btn-block">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>