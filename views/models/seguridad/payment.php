<?php
    if( isset($_SESSION["rol"] ) )
    {
 
       
    }else {
           
        echo '<script>
        setTimeout(function () {
            $("#login_session").modal({backdrop: "static", keyboard: false});
                // setTimeout(function () {
                //     window.location = "login";
                // }, 5000);
        }, 1500);
        
    
        </script>';
    
        return;
         
        }

?>