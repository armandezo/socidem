	<?php 
	
	switch ($rol_) {

		case 1:
			include 'themes/pacientes.php';
		 	// include 'themes/medicos.php';
		break;

		case 2:
			include 'themes/pacientes.php';
		break;

		default:
			include 'themes/pacientes.php';
		break;
		
	}
	
	
	?>
	  