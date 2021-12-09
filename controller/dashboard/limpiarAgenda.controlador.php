<?php
session_start();
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';

$token = $codigo_referido_;

consultasSQL::UpdateSQL("agenda_medica", "agenda='[]'", "cod_medico='$token'");
