 <!-- Page Content -->
 <div class="content">
				<div class="container-fluid" style="    padding-bottom: 10%;
    padding-top: 6%;">
					
					<div class="row">
						<div class="col-md-8 offset-md-2">
							
							<!-- Account Content -->
							<div class="account-content">
								<div class="row align-items-center justify-content-center">
									<div class="col-md-7 col-lg-6 login-left">
										<img src="views/assets/img/login-banner.png" class="img-fluid" alt="Login Banner">	
									</div>
									<div class="col-md-12 col-lg-6 login-right">
										<div class="login-header">
											<h3>Recuperar Contraseña</h3>
											<p class="small text-muted">Ingresa tu email para resetear tu contraseña</p>
										</div>
										
										<!-- Forgot Password Form -->
										<form action="controller/forgot_pass.controlador.php" method="POST">
											<div class="form-group form-focus">
												<input type="email" name="correo-forgot" class="form-control floating">
												<label class="focus-label">Email</label>
											</div>
											<div class="text-right">
												<a class="forgot-link" href="login">Recordaste tu contraseña?</a>
											</div>
											<button class="btn btn-primary btn-block btn-lg login-btn" type="submit">Resetear Password</button>
										</form>
										<!-- /Forgot Password Form -->
										
									</div>
								</div>
							</div>
							<!-- /Account Content -->
							
						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->