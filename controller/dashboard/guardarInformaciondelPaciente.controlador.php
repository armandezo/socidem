<?php
session_start();
@$_SESSION['temp_idpaciente'] = trim(@$_REQUEST['idpaciente']);
@$_SESSION['temp_nombrepaciente'] = trim(@$_REQUEST['nombrepaciente']);
@$_SESSION['temp_celular'] = trim(@$_REQUEST['celular']);
@$_SESSION['temp_tipodecita'] = trim(@$_REQUEST['tipodecita']);
@$_SESSION['temp_hora'] = trim(@$_REQUEST['hora']);
@$_SESSION['temp_fecha'] = trim(@$_REQUEST['fecha']);