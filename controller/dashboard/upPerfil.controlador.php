<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';

$especialidad = $_POST['especialidad'];
 
$correo_old = $correo_;

$foto_cortada = $_POST['foto_crop'];
  
$num_colegiatura = $_POST['num_colegiatura'];
$otros_num_colegiatura = $_POST['otros_nro_colegiatura'];
$otras_especialidades = $_POST['otras_especialidades'];
$telefono = $_POST['telefono'];

$url_departament = "../../controller/json_departamentos.json";
$departamentos_json  = json_decode(file_get_contents($url_departament), true);

$url_provincia = "../../controller/json_provincias.json";
$provincias_json  = json_decode(file_get_contents($url_provincia), true);

$url_distrito = "../../controller/json_distritos.json";
$distrito_json  = json_decode(file_get_contents($url_distrito), true);

 
foreach($departamentos_json as $d){
   if ($_POST['departamento'] == $d['id']) {
     $departamento_name = $d['name'];
   }; 
}

foreach($provincias_json as $prov){
   if ($_POST['provincia'] == $prov['id']) {
     $provincia_name = $prov['name'];
   }; 
}

foreach($distrito_json as $dist){
   if ($_POST['distrito'] == $dist['id']) {
     $distrito_name = $dist['name'];
   }; 
} 

$ubicacion = $departamento_name." ".$provincia_name." ".$distrito_name;
$sobre_mi = $_POST['sobre_mi'];
$idiomas = $_POST['idiomas'];
$nombre_clinica = $_POST['nombre_clinica'];
$direccion_clinica = $_POST['direccion_clinica'];
$precio_consulta = $_POST['precio_consulta'];
$precio_consulta_online = $_POST['precio_online'];
$services = $_POST['services'];
$titulo = $_POST['titulo'];
$universidad = $_POST['universidad'];
$años = $_POST['anio_exp'];

$check_tel_format = $_POST['check_tel'];

if($check_tel_format == "on"){
   $check_tel = 1;
}else {
   $check_tel = 0;
}

$check_correo_format = $_POST['check_correo'];

if($check_correo_format == "on"){
   $check_correo = 1;
}else {
   $check_correo = 0;
} 


if( $foto_cortada != null){
     

$filename_path = md5(time().uniqid()).".png"; 
$decoded=base64_decode($foto_cortada); 

file_put_contents("../../views/assets/images/medicos/".$filename_path, file_get_contents($foto_cortada));


} 
    $BuscaAfil = ejecutarSQL::consultar("select * from medicos where correo='$correo_' ");
   
    $AfilC = mysqli_num_rows($BuscaAfil);
         
  

        if ($AfilC == 1) {
            consultasSQL::UpdateSQL("medicos", "estado='1'", "correo='$correo_'");
            
            if($foto_cortada != null){

               consultasSQL::UpdateSQL("perfil", " 
               foto='$filename_path',
               telefono='$telefono',
               num_colegiatura='$num_colegiatura',
               especialidad='$especialidad',
               otros_nro_colegiatura='$otros_num_colegiatura',
               otras_especialidades='$otras_especialidades',
               servicios='$services',
               titulo='$titulo',
               universidad='$universidad',
               años='$años',
               ubicacion='$ubicacion',
               sobre_mi='$sobre_mi',
               idiomas='$idiomas',
               nombre_clinica='$nombre_clinica',
               direccion_clinica='$direccion_clinica',
               precio_consulta='$precio_consulta',
               precio_online='$precio_consulta_online',
               check_tel='$check_tel',
               check_correo='$check_correo'
               ",
               "correo='$correo_'");
               
               session_reset();  
               $_SESSION["foto"] = $filename_path;
               $_SESSION["especialidad"] = $especialidad;
               $_SESSION["ubicacion"] = $ubicacion;
               $_SESSION["codigo_referido"] =  $codigo_referido_;
               $_SESSION["num_colegiatura"] = $num_colegiatura;
               $_SESSION["estado"] = 1;

            }else {
               consultasSQL::UpdateSQL("perfil", "  
               telefono='$telefono',
               num_colegiatura='$num_colegiatura',
               especialidad='$especialidad',
               otros_nro_colegiatura='$otros_num_colegiatura',
               otras_especialidades='$otras_especialidades',
               servicios='$services',
               titulo='$titulo',
               universidad='$universidad',
               años='$años',
               ubicacion='$ubicacion',
               sobre_mi='$sobre_mi',
               idiomas='$idiomas',
               nombre_clinica='$nombre_clinica',
               direccion_clinica='$direccion_clinica',
               precio_consulta='$precio_consulta',
               precio_online='$precio_consulta_online',
               check_tel='$check_tel',
               check_correo='$check_correo'
               ",
               "correo='$correo_'");

               session_reset();   
               $_SESSION["especialidad"] = $especialidad;
               $_SESSION["ubicacion"] = $ubicacion;
               $_SESSION["codigo_referido"] =  $codigo_referido_;
               $_SESSION["num_colegiatura"] = $num_colegiatura;
               $_SESSION["estado"] = 1;
            }
           

          
            echo ' <script> window.location = "referidos";  </script>';
           
        } 
         
        else {
                    echo "Este correo ya se encuentra registrado ";        
            
        }
   