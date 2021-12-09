<?php 
date_default_timezone_set('America/Lima');

$fecha_hoy = date('d/m/Y');
$correo_cod = $_POST['cod_correo'];

echo ' 
<form action="controller/dashboard/createRecetas.controlador.php" class="dropzone recetas"  >  
                        
 <input class="uk-input" type="hidden" name="fecha_actual" value="'.$fecha_hoy.'" />
 <input class="uk-input" type="hidden" name="cod_correo" value="'.$correo_cod.'" /> 
 </form>
';    