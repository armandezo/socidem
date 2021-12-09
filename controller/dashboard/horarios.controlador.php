<?php
session_start(); 
include '../../model/consulSQL.php';
include '../../model/sessiones.php';
date_default_timezone_set('America/Lima'); 
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
setlocale(LC_TIME, 'es_ES');
setlocale(LC_TIME, 'spanish');  

  $dia = $_POST['dia'];
  $id_track = $_POST['id'];
  $token = $codigo_referido_;
  
  $agenda_medica_horarios = ejecutarSQL::consultar("SELECT `agenda_medica`.*, `agenda_medica`.`cod_medico`
  FROM `agenda_medica`
  WHERE `agenda_medica`.`cod_medico` = '$token';");
 
  while($dato_medico_horarios=mysqli_fetch_assoc($agenda_medica_horarios)){
        $objAgenda=$dato_medico_horarios['agenda']; 
        $agenda = json_decode($objAgenda, true); 

  } 
  
  echo '
    <div  id="box_cuerpo-'.$id_track.'" style="background:#ececec; border-radius: 10px; margin-top: 32px; width: 100%;">
    <form   id="form_track_'.$dia.'"> 
    <br> 
    <div class="row" style="margin-right: 5px;">
    
        <div class="col-md-3" style="position: relative; top: 30px;">
        <span class="">'.$dia.'</span>
       
        
        </div>
';

$conta = 0;

foreach ($agenda as $key => $value) {
      
    if($dia == $value['dia']){ 
        
        $array_filtrado[] = array(
            'startHour' => $value['startHour'],
            'endHour' => $value['endHour'],
            'tipo' => $value['tipo']
        );
        $conta++;
       
    }
    
    
}

        if($array_filtrado == NULL){ 
            $valor_unico = md5(uniqid(rand(), true));
            echo '
           
            <div class="row fila_horarios_'.$dia.'" id="row_hora_'.$valor_unico.'" style="    margin-left: 156px; margin-right: 46px; padding-bottom: 21px;">
                
                <div class="col-md-4">
                    <input type="text" name="horario_init[]" autocomplete="off" style="cursor: pointer;"  class="form-control init-'.$valor_unico.'" placeholder="Elige un Horario">
                    
                </div>
                <div class="col-md-1">
                
                <span class="" style="vertical-align:-webkit-baseline-middle"> a </span>
                            
                </div> 
                <input type="hidden" name="dia_name[]" value="'.$dia.'">
                <div class="col-md-4">
                
                <input type="text" name="horario_end[]" autocomplete="off" onkeyup="valid('.$valor_unico.')" style="cursor: pointer;"  class="form-control end-'.$valor_unico.'" placeholder="Elige un Horario">
                            
                </div>  

                <div class="col-md-3">
                <select class="form-control " id="tipoCita-'.$valor_unico.'"  name="tipoCita[]" onchange="cambiaColor(this, &quot;'.$valor_unico.'&quot;)">
                <option class="base_select"  value="Online">
                        Online
                        </option>
                        <option class="base_select" value="Presencial">
                    Presencial
                    </option>
                    <option value="" class="base_select" disabled hidden selected>Tipo Cita</option>
                 
                    </select>
                    <div class="" style="position: absolute; right: -33px; top: 8px;">
                    <button type="button" class="btn btn-sm bg-danger-light" onclick="quitarHorario(&quot;'.$valor_unico.'&quot;)"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            </div>
            <script >
            $(".init-'.$valor_unico.'").timepicker();
            $(".end-'.$valor_unico.'").timepicker();
            </script>
            
            '; 


        
        }else { 
            
        $tempArr = array_unique(array_column($array_filtrado, 'endHour'));
        $arreglo_final = (array_intersect_key($array_filtrado, $tempArr));

        $conta_array = count($arreglo_final);
        
        
        foreach ($arreglo_final as $key2 => $value2) {
            $valor_unico = md5(uniqid(rand(), true));
            echo '
            <div class="row fila_horarios_'.$dia.'" id="row_hora_'.$valor_unico.'" style="margin-left: 156px; margin-right: 46px; padding-bottom: 21px;">
                
                <div class="col-md-4">
                    <input type="text" name="horario_init[]" id="horario_init[]" autocomplete="off" style="cursor: pointer;" value="'.$value2['startHour'].'" class="form-control init-'.$valor_unico.'" placeholder="Elige un Horario">
                    
                </div>
                <div class="col-md-1">
                
                <span class="" style="vertical-align:-webkit-baseline-middle"> a </span>
                            
                </div> 
                <input type="hidden" name="dia_name[]" value="'.$dia.'">
                <div class="col-md-4">
                
                <input type="text" name="horario_end[]" id="horario_end" autocomplete="off" onclick="valid()"  style="cursor: pointer;" value="'.$value2['endHour'].'" class="form-control end-'.$valor_unico.'" placeholder="Elige un Horario">
                            
                </div>  

                <div class="col-md-3">
                ';
                if($value2['tipo'] == "Online"){
                    echo '<select class="form-control select_online" id="tipoCita-'.$valor_unico.'"  name="tipoCita[]" onchange="cambiaColor(this, &quot;'.$valor_unico.'&quot;)">';
                }else {
                    echo '<select class="form-control select_presencial" id="tipoCita-'.$valor_unico.'" name="tipoCita[]" onchange="cambiaColor(this, &quot;'.$valor_unico.'&quot;)">';
                }
                switch ($value2['tipo']) {

                        case 'Online':
                        echo '
                        <option class="base_select"  value="Online">
                        Online
                        </option>
                        <option class="base_select" value="Presencial">
                    Presencial
                    </option>
                    <option value="" class="base_select" disabled hidden>Tipo Cita</option>
                        ';
                        break;
                        case 'Presencial':
                        echo '<option class="base_select"  value="Presencial">
                        Presencial
                        </option>
                        <option class="base_select"  value="Online">
                        Online
                        </option>
                        <option value="" class="base_select"  disabled hidden>Tipo Cita</option>
                        ';
                        break;


                    }

                    echo '  
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
            
        }
 
        }
    
    
        echo ' 
        
        </div>
        <div id="carga_horario_'.$valor_unico.'"></div>
        </form>
        <br>
        <br>
        <div class="row">
        <div class="col-md-6"><button type="button" class="btn btn-new btn-info btn-block" style="background: #008298; border: 1px solid #ececec;"  onclick="agregarMas(&quot;'.$dia.'&quot; , &quot;'.$id_track.'&quot; , &quot;'.$valor_unico.'&quot; )" ><i class="fas fa-plus"></i> Agregar mas Horarios</button></div>
 
        <div class="col-md-6"><button type="button" class="btn btn-new btn-info btn-block" style="background: #008298; border: 1px solid #ececec;" onclick="replicar(&quot;'.$id_track.'&quot;, &quot;'.$dia.'&quot;)"><i class="fas fa-clone"></i> Replicar Resto de dias </button></div>
        </div> 
        </div>  
        ';
   
   
 