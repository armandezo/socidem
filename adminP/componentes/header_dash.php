<div class="header">

<!-- Logo -->
<div class="header-left">
    <a href="adminDash-inicio" class="logo">
        <img src="adminP/assets/img/logo.png" alt="Logo">
    </a>
    <a href="adminDash-inicio" class="logo logo-small">
        <img src="adminP/assets/img/logo.png" alt="Logo" width="30" height="30">
    </a>
</div>
<!-- /Logo -->

<a href="javascript:void(0);" id="toggle_btn">
    <i class="fe fe-text-align-left"></i>
</a>



<!-- Mobile Menu Toggle -->
<a class="mobile_btn" id="mobile_btn">
    <i class="fa fa-bars"></i>
</a>
<!-- /Mobile Menu Toggle -->

<!-- Header Right Menu -->
<ul class="nav user-menu">

    <!-- Notifications -->
    
    <!-- /Notifications -->

    <!-- User Menu -->
    <li class="nav-item dropdown has-arrow">
        <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
            <span class="user-img"><img class="rounded-circle" src="views/assets/img/anadir.png"
                    width="31" alt="Administrador"></span>
        </a>
        <div class="dropdown-menu">
            <div class="user-header">
                <div class="avatar avatar-sm">
                    <img src="views/assets/img/anadir.png" alt="User Image"
                        class="avatar-img rounded-circle">
                </div>
                <div class="user-text">
                    <h6>Bienvenido </h6>
                    <?php 
                if( $_SESSION['user_admin'] == "admin"){ 
                    echo ' <p class="mb-0 text-muted">Admin</p>';
                }elseif($_SESSION['user_admin'] == "super_admin"){
                    echo ' <p class="mb-0 text-muted">Super Admin</p>';
                }
                    
                    ?>
                   
                </div>
            </div>
            <a class="dropdown-item" href="adminDash-perfil">Cambiar Password</a>
            <a class="dropdown-item" href="adminDash-salir">Logout</a>
        </div>
    </li>
    <!-- /User Menu -->

</ul>
<!-- /Header Right Menu -->

</div>