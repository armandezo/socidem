	<!-- Breadcrumb -->
    <div class="breadcrumb-bar">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-md-12 col-12">
							<nav aria-label="breadcrumb" class="page-breadcrumb">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index-2.html">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Booking</li>
								</ol>
							</nav>
							<h2 class="breadcrumb-title">Booking</h2>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!-- Page Content -->
			<div class="content success-page-cont">
				<div class="container-fluid">
				
					<div class="row justify-content-center">
						<div class="col-lg-6">
						<?php
						
						$codigoRef = $routes[1];
						 
						$consAgendaNew = ejecutarSQL::consultar("SELECT `agenda`.*, `agenda`.`pagoID` FROM `agenda` WHERE `agenda`.`pagoID` = '$codigoRef' ");


						while($datos_agenda_C=mysqli_fetch_assoc($consAgendaNew)){
						$cita_array = $datos_agenda_C['cita'];
						$fecha_start = $datos_agenda_C['fecha_start'];
						$fecha_end = $datos_agenda_C['fecha_hora'];
						$jsonCitaObj = json_decode($cita_array, TRUE);
						 
					 	
						
						?>
							<!-- Success Card -->
							<div class="card success-card">
								<div class="card-body">
									<div class="success-cont">
										<i class="fas fa-check"></i>

										<?php 
										 
											switch ($jsonCitaObj['status']) {
												case "aproved":
												echo '<h3>Cita agendada con Exito!</h3>';
													break;
												case "in_process":
													echo '<h3>Cita en Espera!</h3>';
														break;
												 
											}
											
											setlocale(LC_TIME, 'es_ES');
											setlocale(LC_TIME, 'spanish');
											
										$fecha_formateada =	str_replace('/', '-', $fecha_start);
											
										 
											$dia= date("d", strtotime($fecha_formateada)); 	
											$anio = strftime("%Y", strtotime($fecha_formateada));  
											$fecha_init = strtotime($fecha_formateada);
											$fecha_fin = strtotime($fecha_end);
											$init_hora_min =  date("g:ia", $fecha_init);
                                            $end_hora_min = date("g:ia", $fecha_fin);
											$mes_texto = strftime("%B", strtotime($fecha_formateada) );  

											 $fecha_result = $dia." ".$mes_texto." del ".$anio." <br><br> ".$end_hora_min;									
										?>

										
										<h4> <strong>  Cita Agendada  </strong><br> <br><strong>Codigo: <?=$codigoRef ?></strong><br><br> <strong style="text-transform: capitalize;"> <?=$fecha_result  ?> </strong> <br><br></h4>
										<a href="dashboard" class="btn btn-primary view-inv-btn">Ir al Dashboard</a>
									</div>
								</div>
							</div>
							<!-- /Success Card -->
						
						<?php }  ?> 
						</div>
					</div>
					
				</div>
			</div>		
			<!-- /Page Content -->