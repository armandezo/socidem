/*Ajax para Login y registro (clientes y vendedores)*/
$('.Login-Form').submit(function(e) {
    e.preventDefault();
    var data = $(this).serialize();
    var formType = $(this).attr('data-form');

    if (formType == "login") {

        $.ajax({
            type: "POST",
            url: "adminP/controller/login.controlador.php",
            data: data,
            beforeSend: function() {
                $(".res-Login").html('<div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: 100%">Iniciando sesion</div></div>');
            },
            error: function() {
                $(".res-Login").html("Ha ocurrido un error en el sistema");
            },
            success: function(data) {
                $(".res-Login").html(data);
            }
        });
        return false;
    }

    if (formType == "register") {

        $.ajax({
            type: "POST",
            url: "adminP/controller/register.controlador.php",
            data: data,
            beforeSend: function() {
                $(".res-register").html('<div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: 100%">Registrando</div></div>');
            },
            error: function() {
                $(".res-register").html("Ha ocurrido un error en el sistema");
            },
            success: function(data) {
                $(".res-register").html(data);
            }
        });
        return false;
    }


});

function pagarNomina(date) {

    $.ajax({
        type: "POST",
        url: "adminP/controller/pagoDoc.controlador.php",
        data: {
            date: date
        },
        error: function() {
            $(".res-pago").html("Ha ocurrido un error en el sistema");
        },
        success: function(data) {
            if (data == "existe") {
                Swal.fire({
                    title: 'ESTE MES YA ESTA PAGO',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                Swal.fire({
                    title: 'MES PAGADO CON EXITO',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(function() { location.reload(); }, 2000);

            }


        }
    });




}

function pagarNominaUnit(cod, date, count) {
    input_check = document.getElementById("status_" + count);

    $.ajax({
        type: "POST",
        url: "adminP/controller/pagoDocUnit.controlador.php",
        data: {
            cod: cod,
            date: date,
            status: input_check.checked,
        },
        error: function() {
            $(".res-pago").html("Ha ocurrido un error en el sistema");
        },
        success: function(data) {


            switch (data) {
                case 'existe':
                    Swal.fire({
                        title: 'ESTA SEMANA ESTA PAGA',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    break;
                case 'revertido':
                    Swal.fire({
                        title: 'SEMANA PAGO REVERTIDO',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    break;
                case 'no_veri':
                    Swal.fire({
                        title: 'MEDICO NO VERIFICADO',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    break;
                case 'no_saldo':
                    Swal.fire({
                        title: 'PAGO VACIO',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    });


                    break;
                case 'exito':
                    Swal.fire({
                        title: 'SEMANA PAGADA CON EXITO',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    // setTimeout(function() { location.reload(); }, 2000);
                    break;
            }





        }
    });




}

function verPago(id) {

    $.ajax({
        type: "POST",
        url: "adminP/controller/verPago.controlador.php",
        data: {
            cod: id
        },
        success: function(data) {
            $("#print_pago").html(data);

        }
    });


}

function newRef() {
    num_ref = document.getElementById("num_ref");
    caducidad_ref = document.getElementById("caducidad_ref");

    $.ajax({
        type: "POST",
        url: "adminP/controller/newRef.controlador.php",
        data: {
            num_ref: num_ref.value,
            caducidad_ref: caducidad_ref.value

        },
        success: function(data) {
            Swal.fire({
                title: 'CREADOS CON EXITO',
                icon: 'success',
                showConfirmButton: false,
                timer: 1500
            });
            setTimeout(function() { location.reload(); }, 2000);

        }
    });
}

function verificar(tipo, cod) {


    $.ajax({
        type: "POST",
        url: "adminP/controller/verificar.controlador.php",
        data: {
            tipo: tipo,
            cod: cod
        },
        success: function(data) {

            Swal.fire({
                title: 'EXITO',
                icon: 'success',
                showConfirmButton: false,
                timer: 1500
            });
            setTimeout(function() { location.reload(); }, 2000);
        }
    });
}

function cambioEstado(id) {
    input_check = document.getElementById("status_" + id);
    $.ajax({
        type: "POST",
        url: "adminP/controller/cambioStatus.controlador.php",
        data: {
            status: input_check.checked,
            cod: input_check.value
        },
        success: function(data) {

            Swal.fire({
                title: 'ACTUALIZADO CON EXITO',
                icon: 'success',
                showConfirmButton: false,
                timer: 1500
            });

        }
    });
}

function NewP() {
    n_pass = document.getElementById("n-pass");
    c_pass = document.getElementById("c-pass");

    $.ajax({
        type: "POST",
        url: "adminP/controller/newPass.controlador.php",
        data: {
            n_pass: n_pass.value,
            c_pass: c_pass.value,

        },
        success: function(data) {

            if (data == "ok") {

                Swal.fire({
                    title: 'ACTUALIZADO CON EXITO',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(function() { location.reload(); }, 2000);

            } else {

                Swal.fire({
                    title: 'PASSWORD NO COINCIDE',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500
                });

            }



        }
    });



}



//Initialize the datePicker(I have taken format as mm-dd-yyyy, you can     //have your owh)
$("#weeklyDatePicker").datetimepicker({
    format: 'YYYY-MM-DD',
    locale: 'es',

});

$('.input-group.date').datepicker({
    language: "es",
    orientation: "bottom auto",
    autoclose: true,
    format: 'yyyy-mm-dd'
});



function remove_table_med() {
    $("#myChart").remove();
    var elemento1 = $('#elemento1').val('');
    var elemento2 = $('#elemento2').val('');
}

function table_export_med() {

    var elemento1 = $('#elemento1').val();
    var elemento2 = $('#elemento2').val();

    if (elemento1 != '' && elemento2 != '') {
        window.location = "adminP/controller/histMedExcel.controlador.php?elemento1=" + elemento1 + "&elemento2=" + elemento2;

    }

}




function table_row_med() {
    var elemento1 = $('#elemento1').val();
    var elemento2 = $('#elemento2').val();


    $.ajax({
        type: "POST",
        dataType: "json",
        url: "adminP/controller/histMed.controller.php",
        data: {
            "elemento1": elemento1,
            "elemento2": elemento2
        },
        beforeSend: function() {

            $("#myChart").remove();
            $("#grafico_div").append('<canvas id="myChart" width="900" height="400" ></canvas>');

        },
        success: function(data) {

            var ctx = document.getElementById('myChart').getContext('2d');

            // var ctx2 = document.getElementById('myChart2').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data['cantidad_citas'],
                    datasets: [{
                        label: 'Cantidad Historico Citas',
                        data: data['monto_citas'],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: true
                        }
                    }

                }
            });

        }
    });


}


// //Get the value of Start and End of Week
// $('#weeklyDatePicker').on('dp.change', function(e) {
//     var value = $("#weeklyDatePicker").val();
// });



function remove_table() {
    $("#table_hist").remove();
}

function table_export() {
    var from_date = $('#weeklyDatePicker').val();
    window.location = "adminP/controller/doctoresExcelFiltrado.controlador.php?fecha=" + from_date;

}

function table_export_externos() {
    var from_date = $('#weeklyDatePicker').val();
    window.location = "adminP/controller/refExternosExcelFiltrado.controlador.php?fecha=" + from_date;

}

function table_row() {
    var from_date = $('#weeklyDatePicker').val();

    $.ajax({
        type: "POST",
        url: "adminP/controller/historialControlador.php",
        data: {
            fecha: from_date
        },
        success: function(data) {

            $("#tabla_ref").html(data);


        }
    });


}

function table_ref_externos() {
    var from_date = $('#weeklyDatePicker').val();

    $.ajax({
        type: "POST",
        url: "adminP/controller/pagoRefExterno.controlador.php",
        data: {
            fecha: from_date
        },
        success: function(data) {

            $("#tabla_ref").html(data);


        }
    });


}

function pagarRefUnit(cod, date, count) {
    input_check = document.getElementById("status_" + count);

    $.ajax({
        type: "POST",
        url: "adminP/controller/pagoRefUnit.controlador.php",
        data: {
            cod: cod,
            date: date,
            status: input_check.checked,
        },
        error: function() {
            $(".res-pago").html("Ha ocurrido un error en el sistema");
        },
        success: function(data) {


            switch (data) {
                case 'existe':
                    Swal.fire({
                        title: 'ESTA SEMANA ESTA PAGA',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    break;
                case 'revertido':
                    Swal.fire({
                        title: 'SEMANA PAGO REVERTIDO',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    break;
                case 'no_saldo':
                    Swal.fire({
                        title: 'PAGO VACIO',
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    });


                    break;
                case 'exito':
                    Swal.fire({
                        title: 'SEMANA PAGADA CON EXITO',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    // setTimeout(function() { location.reload(); }, 2000);
                    break;
            }





        }
    });




}

var dataTable1 = $('#doc-table').DataTable({
    "responsive": true,
    "iDisplayLength": "3",
    "aLengthMenu": [3, 10, 50, 100, 150, 200],
    "lengthMenu": true
});

var dataTable2 = $('#paciente-table').DataTable({
    "responsive": true,
    "iDisplayLength": "4",
    "aLengthMenu": [4, 10, 50, 100, 150, 200],
    "lengthMenu": true
});

var dataTable3 = $('#citas-table').DataTable({
    "responsive": true,
    "iDisplayLength": "10",
    "aLengthMenu": [10, 50, 100, 150, 200],
    "lengthMenu": true
});

var dataTable4 = $('#referidos-table').DataTable({
    "responsive": true,
    "iDisplayLength": "10",
    "aLengthMenu": [10, 50, 100, 150, 200],
    "lengthMenu": true
});

var dataTable4 = $('#referidos-interno-table').DataTable({
    "responsive": true,
    "iDisplayLength": "4",
    "aLengthMenu": [4, 10, 50, 100, 150, 200],
    "lengthMenu": true
});

var dataTable5 = $('#doc-table2').DataTable({
    "responsive": true,
    "iDisplayLength": "5",
    "aLengthMenu": [5, 10, 50, 100, 150, 200],
    "lengthMenu": true
});

var dataTable6 = $('#referidos-100').DataTable({
    "responsive": true,
    "iDisplayLength": "10",
    "aLengthMenu": [10, 50, 100, 150, 200],
    "lengthMenu": true
});

var dataTable7 = $('#table_hist').DataTable({
    "responsive": true,
    "iDisplayLength": "2",
    "aLengthMenu": [2, 10, 50, 100, 150, 200],
    "lengthMenu": true
});