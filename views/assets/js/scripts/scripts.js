$('.input-group.date').datepicker({
    language: "es",
    orientation: "bottom auto",
    autoclose: true,
    format: 'yyyy-mm-dd'
});


function remove_table() {
    $("#myChart").remove();
    var elemento1 = $('#elemento1').val('');
    var elemento2 = $('#elemento2').val('');
}

function table_export() {

    var elemento1 = $('#elemento1').val();
    var elemento2 = $('#elemento2').val();

    if (elemento1 != '' && elemento2 != '') {
        window.location = "controller/dashboard/doctoresExcelHistorialCitas.controlador.php?elemento1=" + elemento1 + "&elemento2=" + elemento2;

    }

}




function table_row() {
    var elemento1 = $('#elemento1').val();
    var elemento2 = $('#elemento2').val();


    $.ajax({
        type: "POST",
        dataType: "json",
        url: "controller/dashboard/histCitas.controlador.php",
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


$('#sandbox-container').datepicker({
    language: "es",
    orientation: "bottom left",
    autoclose: true,
    todayHighlight: true,
    toggleActive: true
});

var clipboard = new ClipboardJS('.btna');

clipboard.on('success', function(e) {
    alert("Perfil Copiado");

});

var clipboard2 = new ClipboardJS('.btn_pass');

clipboard2.on('success', function(e) {
    alert("Password Copiado");

});


var clipboard3 = new ClipboardJS('.link_compartir');

clipboard3.on('success', function(e) {
    Swal.fire({
        title: 'PERFIL COPIADO',
        icon: 'success',
        showConfirmButton: false,
        timer: 1500
    });

});


function cambio() {

    $('.caja1').addClass('caja2').removeClass('caja1');

    $('.caja3').addClass('caja1').removeClass('caja3');


}

function cargarDepartamentos() {
    var departamentos_json = [{ "id": "01", "name": "Amazonas" }, { "id": "02", "name": "\u00c1ncash" }, { "id": "03", "name": "Apur\u00edmac" }, { "id": "04", "name": "Arequipa" }, { "id": "05", "name": "Ayacucho" }, { "id": "06", "name": "Cajamarca" }, { "id": "07", "name": "Callao" }, { "id": "08", "name": "Cusco" }, { "id": "09", "name": "Huancavelica" }, { "id": "10", "name": "Hu\u00e1nuco" }, { "id": "11", "name": "Ica" }, { "id": "12", "name": "Jun\u00edn" }, { "id": "13", "name": "La Libertad" }, { "id": "14", "name": "Lambayeque" }, { "id": "15", "name": "Lima" }, { "id": "16", "name": "Loreto" }, { "id": "17", "name": "Madre de Dios" }, { "id": "18", "name": "Moquegua" }, { "id": "19", "name": "Pasco" }, { "id": "20", "name": "Piura" }, { "id": "21", "name": "Puno" }, { "id": "22", "name": "San Mart\u00edn" }, { "id": "23", "name": "Tacna" }, { "id": "24", "name": "Tumbes" }, { "id": "25", "name": "Ucayali" }];

    addOptions("departamento", departamentos_json);
}

function cargarEspecialidades() {

    $.getJSON('controller/dashboard/json_especialidades.controlador.php', function(data) {

        var selector = document.getElementsByName("especialidad")[0];


        data.nombre.forEach(function(valor, indice, array) {
            var opcion = document.createElement("option");
            opcion.text = valor;
            opcion.value = data.id[indice];
            selector.add(opcion);
        });
    });
}

function cargarEspecialidades2() {

    $.getJSON('controller/dashboard/json_especialidades.controlador.php', function(data) {

        var selector = document.getElementsByName("especialidad")[0];
        var selector2 = document.getElementsByName("especialidad2")[0];

        data.nombre.forEach(function(valor, indice, array) {
            var opcion = document.createElement("option");
            opcion.text = valor;
            opcion.value = data.id[indice];
            selector.add(opcion);
            selector2.add(opcion);
        });
    });
}




//Función para agregar opciones a un <select>.
function addOptions(domElement, array) {
    var selector = document.getElementsByName(domElement)[0];

    array.forEach(function(valor, indice, array) {
        var opcion = document.createElement("option");
        opcion.text = valor['name'];
        opcion.setAttribute('data-path', "." + valor['name']);
        opcion.value = valor['id'];
        selector.add(opcion);
    });

}



function cargaProvincias() {
    // Objeto de provincias con pueblos
    $.getJSON('controller/json_provincias.json', function(data) {
        var listaProvincias = data;
        var departamentos = document.getElementById('departamento');
        var provincias = document.getElementById('provincia');
        var departamentosSeleccionada = departamentos.value

        // Se limpian los provincias
        provincias.innerHTML = '<option  default hidden>Elige una opcion</option>';


        // provinciaSeleccionada.sort()
        listaProvincias.forEach(function(valor, indice, array) {

            if (departamentosSeleccionada == valor['department_id']) {
                let opcion = document.createElement('option')
                opcion.value = valor['id']
                opcion.setAttribute('data-path', "." + valor['name'])
                opcion.text = valor['name']
                provincias.add(opcion)
            }

        });
        // if (provinciaSeleccionada !== '') {}
    });
}

function cargaDistritos() {

    // Objeto de provincias con pueblos
    $.getJSON('controller/json_distritos.json', function(data) {
        var listaDistritos = data;
        var provincia = document.getElementById('provincia');
        var distritos = document.getElementById('distrito');
        var provinciaSeleccionada = provincia.value

        // Se limpian los distritos
        distritos.innerHTML = '<option  default hidden>Elige una opcion</option>';


        // provinciaSeleccionada.sort()
        listaDistritos.forEach(function(valor, indice, array) {
            console.log(provinciaSeleccionada);
            if (provinciaSeleccionada == valor['province_id']) {
                let opcion = document.createElement('option')
                opcion.value = valor['id']
                opcion.setAttribute('data-path', "." + valor['name'])
                opcion.text = valor['name']
                distritos.add(opcion)
            }

        });
        // if (provinciaSeleccionada !== '') {}
    });
}

// Iniciar la carga de provincias solo para comprobar que funciona
cargarDepartamentos();
cargarEspecialidades();
cargarEspecialidades2();

const removeAccents = (str) => {
    string = str.replace(/\s/g, '-');
    return string.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();
}


function guardar() {
    var elemento1 = $('#especialidad').val();
    var elemento2 = removeAccents($('#especialidad').val());

    $.ajax({
        type: "POST",
        url: "controller/dashboard/guardar.controlador.php",
        data: {
            "elemento1": elemento1,
            "elemento2": elemento2,
        },
        success: function(data) {
            Swal.fire({
                title: 'guardado',
                icon: 'success',
                showConfirmButton: false,
                timer: 500
            });
        }
    });
}

function search() {
    var elemento1 = removeAccents($('#departamento').val());
    var elemento2 = removeAccents($('#provincia').val());
    var elemento3 = removeAccents($('#distrito').val());
    var elemento4 = removeAccents($('#especialidad').val());


    var subj = elemento1 + " " + elemento2 + " " + elemento3 + " " + elemento4;

    var extra_slug = subj.replace(/\s/g, '-');
    window.location = "busqueda-" + extra_slug;

}

function search2() {
    var elemento1 = removeAccents($('#departamento').val());
    var elemento2 = removeAccents($('#provincia').val());
    var elemento3 = removeAccents($('#distrito').val());
    var elemento4 = removeAccents($('#especialidad2').val());


    var subj = elemento1 + " " + elemento2 + " " + elemento3 + " " + elemento4;

    var extra_slug = subj.replace(/\s/g, '-');
    window.location = "busqueda-" + extra_slug;

}