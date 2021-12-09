<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-8 offset-md-2">

                <!-- Register Content -->
                <div class="account-content">
                    <div class="row align-items-center justify-content-center" >
                        <div class="col-md-7 col-lg-6 login-left" style="margin-bottom: 138px;">
                            <img src="views/assets/img/reg_user.svg" class="img-fluid" alt="Doccure Register">
                        </div>
                        <div class="col-md-12 col-lg-6 login-right">
                            <div class="login-header">
                                <h3>Registro Pacientes<a href="registroDoc">Eres un Doctor?</a></h3>
                            </div>

                            <!-- Register Form -->
                            <form class="theme-form Login-Form" id="reg_paciente" action="controller/registro.controlador.php" method="post" role="form"
                                    data-form="registro">
                                <div class="form-group form-focus">
                                    <input type="text" name="nombre-reg" class="form-control floating" autocomplete="off">
                                    <label class="focus-label">Nombre</label>
                                </div>
                                <div class="form-group form-focus">
                                    <input type="text" name="correo-reg" class="form-control floating" autocomplete="off">
                                    <label class="focus-label">Email</label>
                                </div>
                                <div class="form-group form-focus">
                                    <input type="text" name="tel-reg" class="form-control floating" autocomplete="off">
                                    <label class="focus-label">Telefono</label>
                                </div>
                                <div class="form-group form-focus">
                                    <input type="password" name="pass-reg" class="form-control floating">
                                    <label class="focus-label">Contraseña</label>
                                </div>
                                <div class="text-right">
                                    <a class="forgot-link" href="login">Ya tienes una cuenta?</a>
                                </div>
                                
                                <button class="btn btn-primary btn-block btn-lg login-btn res-registro" type="submit"> Registrarme 
                                <span class="res-registro animated fadeInDown"></span>
                                </button>
                                <span class="res-registro-end animated fadeInDown"></span>
                                <div class="login-or">
                                    <span class="or-line"></span>
                                    <span class="span-or">or</span>
                                </div>
                                <div class="row form-row social-login">
                                    <div class="col-6">
                                    <?php 
                                    require_once 'model/credencialesRegFace.php';
                                    echo "<a href='".$loginUrl."' class='btn btn-facebook btn-block'><i
                                    class='mr-1 fab fa-facebook-f'></i> Facebook</a>
                                        ";
                                    ?>
                                    </div>
                                    <div class="col-6">
                                    <?php  
                                    require_once 'model/credencialesReg.php';
                                    echo "<a href='".$client->createAuthUrl()."' class='btn btn-google btn-block'><i class='mr-1 fab fa-google'></i>
                                        Gmail</a>
                                        ";
                                        ?>
                                    </div>
                                </div>
                            </form>
                            <!-- /Register Form -->

                        </div>
                    </div>
                </div>
                <!-- /Register Content -->

            </div>
        </div>

    </div>

</div>