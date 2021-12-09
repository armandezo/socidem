<?php
session_start();
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
include '../../model/consulSQL.php';
include '../../model/sessiones.php';

$token = $codigo_referido_;
$horario_final = $_POST['horario_final'];  
$dia = $_POST['dia'];
 
$verAgendaMedica = ejecutarSQL::consultar("SELECT `agenda_medica`.`agenda`, `agenda_medica`.`cod_medico`, `agenda_medica`.`estado` FROM `agenda_medica` WHERE `agenda_medica`.`cod_medico` = '$token';");

while($datos_agenda_medica=mysqli_fetch_assoc($verAgendaMedica)){
    
    $objAgenda=$datos_agenda_medica['agenda']; 
    $agenda_full = json_decode($objAgenda, true);  
}

   
 if(isset($horario_final)){
    $count = count($horario_final) === count(array_flip($horario_final));

    switch ($count) {
        case true:
            $valor_unico = md5(uniqid(rand(), true));
            echo ' 
        
            <div class="col-md-3" style="position: relative; top: 30px;">
          
            </div>
        
            
            <div class="row fila_horarios_'.$dia.'" id="row_hora_'.$valor_unico.'"  style=" margin-left: 141px; margin-right: 46px; padding-bottom: 21px;">
                
            <div class="col-md-4">
            <input type="text" name="horario_init[]" autocomplete="off" style="cursor: pointer;" value="'.$value['startHour'].'" class="form-control init-'.$valor_unico.'" placeholder="Elige un Horario">
                
            </div>
        
            <div class="col-md-1">
                
            <span class="" style="vertical-align:-webkit-baseline-middle"> a </span>
                        
            </div> 
            <input type="hidden" name="dia_name[]" value="'.$dia.'">
            <div class="col-md-4">
            
            <input type="text" name="horario_end[]" autocomplete="off" style="cursor: pointer;" value="'.$value['endHour'].'" class="form-control end-'.$valor_unico.'" placeholder="Elige un Horario">
                        
            </div>  
        
            <div class="col-md-3">
             <select class="form-control " id="tipoCita-'.$valor_unico.'" name="tipoCita[]" onchange="cambiaColor(this, &quot;'.$valor_unico.'&quot;)">               
                    <option class="base_select" value="Online">
                    Online
                    </option>
                    <option class="base_select" value="Presencial">
                Presencial
                </option>
                <option value="" class="base_select"  hidden selected>Tipo Cita</option>
                      
                </select>
                <div class="" style="position: absolute; right: -33px; top: 8px;">
        <button type="button" class="btn btn-sm bg-danger-light" onclick="quitarHorario(&quot;'.$valor_unico.'&quot; , &quot;'.$dia.'&quot;)"><i class="fa fa-trash"></i></button>
        </div>
            </div>
        </div>
        <script >
        $(".init-'.$valor_unico.'").timepicker();
        $(".end-'.$valor_unico.'").timepicker();
        </script>
        ';  
        break;
        case false:
            echo "false";
        break;
        default:
            $valor_unico = md5(uniqid(rand(), true));
            echo '
    
            <div class="col-md-3" style="position: relative; top: 30px;">
        
            </div>
    
            
            <div class="row fila_horarios_'.$dia.'" id="row_hora_'.$valor_unico.'"  style="      margin-left: 141px; margin-right: 46px; padding-bottom: 21px;">
                
            <div class="col-md-3">
                <input type="text" name="horario_name[]" onclick="cleanRange(&quot;'.$valor_unico.'&quot;)" id="hora-'.$valor_unico.'" style="cursor: pointer;" value="'.$value['startHour'].'" class="form-control aca-'.$valor_unico.'" placeholder="Elige el Horario" autocomplete="off">
                
            </div>
    
            <div class="col-md-3">
            <select class="form-control" name="rango[]" id="rango-'.$valor_unico.'" onchange="getComboA(this, &quot;'.$valor_unico.'&quot;)"  placeholder="Horario Agendado"> 
            
            <option value="30">
            30 Min
            </option> 
            <option value="45">
            45 Min 
            </option>
            <option value="60">
            60 Min
            </option>
            <option value=""  disabled hidden selected>Duración</option>
    
            </select>
            
            </div>
    
            <div class="col-md-3">
            
            <input type="text" name="horario_final[]"  class="form-control" id="'.$valor_unico.'" value="'.$value['endHour'].'" readonly placeholder="Agenda">
                        
            </div>  
    
            <div class="col-md-3">
            
                <select class="form-control" name="tipoCita[]"  >
                
                    <option value="Online">
                    Online
                    </option>
                    <option value="Presencial">
                Presencial
                </option>
                <option value="" hidden selected>Tipo Cita</option>
                    
                </select>
                <div class="" style="position: absolute; right: -33px; top: 8px;">
        <button type="button" class="btn btn-sm bg-danger-light" onclick="quitarHorario(&quot;'.$valor_unico.'&quot;, &quot;'.$dia.'&quot;)"><i class="fa fa-trash"></i></button>
        </div>
            </div>
        </div>
        <script >
        $(".init-'.$valor_unico.'").timepicker();
        $(".end-'.$valor_unico.'").timepicker();
        </script>
        ';  
        break;
    }

    
 }else {
     
    
    $valor_unico = md5(uniqid(rand(), true));
    echo '

    <div class="col-md-3" style="position: relative; top: 30px;">
  
    </div>

    
    <div class="row fila_horarios_'.$dia.'" id="row_hora_'.$valor_unico.'"  style="      margin-left: 141px; margin-right: 46px; padding-bottom: 21px;">
        
    <div class="col-md-4">
    <input type="text" name="horario_init[]" autocomplete="off" style="cursor: pointer;" value="'.$value['startHour'].'" class="form-control init-'.$valor_unico.'" placeholder="Elige un Horario">
        
    </div>

    <div class="col-md-1">
    <span class="" style="vertical-align:-webkit-baseline-middle"> a </span>
       
    </div>
 
    <div class="col-md-4">
    
    <input type="text" name="horario_end[]" autocomplete="off" style="cursor: pointer;" value="'.$value['endHour'].'" class="form-control end-'.$valor_unico.'" placeholder="Elige un Horario">
                
    </div>  
    <input type="hidden" name="dia_name[]" value="'.$dia.'">
    <div class="col-md-3">
    <select class="form-control " id="tipoCita-'.$valor_unico.'" name="tipoCita[]" onchange="cambiaColor(this, &quot;'.$valor_unico.'&quot;)">               
         
            <option class="base_select" value="Online">
            Online
            </option>
            <option class="base_select" value="Presencial">
        Presencial
        </option>
        <option value="" class="base_select"  hidden selected>Tipo Cita</option>
              
        </select>
        <div class="" style="position: absolute; right: -33px; top: 8px;">
        <button type="button" class="btn btn-sm bg-danger-light" onclick="quitarHorario(&quot;'.$valor_unico.'&quot; , &quot;'.$dia.'&quot;)"><i class="fa fa-trash"></i></button>
        </div>
    </div>
   
</div>
<script > 
$(".init-'.$valor_unico.'").timepicker();
$(".end-'.$valor_unico.'").timepicker(); 
</script>
';  



    
 }
    
   


   