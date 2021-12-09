<?php

include 'config.php';

switch ($conectame) {
    case 'LOCAL':
        define("USER", "root");
        define("SERVER", "localhost");
        define("BD", "socidem_bd");
        define("PASS", "");
    break;
    
    case 'LIVE':
        define("USER", "medico47_user");
        define("SERVER", "localhost");
        define("BD", "medico47_BD");
        define("PASS", "~LP7gW=@U]]w");
    break;
        
}
 

/* Clase para ejecutar las consultas a la Base de Datos*/
class ejecutarSQL {
    public static function conectar(){
        if(!$con=  ($GLOBALS["___mysqli_ston"] = mysqli_connect(SERVER, USER, PASS))){
            die("Error en el servidor, verifique sus datos");
        }
        if (!mysqli_select_db($GLOBALS["___mysqli_ston"], constant('BD'))) {
            die("Error al conectar con la base de datos, verifique el nombre de la base de datos");
        }
        /* Codificar la información de la base de datos a UTF8*/
        ((bool)mysqli_set_charset($con, "utf8"));
        return $con;  
    }
    public static function consultar($query) {
        if (!$consul = mysqli_query( ejecutarSQL::conectar(), $query)) {
            die(mysqli_error($GLOBALS["___mysqli_ston"]).'Error en la consulta SQL ejecutada');
        }
        return $consul;
    }  
}
/* Clase para hacer las consultas Insertar, Eliminar y Actualizar */
class consultasSQL{
    public static function InsertSQL($tabla, $campos, $valores) {
        if (!$consul = ejecutarSQL::consultar("insert into $tabla ($campos) VALUES($valores)")) {
            die("Ha ocurrido un error al insertar los datos en la tabla $tabla");
        }
        return $consul;
    }
    public static function DeleteSQL($tabla, $condicion) {
        if (!$consul = ejecutarSQL::consultar("delete from $tabla where $condicion")) {
            die("Ha ocurrido un error al eliminar los registros en la tabla $tabla");
        }
        return $consul;
    }
    public static function UpdateSQL($tabla, $campos, $condicion) {
        if (!$consul = ejecutarSQL::consultar("update $tabla set $campos where $condicion")) {
            die("Ha ocurrido un error al actualizar los datos en la tabla $tabla");
        }
        return $consul;
    }
}
    $conn=@mysqli_connect(SERVER, USER, PASS, BD);

    try {
        $conn2 = new PDO('mysql:host=localhost;dbname=' .BD , USER, PASS);
        $conn2->query("set names utf8;");
        $conn2->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn2->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        return $conn2;
    } catch (Exception $e) {
        echo "Ocurrió algo con la base de datos: " . $e->getMessage();
        return null;
    }
    
    function generate_string($input, $strength = 16) {
        $input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
        }

    return $random_string;
    } 
     
    if(!$conn){
        die("imposible conectarse: ".mysqli_error($conn));
    }
    if (@mysqli_connect_errno()) {
        die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }


         
 