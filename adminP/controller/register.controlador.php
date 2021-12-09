<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE);
include '../../model/consulSQL.php';
 
    $usuario_new = $_POST['user_new'];
    $clave_new = md5($_POST['pass_new']);
 

if (!$usuario_new == "" && !$clave_new == "") {
     
    $verAfil = ejecutarSQL::consultar("SELECT `admin`.*, `admin`.`user`, `admin`.`role`, `admin`.`pass` FROM `admin` WHERE `admin`.`user` = '$usuario_new'");
     
    $AfilC = mysqli_num_rows($verAfil);
        if ($AfilC == 0) {
           
            date_default_timezone_set('America/Lima');
            setlocale(LC_TIME, 'es_ES.UTF-8');
            setlocale(LC_TIME, 'spanish');
            $last_login_up = date('l jS F Y h:i:s A');
            
            consultasSQL::InsertSQL("admin", "user, pass, last_login, role", "'$usuario_new', '$clave_new', '$last_login_up', 2"); 
            
            $verAfil_new = ejecutarSQL::consultar("SELECT `admin`.*, `admin`.`user`, `admin`.`role`, `admin`.`pass` FROM `admin` WHERE `admin`.`user` = '$usuario_new' AND `admin`.`pass` = '$clave_admin';");
            
            while($datos_admin=mysqli_fetch_assoc($verAfil_new)){
         
                $user_new=$datos_admin['user']; 
                $user_role =$datos_admin['role']; 
            } 
            
            $_SESSION['user_admin'] = $user_new; 
            $_SESSION['user_role'] = $user_role;
            $_SESSION["iniciarSesion"] = "estable";
 
             
            echo '<div class="progress"><div class="progress-bar progress-bar-success" style="width: 100%">Creado con exito</div> </div>
            <script>  setTimeout(function() { location.reload(); }, 1500);	 </script>
            ';
           
           

        
        } else {
           
            
            echo '<div class="progress"><div class="progress-bar progress-bar-danger" style="width: 100%">Usuario Repetido </div> </div>';
        }
    
            
        } else {
            echo '<div class="progress"><div class="progress-bar progress-bar-danger" style="width: 100%">Campos Vacios</div> </div>';
        }