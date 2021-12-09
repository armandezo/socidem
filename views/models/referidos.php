<?php 
include 'views/admin/breadcrumb_med.php'; 
include 'views/admin/secretaria.php';
?>
<!-- /Breadcrumb -->
<style>
.ref1 {
    color: #676767;
    font-weight: 500;
    font-size: 15px;
}

.link_ref {
    margin-left: auto;
    margin-right: auto;
    display: table;
    font-size: 18px;
    color: #008298;
    font-weight: 500;
}

.btn_ref {
    background: #ff7c00;
    border: 1px solid #ececec;
    color: white;
}

.btn_ref:hover {
    background: #ff7c00;
    border: 1px solid #ececec;
    color: white;
}

.centrar {
    text-align: center;
}

.cod_ref {

    font-size: 22px;
}

.ajust_table {
    margin-left: auto;
     margin-right: auto; 
     display: table;
}

.ajust_div {
    background:#ececec;
     border-radius: 10px; 
     margin-top: 32px; 
     width: 100%;
}
.input_ref {
    width: 30%;
    display: -webkit-inline-box;
    border: solid 1px #a9a9a9;
    margin-left: 80px;
}
</style>
<!-- Page Content -->
<div class="content">
    <div class="container-fluid">

        <div class="row">

            <?php include 'views/admin/sidebar.php'; ?>

            <div class="col-md-7 col-lg-8 col-xl-9">
            <?php include 'views/admin/promo.php'; ?>
                <div class="ajust_div">

                    <br>
                    <h3 class="ajust_table" >Plan de Referidos</h3>

                    <div class="row">
                        <div class="col-md-4 centrar">
                            <span class="ref1">1</span><br>
                            <img src="views/assets/images/envio_ref.png" style="padding-bottom: 7px;"><br>
                            <span class="ref1">Comparta su código<br> con un colega</span>
                        </div>
                        <div class="col-md-4 centrar">
                            <span class="ref1">2</span><br>
                            <img src="views/assets/images/logo_ref.png"><br>
                            <span class="ref1">Su colega recibirá 20%<br> de descuento</span>
                        </div>
                        <div class="col-md-4 centrar">
                            <span class="ref1">3</span><br>
                            <img src="views/assets/images/medico_ref.png" style="height: 115px; margin-left: 14px; margin-bottom: 9px;"><br>
                            <span class="ref1">Usted recibirá 20% <br> en efectivo</span>
                        </div>
                    </div>
                    <br>
                    <a href="faqRef" class="link_ref">+ Mas Información</a>
                    <br>
                </div>


                <?php 
                if($_SESSION["membresia"] != "Gratuito"){ 
                echo '

                    <div class="ajust_div " >

                    <br>
                    <h3 class="ajust_table" >Su código</h3>
                    <br>
                    <div class="centrar">

                        <strong class="cod_ref">'.$codigo_referido_.'</strong> <br><br>
                        <button class="btn btn-info btn_ref " type="button"> Copiar Codigo</button>

                    </div>
                    <br>
                    </div>


                ';
                } 
 
                if($_SESSION["reg_token_bank"] != "registrado"){
                echo ' 
                <form class="theme-form update-Form" action="controller/dashboard/upCCI.controlador.php" method="post" role="form"
                    data-form="updateCCI" > 
                    <div class="ajust_div "  >

                    <br>
                    <h5 class="ajust_table">Para participar debe Ingresar su CCI Para transferir el 20%  </h5>
                    <br>
                    <div class="centrar">
                        
                        <input class="form-control input_ref" type="text" name="cci" placeholder="Codigo CCI min 20 Digitos" autocomplete="off"> <button class="btn btn-info btn_ref " type="submit"> Aceptar</button>
                       <br>
                        <small>Código de Cuenta Interbancario</small>
                        <br><br>
                        <h5>Nota: esta acción es obligatoria si desea registrar una membresia </h5>
                    </div>
                    <br>
                </div>
                </form>
                ';


                }  
                ?>
                
            </div>
        </div>

    </div>

</div>