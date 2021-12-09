<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
 
$tipo_picture = $_POST['tipo_pic'];
 
$verPerfil = ejecutarSQL::consultar("SELECT `perfil`.*, `perfil`.`correo`
FROM `perfil`
WHERE `perfil`.`correo` = '$correo_';");

while($datos_perfil=mysqli_fetch_assoc($verPerfil)){

    $result  = array();
    $ds          = DIRECTORY_SEPARATOR; 

    $storeFolder = '../../views/assets/images/perfil/'; 

    

    switch ($tipo_picture) {
        case 'fotos':
       $objHC=$datos_perfil['fotos_varias'];
       
        break;
        case 'cert':
       $objHC=$datos_perfil['certificados'];
        break;
        case 'form':
       $objHC=$datos_perfil['formacion'];
        break;
        case 'premios':
       $objHC=$datos_perfil['premios'];
        break;

        case 'all':
       $obj_foto=$datos_perfil['fotos_varias'];
       $obj_cert=$datos_perfil['certificados'];
       $obj_formacion=$datos_perfil['formacion'];
       $obj_premios=$datos_perfil['premios'];

       $pic_foto = json_decode($obj_foto, true); 
       $pic_cert = json_decode($obj_cert, true); 
       $pic_form = json_decode($obj_formacion, true); 
       $pic_premios = json_decode($obj_premios, true); 

        break;
         
    } 

    $pic_med = json_decode($objHC, true); 
    $files = scandir($storeFolder);  

    if ( false!==$files ) {

        if($tipo_picture == "all"){
            if($pic_foto != NULL){
            foreach ($pic_foto as $file ) { 
                     
                    $obj['name'] = $file['pictures'];
                    $obj['size'] = filesize($storeFolder.$ds.$file['pictures']);
                    $foto[] = $obj;
                    
                
            }
            }
            if($pic_cert != NULL){
                foreach ($pic_cert as $file ) { 
                          
                        $obj['name'] = $file['pictures'];
                        $obj['size'] = filesize($storeFolder.$ds.$file['pictures']);
                        $cert[] = $obj;
                        
                }
            }
           
            if($pic_form != NULL){
            foreach ($pic_form as $file ) { 
                  
                    $obj['name'] = $file['pictures'];
                    $obj['size'] = filesize($storeFolder.$ds.$file['pictures']);
                    $form[] = $obj; 
            }
            }

            if($pic_premios != NULL){
            foreach ($pic_premios as $file ) { 
                
                    $obj['name'] = $file['pictures'];
                    $obj['size'] = filesize($storeFolder.$ds.$file['pictures']);
                    $premios[] = $obj;
                    
            } 
            }


            $resultado[] = array(
                'foto' =>  $foto,
                'cert' =>  $cert,
                'form' =>  $form,
                'premios' => $premios
            ); 

        }else {
            
            foreach ($pic_med as $file ) { 
                    
                    $obj['name'] = $file['pictures'];
                    $obj['size'] = filesize($storeFolder.$ds.$file['pictures']);
                    $result[] = $obj;
                
             
            }
            $resultado[] = array(
                'morph' =>  $result, 
            ); 

        }
      


    }
 
    header('Content-type: text/json');             
    header('Content-type: application/json');
    echo json_encode($resultado);
}

