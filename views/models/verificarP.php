 <div class="content">
     <div class="container-fluid">

         <div class="row">
             <div class="col-md-8 offset-md-2" style="    margin-bottom: 8rem; margin-top: 4rem;">

                 <!-- Account Content -->
                 <div class="account-content">
                     <div class="row align-items-center justify-content-center">
                         <div class=" col-md-7 col-lg-6 login-left">
                             <img src="views/assets/img/login-banner.png" class="img-fluid" alt="Login Banner">
                         </div>
                         <div class="mb-10 col-md-12 col-lg-6 login-right">
                             <div class="login-header">
                                 <h3>Verificar SMS</h3> 
                                 <p class="small text-muted">Ingresa tu codigo SMS</p>
                             </div>
                             
                             <form class="theme-form Login-Form" action="controller/sms_confirm.controlador.php" method="post" role="form" data-form="registro">
                                 <div class="form-group form-focus">
                                     <input type="text" name="sms_code" value="<?=$_SESSION['codigo_validacion']?>" class="form-control floating" autocomplete="off"> 
                                     <label class="focus-label">SMS 8 digitos</label>
                                 </div> 

                                
                                 
                                 <button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Verificar 
                                 <span class="res-registro animated fadeInDown"></span>
                                 </button>
                                 <div class=" animated fadeInDown res-registro-end"> </div>
                                </form>
                             <!-- Forgot Password Form -->

                             <!-- /Forgot Password Form -->

                         </div>
                     </div>
                 </div>
                 <!-- /Account Content -->

             </div>
         </div>

     </div>

 </div>