<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Agenda una Cita</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">Agenda una Cita</h2>
            </div>
        </div>
    </div>
</div>
<style>
 
.fc-event {
    border-radius: 0px; 
    border: none;
    color: #ffffff !important;
    cursor: pointer;
    font-size: 16px;
    font-weight: 500;
    margin: 1px 7px;
    padding: 5px 5px;
    text-align: center;
}
.fc .fc-button-primary {
    color: #fff;
    color: var(--fc-button-text-color, #fff);
    background-color: #2C3E50;
    background-color: #15558d;
    border-color: #2C3E50;
    border-color: #15558d;
}

.fc .fc-button-primary:hover {
    color: #fff;
    color: var(--fc-button-text-color, #fff);
    background-color: #1e2b37;
    background-color: #003c71;
    border-color: #1a252f;
    border-color: #15558d;
}
.fc .fc-button-primary:not(:disabled):active, .fc .fc-button-primary:not(:disabled).fc-button-active {
    color: #fff;
    color: var(--fc-button-text-color, #fff);
    background-color: #1a252f;
    background-color: #15558d;
    border-color: #151e27;
    border-color: #15558d;
}
</style>
<!-- /Breadcrumb -->
<?php 
$codigoRef = $routes[1];

$consMedico = ejecutarSQL::consultar("SELECT `perfil`.`codigo_referido`, `perfil`.`correo`, `medicos`.`correo`, `perfil`.`foto`, `perfil`.`nombre_clinica`, `perfil`.`especialidad`, `perfil`.`direccion_clinica`, `medicos`.`nombre_completo` FROM `perfil`, `medicos` WHERE `perfil`.`codigo_referido` = '$codigoRef' AND `medicos`.`correo` = `perfil`.`correo`");


 while($datos_med_C=mysqli_fetch_assoc($consMedico)){
    $foto_med = $datos_med_C['foto'];
    $nombre_completo_med = $datos_med_C['nombre_completo'];
    $nombre_clinica_med = $datos_med_C['nombre_clinica'];
    $direccion_clinica_med = $datos_med_C['direccion_clinica'];
    $especialidad_med = $datos_med_C['especialidad'];
?>
<!-- Page Content -->
<div class="content">
    <div class="container">

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <div class="booking-doc-info">
                            <a href="perfil-<?=$codigoRef ?>" class="booking-doc-img">
                                <img src="views/assets/images/medicos/<?=$foto_med ?>" alt="User Image">
                            </a>
                            <div class="booking-info">
                                <h4><a href="perfil-<?=$codigoRef ?>">Dr. <?=$nombre_completo_med ?></a></h4>
                                <p class="doc-speciality" style="text-transform: capitalize;"><?=$especialidad_med ?></p>
                                <p class="doc-department" style="color: #757575; font-weight: 500;">
                                    <img src="views/assets/img/hospital.png" class="img-fluid" alt="localizacion">
                                    Consultorio:
                                    <span class="doc-locate"
                                        style="color: #757575; font-weight: 500; text-transform: capitalize;"><?=$nombre_clinica_med ?></span>
                                </p>
                                <p class="doc-department" style="color: #757575; font-weight: 500;">
                                    <img src="views/assets/img/marcador-de-posicion.png" class="img-fluid" alt="localizacion">
                                    Dirección:
                                    <span class="doc-locate"
                                        style="color: #757575; font-weight: 500; text-transform: capitalize;"><?=$direccion_clinica_med ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-4 col-md-6">
                        <h4 class="mb-1">Selecciona una Fecha</h4>
                        <p class="text-muted">Nota: las citas se reservaran con 1 dia de anticipación</p>
                    </div>

                </div>
                <!-- Schedule Widget -->
                <div >
                    <div id='loading'></div>

                    <div id='calendar'></div>
                </div>
                <!-- /Schedule Widget -->
 

            </div>
        </div>
    </div>
    <?php } ?>
</div>


