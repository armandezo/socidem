<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';

 $fecha_actual = $_POST['fecha_actual'];
 $cod_correo = $_POST['cod_correo'];
  
    $verAnalisis_lab = ejecutarSQL::consultar("SELECT `historial_medico`.*, `historial_medico`.`correo` FROM `historial_medico` WHERE `historial_medico`.`correo` = '$cod_correo';");

    while($datos_analisis_lab=mysqli_fetch_assoc($verAnalisis_lab)){

        $objAL=$datos_analisis_lab['recetas_med'];
        
        $analisis_lab = json_decode($objAL, true); 
        

        foreach ($analisis_lab as $key1 => $entry) { 
            
        } 
                    $nuevo_ID = $entry['id'] + 1;
                    $nuevoAnalisis = $entry['recetas'];


        foreach ($nuevoAnalisis as $key2 => $entry_2_lvl) { 

        }  

        if (!empty($_FILES['file']['name'])) {
            
            $file_name = "";

            $totalFile = count($_FILES['file']['name']);

            for ($i=0; $i < $totalFile ; $i++) {

                $fileName = $_FILES['file']['name'][$i]; 
                $extension = pathinfo($fileName, PATHINFO_EXTENSION);
                $allowExtn = array('png', 'jpeg', 'jpg');

                if (in_array($extension, $allowExtn)) {
                $newName = rand() . ".". $extension;
                $uploadFilePath = "../../views/assets/images/historial/recetas_med/".$newName;
                move_uploaded_file($_FILES['file']['tmp_name'][$i], $uploadFilePath);

                $file_name .= $newName.",";	
                }
            }
        }
            
                $array_1 =  substr($file_name, 0, -1);
                $array_pictures = explode(",", $array_1);

                if($entry['fecha'] !== $fecha_actual){
            
                    $nuevo_ID_2_lvl = 0;
                }else {
                    $nuevo_ID_2_lvl = $entry_2_lvl['id'] + 1;
                }

                foreach ($array_pictures as $key3) { 

                    $nuevo_ID_2_lvl = $nuevo_ID_2_lvl + 1 ;

                    $analisis_carga[] = array(
                        'id' =>  $nuevo_ID_2_lvl,
                        'pictures' =>  $key3
                    );  

                }  

                    $nueva_agenda[] = array(
                        'id' =>  $nuevo_ID,
                        'fecha' =>  $fecha_actual,
                        'recetas' => $analisis_carga
                    ); 

            
    
            $resultado =  array_merge($analisis_lab, $nueva_agenda );
            $insertar_data = json_encode($resultado, JSON_UNESCAPED_UNICODE);
         
            consultasSQL::UpdateSQL("historial_medico", "recetas_med='$insertar_data'", "correo='$cod_correo'");
             
    }     
 