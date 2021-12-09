<?php include 'views/admin/breadcrumb_med.php'; ?>
    
    <!-- Page Content -->
    <div class="content" >
    <div class="container-fluid ajust_fluid">

        <div class="row">

            <?php include 'views/admin/sidebar.php'; ?>

            <div class="col-md-7 col-lg-8 col-xl-9">
                 <?php include 'views/admin/promo.php'; ?>
                <link rel="stylesheet" href="views/assets/css/agenda.css">
                <?php 
                if($membresia_ == "Gratuito"  ) {
                echo '<img src="views/assets/images/agenda.png" >';
                }else {

                ?>
                <form action="" method="post" id="form_cita"> 
                    <div class="mb-0 card card-table" style="text-align: center">
                        <br> 
                        <h3>Selecciona el dia </h3>
                        <br>
                        <div class="card-body" style="margin-left: 5%;  margin-right: 5%;">

                            <input class="ocult" type="checkbox" name="check_date[]" value="Lunes" id="primer_toggle"
                                onclick="validate('primer_toggle' , 'Lunes');">
                            <label for="primer_toggle" class="btn btn-primary submit-btn control-me-primer_toggle "> LUNES </label>

                            <input class="ocult" type="checkbox" name="check_date[]" value="Martes" id="segundo_toggle"
                                onclick="validate('segundo_toggle' , 'Martes');">
                            <label for="segundo_toggle" class="btn btn-primary submit-btn control-me-segundo_toggle "> MARTES </label>

                            <input class="ocult" type="checkbox" name="check_date[]" value="Miércoles" id="tercer_toggle"
                                onclick="validate('tercer_toggle' , 'Miércoles');">
                            <label for="tercer_toggle" class="btn btn-primary submit-btn control-me-tercer_toggle "> MIERCOLES </label>

                            <input class="ocult" type="checkbox" name="check_date[]" value="Jueves" id="cuarto_toggle"
                                onclick="validate('cuarto_toggle' , 'Jueves');">
                            <label for="cuarto_toggle" class="btn btn-primary submit-btn control-me-cuarto_toggle "> JUEVES </label>

                            <input class="ocult" type="checkbox" name="check_date[]" value="Viernes" id="quinto_toggle"
                                onclick="validate('quinto_toggle' , 'Viernes');">
                            <label for="quinto_toggle" class="btn btn-primary submit-btn control-me-quinto_toggle "> VIERNES </label>

                            <input class="ocult" type="checkbox" name="check_date[]" value="Sábado" id="sexto_toggle"
                                onclick="validate('sexto_toggle' , 'Sábado');">
                            <label for="sexto_toggle" class="btn btn-primary submit-btn control-me-sexto_toggle"> SABADO </label>

                            <input class="ocult" type="checkbox" name="check_date[]" value="Domingo" id="septimo_toggle"
                                onclick="validate('septimo_toggle' , 'Domingo');">
                            <label for="septimo_toggle" class="btn btn-primary submit-btn control-me-septimo_toggle "> DOMINGO </label>

                            <br>
                            <br>

                            <h3>Selecciona el Tiempo de la cita </h3>
                            <br>
                            <input type="hidden" id="rango_recib_presencial">
                            <div class="card-body" style="margin-left: auto; margin-right: auto; width: 60%; display: inline-flex;">
                                <select class="form-control" name="rango_gen_presencial" id="rango_gen_presencial" style="margin-right: 50px;" onchange="cambiaColorRadio(this)">
                                
                                
                                <option value="" selected>Duración Presencial</option>
                                    <option value="30">
                                        30 Min - Presencial
                                    </option>
                                    <option value="45">
                                        45 Min - Presencial
                                    </option>
                                    <option value="60">
                                        60 Min - Presencial
                                    </option>
                                    


                                </select>
                                
                                <select class="form-control" name="rango_gen_online" id="rango_gen_online" onchange="cambiaColorRadio(this)">
                                <option value=""   selected>Duración Online</option>
                                    <option value="30">
                                        30 Min - Online
                                    </option>
                                    <option value="45">
                                        45 Min - Online
                                    </option>
                                    <option value="60">
                                        60 Min - Online
                                    </option>
                                    


                                </select> 
                                    
                            </div> 
                            <br>
                            <br>
                            <a href="javascript:" class="btn btn-elim " onclick="subir()" style="background: #008298; border: 1px solid #ececec; color:white;"> <i
                                    class="fa fa-save"></i> Guardar Agenda </a> 
                            <a href="exepciones" class="btn btn-elim " style="background: #008298; border: 1px solid #ececec; color:white;"> <i
                                    class="fa fa-cog"></i> Configurar Excepciones </a>
                            <a href="javascript:" class="btn btn-elim " onclick="limpiar()" style="background: #008298; border: 1px solid #ececec; color:white;"> <i
                                class="fa fa-trash"></i> Limpiar Agenda </a>
                            <br>
                            <br>
                            <div class="card-body " style="text-align: center; " id="box_cita">
                            </div>
                        </div>
                    </div>
                </form>
                <?php }?>
            </div>

        </div>
       
    </div>
   
    </div>

   

    <?php 

    if($comps[$i] == "text"){
        echo '<h3 class="nob">
        <textarea type="text" class="nol ml0 lumise-edit-text" placeholder="'.$this->main->lang('Enter your text').'"></textarea>
    </h3>';
    }


    ?>

    <script> 

        

        function cambiaColor(sel, track){
            
            if(sel.value == "Presencial"){
                $("#tipoCita-"+track).removeClass('select_online');
                $("#tipoCita-"+track).addClass('select_presencial');
            }else {
                $("#tipoCita-"+track).removeClass('select_presencial');
                $("#tipoCita-"+track).addClass('select_online');
            }
            
        }

        cargaTiempoCita();
        function cargaTiempoCita(){
            
            $.ajax({ 
                url: "controller/dashboard/cargaTiempoAgenda.controlador.php",  
                success: function(data) {
                    var datax = JSON.parse(data);
                    
                    $('#rango_gen_presencial').addClass('select_presencial').val(datax.horapresencial); 
                    $('#rango_gen_online').addClass('select_online').val(datax.horaonline); // also selects "Two"
                
                    
                }  
                
            });
            
        }


        function cambiaColorRadio(sel){
            
            if(sel.id == "rango_gen_presencial"){
            $("#rango_gen_presencial").removeClass('select_online');
            $("#rango_gen_presencial").addClass('select_presencial');
            }else {
            $("#rango_gen_online").removeClass('select_presencial');
            $("#rango_gen_online").addClass('select_online');
            }

            
            
        }


        function changeColor(tipo) {

            $('input[type=checkbox]').prop('checked', false);
            var tipo_cita = tipo;

            $.ajax({
                type: "POST",
                url: "controller/dashboard/buscaPrecio.controlador.php",
                data: {
                    tipo_cita: tipo_cita
                },
                success: function(data) {

                    $('#precio_cita').html(data);


                }
            });

            if (tipo == 'online') {

                $(".online_t").addClass('tipo_class_online');
                $(".presencial_t").removeClass('tipo_class_presencial');


                $(".control-me-primer_toggle").addClass('blue_class_primer');
                $(".control-me-segundo_toggle").addClass('blue_class_segundo');
                $(".control-me-tercer_toggle").addClass('blue_class_tercer');
                $(".control-me-cuarto_toggle").addClass('blue_class_cuarto');
                $(".control-me-quinto_toggle").addClass('blue_class_quinto');
                $(".control-me-sexto_toggle").addClass('blue_class_sexto');
                $(".control-me-septimo_toggle").addClass('blue_class_septimo');

                $(".control-me-primer_toggle").removeClass('orange_class_primer');
                $(".control-me-segundo_toggle").removeClass('orange_class_segundo');
                $(".control-me-tercer_toggle").removeClass('orange_class_tercer');
                $(".control-me-cuarto_toggle").removeClass('orange_class_cuarto');
                $(".control-me-quinto_toggle").removeClass('orange_class_quinto');
                $(".control-me-sexto_toggle").removeClass('orange_class_sexto');
                $(".control-me-septimo_toggle").removeClass('orange_class_septimo');
            } else {

                $(".presencial_t").addClass('tipo_class_presencial');
                $(".online_t").removeClass('tipo_class_online');



                $(".control-me-primer_toggle").addClass('orange_class_primer');
                $(".control-me-segundo_toggle").addClass('orange_class_segundo');
                $(".control-me-tercer_toggle").addClass('orange_class_tercer');
                $(".control-me-cuarto_toggle").addClass('orange_class_cuarto');
                $(".control-me-quinto_toggle").addClass('orange_class_quinto');
                $(".control-me-sexto_toggle").addClass('orange_class_sexto');
                $(".control-me-septimo_toggle").addClass('orange_class_septimo');

                $(".control-me-primer_toggle").removeClass('blue_class_primer');
                $(".control-me-segundo_toggle").removeClass('blue_class_segundo');
                $(".control-me-tercer_toggle").removeClass('blue_class_tercer');
                $(".control-me-cuarto_toggle").removeClass('blue_class_cuarto');
                $(".control-me-quinto_toggle").removeClass('blue_class_quinto');
                $(".control-me-sexto_toggle").removeClass('blue_class_sexto');
                $(".control-me-septimo_toggle").removeClass('blue_class_septimo');
            }


            $("#box_cuerpo-primer_toggle").remove();
            $("#box_cuerpo-segundo_toggle").remove();
            $("#box_cuerpo-tercer_toggle").remove();
            $("#box_cuerpo-cuarto_toggle").remove();
            $("#box_cuerpo-quinto_toggle").remove();
            $("#box_cuerpo-sexto_toggle").remove();
            $("#box_cuerpo-septimo_toggle").remove();


        }



        function validate(id, dia) {

            $.ajax({
                type: "POST",
                url: "controller/dashboard/horarios.controlador.php",
                data: {
                    id: id,
                    dia: dia
                },
                success: function(data) {

                    var cuerpo = data;
                    var tracking = document.getElementById(id).checked;
        
                    if (document.getElementById(id).checked) { 
                        $("#box_cita").append(cuerpo); 

                    } else {
                        var track_cuerpo = "#box_cuerpo-" + id;

                        $("#box_cuerpo-" + id).remove();
                    }
                }

            });

        }

        function agregarMas(dia, track, id) {

            var data1 = $('#form-' + track).serialize() + "&dia=" + dia;

            $.ajax({
                type: "POST",
                url: "controller/dashboard/agregarHorario.controlador.php",
                data: data1,
                success: function(data) {
                
                
                    if (data == "false") {
                        Swal.fire({
                            title: 'HORARIOS DUPLICADOS',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        // 
                    } else {

                        $("#carga_horario_" + id).append(data);
                    }



                }
            });

        }

        function quitarHorario(track, dia) {
            let dias_creados = document.querySelectorAll(".fila_horarios_"+dia).length;
            
            
            if(dias_creados == 1){
            
                Swal.fire({
                title: 'SEGURO QUE DESEA ELIMINAR',
                icon: 'warning',
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: '<i class="fa fa-clone"></i> Eliminar',
                confirmButtonAriaLabel: 'Thumbs up, great!',
                cancelButtonText: '<i class="fa fa-times"></i> Cancelar',
                cancelButtonAriaLabel: 'Thumbs down'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                    type: "POST",
                    url: "controller/dashboard/limpiarDiaAgenda.controlador.php",
                    data: {
                    dia_reset: dia
                    },
                    success: function(data) { 
                    
                    Swal.fire({
                        title: 'ELIMINADO CON EXITO',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        $("#row_hora_" + track).remove();
                    
                    });


                    } 
                    });
                } else {

                }
                }); 
            }else {
                $("#row_hora_" + track).remove();
            }
        
            
        }

        function cleanRange(track) {

            var temp = "rango-" + track;
            $("rango" + track).val(temp);

            document.getElementById(temp).selectedIndex = 3;

        }


        function getComboA(selectObject, track_id) {


            var rango = selectObject.value;
            var hora = document.getElementById("hora-" + track_id).value;

            $.ajax({
                type: "POST",
                url: "controller/dashboard/rangoHorario.controlador.php",
                data: {
                    hora: hora,
                    rango: rango
                },
                success: function(data) {

                    var NewHora = document.getElementById(track_id);
                    NewHora.value = data;

                }
            });



        }

        function replicar(track, dia) {
            Swal.fire({
                title: 'SEGURO QUE DESEA REPLICAR EL '+dia,
                icon: 'warning',
                showConfirmButton: true,
                showCancelButton: true,
                confirmButtonText: '<i class="fa fa-clone"></i> Replicar',
                confirmButtonAriaLabel: 'Thumbs up, great!',
                cancelButtonText: '<i class="fa fa-times"></i> Cancelar',
                cancelButtonAriaLabel: 'Thumbs down'
            }).then((result) => {

                if (result.isConfirmed) {
                    var rango_presencial = document.getElementById('rango_gen_presencial').value;
                    var rango_online = document.getElementById('rango_gen_online').value;
                    
                    var dias_replica = $('input[name="check_date[]"]:checked').map(function () {return this.value}).get();
        
                    var serialize = $('#form_track_'+dia).serialize()+"&dias_replica="+dias_replica+"&dia_track=" + dia+"&rango_gen_presencial="+rango_presencial+"&rango_gen_online="+rango_online;
                    
                    $.ajax({
                        type: "POST",
                        url: "controller/dashboard/replicarAgenda.controlador.php",
                        data: serialize,
                        success: function(data) {  
        
                            switch (data) {
                            case "ok":
                                Swal.fire({
                                title: 'REPLICADO CON EXITO',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                        
                                });

                                var tracking = $('input[name="check_date[]"]:checked').map(function () {
                                
                                    var track_cuerpo = "#box_cuerpo-" + this.id; 
                                    $("#box_cuerpo-" + this.id).remove(); 

                                    cargaDiferida(this.id, this.value);
                                
                                }).get();
                                
                                
                                //  
                                // setTimeout(function(){  location.reload(); }, 2000);

                            break;

                            case 'false':
                                Swal.fire({
                                title: 'ELIGE UN RANGO DE HORARIO',
                                icon: 'error',
                                showConfirmButton: false,
                                timer: 1500
                                })
                            break; 

                            

                            default: 
                                Swal.fire({
                                title: data,
                                icon: 'error',
                                showConfirmButton: true, 
                                }) 
                            break;
                            }

                        

                        }
                    });
                } else {

                }
            });
        }

        function cargaDiferida(id, dia){

                $.ajax({
                type: "POST",
                url: "controller/dashboard/horarios.controlador.php",
                data: {
                id: id,
                dia: dia
                },
                success: function(data) {

                var cuerpo = data;
                var tracking = document.getElementById(id).checked;

                if (document.getElementById(id).checked) { 
                $("#box_cita").append(cuerpo); 

                }  

                }

                });

        }

        function limpiar(){
            
            $.ajax({
                type: "POST",
                url: "controller/dashboard/limpiarAgenda.controlador.php", 
                success: function(data) { 

                    Swal.fire({
                        title: 'LIMPIADO CON EXITO',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {

                        location.reload();
                    });


                } 
            });

        }

        

        function subir() { 
            
            var serialize = $('#form_cita, #form_track_Lunes, #form_track_Martes, #form_track_Miércoles, #form_track_Jueves, #form_track_Viernes, #form_track_Sábado, #form_track_Domingo   ').serialize();  

            $.ajax({
                type: "POST",
                url: "controller/dashboard/crearAgenda.controlador.php",
                data: serialize,
                success: function(data) { 
                    
                    switch (data) {
                        case "ok":
                            Swal.fire({
                            title: 'AGREGADO CON EXITO',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            // location.reload();
                            if (result.isConfirmed) {
                                
                            } else {

                            }
                        });
                    
                        break;

                        case "vacio":
                            Swal.fire({
                            title: 'ERROR CAMPOS VACIOS',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {

                        
                        });
                        break;
                        case "error":
                            Swal.fire({
                            title: 'ERROR CAMPOS CORRUPTOS',
                            icon: 'error',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {

                            location.reload();
                        });
                        break;

                        default: 
                        Swal.fire({
                            title: data,
                            icon: 'error',
                            showConfirmButton: true, 
                        }) 
                        break;
                    }
                

                }
            });

        }


        function selectall(id) {

            $("#selectall-" + id).change(function() {
                $(".horario-" + id).prop('checked', $(this).prop("checked"));
            });

        }
</script>