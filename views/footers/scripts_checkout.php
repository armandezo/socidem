<script>
    function proPat(){
        $.ajax({
            type: $('#checkout_form').attr('method'),
            url: $('#checkout_form').attr('action'),
            data: $('#checkout_form').serialize()
             
        });  
    }

    function servicio(ref){
        $.ajax({
       type: "POST",
       url: "controller/dashboard/buscaServ.controlador.php",
       data: {
         ref: ref          
       },            
       success: function(data) {
           $('#cuerpo_servicios').html(data);
            
           $('#servicios_check').modal('show');
       }
   });
    }


    function nombreServ(nombre) {

        $('#servicios_content').html(nombre);
        document.getElementById("servicios_content_value").value = nombre;
        $('#servicios_check').modal('hide');

    }
</script> 