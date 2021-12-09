<div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu-title">
                        <span>Main</span>
                    </li>
                    <li >
                        <a href="adminDash-inicio"><i class="fe fe-home"></i> <span>Dashboard</span></a>
                    </li>

                    <!-- <li >
                        <a href="inicio"><i class="fe fe-layout"></i> <span>Inicio Medicos</span></a>
                    </li> -->
 
                    <li> 
                         <a href="adminDash-doctores"><i class="fe fe-user-plus"></i> <span>Doctores</span></a>
                    </li>
 
                    <li> 
                         <a href="adminDash-pacientes"><i class="fe fe-user"></i> <span>Pacientes</span></a>
                    </li>
                        <?php 
                        if( $_SESSION['user_role'] == 1){ 
                        echo '
                            <li> 
                            <a href="adminDash-usuarios"><i class="fe fe-users"></i> <span>Usuarios</span></a>
                            </li>
                        ';
                        }elseif($_SESSION['user_2'] == 2){
                        echo '';
                        }

                        ?>
                    

                    <li> 
                         <a href="adminDash-citas"><i class="fe fe-document"></i> <span>Citas</span></a>
                    </li>
                    
                    <li class="submenu">
                        <a href="#"><i class="fe fe-activity"></i> <span> Referidos </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <?php 
                            if( $_SESSION['user_role'] == 1){ 
                            echo '
                            <li> 
                            <a href="adminDash-referidos100"> <span>Referidos 100%</span></a>
                            </li>
                            ';
                            }elseif($_SESSION['user_2'] == 2){
                            echo '';
                            }

                            ?>
                           

                            <li> 
                            <a href="adminDash-referidosInt"> <span>Referidos internos</span></a>
                            </li>

                            <li> 
                            <a href="adminDash-referidosExt"> <span>Referidos externos</span></a>
                            </li>

                            
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fe fe-document"></i> <span> Reportes </span> <span class="menu-arrow"></span></a>
                        <ul style="display: none;"> 
                            <li> 
                             <a href="adminDash-historialMed"> <span>Historial de medicos</span></a>
                            </li>
                            <li> 
                             <a href="adminDash-historial"> <span>Historial de pagos</span></a>
                            </li>
                            <li> 
                            <li> 
                             <a href="adminDash-pagosExternos"> <span>Pagos Ref. Externos</span></a>
                            </li>
                            <li> 
                            <a href="adminP/controller/doctoresGratExcel.controlador.php"> <span>Med. Gratuito</span></a>
                            </li>

                            <li> 
                            <a href="adminP/controller/doctoresProfExcel.controlador.php"> <span>Med. Profesional</span></a>
                            </li>

                            <li> 
                            <a href="adminP/controller/doctoresVeriExcel.controlador.php"> <span>Med. Verificado</span></a>
                            </li>
                            
                        </ul>
                    </li>
                    <!-- <li> 
                         <a href="adminDash-repMembresias"><i class="fe fe-document"></i> <span>Reporte Membresias</span></a>
                    </li> -->
                     

                    <li> 
                         <a href="adminDash-salir"><i class="fe fe-logout"></i> <span>Salir</span></a>
                    </li>
                        
                     
                </ul>
            </div>
        </div>
    </div>