<?php  
/*=============================================
CONTADOR DE MEDICOS 
=============================================*/
     $medConsProf = ejecutarSQL::consultar("SELECT `medicos`.`membresia` FROM `medicos` WHERE `medicos`.`membresia` = 'Profesional'");
     $medTotalProf = mysqli_num_rows($medConsProf);
/*=============================================
CONTADOR DE PACIENTES 
=============================================*/
     $pacConsProf = ejecutarSQL::consultar("SELECT `pacientes`.* FROM `pacientes`;");
     $pacTotalProf = mysqli_num_rows($pacConsProf);
/*=============================================
CONTADOR DE CITAS
=============================================*/
     $agendaConsProf = ejecutarSQL::consultar("SELECT `agenda`.* FROM `agenda`;");
     $agendaTotalProf = mysqli_num_rows($agendaConsProf);
/*=============================================
CONTADOR DE REFERIDOS EXTERNOS
=============================================*/ 
     $refInternoConsProf = ejecutarSQL::consultar("SELECT `codigos_promo`.*, `codigos_promo`.`tipo` FROM `codigos_promo` ");
     $refInternoTotalProf = mysqli_num_rows($refInternoConsProf);
/*=============================================
CONTADOR DE REFERIDOS EXTERNOS
=============================================*/
     $refExternosConsProf = ejecutarSQL::consultar("SELECT `referidos_externos`.* FROM `referidos_externos`;");
     $refExternosTotalProf = mysqli_num_rows($refExternosConsProf) + $refInternoTotalProf;
/*=============================================
CONTADOR DE REFERIDOS EXTERNOS
=============================================*/
     $refPorcentajeConsProf = ejecutarSQL::consultar("SELECT `codigos_promo`.*, `codigos_promo`.`tipo` FROM `codigos_promo` WHERE `codigos_promo`.`tipo` = 'porcentaje' ORDER BY `codigos_promo`.`id` ASC");
     $refPorcentajeTotalProf = mysqli_num_rows($refPorcentajeConsProf);
/*=============================================
LISTA DE MEDICOS 
=============================================*/
     $listaMedConsProf = ejecutarSQL::consultar("SELECT `medicos`.`nombre_completo`, `medicos`.`correo`,  `medicos`.`estado`, `medicos`.`periodo_membresia`, `medicos`.`membresia`, `perfil`.`foto`, `perfil`.`codigo_referido` FROM `medicos` , `perfil` WHERE `medicos`.`correo` = `perfil`.`correo`");
    
 

?>
 