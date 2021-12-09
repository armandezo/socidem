<div class="col-md-5 col-lg-4 col-xl-3 "> 
    <!-- Profile Sidebar -->
    <div class="profile-sidebar">
        <div class="widget-profile pro-widget-content">
            <div class="profile-info-widget">
                <a href="javascript:" class="booking-doc-img">
                <?php 
                if($foto_ == ""){
                    $foto_ = "1.jpg";
                } 
                 
                ?>
                    <img src="views/assets/images/medicos/<?=$foto_?>" alt="User Image">
                </a>
                <div class="profile-det-info">
                    <h3>Dr. <?=$nombre_ ?></h3>

                    <div class="patient-details">
                        <h4 class="mb-2"><?=$especialidad_ ?></h4> 
                        <h4 class="mb-2">Plan <?=$membresia_?> </h4> 
                        <h4 class="mb-2">Meses Activos: <?=$periodo_membresia_ ?></h4> 
                        <?php 
                        
                         $extra_slug = preg_replace("/[^a-zA-Z0-9 \_\-]+/", '', $nombre_." ".$especialidad_." ".$ubicacion_); 
                         $journalName = preg_replace('/\s+/', '-', $extra_slug);
                        
                        ?>
                        <a href="perfil-<?=$codigo_referido_."-".$journalName ?>" target="_blank" class="btn btn-info_2 btn_ref_2 "  type="button">Ver Perfil</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="dashboard-widget">
            <nav class="dashboard-menu">
                <ul>
                    <li class="">
                        <a href="dashboard">
                            <i class="fas fa-columns"></i>
                            <span>Dashboard</span>
                        </a>
                    </li> 
                    <li> 
                            <a href="agenda">
                                <i class="fas fa-calendar-check"></i>
                                <span>Configurar Horarios</span>
                            </a>
                        </li>
                        <li>
                            <a href="calendario">
                            <i class="fas fa-address-book"></i>
                                <span>Mi Calendario</span>
                            </a>
                        </li>
                        <li>
                            <a href="exepciones">
                            <i class="fas fa-cog"></i>
                                <span>Mis Exepciones</span>
                            </a>
                        </li>
                        <li>
                            <a href="pacientes">
                                <i class="fas fa-user-injured"></i>
                                <span>Pacientes</span>
                            </a>
                        </li>
                        <li>
                            <a href="histCitas">
                                <i class="fas fa-user-injured"></i>
                                <span>Historico Citas</span>
                            </a>
                        </li>
                        <?php 
                        if ($_SESSION["asistente"] != "ok") {
                            echo '
                            <li>
                            <a href="referidos">
                                <i class="fas fa-file-invoice"></i>
                                <span>Plan de Referidos</span>

                            </a>
                        </li>
                        <li> 
                            <a href="membresias">
                                <i class="fas fa-star"></i>
                                <span>Membresias</span>

                            </a>
                        </li>
                            <li>
                            <a href="secretaria">
                                <i class="fas fa-user-plus"></i>
                                <span>Secretaria</span>

                            </a>
                        </li>
                            
                            
                            <li>
                            <a href="perfilMed">
                                <i class="fas fa-user-cog"></i>
                                <span>Perfil</span>

                            </a>
                        </li>';
                        } 
                        ?> 
                       
                    
                        <li>
                            <a href="salir">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </a>
                        </li>  
                </ul>
            </nav>
        </div>
    </div>
    <!-- /Profile Sidebar -->

</div>
 