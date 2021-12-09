<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
 
$id_cita = $_POST['valor'];
$codigo_referido = $_POST['secur'];
$fecha_start = $_POST['fecha_start'];
$fecha_end = $_POST['fecha_end'];

echo '
    <div class="col-md-12">
    <h3 style="text-align: center">Elige el tipo de Cita</h3>
     
        <label class="payment-radio credit-card-option" style="top: 20px;">
            <input type="radio" name="radio" id="online" value="online" checked>
            <span class="checkmark"></span>
            Agendar Cita Online
        </label>

        <label class="payment-radio credit-card-option" style="top: 40px;">
            <input type="radio" name="radio" id="precencial" value="presencial" >
            <span class="checkmark"></span>
            Agendar Cita Presencial
        </label>
         <br>
         <br> 
         <br>
        <div class="clinic-booking">
        <a  onclick="procesoCita(&apos;'.$id_cita.'&apos; , &apos;'.$codigo_referido.'&apos; , &apos;'.$fecha_start.'&apos; , &apos;'.$fecha_end.'&apos;)"  class="apt-btn" href="javascript:">Continuar</a>
        </div>
      
    </div>
    
';