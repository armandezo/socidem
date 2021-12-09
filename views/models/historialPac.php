<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-12 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="inicio">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
                <h2 class="breadcrumb-title">Dashboard </h2>

            </div>
        </div>
    </div>
</div>
<!-- /Breadcrumb -->
    <style>
            .med_row {
                margin-bottom: 15px;
                background: #008298;
                color: white;
                margin-left: auto;
                margin-right: auto;
                display: inherit;
            }

            .med_row:hover{
                background: #008298;
                color: white;
            }

            .img_data {
                width: 800px;
                height: fit-content;
                margin-left: auto;
                margin-right: auto;
                display: -webkit-box;
                margin-bottom: 30px;
            }
            .custom-edit-service .service-upload {
            border: 1px solid #dcdcdc;
            border-radius: .25rem;
            text-align: center;
            padding: 70px 0;
            margin-bottom: 30px;
            background-color: #fff;
            position: relative;
        }
    </style>

   
<!-- Page Content -->
<div class="content">

    <div class="container-fluid">

        <div class="row">

        <?php include 'views/admin/sidebar_paciente.php'; ?>

            <div class="col-md-10 col-lg-10 col-xl-10">
               
                <nav class="mb-4 user-tabs">

                    <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" href="#historial" data-toggle="tab">Historia Clínica</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#analisis_lab" data-toggle="tab">Análisis de Laboratorio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#imagenes_digitales" data-toggle="tab">Imágenes Digitales</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#imagenes_recetas" data-toggle="tab">Recetas Medicas</a>
                        </li>
                    </ul>
                </nav>
                
                <div class="tab-content ">
             
                    <?php 
                    $get_mail = md5($correo_);
                    $ConsHistorial = ejecutarSQL::consultar("SELECT `historial_medico`.*, `historial_medico`.`correo` FROM `historial_medico` WHERE `historial_medico`.`correo` = '$get_mail';");
                    while( $datos_historial_med =mysqli_fetch_assoc($ConsHistorial)){

                    $cod_correo = $datos_historial_med['correo'];  

                    $objHistoria_clinica = $datos_historial_med['historia_clinica']; 
                    $objAnalisis_lab = $datos_historial_med['analisis_lab']; 
                    $objImg_digitales = $datos_historial_med['img_digitales']; 
                    $objRecetas = $datos_historial_med['recetas_med']; 

                    ?>

                    <div class="tab-pane show active" id="historial">
                         
                        
                        <?php 
                        $historia_clinica = json_decode($objHistoria_clinica, true); 
                        $count = 0;

                        foreach ($historia_clinica as $key => $entry) { 
                            $count = $count + 1;
                            
                            echo '
                            <button type="button" class="btn btn-block" style="margin-bottom: 15px; background:#008298; color:white;" data-toggle="collapse" data-target="#h'.$count.'">'.$entry['fecha'].'</button>
                            <div id="h'.$count.'" class="collapse" style="margin-top: 15px; margin-bottom: 15px;">
                                 '.$entry['texto'].'
                                 <br><br> 
                            </div>
                          
                            ';


                        } 
                       
                        ?>
                       


                    </div>

                    <div class="tab-pane" id="analisis_lab"> 
                    <button type="button" class="btn med_row" onclick="addLab('<?=$get_mail?>')" ><i class="fa fa-plus"></i>
                            AGREGAR ANALISIS DE LABORATORIO</button>
                        <?php 
                        $analisis_lab = json_decode($objAnalisis_lab, true); 
                        $count = 0;

                        foreach ($analisis_lab as $key => $entry) { 
                            $count = $count + 1;
                            
                            echo '
                            <button type="button" class="btn btn-block" style="margin-bottom: 15px; background:#008298; color:white;" data-toggle="collapse" data-target="#a'.$count.'">'.$entry['fecha'].'</button>
                            <div id="a'.$count.'" class="collapse" style="margin-top: 15px; margin-bottom: 15px;">
                            ';
                              
                            foreach ($entry['analisis'] as $key => $entry) { 

                                echo '
                                <img class="img_data" src="views/assets/images/historial/analisis_lab/'.$entry['pictures'].'" alt="" >
                                ';

                            } 
                            echo ' 
                            </div>
                            ';
 

                        } 
                       
                        ?>

                    </div>

                    <div class="tab-pane" id="imagenes_digitales">
                    <button type="button" onclick="addImgDig('<?=$get_mail?>')" class="btn med_row "><i  class="fa fa-plus"></i> AGREGAR IMAGENES DIGITALES</button>
                            <?php 
                        $img_digitales = json_decode($objImg_digitales, true); 
                        $count = 0;

                        foreach ($img_digitales as $key => $entry) { 
                            $count = $count + 1;
                            
                            echo '
                            <button type="button" class="btn btn-block" style="margin-bottom: 15px; background:#008298; color:white;" data-toggle="collapse" data-target="#i'.$count.'">'.$entry['fecha'].'</button>
                            <div id="i'.$count.'" class="collapse" style="margin-top: 15px; margin-bottom: 15px;">
                            ';
                              
                            foreach ($entry['digitales'] as $key => $entry) { 

                                echo '
                                <img class="img_data" src="views/assets/images/historial/img_digitales/'.$entry['pictures'].'" alt="" >
                                ';

                            }

                            echo '
                            </div>
                            ';


                        } 
                       
                        ?>
                    </div>

                    <div class="tab-pane" id="imagenes_recetas">
                    <button type="button" class="btn med_row " onclick="addRecetas('<?=$get_mail?>')" ><i
                                class="fa fa-plus"></i>
                            AGREGAR RECETAS MEDICAS</button>

                            <?php 
                        $recetas = json_decode($objRecetas, true); 
                        $count = 0;

                        foreach ($recetas as $key => $entry) { 
                            $count = $count + 1;
                            
                            echo '
                            <button type="button" class="btn btn-block" style="margin-bottom: 15px; background:#008298; color:white;" data-toggle="collapse" data-target="#r'.$count.'">'.$entry['fecha'].'</button>
                            <div id="r'.$count.'" class="collapse" style="margin-top: 15px; margin-bottom: 15px;">
                            ';
                              
                            foreach ($entry['recetas'] as $key => $entry) { 

                                echo '
                                <img class="img_data" src="views/assets/images/historial/recetas_med/'.$entry['pictures'].'" alt="" >
                                ';

                            }

                            echo '
                            
                            </div>
                            
                            ';


                        } 
                       
                        ?>
                    </div>


                    <?php }?>

                </div>

              
                
            </div>

        </div>

    </div>
</div>