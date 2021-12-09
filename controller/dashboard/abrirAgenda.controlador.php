<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';


$fecha = $_POST['fecha'];
$hora = $_POST['hora']; 
$token = $codigo_referido_;

echo '
    <div class="col-md-12">
    <h3 style="text-align: center">Elige el tipo de Cita</h3>
     
        <label class="payment-radio credit-card-option" style="top: 20px;">
            <input type="radio" name="radio" value="online" checked>
            <span class="checkmark"></span>
            Crear Agenda Online 
        </label>

        <label class="payment-radio credit-card-option" style="top: 40px;">
            <input type="radio" name="radio" value="presencial" >
            <span class="checkmark"></span>
            Crear Agenda Presencial
        </label>
         <br>
         <br> 
         <br>
        <div class="clinic-booking">
        <a  onclick="CrearAgenda(&apos;'.$fecha.'&apos; , &apos;'.$hora.'&apos; , &apos;'.$token.'&apos;)"  class="apt-btn" href="javascript:">Crear Agenda</a>
        </div>
    </div> 
';

 

