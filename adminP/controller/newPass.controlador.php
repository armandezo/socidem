<?php 
session_start();
error_reporting(E_ALL ^ E_NOTICE);
include '../../model/consulSQL.php';

$n_pass = $_POST['n_pass']; 
$c_pass = $_POST['c_pass']; 
$user_admin = $_SESSION['user_admin'];
$nueva_pass = md5($n_pass);


if($n_pass == $c_pass ){
    consultasSQL::UpdateSQL("admin", "pass='$nueva_pass' ", "user='$user_admin '");
   echo "ok";
}else { 
    echo "duplicado";
}
