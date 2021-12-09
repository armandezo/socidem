<?php include 'views/admin/breadcrumb_med.php'; include 'views/admin/secretaria.php';?>

<style>
.demo-wrap {
    display: flex;
    align-items: center;
    flex-flow: column;
    justify-content: center;
    padding-top: 2em;
    width: 100%;
}

.demo-header {
    padding-right: 1em;
    padding-left: 1em;
    text-align: center;
}

@media (min-width: 62em) {
    .demo-wrap {
        padding-top: 0;
        height: 100vh;
    }
}


/* --- Pricing Plans --- */

.pricing-plans {
    /* padding: 2em 0; */
    width: 100%;
}

.pricing-tables {
    display: flex;
    flex-flow: column;
    padding-top: 1em;
}

.pricing-plan {
    background-color: #f6f6f6;
    border: 2px solid #DDD;
    border-bottom: 2px solid #DDD;
    display: block;
    padding: 1em 0;
    text-align: center;
    width: 100%;
}

.pricing-plan:first-child,
.pricing-plan:last-child {
    background-color: #EEE;
}

.pricing-plan:first-child {
    border-bottom: 0;
}

.pricing-plan:last-child {
    border-top: 0;
}

.pricing-plan:nth-child(2) {
    border-bottom: 0;
}

.no-flexbox .pricing-plan {
    float: left;
}

.plan-title {
    font-size: 1em;
    letter-spacing: -0.05em;
    margin: 0;
    padding: 0.75em 1em 1.25em;
    text-transform: uppercase;
}

.plan-cost {
    background-color: white;
    color: #77b9dd;
    font-size: 1.25em;
    font-weight: 700;
    padding: 1.25em 1em;
    text-transform: uppercase;
}

.plan-cost span {
    display: none;
}

.plan-price {
    font-size: 3em;
    letter-spacing: -0.05em;
    line-height: 1;
    margin-bottom: 0;
}

.plan-type {
    border: 0.313em solid #DDD;
    color: #999;
    display: inline-block;
    font-size: 0.75em;
    margin: 0.75em 0 0 0.75em;
    padding: 0.3em 0.4em 0.25em;
    width: auto;
}

.plan-features {
    margin: 0;
    padding: 2em 1em 1em;
}

.plan-features li {
    list-style-type: none;
    border-bottom: 1px solid #DDD;
    margin-bottom: 0.5em;
    padding-bottom: 0.75em;
    color: #555;
    display: block;
    font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;
    font-size: .8em;
    font-weight: normal;
    line-height: 1.3;

}

.plan-features li:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}



.plan-features i {
    font-size: 1.5em;
}

.plan-features i.icon-ok-squared {
    color: #3aa14d;
}

.plan-features i.icon-cancel-circled {
    color: darkRed;
}

.btn-plan {
    background-color: #1B8DC8;
    color: white;
    max-width: 12em;
}

.cta {
    background-color: #6cb507;
}

.cta:hover {
    background-color: #6cb507;
    color: white;
}

.featured-plan {
    background-color: #eef7fc;
    border-top: 5px solid #8cd0f5;
    border-right: 0 solid transparent;
    border-bottom: 5px solid #8cd0f5;
    border-left: 0 solid transparent;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    overflow: hidden;
    position: relative;
    transition: transform 400ms ease;
}

.featured-plan .plan-title {
    color: #1B8DC8;
}

.featured-ribbon {
    width: 200px;
    background: #1B8DC8;
    position: absolute;
    top: 15px;
    left: -60px;
    text-align: center;
    line-height: 35px;
    letter-spacing: 0.01em;
    font-size: 0.65em;
    font-weight: 700;
    color: white;
    text-transform: uppercase;
    transform: rotate(-45deg);
    -webkit-transform: rotate(-45deg);
    /* Custom styles */
    /* Different positions */
}

.featured-ribbon.sticky {
    position: fixed;
}

.featured-ribbon.shadow {
    box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
}

.featured-ribbon.top-left {
    top: 25px;
    left: -50px;
    transform: rotate(-45deg);
    -webkit-transform: rotate(-45deg);
}

.featured-ribbon.top-right {
    top: 25px;
    right: -50px;
    left: auto;
    transform: rotate(45deg);
    -webkit-transform: rotate(45deg);
}

.featured-ribbon.bottom-left {
    top: auto;
    bottom: 25px;
    left: -50px;
    transform: rotate(45deg);
    -webkit-transform: rotate(45deg);
}

.featured-ribbon.bottom-right {
    top: auto;
    right: -50px;
    bottom: 25px;
    left: auto;
    transform: rotate(-45deg);
    -webkit-transform: rotate(-45deg);
}

@media (min-width: 400px) {
    .pricing-plans {
        /* padding-right: 2em;
        padding-left: 2em; */
        width: 100%;
    }

    .featured-plan {
        transform: scale(1.05);
    }
}

@media (min-width: 33.75em) {
    .pricing-plans .module-title {
        margin-bottom: 1em;
    }

    .pricing-tables {
        flex-flow: row wrap;
    }

    .pricing-plan {
        flex-grow: 1;
        width: 50%;
    }

    .pricing-plan:first-child {
        border-right: 0;
        border-bottom: 0;
    }

    .featured-plan {
        margin-top: 0.6em;
        order: 0;
    }



    .pricing-plan:last-child {
        border-top: 2px solid #DDD;
        border-left: 0;
    }

    .no-flexbox .pricing-plan {
        width: 48%;
    }

    .plan-title {
        font-size: 0.875em;
    }
}

@media (min-width: 48em) {
    .no-flexbox .pricing-plan {
        width: 24%;
    }

    .plan-type {
        font-size: 0.7em;
        margin: 0.5em 0 0 1em;
        padding-bottom: 0.2em;
    }

    .featured-ribbon {
        font-size: 0.65em;
    }
}

@media (min-width: 62em) {
    .pricing-tables {
        padding-top: 3em;
    }

    .pricing-plan {
        flex-grow: 1;
        width: 25%;
    }

    .featured-plan {
        margin-top: 0;
        order: 0;
    }

    .pricing-plan:first-child,
    .pricing-plan:nth-child(2n) {
        border-bottom: 2px solid #DDD;
    }

    .pricing-plan .plan-features span {
        display: block !important;
    }

    .plan-cost {
        display: flex;
        flex-flow: row wrap;
        align-items: center;
        justify-content: center;
        font-size: 1em;
    }

    .plan-cost span {
        color: #BBB;
        font-size: 1.5em;
        font-weight: 400;
        padding-right: 0.15em;
        padding-left: 0.15em;
    }

    .plan-price {
        font-size: 3.25em;
    }

    .btn-plan {
        font-size: 0.875em;
    }

    .featured-ribbon {
        font-size: 0.45em;
        left: -68px;
        line-height: 25px;
    }
}

@media (min-width: 75em) {
    .plan-cost {
        font-size: 1em;
    }
}

@media (min-width: 100em) {
    .pricing-tables {
        margin: 0 auto;
        max-width: 75.00em;
    }
} 
.input_val {
    background: transparent;
    border: none;
    color: #77b9dd;
    font-size: 44px;
    font-weight: 700;
    width: 32%;
}

.form-control {
    border-color: #15558d;
    color: #333;
    font-size: 15px;
    min-height: 34px;
    padding: 6px 15px;
    border: solid 2px #8cd0f5;
    width: 65%;
    margin-left: auto;
    margin-right: auto;
    margin-top: 17px;
    margin-bottom: 2px;
}

.div_box_promo {
    display: inline-flex;
    width: 97%;
    margin-left: 3%;
    margin-right: 25%;
    padding-bottom: 18px;
}
/* #989898 */
.costo_promo {
    background: #008298;
    color: white;
    padding: 1px; 
    padding-top: 6px;
    margin-bottom: -18px;
}

.strong_text {
    font-size: 23px; 
    padding-left: 23px;
}
 
</style>
<!-- Page Content -->
<div class="content">
    <div class="container-fluid">

        <div class="row">

            <?php include 'views/admin/sidebar.php'; ?>

            <div class="col-md-7 col-lg-8 col-xl-9" style="margin-bottom: 12%;">
            <?php include 'views/admin/promo.php'; ?>


                <!-- PRICING PLANS -->
                <section class="pricing-plans">
                    <!-- Pricing Tables -->
                    <div class="pricing-tables">

                        <div class="pricing-plan" style="height: 50%;">
                            <h2 class="plan-title">Free</h2>
                            <div class="plan-cost">
                                <p class="plan-price">S/ 0</p>
                                <span>|</span>
                                <p class="plan-type">Mensual</p>
                            </div>
                            <ul class="plan-features">
                                <li>Funciona en cualquier Pc o celular</li>
                                <li>Sin necesidad de instalar programas</li>
                                <li>Funciones limitadas</li>

                            </ul>
                            <a class="btn-plan btn-info btn" href="">Elegir Plan</a>
                        </div>
                        <!-- "Premium" Plan -->
                        <div class="pricing-plan featured-plan">
                            <div class="featured-ribbon">Mejor Opcion</div>
                            <h2 class="plan-title">Profesional</h2>
                            <div class="plan-cost">
                                <p class="plan-price">S/  <input type="text" class="input_val " id="val_mem" disabled></p>
                                <span>/</span>
                                <p class="plan-type">Anual</p> 
                            </div>
                            <div class="plan-cost costo_promo">
                                <?php 
                                    if($membresia_ == "Gratuito"){
                                        echo '<p class="plan-price">2</p>
                                        <span>/</span>
                                        <p>Meses <br> <strong class="strong_text"> Gratis</strong> </p>';
                                    }  
                                ?>
                               

                            </div>
                            <br>
                            <small class="" style="color:#008298; font-weight: 600;">Si Tienes un codigo Promocional</small> 
                                 <div class="div_box_promo"> 
                                
                                 <input class="form-control " id="codigoP" placeholder="Ingresa tu codigo aqui" onkeyup="loaddata()" onchange="loaddata()" name="codigoP" type="text" autocomplete="off"> 
                                 </div>
                                 
                                 <a class="btn-plan btn-info btn" style="margin-top: -4px;" id="id_btn_val">Pagar Plan</a>
                            <?php 
                             if($_SESSION["reg_token_bank"] == "registrado"){ 
                                //  echo ' <small class="" style="color:#008298; font-weight: 600;">Si Tienes un codigo Promocional</small> 
                                //  <div class="div_box_promo"> 
                                
                                //  <input class="form-control " id="codigoP" placeholder="Ingresa tu codigo aqui" onkeyup="loaddata()" onchange="loaddata()" name="codigoP" type="text" autocomplete="off"> 
                                //  </div>
                                 
                                //  <a class="btn-plan btn-info btn" style="margin-top: -4px;" id="id_btn_val">Pagar Plan</a>';
                             }else { 

                                
                                if($membresia_ == "Profesional"){
                                    
                                // echo '
                                // <br>
                                // <small class="" style="color:red; font-weight: 600;">Debe Registrar un CCI para Continuar </small>
                                // <br>
                                // <a href="referidos" style="color:#008298; font-weight: 600;" >Ir a Referidos</a>
                                // <div class="div_box_promo">
                                // <input class="form-control "  placeholder="Ingresa tu codigo aqui" type="text" disabled readonly autocomplete="off"> 
                                // </div>
                                // ';
                                }else {
                                    
                                } 
                                
                               
                             } 
                            ?>
                           
                           
                           <br>
                           <!-- $membresia_ -->
                            
                            <ul class="plan-features">
                                
                                <li>Comparta con un solo clic su consultorio virtual</li>
                                <li>Establezca sus horarios y el monto por consulta tanto en video llamada o presencial</li>
                                <li>Difunda la ubicación de su consultorio para consultas presenciales</li>
                                <li>Pacientes y médicos recibirán confirmación y recordatorios de cada cita</li>
                                <li>Historiales médicos ilimitados</li>
                                <li>Envió de recetas y recibo de análisis</li>
                                <li>Puede optar por el sistema de cobranza en línea a pacientes</li>
                                <li>Sin avisos </li>
                            </ul>
                            <!-- <br><br> -->
                        </div>
                        <!-- "Ultmate" Plan -->
                        <div class="pricing-plan" style="height: 50%;">
                            <h2 class="plan-title">Coorporativo</h2>
                            <h2 class="plan-title">Hospitales y Clinicas</h2> 
                             
                            <div class="plan-cost">
                                <p class="plan-price" style="font-size: 29px;">Consultar</p>  
                            </div>
                            <ul class="plan-features">
                                <li>Múltiples usuarios</li>
                                <li>Funciones de Market place</li>
                                <li>Panel de control de todos los usuarios </li>
                                
                            </ul>
                            <a class="btn-plan btn-info btn" href="">Consultar</a>
                        </div>
                    </div>
                </section>
                
                 
            </div>
        </div>

    </div>

</div>


<script>
    function loaddata(){ 

    $.ajax({
        type: "POST",
        url: "controller/dashboard/consulCodigoP.controlador.php", 
            dataType: "json", 
        data: {
            cod : $("#codigoP").val(),
        },
        
        success: function(data) {   
            $("#val_mem").val(data['precio']); 
            
            btn_val = document.getElementById('id_btn_val');
            btn_val.href = data['href'];
            
            input_status = document.getElementById('codigoP');
             
            
            switch (data['status']) {
                case "activo":
                    input_status.classList.remove("is-invalid");
                    input_status.classList.add("is-valid");
                    
                    break;
                case "porcentaje":
                input_status.classList.remove("is-invalid");
                input_status.classList.add("is-valid");
                
                break;
                case "nulo":
                    if($("#codigoP").val() != ""){
                        input_status.classList.remove("is-valid");
                        input_status.classList.add("is-invalid");
                    }
                    
                break;
                
            }

            
           

           
        }
    });



    }

    loaddata();
    

</script>