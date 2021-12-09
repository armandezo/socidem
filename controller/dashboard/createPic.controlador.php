<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';

$tipo_picture = $_POST['tipo_pic'];
// 

        $verPerfil = ejecutarSQL::consultar("SELECT `perfil`.*, `perfil`.`correo`
            FROM `perfil`
            WHERE `perfil`.`correo` = '$correo_';");


        switch ($tipo_picture) {
        case 'fotos':
        $campo_dinamico = "fotos_varias";

        break;

        case 'cert':
        $campo_dinamico = "certificados";
        break;

        case 'form':
        $campo_dinamico = "formacion";
        break;

        case 'premios':
        $campo_dinamico = "premios";
        break;
            
        }


        while($datos_perfil=mysqli_fetch_assoc($verPerfil)){ 

            $obj_picture =$datos_perfil[$campo_dinamico]; 
            $pic_foto = json_decode($obj_picture , true); 
            
        } 
        $totalFile = count($_FILES['file']['name']);

        if($pic_foto != NULL){
           $cant_pic = count($pic_foto) + $totalFile;
        } else {
            $cant_pic = 0 + $totalFile;
        }
       

        if($cant_pic <= 5){ 

            if (!empty($_FILES['file']['name']) ) {
                        
                        $file_name = "";

                        $totalFile = count($_FILES['file']['name']);

                        for ($i=0; $i < $totalFile ; $i++) {

                            $fileName = $_FILES['file']['name'][$i]; 
                            $extension = pathinfo($fileName, PATHINFO_EXTENSION);
                            $allowExtn = array('png', 'jpeg', 'jpg');

                            if (in_array($extension, $allowExtn)) {
                            $newName = rand() . ".". $extension;
                            $uploadFilePath = "../../views/assets/images/perfil/".$newName;
                            move_uploaded_file($_FILES['file']['tmp_name'][$i], $uploadFilePath);

                            $file_name .= $newName.",";	
                            }
                        }

                        $array_1 =  substr($file_name, 0, -1);
                        $array_pictures = explode(",", $array_1); 
                
                        foreach ($array_pictures as $key3) { 
                            $analisis_carga[] = array( 
                                'pictures' =>  $key3
                            );  
                        }  

                    if($pic_foto != NULL){
                        $resultado =  array_merge($pic_foto, $analisis_carga);
                    }else {
                        $resultado = $analisis_carga;
                    }
                    
                
                    $insertar_data = json_encode($resultado, JSON_UNESCAPED_UNICODE);
                        
            
                    consultasSQL::UpdateSQL("perfil", "$campo_dinamico='$insertar_data'", "correo='$correo_'");
            }
        
        }
        else {
            echo "limit";
           
        }

       


        

    
