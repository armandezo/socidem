<?php 
if( $_SESSION['user_role'] == 2){ 
    header("Location: adminDash-inicio",  TRUE, 301);  
    exit();
} 

?>
<div class="main-wrapper">
    <?php
    include 'adminP/seguridad/session_interna.php';
    include 'adminP/componentes/header_dash.php';
    include 'adminP/componentes/sidebar.php';
    ?>

    <div class="page-wrapper">

        <div class="content container-fluid">
       
        
            <div class="row">
           
                <?php

                   include 'adminP/componentes/usuarios.php';

                ?>
            </div>


        </div>
    </div>