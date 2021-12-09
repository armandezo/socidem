<?php require_once 'views/models/seguridad/payment.php'; ?>

<!-- Breadcrumb -->
<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">Checkout </h2>
            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">
    <div class="container">

        <div class="row">
            <div class="col-md-7 col-lg-8">
                <div class="card">
                    <div class="card-body">

                        <!-- Checkout Form -->
                        <form action="controller/dashboard/checkoutPaciente.controlador.php" method="post" role="form"
                            class="theme-form checkout-Form" id="checkout_form">


                            <div class="info-widget">
                                <h4 class="card-title">Información del paciente</h4>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group card-label">
                                            <label>Primer Nombre</label>
                                            <input class="form-control" name="nombre_paciente" type="text" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group card-label">
                                            <label>Apellido</label>
                                            <input class="form-control" name="apellido_paciente" type="text" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group card-label">
                                            <label>Email</label>
                                            <input class="form-control" type="email" name="email_paciente" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group card-label">
                                            <label>Telefono</label>
                                            <input class="form-control" name="telefono_paciente" type="text" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 col-sm-12" style="display: none;">
                                    <h4 class="card-title">Elige tu servicio</h4>
                                    <br>
                                        <div style="background-color: #fff; border: 1px solid #dbdbdb; border-radius: 4px; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .05);  display: block;  height: 50px;  margin-top: -13px;  padding: 5px 15px 0; transition: border-color .3s; width: 100%;"
                                            class="p-1 card-body d-flex justify-content-between flex-column flex-md-row align-items-md-center">
                                            <div data-v-04146088="" data-v-3ee56c44="" class="pr-2 ellipsis-flex-fix">
                                                <div data-v-3ee56c44="">
                                                    <p id="servicios_content" class="mb-0">&nbsp; Servicio General </p>
                                                    <input type="hidden" name="servicios_content_value" id="servicios_content_value" value="Servicio General" required>
                                                    <!---->
                                                </div>
                                            </div> <button type="button" onclick="servicio('<?=$_SESSION['secur']?>')" class="mt-1 mt-md-0 btn btn-primary"
                                                >
                                                <!---->
                                                Cambiar
                                                <!---->
                                            </button>
                                           
                                        </div>
                                    </div>
                                    <br><br><br>
                                    <div class="col-md-12 col-sm-12">
                                  
                                    <br>
                                    <h4 class="card-title">Detalles Previos</h4>
                                        <div class="form-group card-label">

                                            <textarea placeholder="Detalles medicos de la consulta..." name="detalles_paciente" class="form-control"
                                                rows="4" cols="50" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 submit-section">
                                    <?php require_once 'controller/dashboard/mercadoPago.controlador.php'; ?>
                                </div>
                            </div>



                        </form>
                        <!-- /Checkout Form -->

                    </div>
                </div>

            </div>

            <div class="col-md-5 col-lg-4 ">

                <!-- Booking Summary -->
                <div class="card booking-card">
                    <div class="card-header">
                        <h4 class="card-title">Resumen de pago</h4>
                    </div>
                    <div class="card-body">
                        <?php 
						$token_v = $_SESSION['secur'];				
						$checkMed = ejecutarSQL::consultar("SELECT `medicos`.`nombre_completo`, `perfil`.`codigo_referido`, `perfil`.`especialidad`, `perfil`.`foto`, `perfil`.`nombre_clinica`, `perfil`.`direccion_clinica`, `perfil`.`correo` FROM `medicos`, `perfil` WHERE `perfil`.`codigo_referido` = '$token_v' AND `perfil`.`correo` = `medicos`.`correo`");

						while($d=mysqli_fetch_assoc($checkMed)){
						$nombre_completo=$d['nombre_completo'];
                        $especialidad=$d['especialidad'];
						$foto=$d['foto'];
						$nom_clinica=$d['nombre_clinica'];
						$dir_clinica=$d['direccion_clinica'];
						
						?>
                        <!-- Booking Doctor Info -->
                        <div class="booking-doc-info">
                           
                            <a href="<?="perfil-".$_SESSION['secur']; ?>" class="booking-doc-img">
                                <img src="views/assets/images/medicos/<?=$foto ?>" alt="User Image">
                            </a>
                            <div class="booking-info">
                                <h4 style="text-transform: capitalize"><a href="<?="perfil-".$_SESSION['secur']; ?>"><?="Dr ".$nombre_completo ?></a>
                                </h4>
                                <div class="clini-infos">
                                    <ul>
                                        <li><i class="fa fa-address-card" style="color: #008298;"></i> <?=$especialidad  ?></li>
                                        <li><i class="fa fa-check" style="color: #008298;"></i> Perfil Verificado  </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Booking Doctor Info -->
                        <?php }  ?>
                        <div class="booking-summary">
                            <div class="booking-item-wrap">
                                <ul class="booking-date">
                                    <li><i class="fa fa-calendar" style="color: #008298;" aria-hidden="true"></i>
                                        <?php
                                        
                                        $nuevaHora =  date('G:i', strtotime('+'.$_SESSION['rango'].' minutes ', strtotime($_SESSION['hora']) ) );
                                        
                                        echo $_SESSION['fecha'] ." , ". $_SESSION['hora']." - ".$nuevaHora ?> </li>
                                <?php 
                                
                                if($_SESSION['tipo'] == "presencial"){
                                  
                                ?> 
                                    <li><i class="fa fa-map-marker" style="color: #008298;" aria-hidden="true"></i> <?php echo $nom_clinica ?> </li>
                                    <li><i class="fa fa-map-marker" style="color: #008298;" aria-hidden="true"></i> <?php echo $dir_clinica ?> </li>
                                
                                <?php } else {
                                    
                                }?>

                                </ul>



                                <ul class="booking-fee">
                                    <li>Consulta <span>S/ <?=$_SESSION['precio_final'] ?></span></li>
                                    <li>Tipo de consulta <span><?=$_SESSION['tipo'] ?> </span></li>

                                </ul>
                                <div class="booking-total">
                                    <ul class="booking-total-list">
                                        <li>
                                            <span>Total</span>
                                            <span class="total-cost">S/ <?=$_SESSION['precio_final'] ?></span>
                                        </li>
                                    </ul>
                                </div>


                                <div class="res-checkout animated fadeInDown"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Booking Summary -->

            </div>
        </div>

    </div>

</div>
<!-- /Page Content -->