<?php 
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
header("Content-Type: application/json", true);


if ( $rol_ == "1"){  
        
        $verUsuario = ejecutarSQL::consultar("SELECT `medicos`.*, `medicos`.`correo` FROM `medicos` WHERE `medicos`.`correo` = '$correo_' ");
        $verPerfil = ejecutarSQL::consultar("SELECT `perfil`.*, `perfil`.`correo` FROM `perfil` WHERE `perfil`.`correo` = '$correo_' ");

    
    
    }

    while($datos_usuario=mysqli_fetch_assoc($verUsuario)){
               
        $nombre=$datos_usuario['nombre_completo'];
        $correo_usuario=$datos_usuario['correo'];

    } 

    while($datos_perfil=mysqli_fetch_assoc($verPerfil)){
               
        $correo_perfil=$datos_perfil['correo'];
        $documento_perfil=$datos_perfil['documento'];
        $foto_perfil=$datos_perfil['foto'];
        $telefono_perfil=$datos_perfil['telefono'];
        $num_colegiatura_perfil=$datos_perfil['num_colegiatura'];
        $type_colegiatura_perfil=$datos_perfil['tipo_colegiado_doc'];
        $especialidad_perfil=$datos_perfil['especialidad'];
        $servicios_perfil=$datos_perfil['servicios'];
        $otras_especialidades_perfil=$datos_perfil['otras_especialidades'];
        $otros_nro_colegiatura_perfil=$datos_perfil['otros_nro_colegiatura'];
        $titulo_perfil=$datos_perfil['titulo'];
        $universidad_perfil=$datos_perfil['universidad'];
        $años_perfil=$datos_perfil['años'];
        $ubicacion_perfil=$datos_perfil['ubicacion'];
        $sobre_mi_perfil=$datos_perfil['sobre_mi'];
        $idiomas_perfil=$datos_perfil['idiomas'];
        $nombre_clinica_perfil=$datos_perfil['nombre_clinica'];
        $direccion_clinica_perfil=$datos_perfil['direccion_clinica'];
        $precio_consulta_perfil=$datos_perfil['precio_consulta'];
        $precio_online_perfil =$datos_perfil['precio_online'];
        $check_tel_perfil = $datos_perfil['check_tel'];
        $check_correo_perfil = $datos_perfil['check_correo'];
    } 


    $output = array(
        'nombre_completo' => $nombre,
        'correo' => $correo_perfil, 
        'foto' => $foto_perfil,
        'telefono' => $telefono_perfil,
        'type_colegiatura_perfil' => $type_colegiatura_perfil,
        'num_colegiatura' => $num_colegiatura_perfil,
        'especialidad' => $especialidad_perfil,
        'servicios' => $servicios_perfil,
        'otras_especialidades'=> $otras_especialidades_perfil,
        'otros_nro_colegiatura'=> $otros_nro_colegiatura_perfil,
        'titulo' => $titulo_perfil,
        'universidad' => $universidad_perfil,
        'años' => $años_perfil,
        'idiomas' =>  $idiomas_perfil,
        'ubicacion' => $ubicacion_perfil,
        'sobre_mi' => $sobre_mi_perfil,
        'nombre_clinica' => $nombre_clinica_perfil,
        'direccion_clinica' => $direccion_clinica_perfil,
        'precio_consulta' => $precio_consulta_perfil,
        'precio_online' => $precio_online_perfil,
        'check_tel' => $check_tel_perfil,
        'check_correo' => $check_correo_perfil
        
    );
    
    echo json_encode( $output );







?>