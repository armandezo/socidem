<select onchange="getComboA(this, &quot;'.$valor_unico.'&quot;)">
  <option  >Elige un Horario</option>
 ';
    $d = "05:00"; 
    for ($j=0; $j < 38 ; $j++) { 
            $g = 15;
            $t  = strtotime ( $g.' minutes', strtotime ( $d ) );
            $d = date("H:i", $t); 

             $horas_limpias[] = array(
                'horas' => $d, 
            );  

    }
   

    foreach($horas_filtradas as $key => $val){
        $aTmp1[] = $val['horas'];
    }
    
    foreach($horas_limpias as $key => $val){
        $aTmp2[] = $val['horas'];
    }
    
    $new_array = array_diff($aTmp2,$aTmp1);

    
    foreach ($new_array as $key) {
        echo " <option  >".$key."</option>";
    }

    //  
    // 
echo '

foreach ($agenda_full  as $key => $value) { 
    if($_POST['dia'] == $value['dia']){ 

        $horas_registradas[] = array(
            'hora' => $value['startHour'],
            'rango' => $value['endHour']
        ); 

    }  

    }
    $f = "05:00"; 
    for ($i=0; $i < 38 ; $i++) { 
        $r = 15;
            $n  = strtotime ( $r.' minutes', strtotime ( $f ) );
            $f = date("H:i", $n); 
        foreach ($horas_registradas  as $key => $horas) { 

            $hora_rango  = strtotime ( $horas['rango'].' minutes', strtotime ( $horas['hora'] ) );
            $hora_rango_formato = date("H:i", $hora_rango); 
            
            if($f > $horas['hora'] && $f < $hora_rango_formato){
                $horas_filtradas[] = array(
                    'horas' => $f, 
                ); 
            }
        }  
    }

[
    {
        "id":1,
        "token":"885de4290058cd230e907b9ecb0da276",
        "name":"08:00",
        "dia":"Lunes",
        "startHour":"08:00",
        "endHour":"30",
        "customClass":"blueClass",
        "estado":"agendado",
        "tipo":"online"
    },
    {
        "id":2,
        "token":"885de4290058cd230e907b9ecb0da276",
        "name":"08:30",
        "dia":"Martes",
        "startHour":"08:30",
        "endHour":"45",
        "customClass":"blueClass",
        "estado":"agendado",
        "tipo":"online"
    },
    {
        "id":3,
        "token":"885de4290058cd230e907b9ecb0da276",
        "name":"09:15",
        "dia":"Lunes",
        "startHour":"09:15",
        "endHour":"60",
        "customClass":"blueClass",
        "estado":"agendado",
        "tipo":"online"
    },
    {
        "id":4,
        "token":"885de4290058cd230e907b9ecb0da276",
        "name":"10:15",
        "dia":"Martes",
        "startHour":"10:15",
        "endHour":"60",
        "customClass":"blueClass",
        "estado":"agendado",
        "tipo":"online"
    }
]