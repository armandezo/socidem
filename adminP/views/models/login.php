<div class="main-wrapper login-body">
    <?php
     include 'adminP/seguridad/session.php'; 
    ?>
    <style>
    .lock-user img {
    margin-bottom: 39px;
    width: 241px;
}
    </style>
    <div class="login-wrapper " style="background: #166ea0;">
        <div class="container">
            <div class="loginbox">
                <div class="login-left">
                    <img class="img-fluid" src="views/assets/img/dr-slider.png" alt="Logo">
                    
                </div>
                <div class="login-right ">
                    <div class="login-right-wrap ">
                        <div class="lock-user">
                            <img class="" src="views/assets/img/logo_final.png" alt="User Image">
                            <!-- <h4>DASHBOARD</h4> -->
                        </div>

                        <!-- Form -->
                        <form class="margin-bottom-0 Login-Form" data-form="login">
                            <div class="form-group">
                                <input class="form-control" name="email-log" type="text" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="pass-log" type="password" placeholder="Password">
                            </div>
                            <div class="mb-0 form-group">
                                <button class="btn btn-primary btn-block" type="submit">Ingresar</button>
                            </div>
                            <br>
                            <div class="res-Login"></div>
                        </form>
                      

                         
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>