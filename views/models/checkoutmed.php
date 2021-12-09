<div class="content">
    <div class="container-fluid">
<style >
.input_val {
    background: transparent;
    border: none;
    color: #20c0f3;
    font-size: 16px;
    font-weight: 600;
}

</style>
        <div class="row">
        <?php include 'views/admin/sidebar.php'; ?>

            <div class="col-md-7 col-lg-8 col-xl-9">
                <div class="card">
                    <div class="card-body">

                        <!-- Checkout Form -->
                        <form action="controller/dashboard/checkoutPaciente.controlador.php" method="post" role="form"
                            class="theme-form checkout-Form" id="checkout_form">


                            <div class="info-widget">
                                <h4 class="card-title">Información General</h4>
                            <?php 
                                $token_v = $_SESSION["codigo_referido"];				
                                // $checkMembresia = ejecutarSQL::consultar("SELECT `membresias`.`precio`, `planes_membresias`.*, `planes_membresias`.`token_med`
                                // FROM `membresias`
                                //     , `planes_membresias`
                                // WHERE `planes_membresias`.`token_medico` = '$token_v' ");

                                // while($mem=mysqli_fetch_assoc($checkMembresia)){
                                //     $meses_activos=$mem['meses'];
                                //     $membresia=$mem['membresia'];
                                //     $promo=$mem['promo'];
                                //     $status=$mem['status']; 
                                //     $precio_membresia = $mem['precio'];

                                    
                                ?>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group card-label">
                                            <label>Codigo Promocional</label>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group card-label">
                                            <label>Membresia Actual</label>
                                           
                                        </div>
                                    </div>
                                </div>
                                <h4 class="card-title">Resumen de pago</h4>
                                   
                                    
                                 
 
                                <div class="booking-total">
                                    <ul class="booking-total-list">
                                        <li>
                                            <span>Total</span>
                                            <span class="total-cost" style="float:none;"> S/   </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="mt-4 submit-section">
                               
                                <?php   
                                echo "<a style='width: 100%;' id='id_btn_val' class='btn btn-primary submit-btn'  >Confirmar y Pagar</a>";                                  
                            // }   

                                // $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

                                // function generate_string($input, $strength = 16) {
                                // $input_length = strlen($input);
                                // $random_string = '';
                                // for($i = 0; $i < $strength; $i++) {
                                // $random_character = $input[mt_rand(0, $input_length - 1)];
                                // $random_string .= $random_character;
                                // }

                                // return $random_string;
                                // }       

                                // echo generate_string($permitted_chars, 8);
                                
                              ?>
                                </div>
                            </div>
                           
                        
                        </form>
                        <!-- /Checkout Form -->

                    </div>
                </div>

            </div>

            
        </div>

    </div>

</div>
