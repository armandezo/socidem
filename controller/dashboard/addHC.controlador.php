<?php 
date_default_timezone_set('America/Lima');

$fecha_hoy = date('d/m/Y');
$correo_cod = $_POST['cod_correo'];

echo '
 <h4 class="modal-title" style="margin-left: auto; margin-right: auto;">Agregar Historia Clinica </h4>

 <div class="col-md-12">
 <br>
 <form id="form_HC">
 <input type="hidden" name="fecha_actual" value="'.$fecha_hoy.'">
 <input type="hidden" name="cod_correo" value="'.$correo_cod.'">
 <textarea rows="15" name="texto_HC" id="texto_HC" cols="5" class="form-control" placeholder="Ingresa tu texto aqui...."></textarea>
 <br>
 <button type="button"  class="btn med_row " onclick="createHC();"><i class="fas fa-edit"></i> GUARDAR </button>
 </form>
 </div>

';    