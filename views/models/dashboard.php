<?php 

switch ($rol_) {
    case 1:
        if($estado_ == 0){
            
           echo '<script>  window.location = "perfilMed"; </script>';
           
        }else {
            include 'views/admin/dashboard_med.php';
        }
      
    break;

    case 2:
        include 'views/admin/dashboard.php';
    break;
     
    }
?>