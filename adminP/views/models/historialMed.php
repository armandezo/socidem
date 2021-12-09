<div class="main-wrapper">
    <?php
    include 'adminP/seguridad/session_interna.php';
    include 'adminP/componentes/header_dash.php';
    include 'adminP/componentes/sidebar.php';
    ?>

    <div class="page-wrapper">

        <div class="content container-fluid">
            <h2>Historial Medico de Citas</h2><br>
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3 input-group date">
                        <div class="input-group-prepend ">
                            <span class="text-white input-group-text bg-info" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input type="text" class="form-control" id="elemento1" placeholder="Desde" autocomplete="off">
                    </div>


                </div>

                <div class="col-md-3">
                    <div class="mb-3 input-group date">
                        <div class="input-group-prepend ">
                            <span class="text-white input-group-text bg-info" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input type="text" class="form-control" id="elemento2" placeholder="Hasta" autocomplete="off">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3 input-group" style="margin-top: 5px;">
                        <button class="btn btn-success btn-sm" style="margin-right: 5px;" onclick="table_row_med()">Buscar</button>
                        <button onclick="table_export_med()" style="margin-right: 5px;" class="btn btn-info btn-sm">Exportar</button>
                        <button onclick="remove_table_med()" class="btn btn-danger btn-sm">Limpiar</button>
                    </div>
                </div>


                <div id="tabla_exp"></div>

                <div class="row">
                <div class="col-md-12" id="grafico_div">

                <canvas id="myChart" width="900" height="400"></canvas>
                </div>

                </div>
            </div>


        </div>
    </div>


</div>