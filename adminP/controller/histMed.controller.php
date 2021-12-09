<?php 
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php'; 
header('Content-type: application/json');

$elemento1 = $_POST['elemento1'];
$elemento2 = $_POST['elemento2']; 


$BuscaElementos = ejecutarSQL::consultar("SELECT cod_medico, COUNT(*) AS cantidad_citas, SUM(precio_consulta) AS monto_citas FROM agenda WHERE pago_estado = 'approved' AND fecha_start BETWEEN '$elemento1' AND '$elemento2' GROUP BY cod_medico");
 

while($datos_historia_citas=mysqli_fetch_assoc($BuscaElementos)){

    $codigo_medico_f = $datos_historia_citas['cod_medico'];

    $BuscaMedico = ejecutarSQL::consultar("SELECT `medicos`.`correo`, `medicos`.`nombre_completo`, `perfil`.`correo`, `perfil`.`codigo_referido` FROM `medicos` , `perfil` WHERE `perfil`.`correo` = `medicos`.`correo` AND `perfil`.`codigo_referido` = '$codigo_medico_f'");
    
    while($datos_nombre_med=mysqli_fetch_assoc($BuscaMedico)){ 

        $nombre_medico = $datos_nombre_med['nombre_completo'];

    }

    
    $cantidad_citas[] = $nombre_medico." - Total Citas( ".$datos_historia_citas['cantidad_citas']." )";
    $monto_citas[] = intval($datos_historia_citas['monto_citas']);

}

$historial_array = array(
'cantidad_citas' => $cantidad_citas,
'monto_citas' => $monto_citas
); 

$historial_obj = (json_encode($historial_array, true));

echo  $historial_obj;
   



