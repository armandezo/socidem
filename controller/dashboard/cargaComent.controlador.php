<?php 
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';

$shortname = $_POST['textShortname'];
  
$BuscaComent = ejecutarSQL::consultar("SELECT `comentarios`.*, `comentarios`.`medico` FROM `comentarios`
WHERE `comentarios`.`medico` = '$shortname' ORDER BY `id` ASC  LIMIT  10");
        
    while($datos_usuario=mysqli_fetch_assoc($BuscaComent)){
        $comentario_ = $datos_usuario['comentario'];
        $nombre_ = $datos_usuario['nombre'];
        $datetime_ = $datos_usuario['datetime'];
        echo ' 
        <li>
        <div class="comment">
        <label class="circulo">
        <h2>  
        ';
        $words = explode(' ', $nombre_);
        $paa = strtoupper(substr($words[0], 0, 1) . substr(end($words), 0, 1));
        echo $paa;
        echo '            
        </h2>

        </label>
    
            <div class="comment-body">
                <div class="meta-data">
                    <span class="comment-author">'.$nombre_.'</span> 
                </div>

                <p class="comment-content">
                '.$comentario_.'
                </p>
                 
            </div>
        </div> 
    </li>
 
        ';
    } 

   