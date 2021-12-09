function modalCred(id) {


    $.ajax({
        type: "POST",
        url: "controller/dashboard/credenciales.controlador.php",
        data: {
            id: id,

        },
        success: function(data) {
            $('#cuerpo_cred').html(data);
            $('#credenciales').modal('show');
        }
    });

}

function modalDetalle(id) {


    $.ajax({
        type: "POST",
        url: "controller/dashboard/agendaMedListPacient.controlador.php",
        data: {
            id: id,

        },
        success: function(data) {
            $('#cuerpo_detalles_paciente').html(data);
            $('#detalles_med_paciente').modal('show');
            $('#detalles_cli_agenda').modal('hide');
        }
    });


}

function modalReAsignarCita(cod) {
    $('#id_cita_val').val(cod);
    $('#detalles_cli_agenda').modal('hide');
    $('#reasignar_horario').modal('show');
}

function atenderPaciente(id) {
    $.ajax({
        type: "POST",
        url: "controller/dashboard/agendaCambioAtendido.controlador.php",
        data: {
            id: id,

        },
        success: function(data) {
            Swal.fire({
                title: 'ATENDIDO CON EXITO',
                icon: 'success',
                showConfirmButton: false,
                timer: 1500
            });

            setTimeout(function() { location.reload(); }, 1500);
        }
    });
}

function histCitas() {

    elemento1 = document.getElementById("fecha_1");
    elemento2 = document.getElementById("fecha_2");

    $.ajax({
        type: "POST",
        url: "controller/dashboard/histCistas.controlador.php",
        data: {
            elemento1: elemento1,
            elemento2: elemento2

        },
        success: function(data) {

        }
    });



}


function modalConfirm(id) {


    $.ajax({
        type: "POST",
        url: "controller/dashboard/confirmarCita.controlador.php",
        data: {
            id: id,

        },
        success: function(data) {
            $('#cuerpo_confirm_paciente').html(data);
            $('#confirm_cita_paciente').modal('show');
        }
    });


}


function modalReasignar(cod_med, cod_consulta) {

    $.ajax({
        type: "POST",
        url: "controller/dashboard/reAsignarCita.controlador.php",
        data: {
            cod_med: cod_med,
            cod_consulta: cod_consulta
        },
        success: function(data) {
            $('#cuerpo_citas_medico').html(data);
            $('#example_id').DataTable({ "destroy": true, "iDisplayLength": "5", "aLengthMenu": [5, 10, 15, 20, 50, 100], "lengthMenu": true });
            $('#re_asig_cita_paciente').modal('show');
        }
    });

}

function actualizarAgenda(cod_med, cod_consulta, id) {


    $.ajax({
        type: "POST",
        url: "controller/dashboard/actualizarAgendaCita.controlador.php",
        data: {
            cod_med: cod_med,
            cod_consulta: cod_consulta,
            id: id

        },
        success: function(data) {
            alert(data);
            window.location = "dashboard";
        }
    });

}

function enviarWhatsApp(id) {


    alert("hoa");




}


function enviarCorreo(id) {

    $.ajax({
        type: "POST",
        url: "controller/dashboard/correo.controlador.php",
        data: {
            id: id,
        },
        success: function(data) {

            Swal.fire(data, '', 'info')

        }
    });



}

function updateRoom(id) {

    $.ajax({
        type: "POST",
        url: "controller/dashboard/upVideoConf.controlador.php",
        data: {
            id: id
        },
        success: function(data) {
            alert(data);
            window.location = "dashboard";

        }
    });
};


function updatePresencialCita() {


    var type = $('#update-presencial-cita').attr('method');
    var url = $('#update-presencial-cita').attr('action');
    var formType = $('#update-presencial-cita').attr('data-form');


    $.ajax({
        type: type,
        url: url,
        data: $('#update-presencial-cita').serialize(),
        success: function(data) {
            alert(data);
            window.location = "dashboard";

        }
    });
};


function AbrirAgenda(fecha, hora) {

    $.ajax({
        type: 'POST',
        url: 'controller/dashboard/abrirAgenda.controlador.php',
        data: {
            fecha: fecha,
            hora: hora
        },
        success: function(data) {

            $('#cuerpo_crear_agenda').html(data);
            $('#crear_agenda').modal('show');

        }
    });
}

function CrearAgenda(fecha, hora, token) {
    var tipo = $("input[type='radio'][name='radio']:checked").val();


    $.ajax({
        type: 'POST',
        url: 'controller/dashboard/crearAgenda.controlador.php',
        data: {
            fecha: fecha,
            hora: hora,
            tipo: tipo
        },
        success: function(data) {


            $('#crear_agenda').modal('hide');
            cargaCalendar("cal-" + token, token, 8, "med");

        }
    });
}

function procesoCita(a, token, fecha, hora_init, time, type) {
    var cod_cita = $('#id_cita_val').val();



    Swal.fire({
        title: '¢ÄSeguro que desea Reasignar?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `SI`,
        denyButtonText: `NO ReAsignar`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: 'controller/dashboard/reAsignarAgenda.controlador.php',
                data: {
                    cod_cita: cod_cita,
                    fecha: fecha,
                    hora_init: hora_init,
                    time: time,
                    type: type
                },
                success: function(data) {
                    $('#reasignar_horario').modal('hide');
                    Swal.fire('Re Asignado con Exito', '', 'success');
                    cargaCalendar("rea-" + token, token, 8, "paciente");
                    cargaCalendar("cal-" + token, token, 8, "dash_med");


                }
            });
        } else if (result.isDenied) {
            Swal.fire('NO ReAsignado', '', 'error')
        }
    })
}

function elimAgenda(id, token) {

    Swal.fire({
        title: '¢ÄSeguro que desea Eliminar?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `SI`,
        denyButtonText: `NO ELIMINAR`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {

            $.ajax({
                type: 'POST',
                url: 'controller/dashboard/elimAgenda.controlador.php',
                data: {
                    id: id
                },
                success: function(data) {

                    Swal.fire({
                        title: 'ELIMINADO CON EXITO',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    cargaCalendar("cal-" + token, token, 8, "med");

                }
            });

        } else if (result.isDenied) {
            Swal.fire('NO ELIMINADO', '', 'error')
        }
    });

}

function abrirDetallesCli(cod_agenda) {

    $.ajax({
        type: 'POST',
        url: 'controller/dashboard/modalDetCli.controlador.php',
        data: {
            cod_agenda: cod_agenda
        },
        success: function(data) {



            $('#cuerpo_detalles_cli_agenda').html(data);
            $('#detalles_cli_agenda').modal('show');

        }
    });

}

function addHC(cod_correo) {

    $.ajax({
        type: 'POST',
        url: 'controller/dashboard/addHC.controlador.php',
        data: {
            cod_correo: cod_correo
        },
        success: function(data) {

            $('#cuerpo_addHC').html(data);
            $('#crear_HC').modal('show');

        }
    });
}


function createHC() {

    var s = document.getElementById('texto_HC').value;

    if (s == "") {
        Swal.fire('Campo Vacio', '', 'error')
    } else {
        $.ajax({
            type: 'POST',
            url: 'controller/dashboard/createHC.controlador.php',
            data: $('#form_HC').serialize(),
            success: function(data) {
                Swal.fire('AGREGADO CON EXITO', '', 'success');
                $("#elemento_1").load(location.href + " #elemento_1");
                $('#crear_HC').modal('hide');
                // setTimeout(function() { location.reload(); }, 1500);

            }
        });
    }


}

function editHC(cod_correo, id, fecha) {

    $.ajax({
        type: 'POST',
        url: 'controller/dashboard/editHC.controlador.php',
        data: {
            cod_correo: cod_correo,
            id: id,
            fecha: fecha
        },
        success: function(data) {
            $('#cuerpo_addHC').html(data);
            $('#crear_HC').modal('show');

        }
    });
}

function GuardarEditHC(id) {

    var s = document.getElementById('texto_HC').value;

    if (s == "") {
        Swal.fire('Campo Vacio', '', 'error')
    } else {
        $.ajax({
            type: 'POST',
            url: 'controller/dashboard/GuardarEditHC.controlador.php',
            data: $('#form_HC').serialize() + "&id_obj=" + id,
            success: function(data) {
                Swal.fire('EDITADO CON EXITO', '', 'success');
                $("#elemento_1").load(location.href + " #elemento_1");
                $('#crear_HC').modal('hide');
                // setTimeout(function() { location.reload(); }, 1500);

            }
        });
    }
}

function addLab(cod_correo) {

    $.ajax({
        type: 'POST',
        url: 'controller/dashboard/addDataHC.controlador.php',
        data: {
            cod_correo: cod_correo
        },
        success: function(data) {

            $('#cuerpo_addLab').html(data);
            $('#crear_Lab').modal('show');

            var analisis_lab = new Dropzone(".analisis_lab", {
                autoProcessQueue: false,
                parallelUploads: 10,
                acceptedFiles: '.png, .jpeg, .jpg',
                addRemoveLinks: true,
                uploadMultiple: true,
                maxFiles: 5,
                dictRemoveFileConfirmation: "Estas seguro?",
                dictCancelUpload: "Cancelar",
                dictRemoveFile: "Remover",
                dictDefaultMessage: "Maximo 5 imagenes",
                init: function() {
                    this.on("success", function(file, responseText) {

                        Swal.fire('AGREGADO CON EXITO', '', 'success');
                        $("#analisis_lab").load(location.href + " #analisis_lab");
                        $('#crear_Lab').modal('hide');
                    });
                }
            });

            $('#uploadfiles_lab').click(function() {
                analisis_lab.processQueue();
            });
        }

    });

}

function addImgDig(cod_correo) {

    $.ajax({
        type: 'POST',
        url: 'controller/dashboard/addDataImgDig.controlador.php',
        data: {
            cod_correo: cod_correo
        },
        success: function(data) {

            $('#cuerpo_addImgDig').html(data);
            $('#crear_img_dig').modal('show');

            var img_dig = new Dropzone(".img_dig", {
                autoProcessQueue: false,
                parallelUploads: 10,
                acceptedFiles: '.png, .jpeg, .jpg',
                addRemoveLinks: true,
                uploadMultiple: true,
                maxFiles: 5,
                dictRemoveFileConfirmation: "Estas seguro?",
                dictCancelUpload: "Cancelar",
                dictRemoveFile: "Remover",
                dictDefaultMessage: "Maximo 5 imagenes",
                init: function() {
                    this.on("success", function(file, responseText) {

                        Swal.fire('AGREGADO CON EXITO', '', 'success');
                        $("#imagenes_digitales").load(location.href + " #imagenes_digitales");
                        $('#crear_img_dig').modal('hide');
                    });
                }
            });

            $('#uploadfiles_img_dig').click(function() {
                img_dig.processQueue();
            });
        }

    });

}

function addRecetas(cod_correo) {

    $.ajax({
        type: 'POST',
        url: 'controller/dashboard/addDataRM.controlador.php',
        data: {
            cod_correo: cod_correo
        },
        success: function(data) {

            $('#cuerpo_addRecetas').html(data);
            $('#crear_recetas').modal('show');
            var recetas = new Dropzone(".recetas", {
                autoProcessQueue: false,
                parallelUploads: 10,
                acceptedFiles: '.png, .jpeg, .jpg',
                addRemoveLinks: true,
                uploadMultiple: true,
                maxFiles: 5,
                dictRemoveFileConfirmation: "Estas seguro?",
                dictCancelUpload: "Cancelar",
                dictRemoveFile: "Remover",
                dictDefaultMessage: "Maximo 5 imagenes",
                init: function() {
                    this.on("success", function(file, responseText) {

                        Swal.fire('AGREGADO CON EXITO', '', 'success');
                        $("#imagenes_recetas").load(location.href + " #imagenes_recetas");
                        $('#crear_recetas').modal('hide');
                    });
                }
            });
            $('#uploadfiles_recetas').click(function() {
                recetas.processQueue();
            });
        }

    });

}
previewIMG('all');

function addPic2(tipo_pic) {
    $.ajax({
        type: 'POST',
        url: 'controller/dashboard/addPicPerfilMed.controlador.php',
        data: {
            tipo_pic: tipo_pic
        },
        success: function(data) {

            $('#cuerpo_addLab').html(data);
            $('#crear_Lab').modal('show');
            var analisis_lab = new Dropzone(".analisis_lab", {
                autoProcessQueue: false,
                parallelUploads: 5,
                acceptedFiles: '.png, .jpeg, .jpg',
                addRemoveLinks: true,
                uploadMultiple: true,
                maxFiles: 5,
                dictRemoveFileConfirmation: "Estas seguro?",
                dictCancelUpload: "Cancelar",
                dictRemoveFile: "Remover",
                dictDefaultMessage: "Maximo 5 imagenes",
                init: function() {
                    this.on("success", function(file, responseText) {

                        if (responseText == "limit") {
                            Swal.fire('LIMITE DE IMAGENES SUPERADO', '', 'error');
                            $('#crear_Lab').modal('hide');

                        } else {
                            Swal.fire('AGREGADO CON EXITO', '', 'success');
                            $('#crear_Lab').modal('hide');
                        }


                    });


                }
            });

            $('#uploadfiles_lab').click(function() {
                analisis_lab.processQueue();
                setTimeout(function() {
                    previewIMG('all');
                }, 2000);
            });


        }
    });
}

function previewIMG(tipo_pic) {

    $.ajax({
        type: 'POST',
        url: 'controller/dashboard/list-fotos.controlador.php',
        data: {
            tipo_pic: tipo_pic
        },
        dataType: "json",
        success: function(data) {

            switch (tipo_pic) {
                case 'all':

                    images1 = "";
                    images2 = "";
                    images3 = "";
                    images4 = "";

                    if (data[0]['foto'] != null && data[0]['foto'].length > 0) {

                        var foto_lenght = data[0]['foto'].length;
                    } else {
                        var foto_lenght = 0;
                    }
                    for (var x = 0; x < foto_lenght; x++) {
                        // console.log(data[0]['morph'][x]['name']);
                        images1 += "<div class='pic_" + data[0]['foto'][x]['name'] + "' style='text-align: center; margin-right: 12px;'>  <img style='width: 90px; height: 90px;' src='views/assets/images/perfil/" + data[0]['foto'][x]['name'] + "'> <br> <button class='btn btn-sm btn-danger' type='button' onclick='removePic(&quot;" + data[0]['foto'][x]['name'] + "&quot; , &quot;fotos_varias&quot;)' style='margin-top: 10px;'> Remover </button>   </div>";

                    }

                    $('#preview_fotos').html(images1);

                    if (data[0]['cert'] != null && data[0]['cert'].length > 0) {

                        var cert_lenght = data[0]['cert'].length;
                    } else {
                        var cert_lenght = 0;
                    }
                    for (var x = 0; x < cert_lenght; x++) {

                        // console.log(data[0]['morph'][x]['name']);
                        images2 += "<div class='pic_" + data[0]['cert'][x]['name'] + "' style='text-align: center; margin-right: 12px;'>  <img style='width: 90px; height: 90px;' src='views/assets/images/perfil/" + data[0]['cert'][x]['name'] + "'> <br> <button class='btn btn-sm btn-danger' type='button' onclick='removePic(&quot;" + data[0]['cert'][x]['name'] + "&quot; , &quot;certificados&quot;)' style='margin-top: 10px;'> Remover </button>    </div>";

                    }

                    $('#preview_cert').html(images2);
                    if (data[0]['form'] != null && data[0]['form'].length > 0) {

                        var form_lenght = data[0]['form'].length;
                    } else {
                        var form_lenght = 0;
                    }
                    for (var x = 0; x < form_lenght; x++) {

                        // console.log(data[0]['morph'][x]['name']);
                        images3 += "<div class='pic_" + data[0]['form'][x]['name'] + "' style='text-align: center; margin-right: 12px;'>  <img style='width: 90px; height: 90px;' src='views/assets/images/perfil/" + data[0]['form'][x]['name'] + "'> <br> <button class='btn btn-sm btn-danger' type='button' onclick='removePic(&quot;" + data[0]['form'][x]['name'] + "&quot; , &quot;formacion&quot;)' style='margin-top: 10px;'> Remover </button>    </div>";

                    }

                    $('#preview_form').html(images3);
                    if (data[0]['premios'] != null && data[0]['premios'].length > 0) {

                        var premios_lenght = data[0]['premios'].length;
                    } else {
                        var premios_lenght = 0;
                    }
                    for (var x = 0; x < premios_lenght; x++) {

                        // console.log(data[0]['morph'][x]['name']);
                        images4 += "<div class='pic_" + data[0]['premios'][x]['name'] + "' style='text-align: center; margin-right: 12px;'>  <img style='width: 90px; height: 90px;' src='views/assets/images/perfil/" + data[0]['premios'][x]['name'] + "'> <br> <button class='btn btn-sm btn-danger' type='button' onclick='removePic(&quot;" + data[0]['premios'][x]['name'] + "&quot; , &quot;premios&quot;)' style='margin-top: 10px;'> Remover </button>    </div>";

                    }

                    $('#preview_premios').html(images4);

                    break;

                    // default:

                    //     for (var x = 0; x < data[0]['morph'].length; x++) {

                    //         images += "<div class='pic_" + tipo_pic + "' style='text-align: center; margin-right: 12px;'>  <img style='width: 90px; height: 90px;' src='views/assets/images/perfil/" + data[0]['morph'][x]['name'] + "'> <br> <span> Remover </span>   </div>";


                    //     }
                    //     break;
            }

        }

    });

}

function removePic(pictures, type_pic) {

    Swal.fire({
        title: '¢ÄSeguro que desea Eliminar?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: `SI`,
        denyButtonText: `NO ELIMINAR`,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: 'controller/dashboard/elimPicPerfil.controlador.php',
                data: {
                    pictures: pictures,
                    type_pic: type_pic
                },
                success: function(data) {

                    Swal.fire({
                        title: 'ELIMINADO CON EXITO',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    console.log(data);
                    previewIMG('all');

                }
            });
        } else if (result.isDenied) {
            Swal.fire('NO ELIMINADO', '', 'error')
        }
    });
}

function enviarCCI() {
    var cci = document.getElementById("cci_perfil").value;

    $.ajax({
        type: 'POST',
        url: 'controller/dashboard/upCCI.controlador.php',
        data: {
            cci: cci
        },
        success: function(data) {
            Swal.fire(data, '', 'success')
        }
    });
}

function img_digitales() {
    $.ajax({
        type: 'POST',
        url: 'controller/dashboard/addDataHC.controlador.php',
        data: {
            cod_correo: cod_correo
        },
        success: function(data) {

            $('#cuerpo_addLab').html(data);
            $('#crear_Lab').modal('show');


        }

    });

}

function recetas() {



}

function pictures() {
    var pictures = new Dropzone(".pictures", {
        autoProcessQueue: false,
        parallelUploads: 10,
        acceptedFiles: '.png, .jpeg, .jpg',
        addRemoveLinks: true,
        uploadMultiple: true,
        maxFiles: 5,
        dictRemoveFileConfirmation: "Estas seguro?",
        dictCancelUpload: "Cancelar",
        dictRemoveFile: "Remover",
        dictDefaultMessage: "Maximo 5 imagenes",
        init: function() {
            this.on("success", function(file, responseText) {

                Swal.fire('AGREGADO CON EXITO', '', 'success');

                setTimeout(function() {
                        location.reload()
                    }, 1500)
                    // $("#elemento_1").load(location.href + " #elemento_1");
                    // console.log(responseText);
            });
        }
    });

    $('#uploadfiles_pictures').click(function() {
        pictures.processQueue();
    });

}

// img_digitales();
// recetas();
pictures();