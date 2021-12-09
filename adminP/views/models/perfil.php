<div class="main-wrapper">
    <?php
    include 'adminP/seguridad/session_interna.php';
    include 'adminP/componentes/header_dash.php';
    include 'adminP/componentes/sidebar.php';
    ?>

    <div class="page-wrapper">

        <div class="content container-fluid">

            <div class="row">

                <div class="col-md-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Cambiar Password</h5>
                            <div class="row">
                                <div class="col-md-10 col-lg-6">
                                     
                                        <div class="form-group">
                                            <label>Nueva Password</label>
                                            <input type="password" id="n-pass" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Confirmar Password</label>
                                            <input type="password" id="c-pass" class="form-control">
                                        </div>
                                        <button class="btn btn-primary" type="button" onclick="NewP()">Guardar Cambios</button>
                                     
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>


    </div>