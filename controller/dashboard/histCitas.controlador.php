<?php 
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
header('Content-type: application/json');

$elemento1 = $_POST['elemento1'];
$elemento2 = $_POST['elemento2']; 


$BuscaElementos = ejecutarSQL::consultar("SELECT email_usuario, COUNT(*) AS cantidad_citas, SUM(precio_consulta) as monto_citas FROM agenda WHERE cod_medico = '$codigo_referido_' AND pago_estado = 'approved' AND fecha_start BETWEEN '$elemento1' AND '$elemento2' GROUP BY email_usuario");
 

while($datos_historia_citas=mysqli_fetch_assoc($BuscaElementos)){
 
    $cantidad_citas[] = $datos_historia_citas['cantidad_citas'];
    $monto_citas[] = intval($datos_historia_citas['monto_citas']);

}

$historial_array = array(
'cantidad_citas' => $cantidad_citas,
'monto_citas' => $monto_citas
); 

$historial_obj = (json_encode($historial_array, true));

echo  $historial_obj;
   



