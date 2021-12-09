function procesoCita(id, token, fecha, hora, rango, tipo) {


    $.ajax({
        type: "POST",
        url: "controller/dashboard/crearCita.controlador.php",
        data: {
            valor: id,
            secur: token,
            tipo: tipo,
            fecha: fecha,
            hora: hora,
            rango: rango

        },
        success: function(data) {

            window.location = "checkout";
        }
    });


}