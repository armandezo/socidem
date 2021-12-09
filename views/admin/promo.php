<?php 
if($membresia_ == "Gratuito"){
echo '<div class="" style="
background: #15558d;
color: white;
font-size: 20px;
font-weight: 600;
padding-left: 12px;
padding-right: inherit;
padding-top: 16px;
padding-bottom: 15px;

">
<i class="fas fa-star" style="color: #68dda9;"></i> 
Active un plan para obtener todas las funcionalidades y agendas publicas
<a href="membresias" 
style="color: #68dda9; ">
Ver Planes
</a> 
</div>
<br>
';


}  
 
if($estado_  == 3 && $membresia_ == "Profesional"){
    echo '<div class="" style="
    background: #15558d;
    color: white;
    font-size: 20px;
    font-weight: 600;
    padding-left: 12px;
    padding-right: inherit;
    padding-top: 16px;
    padding-bottom: 15px;
    
    ">
    <i class="fas fa-star" style="color: #68dda9;"></i> 
   Tu perfil esta siendo verificado muchas gracias por su paciencia
     
    </div>
    <br>
    ';
    
    
    } 

    
if($estado_  == 2 && $membresia_ == "Profesional"){
    echo '<div class="" style="
    background: #15558d;
    color: white;
    font-size: 20px;
    font-weight: 600;
    padding-left: 12px;
    padding-right: inherit;
    padding-top: 16px;
    padding-bottom: 15px;
    
    ">
    <i class="fas fa-star" style="color: #e20101;"></i> 
   Tu perfil ha sido rechazado el soporte se comunicara con usted. Gracias !
     
    </div>
    <br>
    ';
    
    
    } 
?>

