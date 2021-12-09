<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Perfil</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">Perfil </h2>

            </div>
        </div>
    </div>
</div>


<!-- Page Content -->
<div class="content">

    <div class="container-fluid">

        <div class="row">

            <?php include 'views/admin/sidebar_paciente.php'; ?>

            <div class="col-md-10 col-lg-10 col-xl-10" >
            <form class="theme-form update-Form" action="controller/dashboard/upPerfilPac.controlador.php" method="post" role="form" data-form="updatePerfil"  >
                                <div class=" col-md-4" style="margin: auto;">
                                    <div class="form-group">
                                        <label>Nombre del paciente </label>
                                        <input type="text" name="nombre" id="nombre" value="<?=$nombre_?>" class="form-control "   >
                                    </div>
                                </div>
                                <div class=" col-md-4" style="margin: auto;">
                                    <div class="form-group">
                                        <label>Correo </label>
                                        <input type="email" value="<?=$correo_?>" class="form-control " 
                                            disabled readonly>
                                    </div>
                                </div>
                                <div class=" col-md-4" style="margin: auto;">
                                    <div class="form-group">
                                        <label>Telefono </label>
                                        <input type="number" value="<?=$telefono_?>"  class="form-control " 
                                            disabled readonly>
                                    </div>
                                </div>

                                <div class=" col-md-4" style="margin: auto;">
                                    <div class="form-group">
                                        <label>Cambiar contraseña </label>
                                        <input type="password" name="password" id="password" class="form-control " >
                                    </div>
                                </div>


                                <div class=" col-md-4" style="margin-left: 26rem;">
                                    <div class="form-group"> 
                                        <button type="submit" class="btn btn-primary submit-btn">Guardar Cambios</button>
                                    </div>
                                </div>


                       
                </form>         
            </div>
        </div>
    </div>
</div>