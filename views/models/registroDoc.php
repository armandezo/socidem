<style>
.caja1 {
    display: block;
}

.caja3 {
    display: none;
}

.caja2 {
    display: none;
}
</style>

<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-8 offset-md-2">

                <!-- Register Content -->
                <div class="account-content">
                    <div class="row align-items-center justify-content-center" style="margin-bottom: 10%; margin-top: 8%;">
                        <div class="col-md-7 col-lg-6 login-left">
                            <img src="views/assets/img/reg.svg" class="img-fluid" alt="Doccure Register">
                        </div>

                        <div class="col-md-12 col-lg-6 login-right">
                            <form class="theme-form Login-Form" action="controller/registro_med.controlador.php" method="post" role="form"
                                data-form="registro">
                                <div class="caja1">

                                    <div class="login-header">
                                        <h3>Registro Doctores <a href="registro">No Eres un Doctor? </a></h3>
                                    </div>

                                    <!-- Register Form -->


                                    <div class="form-group form-focus">

                                        <label class="focus-label">Especialidad</label>
                                        <select class="form-control floating" name="especialidad">
                                            <option>Elegir</option>
                                            <option value="Alergista">Alergista</option>
                                            <option value="Anestesiólogo">Anestesiólogo </option>
                                            <option value="Cardiologo">Cardiólogo </option>
                                            <option value="Cirujano"> Cirujano</option>
                                            <option value="Cardiovascular y Torácico"> Cardiovascular y Torácico </option>
                                            <option value="Cirujano general"> Cirujano general</option>
                                            <option value="Cirujano maxilofacial"> Cirujano maxilofacial </option>
                                            <option value="Cirujano pediátrico"> Cirujano pediátrico </option>
                                            <option value="Cirujano plástico"> Cirujano plástico</option>
                                            <option value="Cirujano vascular"> Cirujano vascular</option>
                                            <option value="Dentista"> Dentista</option>
                                            <option value="Dermatólogo"> Dermatólogo</option>
                                            <option value="Endocrinólogo"> Endocrinólogo</option>
                                            <option value="Enfermero"> Enfermero</option>
                                            <option value="Epidemiólogo"> Epidemiólogo</option>
                                            <option value="Especialista en Administración de Salud"> Especialista en
                                                Administración de Salud</option>
                                            <option value="Especialista en Emergencias"> Especialista en Emergencias
                                            </option>
                                            <option value="Especialista en Medicina Estética"> Especialista en Medicina
                                                Estética</option>
                                            <option value="Especialista en Medicina Física y Rehabilitación"> Especialista
                                                en Medicina Física y Rehabilitación</option>
                                            <option value="Especialista en Medicina Intensiva"> Especialista en Medicina
                                                Intensiva</option>
                                            <option value="Especialista en Medicina Natural"> Especialista en Medicina
                                                Natural</option>
                                            <option value="Especialista en Medicina Nuclear"> Especialista en Medicina
                                                Nuclear</option>
                                            <option value="Especialista en Radioterapia"> Especialista en Radioterapia
                                            </option>
                                            <option value="Especialista en Salud Pública"> Especialista en Salud Pública
                                            </option>
                                            <option value="Farmacólogo"> Farmacólogo</option>
                                            <option value="Fisioterapeuta"> Fisioterapeuta</option>
                                            <option value="Fonoaudiólogo"> Fonoaudiólogo</option>
                                            <option value="Gastroenterólogo"> Gastroenterólogo</option>
                                            <option value="Genetista"> Genetista</option>
                                            <option value="Geriatra"> Geriatra</option>
                                            <option value=" Ginecólogo"> Ginecólogo</option>
                                            <option value="Hematólogo"> Hematólogo</option>
                                            <option value="Homeópata"> Homeópata</option>
                                            <option value="Infectólogo"> Infectólogo</option>
                                            <option value="Internista"> Internista</option>
                                            <option value="Médico del Deporte"> Médico del Deporte</option>
                                            <option value="Médico del Trabajo"> Médico del Trabajo</option>
                                            <option value="Médico familiar"> Médico familiar</option>
                                            <option value="Médico general"> Médico general</option>
                                            <option value="Médico legal"> Médico legal</option>
                                            <option value="Médico ocupacional"> Médico ocupacional</option>
                                            <option value="Nefrólogo"> Nefrólogo</option>
                                            <option value="Neonatólogo"> Neonatólogo</option>
                                            <option value="Neumólogo"> Neumólogo</option>
                                            <option value="Neumólogo"> Neumólogo</option>
                                            <option value="Pediátrico"> Pediátrico</option>
                                            <option value="Neurocirujano"> Neurocirujano</option>
                                            <option value="Neurofisiólogo clínico"> Neurofisiólogo clínico</option>
                                            <option value="Neurólogo<"> Neurólogo</option>
                                            <option value="Nutricionista"> Nutricionista</option>
                                            <option value="Oftalmólogo"> Oftalmólogo</option>
                                            <option value="Oncólogo"> Oncólogo</option>
                                            <option value="Óptico"> Óptico</option>
                                            <option value="Otorrino"> Otorrino</option>
                                            <option value="Patólogo"> Patólogo</option>
                                            <option value="Patólogo clínico"> Patólogo clínico</option>
                                            <option value="Pediatra"> Pediatra</option>
                                            <option value="Podólogo"> Podólogo</option>
                                            <option value="Psicólogo"> Psicólogo</option>
                                            <option value="Psiquiatra"> Psiquiatra</option>
                                            <option value="Quiropráctico"> Quiropráctico</option>
                                            <option value="Radiólogo"> Radiólogo</option>
                                            <option value="Reumatólogo"> Reumatólogo</option>
                                            <option value="Técnico en Laboratorio Clínico"> Técnico en Laboratorio Clínico
                                            </option>
                                            <option value="Terapeuta complementario"> Terapeuta complementario</option>
                                            <option value="Traumatólogo y Ortopedista"> Traumatólogo y Ortopedista</option>
                                            <option value="Urólogo"> Urólogo</option>
                                        </select>

                                    </div>
                                    <div class="form-group form-focus">
                                        <input type="text" name="nombre_doc" class="form-control floating" required autocomplete="off">
                                        <label class="focus-label">Nombre Completo</label>
                                    </div>

                                    <div class="text-right">
                                        <a class="forgot-link" href="loginMed">Ya tienes una cuenta?</a>
                                    </div>
                                    <button class="btn btn-primary btn-block btn-lg login-btn" onclick="cambio()" type="button">Continuar </button>
                                </div>
                                <div class="caja3">
                                    <div class="login-header">
                                        <h3>Registro Doctores <a href="registro">No Eres un Doctor? </a></h3>
                                    </div>
                                    <div class="form-group form-focus">
                                        <input type="text" name="ciudad_doc" class="form-control floating" required autocomplete="off">
                                        <label class="focus-label">Ciudad</label>
                                    </div>
                                    <div class="form-group form-focus">
                                        <input type="text" name="telefono_doc" class="form-control floating" required autocomplete="off">
                                        <label class="focus-label">Telefono (+51) no necesario</label>
                                    </div>
                                    <div class="form-group form-focus">
                                        <input type="email" name="email_doc" class="form-control floating" required autocomplete="off">
                                        <label class="focus-label">Email</label>
                                    </div>
                                    <div class="form-group form-focus">
                                        <input type="password" name="pass_doc" class="form-control floating" required autocomplete="off">
                                        <label class="focus-label">Contraseña</label>
                                    </div>

                                    <div class="form-group ">
                                    <select class="form-control "  name="coleg_type" require>
                                            <option selected="true" disabled="disabled" hidden>Seleccione la colegiatura </option>
                                            <option value="Colegio Medico del Peru">Colegio Médico del Perú</option>
                                            <option value="Colegio de Nutricionistas del Peru">Colegio de Nutricionistas del Perú</option>
                                            <option value="Colegio de Psicologos del Peru">Colegio de Psicólogos del Perú</option>
                                            <option value="Colegio de Odontologico del Peru">Colegio de Odontológico del Perú</option>
                                    </select>

                                    </div>
                                    
                                <div class="form-group form-focus"   > 
                                <input type="text" name="num_colegiado_doc" class="form-control floating" required autocomplete="off">
                                <label class="focus-label">Num. Colegiado</label>
                            
                                    </div>

                                    
                                    <button class="btn btn-primary btn-block btn-lg login-btn res-registro" type="submit">Registrarme
                                    <span class="res-registro animated fadeInDown"></span> 
                                    </button>
                                    <div class="res-registro-end animated fadeInDown"> </div>
                                </div>

                        </div>
                        </form>
                        <!-- /Register Form -->

                    </div>
                </div>
            </div>
            <!-- /Register Content -->

        </div>
    </div>

</div>

</div>
