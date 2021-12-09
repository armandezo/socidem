<div class="main-wrapper">
<?php
    include 'adminP/seguridad/session_interna.php';  
    include 'adminP/componentes/header_dash.php';  
    include 'adminP/componentes/sidebar.php';
?>
  
    <div class="page-wrapper">

        <div class="content container-fluid"> 
            <?php 
             include 'adminP/componentes/resume.php'; 
            ?>
        <div class="row">
            <?php 
                include 'adminP/componentes/listDoc.php';
                include 'adminP/componentes/listPac.php';
                // include 'adminP/componentes/listRef_externo.php';
                // include 'adminP/componentes/listRef_interno.php';
            ?> 
        </div>
        <div class="row">
        <?php 
            include 'adminP/componentes/listCitas.php';
        ?>
        </div>
        </div>
    </div>
  

</div>