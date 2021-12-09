<?php include 'views/admin/breadcrumb_med.php'; ?>

<!-- Page Content -->
<div class="content">
    <div class="container-fluid">

        <div class="row">

            <?php include 'views/admin/sidebar.php'; ?>

            <div class="col-md-7 col-lg-8 col-xl-9"> 
            <?php include 'views/admin/promo.php'; ?>
                 <style>
                .move_to_tomorrow {
                position: relative;
                left: 48.6rem;
                top: 6px;
                } 
                tbody {
                display: block;
                max-height: 100%;
                overflow-y: scroll;
                }
                 </style>
                <?php    
                if($membresia_ == "Gratuito") {
                echo '<img src="views/assets/images/calendario.png" >';
                }else { 
                $track = $codigo_referido_;
                echo '
                <div class="doc-info-right "wrapper" style="margin-bottom: 105px;">
                <div class="rescalendar" id="cal-'.$track.'"></div>
                </div>

                <script> cargaCalendar("cal-'.$track.'","'.$codigo_referido_.'", 8, "paciente") </script>
                ';
                }
                ?>

            </div>
        </div>

    </div>

</div> 