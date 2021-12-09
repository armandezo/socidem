<?php
session_start();
require_once "model/consulSQL.php";
include 'model/sessiones.php';
include 'model/data.php';
require_once 'vendor/autoload.php';
date_default_timezone_set('America/Lima');
$routes = array();
$routes = explode("-", $_GET["ruta"]);

switch ($routes[0]) {
	case 'adminDash':
		include 'adminP/model/data.php';
		include 'adminP/headers/header_base.php';
		include "adminP/headers/cabezera.php";

		break;

	case 'resumen':
		include 'views/headers/header_base.php';
		break;

	default:
		include 'views/headers/header_base.php';
		include "views/headers/cabezera.php";
		break;
}




?>


<body class="account-page">


    <?php

	/*=============================================
	 RUTAS
	 =============================================*/

	if (isset($_GET["ruta"])) {

		if (
			$routes[0] == "inicio" ||
			$routes[0] == "login" ||
			$routes[0] == "histCitas" ||
			$routes[0] == "medicos" ||
			$routes[0] == "loginAsistance" ||
			$routes[0] == "salir" ||
			$routes[0] == "registro" ||
			$routes[0] == "registroDoc" ||
			$routes[0] == "faqs" ||
			$routes[0] == "busqueda" ||
			$routes[0] == "perfil" ||
			$routes[0] == "perfilPac" ||
			$routes[0] == "pacientes" ||
			$routes[0] == "perfilMed" ||
			$routes[0] == "mensajes" ||
			$routes[0] == "verificarP" ||
			$routes[0] == "verificarM" ||
			$routes[0] == "secretaria" ||
			$routes[0] == "exepciones" ||
			$routes[0] == "referidos" ||
			$routes[0] == "historial" ||
			$routes[0] == "historialPac" ||
			$routes[0] == "membresias" ||
			$routes[0] == "calendario" ||
			$routes[0] == "faqRef" ||
			$routes[0] == "resumen" ||
			$routes[0] == "faqMed" ||
			$routes[0] == "cambioPass" ||
			$routes[0] == "cita" ||
			$routes[0] == "agenda" ||
			$routes[0] == "test" ||
			$routes[0] == "passForgot" ||
			$routes[0] == "resetPassMessage" ||
			$routes[0] == "lobby" ||
			$routes[0] == "checkout" ||
			$routes[0] == "checkoutmed" ||
			$routes[0] == "checkProcess" ||
			$routes[0] == "factura" ||
			$routes[0] == "servicios" ||
			$routes[0] == "serviciosMed" ||
			$routes[0] == "contacto" ||
			$routes[0] == "medico" ||
			$routes[0] == "loginMed" ||
			$routes[0] == "dashboard" ||

			/*=============================================
			RUTA BASE ADMIN
			=============================================*/
			$routes[0] == "adminDash" ||
			$routes[0] == "salir"
		) {
			switch ($routes[0]) {
				case "adminDash":
					/*=============================================
						RUTAS INTERNAS ADMIN
						=============================================*/
					if (
						$routes[1] == "login" ||
						$routes[1] == "inicio" ||
						$routes[1] == "doctor" ||
						$routes[1] == "doctores" ||
						$routes[1] == "paciente" ||
						$routes[1] == "pacientes" ||
						$routes[1] == "citas" ||
						$routes[1] == "cita" ||
						$routes[1] == "usuarios" ||
						$routes[1] == "historial" ||
						$routes[1] == "historialMed" ||
						$routes[1] == "pagosExternos" ||
						$routes[1] == "referidosInt" ||
						$routes[1] == "referidosExt" ||
						$routes[1] == "referidoInt" ||
						$routes[1] == "referidoExt" ||
						$routes[1] == "referidos100" ||
						$routes[1] == "crearRef" ||
						$routes[1] == "repMembresias" ||
						$routes[1] == "perfil" ||
						$routes[1] == "salir"

					) {

						include "adminP/views/models/" . $routes[1] . ".php";
					} else {
						include "adminP/views/models/404.php";
					}
					break;



				default:


					include "models/" . $routes[0] . ".php";


					break;
			}
		} else {

			include "models/404.php";
		}
	} else {
		include "models/inicio.php";
	}



	?>




    <?php


	switch ($routes[0]) {
		case 'adminDash':
			include 'adminP/footers/footer_base.php';
			include "adminP/footers/footer.php";
			break;

		case 'perfilMed':

			include "views/footers/modal_onboarding.php";
			include 'views/footers/footer_base.php';
			include "views/footers/footer.php";

			include "views/footers/scripts_dash.php";
			include "views/footers/scripts_perfil.php";
			echo "</body>";
			break;

		case 'checkout':
		case 'busqueda':
		case 'perfil':
			include 'views/footers/footer_base.php';
			include "views/footers/scripts_citas.php";
			include "views/footers/scripts_checkout.php";
			include "views/footers/footer.php";
			include "views/footers/modal_onboarding.php";

			echo "</body>";
			break;

		case 'lobby':
			include 'views/footers/footer_base.php';
			include "views/footers/footer.php";
			include "views/footers/modal_onboarding.php";

			echo "</body>";
			break;

		case 'dashboard':
		case 'agenda':
		case 'historial':
		case 'historialPac':

			include 'views/footers/footer_base.php';
			include "views/footers/footer.php";
			include "views/footers/modal_onboarding.php";
			include "views/footers/scripts_dash.php";
			echo "</body>";
			break;

		case 'resumen':
			include 'views/footers/footer_base.php';
			include "views/footers/scripts_citas.php";
			include "views/footers/scripts_checkout.php";

			include "views/footers/modal_onboarding.php";
			echo "</body>";
			break;

		default:
			include 'views/footers/footer_base.php';
			include "views/footers/footer.php";
			echo "</body>";
			break;
	}

	?>


    </html>