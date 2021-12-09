<?php 
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
 

$elemento1 = $_POST['elemento1'];
$elemento2 = $_POST['elemento2'];


consultasSQL::InsertSQL("especialidades", "nombre, slug", "'$elemento1', '$elemento2'"); 