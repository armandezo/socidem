<div class="main-wrapper">
    <div class="header-top">
        <div class="left-top ">
            <ul>
                <li><i class="fas fa-map-marker-alt top-icon"></i>Direccion de contacto </li>
                <li><i class="fas fa-phone-volume top-icon"></i>+19 123-456-7890</li>
                <li><i class="fas fa-envelope top-icon"></i>test_correo@gmail.com</li>
            </ul>
        </div>
        <div class="right-top ">
            <ul>
                <li><i class="fab fa-facebook-f top-icons"></i>
                </li>
                <li><i class="fab fa-instagram top-icons"></i>
                </li>
                <li><i class="fab fa-linkedin-in top-icons"></i>
                </li>
                <li><i class="fab fa-twitter top-icons"></i>
                </li>
            </ul>
        </div>
    </div>
    <style>
    html {
        scroll-behavior: smooth;
    }
    </style>
    <header class="text-center header ">
        <nav class="text-center navbar navbar-expand-lg header-nav">
            <div class="navbar-header">
                <a id="mobile_btn" href="javascript:void(0);">
                    <span class="bar-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>
                <a href="inicio" class="navbar-brand logo">
                    <img src="views/assets/img/logo.png" class="img-fluid" alt="Logo">
                </a>
            </div>
            <?php
            switch ($rol_) {
                case 1:
                    echo '
                            <div class="main-menu-wrapper">
                            <div class="menu-header">
                            <a href="inicio" class="menu-logo">
                            <img src="views/assets/img/logo.png" class="img-fluid" alt="Logo">
                            </a>
                            <a id="menu_close" class="menu-close" href="javascript:void(0);">
                            <i class="fas fa-times"></i>
                            </a>
                            </div>
                            <ul class="main-nav">
                            <li class="has-submenu active">
                            <a href="inicio">inicio </a>

                            </li>
                            <li class="has-submenu">
                            <a href="#section_2" >Nuestros Servicios</a>

                            </li>
                            <li class="has-submenu">
                            <a href="#section_3" >Preguntas Frecuentes</a>

                            </li>
                            <li class="has-submenu">
                            <a href="#section_4" >Precios</a>

                            </li>
 
                            <li class="has-submenu">
                            <a  href="medicos" >Medicos</a>

                            </li>
 
                            <li class="has-submenu">
                            <a href="#section_5" >Contacto</a>

                            </li>

                            <li class="login-link">
                            <a href="loginMed">¿Es Usted Médico?</a>
                            </li>
                            </ul>
                            </div>
                        ';
                    break;

                case 2:
                    echo '
                        <div class="main-menu-wrapper">
                        <div class="menu-header">
                        <a href="inicio" class="menu-logo">
                        <img src="views/assets/img/logo.png" class="img-fluid" alt="Logo">
                        </a>
                        <a id="menu_close" class="menu-close" href="javascript:void(0);">
                        <i class="fas fa-times"></i>
                        </a>
                        </div>
                        <ul class="main-nav">
                        <li class="has-submenu active">
                        <a href="inicio">inicio </a>

                        </li>
                        <li class="has-submenu">
                        <a href="servicios">Nuestros Servicios</a>

                        </li>
                        
                        <li class="has-submenu">
                        <a  href="#section_2" >Nuestros Servicios </a>

                        </li>

                        <li class="has-submenu">
                        <a  href="#section_3" >Preguntas Frecuentes</a>

                        </li>
  
                            <li class="has-submenu">
                            <a  href="medicos" >Medicos</a>

                            </li>
 

                        <li class="has-submenu">
                        <a href="#section_4">Contacto</a> 
                        </li>

                        <li class="login-link">
                        <a href="loginMed">¿Es Usted Médico?</a>
                        </li>
                        </ul>
                        </div>
                    ';
                    break;

                default:
                    echo '
                    <div class="main-menu-wrapper">
                    <div class="menu-header">
                    <a href="inicio" class="menu-logo">
                    <img src="views/assets/img/logo.png" class="img-fluid" alt="Logo">
                    </a>
                    <a id="menu_close" class="menu-close" href="javascript:void(0);">
                    <i class="fas fa-times"></i>
                    </a>
                    </div>
                    <ul class="main-nav">
                    <li class="has-submenu active">
                    <a href="inicio">inicio </a>

                    </li>

                    <li class="has-submenu">
                    <a  href="#section_2" >Nuestros Servicios </a>

                    </li>
                    
                    <li class="has-submenu">
                    <a  href="#section_3" >Preguntas Frecuentes</a>

                    </li>
                    
                    <li class="has-submenu">
                    <a href="#section_4">Contacto</a> 
                    </li>

 
                            <li class="has-submenu">
                            <a  href="medicos" >Medicos</a>

                            </li>
 

                    <li class="login-link">
                    <a href="loginMed">¿Es Usted Médico?</a>
                    </li>
                    </ul>
                    </div>
                ';
                    break;
            }
            ?>



            <?php

            switch ($rol_) {
                case 1:
                    echo '<ul class="nav header-navbar-rht">
                <li class="nav-item contact-item">
                    <div class="header-contact-img">
                        <i class="far fa-user"></i>
                    </div>

                
                    <div class="header-contact-detail">
                        <a href="javascript:">
                            <p href="login" class="contact-header" style="text-transform: capitalize;">' . $nombre_ . '</p>
                        </a>
                        <a href="salir">
                            <p class="contact-header">Cerrar Session</p>
                        </a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link header-login" href="dashboard">Dashboard Med</a>
                </li>
                </ul>';
                    break;

                case 2:
                    echo '<ul class="nav header-navbar-rht">
                <li class="nav-item contact-item">
                    <div class="header-contact-img">
                        <i class="far fa-user"></i>
                    </div>

                
                    <div class="header-contact-detail">
                        <a href="javascript:">
                            <p href="login" class="contact-header" style="text-transform: capitalize;">' . $nombre_ . '</p>
                        </a>
                        <a href="salir">
                            <p class="contact-header">Cerrar Session</p>
                        </a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link header-login" href="dashboard">Dashboard </a>
                </li>
                </ul>';
                    break;
                default:
                    echo '<ul class="nav header-navbar-rht">
                <li class="nav-item contact-item">
                    <div class="header-contact-img">
                        <i class="far fa-hospital"></i>
                    </div>

                
                    <div class="header-contact-detail">
                        <a href="login">
                            <p href="login" class="contact-header">INGRESAR</p>
                        </a>
                        <a href="registro">
                            <p class="contact-header">REGISTRARSE</p>
                        </a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link header-login" href="loginMed">¿Es Usted Médico? </a>
                </li>
                </ul>';
                    break;
            }





            ?>



        </nav>
    </header>