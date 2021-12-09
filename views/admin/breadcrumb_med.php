<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12"  >
                <nav aria-label="breadcrumb" class="page-breadcrumb" style="position: relative; top: 19px;">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="inicio">Home</a></li> 
                        <li class="breadcrumb-item active" aria-current="page" style="text-transform: capitalize;">
                        <?=$routes[0]?>
                        </li>
                    </ol>
                    
                </nav>
                <style>
                    .btn_ref_2 {
                    background: #ff7c00!important;
                    border: 1px solid #ececec!important;
                    color: white;
                    }

                    .btn-info_2.active:not(:disabled):not(.disabled), .btn-info_2:active:not(:disabled):not(.disabled), .show>.btn-info_2.dropdown-toggle {
                        background: #ff7c00!important;
                        border: 1px solid #ececec!important;
                        color: white;
                    }

                    .btn-info_2:hover, .btn-info_2:focus, .btn-info_2.active, .btn-info_2:active, .open>.dropdown-toggle.btn-info_2 {
                        background: #ff7c00!important;
                        border: 1px solid #ececec!important;
                        color: white;
                    }
                </style> 
               
                <button style="float:right; position: relative; top: -11px;"  data-clipboard-text="<?php 
                 $extra_slug = preg_replace("/[^a-zA-Z0-9 \_\-]+/", '', $nombre_." ".$especialidad_." ".$ubicacion_); 
                 $journalName = preg_replace('/\s+/', '-', $extra_slug);
                 if($_SERVER['SERVER_NAME'] == "localhost"){
                    echo "http://".$_SERVER['SERVER_NAME']."/socidem/resumen-".$codigo_referido_."-".$journalName;
                 }else {
                     echo "https://".$_SERVER['SERVER_NAME']."/resumen-".$codigo_referido_."-".$journalName;
                 } 
                ?>" class="btn btn-info_2 btn_ref_2 link_compartir"   type="button">Compartir Perfil </button>
            </div>

        </div>
    </div>
</div>
<!-- /Breadcrumb -->