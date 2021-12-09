<div class="breadcrumb-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-8 col-12">
                <nav aria-label="breadcrumb" class="page-breadcrumb" style="padding-top: 13px; padding-bottom: 13px;">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="inicio">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Busqueda</li>
                    </ol>
                </nav>

            </div>

        </div>
    </div>
</div>
<!-- /Breadcrumb -->

<!-- Page Content -->
<div class="content">

    <div class="container-fluid">

        <div class="row" data-jplist-control="pagination" data-group="group1" data-name="name1" data-items-per-page="3" data-range="2"
            data-current-page="0" data-disabled-class="disabled" data-selected-class="active" data-name="pagination1">

            <div class="col-md-12 col-lg-4 col-xl-3">

                <!-- Search Filter -->
                <div class="card search-filter">
                    <div class="card-header">
                        <h4 class="mb-0 card-title">Filtro de Busqueda
                        </h4>
                    </div>
                    <div class="card-body">


                        <?php

                        $consDepa = ejecutarSQL::consultar("SELECT `departamentos`.*, `departamentos`.`id` FROM `departamentos` WHERE `departamentos`.`id` = '$routes[1]'");
                        $consProv = ejecutarSQL::consultar("SELECT `provincias`.*, `provincias`.`id` FROM `provincias` WHERE `provincias`.`id` = '$routes[2]'");
                        $consDist = ejecutarSQL::consultar("SELECT `distritos`.*, `distritos`.`id` FROM `distritos` WHERE `distritos`.`id` = '$routes[3]'");
                        $consEspe = ejecutarSQL::consultar("SELECT `especialidades`.*, `especialidades`.`id` FROM `especialidades` WHERE `especialidades`.`id` = '$routes[4]'");

                        while ($datos_depa = mysqli_fetch_assoc($consDepa)) {
                            $nombre_departamento = $datos_depa['name'];
                            echo '
                    <input type="hidden" class="form-control " id="inp1" data-jplist-control="textbox-filter" data-group="group1"
                    data-name="my-filter-1" data-path=".doc-depa"  value="' . $nombre_departamento . '"
                    placeholder="Busqueda por departamento">
                    ';
                        }

                        while ($datos_prov = mysqli_fetch_assoc($consProv)) {
                            $nombre_provincia = $datos_prov['name'];
                            echo '
                    <input type="hidden" class="form-control "  id="inp2"  data-jplist-control="textbox-filter" data-group="group1"
                    data-name="my-filter-1" data-path=".doc-provin"  value="' . $nombre_provincia . '"
                    placeholder="Busqueda por provincia">
                    ';
                        }

                        while ($datos_dist = mysqli_fetch_assoc($consDist)) {
                            $nombre_distrito = $datos_dist['name'];
                            echo '
                    <input type="hidden" class="form-control "  id="inp3" data-jplist-control="textbox-filter" data-group="group1"
                    data-name="my-filter-1" data-path=".doc-dist"  value="' . $nombre_distrito . '"
                    placeholder="Busqueda por distrito">
                    ';
                        }

                        while ($datos_esp = mysqli_fetch_assoc($consEspe)) {
                            $nombre_especialidad = $datos_esp['nombre'];
                            echo '
                    <input type="hidden" class="form-control "  id="inp4" data-jplist-control="textbox-filter" data-group="group1"
                    data-name="my-filter-1" data-path=".doc-esp"  value="' . $nombre_especialidad . '"
                    placeholder="Busqueda por especialidad">
                    ';
                        }

                        ?>
                        <div class="filter-widget">
                            <h4>Busca por Especialidad</h4>
                            <select class="form-control floating" data-jplist-control="select-filter" data-group="group1" data-name="name2">

                                <option value="0" data-path="default">Todas las Especialidades</option>

                                <?php

                                while ($datos_espe = mysqli_fetch_assoc($espeCons)) {
                                    $nom_espe = $datos_espe['nombre'];
                                    $slug_espe = $datos_espe['slug'];
                                    $id_espe = $datos_espe['id'];
                                    echo '

                                    <option data-path=".' . $slug_espe . '" >' . $nom_espe . '</option>

                                    ';
                                }



                                ?>

                            </select>
                        </div>


                        <div class="filter-widget">
                            <h4>Busca por Nombre</h4>
                            <div class="">
                                <div style="display: none" data-jplist-control="hidden-sort" data-group="group1" data-path=".doc-name"
                                    data-order="desc" data-type="text" data-clear-btn-id="name-clear-btn">
                                </div>
                                <input type="text" class="form-control " data-jplist-control="textbox-filter" data-group="group1"
                                    data-name="my-filter-1" data-path=".doc-name" type="text" value="" data-clear-btn-id="name-clear-btn"
                                    placeholder="Busqueda por Nombre">
                                <div class="input-group-append">

                                </div>
                            </div>
                        </div>



                        <div class="filter-widget">
                            <h4>Busca por Departamento</h4>
                            <div class="">
                                <select data-jplist-control="select-filter" data-group="group1" data-name="name3" name="departamento"
                                    class="form-control" id="departamento" onchange="cargaProvincias();">
                                    <option default hidden>Departamentos</option>
                                    <option data-path="default">Todas los departamentos</option>
                                </select>

                            </div>
                        </div>

                        <div class="filter-widget">
                            <h4>Busca por Provincia</h4>
                            <div class="">

                                <select data-jplist-control="select-filter" data-group="group1" data-name="name5" name="provincia"
                                    class="form-control" id="provincia" onchange="cargaDistritos();">
                                    <option default hidden>Provincias</option>
                                    <option data-path="default">Todas las provincias</option>
                                </select>
                            </div>
                        </div>

                        <div class="filter-widget">
                            <h4>Busca por Distrito</h4>
                            <div class="">

                                <select data-jplist-control="select-filter" data-group="group1" data-name="name4" name="distrito" class="form-control"
                                    id="distrito">
                                    <option default hidden>Distritos</option>
                                    <option data-path="default">Todas los distritos</option>
                                </select>
                            </div>
                        </div>

                        <div class="filter-widget">
                            <h4>Rango de Precios</h4>
                            <div class="range-slider">
                                <?php
                                while ($maxPrice_C = mysqli_fetch_assoc($maximoCons)) {
                                    $rago_Price_C = $maxPrice_C['precio_consulta'];

                                ?>
                                <div data-jplist-control="slider-range-filter" data-path=".rango_price" data-group="group1"
                                    data-name="width-range-slider" data-min="0" data-from="0" data-clear-btn-id="name-clear-btn"
                                    data-to="<?php echo $rago_Price_C; ?>" data-max="<?php echo $rago_Price_C; ?>">

                                    <span class="range-slider-value">

                                        <span data-type="value-2"></span>

                                        <span style="float:right;" class="range-slider-value" data-type="value-1"></span>
                                    </span>

                                    <div class="jplist-slider" data-type="slider"></div>

                                    <span style="float:right;">Min</span>
                                    <span style="float:left;">Max</span>

                                </div>
                                <?php
                                }
                                ?>
                            </div>



                        </div>
                        <br>
                        <button class="btn btn-primary btn-block" data-jplist-control="reset" onclick="reset()" data-group="group1" type="button">
                            Reset
                        </button>



                    </div>

                </div>
                <!-- /Search Filter -->

            </div>


            <div class="col-md-12 col-lg-8 col-xl-9" data-jplist-group="group1">
                <?php
                while ($data_medicos_C = mysqli_fetch_assoc($listMedicos)) {
                    $nombre_completo_C = $data_medicos_C['nombre_completo'];
                    $foto_C = $data_medicos_C['foto'];
                    $num_colegiatura_C = $data_medicos_C['num_colegiatura'];
                    $especialidad_C = $data_medicos_C['especialidad'];

                    $espConsFilter = ejecutarSQL::consultar("SELECT `especialidades`.`nombre`, `especialidades`.`slug`, `especialidades`.`id`  FROM `especialidades` WHERE `especialidades`.`nombre` = '$especialidad_C';");

                    while ($data_esp_F_C = mysqli_fetch_assoc($espConsFilter)) {

                        $id_esp_C = "_" . $data_esp_F_C['id'];
                        $slug_C = $data_esp_F_C['slug'];
                    }


                    $servicios_C = $data_medicos_C['servicios'];
                    $titulo_C = $data_medicos_C['titulo'];
                    $ubicacion_C = $data_medicos_C['ubicacion'];
                    $nombre_clinica_C = $data_medicos_C['nombre_clinica'];
                    $direccion_clinica_C = $data_medicos_C['direccion_clinica'];
                    $precio_consulta_C = $data_medicos_C['precio_consulta'];
                    $precio_online_C = $data_medicos_C['precio_online'];
                    $codigo_referido_C = $data_medicos_C['codigo_referido'];
                    $separated = explode(',', $servicios_C);
                    $track = md5($codigo_referido_C);

                    $extra_slug = preg_replace("/[^a-zA-Z0-9 \_\-]+/", '', $nombre_completo_C . " " . $especialidad_C . " " . $ubicacion_C);


                    $journalName = preg_replace('/\s+/', '-', $extra_slug);
                    echo '
                    <div class="card" data-jplist-item>
                    <div class="card-body" >
                        <div class="doctor-widget">
                            <div class="doc-info-left">
                                <div class="doctor-img">
                                    <a href="perfil-' . $codigo_referido_C . '-' . $journalName . '">
                                        <img src="views/assets/images/medicos/' . $foto_C . '" class="img-fluid" alt="User Image" style="    height: 200px!important; position: relative; left: 8px;">
                                    </a>
                                    <div class="doctor-action" style="position: absolute; bottom: -5px; left: 27px;">


									</div>
                                </div>
                                <div class="doc-info-cont">
                                    <h4 class="doc-name"><a href="perfil-' . $codigo_referido_C . '-' . $journalName . '" style="text-transform: capitalize;">Dr. ' . $nombre_completo_C . '</a></h4>
                                    <p class="doc-speciality" style="text-transform: capitalize;">' . $titulo_C . '</p>
                                    <h5 class="doc-department " style="color: #757575;">
                                        <img src="views/assets/img/especial.png" class="img-fluid" alt="especialidad"> <span class="doc-esp ' . $slug_C . '">' . $especialidad_C . '</span>
                                    </h5>

                                    <h5 class="doc-department" style="color: #757575;">
                                        <img src="views/assets/img/estetoscopio.png" class="img-fluid" alt="colegiatura" style="margin-right: 13px;">#' . $num_colegiatura_C . '
                                    </h5>

                                    <div class="clinic-details doc-servicio doc-locate">
                                        <p class="doc-department" style="color: #757575; font-weight: 500;">
                                            <img src="views/assets/img/marcador-de-posicion.png" class="img-fluid" alt="localizacion">

                                            <span class="doc-depa doc-dist doc-provin ' . $ubicacion_C . '" style="color: #757575; font-weight: 500;">' . $ubicacion_C . '</span>
                                        </p>

                                    </div>


                                    <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded direccion_class">
                                    <li class="nav-item" style="padding-right: 19px;"><a class="nav-link active" href="#presencial-' . $track . '" data-toggle="tab" style="    background-color: #FF7C00; color: white;  border-color: #FF7C00;"><i class="far fa-calendar"></i> Presencial S/ ' . $precio_consulta_C . '</a></li>
                                     <li class="nav-item"><a class="nav-link " style="background-color: #008292; color: white;" href="#online-' . $track . '" data-toggle="tab"><i class="fa fa-video"></i> Online S/ ' . $precio_online_C . '</a></li>
                                 </ul>
                                <div class="tab-content content_class">
                                    <div class="tab-pane show active" id="presencial-' . $track . '">

                                    <div class="d-flex align-items-top"  style="position: relative; bottom: -7px;">
                                    <div class="pr-1">

                                    </div>

                                </div>
                                    </div>


                                </div>


                                    <input type="hidden" class="rango_price" value="45">





                                    </div>

                            </div>

                            <div class="doc-info-right "wrapper">
                            <div class="rescalendar" id="cal-' . $track . '"></div>
                            </div>
                        </div>
                        <script> cargaCalendar("cal-' . $track . '","' . $codigo_referido_C . '", 3, "paciente") </script>

                        </div>
                </div>
                ';
                }
                ?>









                <div class="text-center col" data-jplist-control="no-results" data-group="group1" data-name="no-results"><br>
                    <h5>No se encontraron resultados</h5>
                </div>


            </div>
            <div class="product-pagination" style="margin-left: auto; margin-right: auto;">
                <div class="theme-paggination-block">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 col-sm-12">
                            <nav aria-label="Page navigation">
                                <ul class="pagination ">


                                    <li class="page-item" data-type="prev">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">
                                                <i class="fa fa-chevron-left" aria-hidden="true"></i></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    <ul class="pagination justify-content-center info jplist-holder" data-type="pages">
                                        <li class="page-item" data-type="page"><a class="page-link" href="#">{pageNumber}</a></li>
                                    </ul>
                                    <li class="page-item" data-type="next">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">
                                                <i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-12">
                            <div class="product-search-count-bottom">
                                <h5 data-type="info"> Mostrando Resultados {startItem} - {endItem} De {itemsNumber}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<script src="views/assets/plugins/jQuery-Plugin-stringToSlug-2.1.0/src/jquery.stringtoslug.js"></script>

<script>
$(document).ready(function() {
    $("#name").stringToSlug({
        setEvents: 'keyup keydown blur',
        getPut: '#slug',
        space: '-'

    });



    jplist.init();



});

function reset() {
    window.location.href = "busqueda";
}
</script>