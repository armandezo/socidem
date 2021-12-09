<?php include 'views/admin/breadcrumb_med.php'; include 'views/admin/secretaria.php'; ?>

<!-- Page Content -->
<div class="content">
    <div class="container-fluid ajust_fluid">

        <div class="row">

            <?php include 'views/admin/sidebar.php'; ?>
            <div class="col-md-7 col-lg-8 col-xl-9">
                <?php include 'views/admin/promo.php'; ?>
                <form class="theme-form secret-Form" action="controller/dashboard/upSecretaria.controlador.php" method="post" role="form" data-form="updateSecretaria">

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Credenciales Secretaria </h4>
                            <div class="row form-row">
                                <div class=" col-md-6">
                                    <div class="form-group">
                                        <label>Usuario </label>
                                        <input type="text" name="usuario-secret" class="form-control" placeholder="Ingresa el usuario" autocomplete="off">
                                    </div>
                                </div>
                                <div class=" col-md-6">
                                    <div class="form-group">
                                        <label>Contraseña</label>
                                        <input type="password" name="pass-secret" class="form-control" placeholder="Ingresa la contraseña" autocomplete="off">
                                    </div>
                                </div>
                                <div class="res-secret animated fadeInDown"> </div>
                            <div class="submit-section submit-btn-bottom">
                                <button type="submit" class="btn btn-primary submit-btn">Guardar Cambios</button>
                            </div>





                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>