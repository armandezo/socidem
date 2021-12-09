$(document).ready(function() {

    /*Ajax para Login y registro (clientes y vendedores)*/
    $('.Login-Form').submit(function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        var type = $(this).attr('method');
        var url = $(this).attr('action');
        var formType = $(this).attr('data-form');

        if (formType == "login") {
            $.ajax({
                type: type,
                url: url,
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
        } else {
            $.ajax({
                type: type,
                url: url,
                data: data,
                beforeSend: function() {
                    $(".res-registro").html('Registrarme <span class="mr-2 spinner-border spinner-border-sm" role="status" style="position: relative; top: -4px; left: 111px;"></span>');
                },
                error: function() {
                    $(".res-registro").html("Ha ocurrido un error en el sistema1");
                },
                success: function(data) {
                    $(".res-registro-end").html(data);
                }
            });
            return false;
        }


    });

    $('.secret-Form').submit(function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        var type = $(this).attr('method');
        var url = $(this).attr('action');
        var formType = $(this).attr('data-form');


        $.ajax({
            type: type,
            url: url,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {

                switch (data) {
                    case "exito":
                        Swal.fire('AGREGADO CON EXITO', '', 'success');
                        break;

                    case "vacio":
                        Swal.fire('ERROR CAMPOS VACIOS', '', 'error');
                        break;

                    case "duplicado":
                        Swal.fire('ERROR USUARIO DUPLICADO', '', 'error');
                        break;
                }



            }
        });

    });
});