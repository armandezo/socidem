  <!-- Home Banner -->
  <style>
.section-search {
    background-image: url("views/assets/images/mios/fondo3.jpg");
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    min-height: 0;
}

.banner-wrapper {
    margin: 0 auto;
    max-width: 1044px !important;
    width: 100%;
}

.opcion {
    font-size: 13px;
}

.nav-tabs {
    border: none;
    background: none;
}

.nav-tabs>li>a {
    margin-right: 10px;
}

.rese {
    color: white;
}

.servicios {
    color: #23C3D4;
}

.category-box>div>img {
    width: 100px;
    height: 80px;
}

.lapopt {
    background-image: url("views/assets/images/mios/fondo_laptop.jpg");
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
}

.vide {
    color: white;
}

center {
    position: relative;
}

.video_doc {
    width: 56.8%;
    height: 80%;
    position: absolute;
    right: 21.6%;
    top: 5%;
}

.start {
    background-color: #23C3D4;
    border-radius: 0px;
    border: none;
    padding: 20px 30px 20px 30px;
}

.section_4 {
    background-image: url("views/assets/images/mios/fondocarrusel.jpg");
    padding: 60px;
}

#selecione {
    display: none;
}

#selecione2 {
    display: none;
}

#selecione3 {
    display: none;
}

#selecione4 {
    display: none;
}

#selecione5 {
    display: none;
}

#selecione6 {
    display: none;
}

#selecione7 {
    display: none;
}

#selecione8 {
    display: none;
}

#selecione9 {
    display: none;
}

#selecione10 {
    display: none;
}

#selecione11 {
    display: none;
}

#selecione12 {
    display: none;
}

/*carrusel*/
.slider {
    width: 800px;
    height: 100px;
    overflow: hidden;
}

.slides {
    width: 500%;
    height: 100px;
    display: flex;
}

.slides input {
    display: none;
}

.slide {
    width: 20%;
    transition: 2s;
}

.slide p {
    width: 800px;
    height: 200px;
}

/* la navegacion en forma manual */
.navegation-manual {
    position: absolute;
    width: 800px;
    margin-top: -40px;
    display: flex;
    justify-content: center;
}

.manual-btn {
    border: 2px solid gray;
    padding: 5px;
    border-radius: 10px;
    cursor: pointer;
    transition: 1s;
}

.manual-btn:not(:last-child) {
    margin-right: 40px;
}

.manual-btn:hover {
    background: gray;
}

#radio1:checked~.first {
    margin-left: 0;
}

#radio2:checked~.first {
    margin-left: -20%;
}

#radio3:checked~.first {
    margin-left: -40%;
}

/*forma automatica*/
.navigation-auto {
    position: absolute;
    display: flex;
    width: 800px;
    justify-content: center;
    margin-top: 460px;

}

.navigation-auto div {
    border: 2px solid black;
    border: 5px;
    border-radius: 10px;
    transition: 1s;
}

.navigation-auto div:not(:last-child) {
    margin-right: 40px;
}

.radio1:checked~.navigation-auto .auto-btn1 {
    background: grey;
}

.radio2:checked~.navigation-auto .auto-btn2 {
    background: grey;
}

.radio3:checked~.navigation-auto .auto-btn3 {
    background: grey;
}

.preguntas {
    color: white;
}
  </style>
  <section class="section section-search" id="section_1">
      <div class="container-fluid">
          <div class="banner-wrapper">
              <div class="banner-header">
                  <h1 class="rese">Reserve una video <br> consulta hoy</h1>
                  <div class="botones">
                      <ul id="myTab" class="nav nav-tabs" role="tablist">
                          <li class="nav-item" role="presentation">
                              <a class=" btn btn-light nav-link active opcion" id="pills-home-tab" href="#pills-home" data-toggle="tab"
                                  data-target=".pills-contet-home">
                                  <img src="views/assets/images/mios/video.png" alt=""> Online</a>
                          </li>
                          <li class="nav-item" role="presentation">
                              <a class=" btn btn-outline-light nav-link opcion" id="pills-profile-tab" href="#pills-profile" data-toggle="tab"
                                  data-target=".pills-contet-profile">
                                  <img src="views/assets/images/mios/ubicacion2.png" alt="" width="24">Visita Presencial</a>
                          </li>
                      </ul>
                      <div class="tab-content">
                          <div class="tab-pane fade show active pills-contet-home">
                              <form>
                                  <div class="mb-4 row">
                                      <!-- <div class="col-md-3">
                                          <div class="form-outline">
                                              <input type="text" id="form3Example1" class="form-control" placeholder="Nombre" style="border-radius:0px;" />
                                          </div>
                                      </div> -->
                                      <div class="form-group col-md-3">
                                          <select name="especialidad" class="form-control" id="especialidad">
                                              <option default hidden>Especialidades</option>

                                          </select>
                                          <span class="form-text">Eliga una espeacialidad</span>
                                      </div>
                                      <button type="button" class="btn btn-success" onclick="search()"
                                          style="background-color: #008298;     height: 46px; border: none;">Buscar</button>
                                  </div>
                                  <div>
                                      <p class="h3 comentario" style="color: white;">Consulte con médicos expertos, obtenga un plan <br> de
                                          tratamiento y recetas si es necesario</p>
                                  </div>
                              </form>
                          </div>
                          <div class="tab-pane fade pills-contet-profile">
                              <form>
                                  <div class="mb-4 row">
                                      <!-- <div class="col-md-3">
                                          <div class="form-outline">
                                              <input type="text" id="form3Example1" class="form-control" placeholder="Nombre" style="border-radius:0px;" />
                                          </div>
                                      </div>
                                      <div class="col-md-3">
                                          <div class="form-outline ">
                                              <input type="text" id="form3Example1" class="form-control" placeholder="Especialidades" style="border-radius:0px;" />
                                          </div>
                                      </div> -->
                                      <!-- <div class="col-md-3">
                                          <div class="form-outline ">
                                              <select class="form-control">
                                                  <option value="1">Lima</option>
                                                  <option value="2">San Borja</option>
                                              </select>
                                          </div>
                                      </div> -->

                                      <!-- <button type="button" class="btn btn-success" style="background-color: #008298; border: none;">Buscar</button> -->
                                      <div class="form-group col-md-3">
                                          <select name="departamento" class="form-control" id="departamento" onchange="cargaProvincias();">
                                              <option default hidden>Departamentos</option>
                                          </select>
                                          <span class="form-text">Eliga un departamento</span>
                                      </div>

                                      <div class="form-group col-md-3">
                                          <select name="provincia" class="form-control" id="provincia" onchange="cargaDistritos();">
                                              <option default hidden>Provincias</option>
                                          </select>
                                          <span class="form-text">Eliga una provincia</span>
                                      </div>

                                      <div class="form-group col-md-3">
                                          <select name="distrito" class="form-control" id="distrito">
                                              <option default hidden>Distritos</option>
                                          </select>
                                          <span class="form-text">Eliga un distrito</span>
                                      </div>

                                      <div class="form-group col-md-3">
                                          <select name="especialidad2" class="form-control" id="especialidad2">
                                              <option default hidden>Especialidades</option>

                                          </select>
                                          <span class="form-text">Eliga una espeacialidad</span>
                                      </div>
                                      <button type="button" class="mt-0 btn btn-primary search-btn" onclick="search2()"><i class="fas fa-search"></i>
                                          <span>Buscar</span></button>

                                  </div>
                                  <div>
                                      <p class="h3 comentario" style="color: white;">Consulte con médicos expertos, obtenga un plan <br> de
                                          tratamiento y recetas si es necesario</p>
                                  </div>
                              </form>
                          </div>
                      </div>
                  </div>
              </div><!-- banner-header -->
          </div>
      </div>
  </section> <!-- primero -->

  <!-- Category Section -->
  <section class="section home-tile-section" id="section_2">
      <div class="container">
          <div class="section-header">
              <h2 class="mt-2 text-center servicios">Nuestros Servicios</h2>
          </div>
          <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active pills-contet-home">
                  <div class="row">
                      <div class="col-lg-4">
                          <div class="category-box">
                              <div>
                                  <img src="views/assets/images/mios/medico.png" alt="celular">
                              </div>
                              <div class="category-content">
                                  <span>Selecione un medico</span> <br>
                                  <button type="button" class="btn" id="boton1" onclick="mostrar();">
                                      <img src="views/assets/images/mios/abajo.png" alt="flecha abajo">
                                  </button>
                              </div>
                          </div>
                          <div id="selecione">
                              <div class="text-center category-box">
                                  <p class="">Seleccione por nombre o <br> por especialidad</p>
                                  <button type="button" class="btn" id="boton1" onclick="ocultar();">
                                      <img src="views/assets/images/mios/arriba.png" alt="">
                                  </button>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-4">
                          <div class="category-box">
                              <div>
                                  <img src="views/assets/images/mios/calendario.png" alt="celular">
                              </div>
                              <div class="category-content">
                                  <span>Variedad de horarios</span> <br>
                                  <button type="button" class="btn" id="boton2" onclick="mostrar2();">
                                      <img src="views/assets/images/mios/abajo.png" alt="">
                                  </button>
                              </div>
                          </div>
                          <div id="selecione2">
                              <div class="text-center category-box">
                                  <p class="">Busque el horario mas <br> conveniente para usted</p>
                                  <button type="button" class="btn" id="boton2" onclick="ocultar2();">
                                      <img src="views/assets/images/mios/arriba.png" alt="">
                                  </button>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-4">
                          <div class="category-box">
                              <div>
                                  <img src="views/assets/images/mios/engranaje.png" alt="celular">
                              </div>
                              <div class="category-content">
                                  <span>Sin instalaciones</span> <br>
                                  <button type="button" class="btn" id="boton3" onclick="mostrar3();">
                                      <img src="views/assets/images/mios/abajo.png" alt="">
                                  </button>
                              </div>
                          </div>
                          <div id="selecione3">
                              <div class="text-center category-box">
                                  <p class="">Web intuitiva de fácil <br> uso y sin instalar <br>programas</p>
                                  <button type="button" class="btn" id="boton3" onclick="ocultar3();">
                                      <img src="views/assets/images/mios/arriba.png" alt="">
                                  </button>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-4">
                          <div class="category-box">
                              <div class="text-center">
                                  <img src="views/assets/images/mios/carpeta.png" alt="celular">
                              </div>
                              <div class="category-content">
                                  <span>Historia clínica digital</span> <br>
                                  <button type="button" class="btn" id="boton4" onclick="mostrar4();">
                                      <img src="views/assets/images/mios/abajo.png" alt="">
                                  </button>
                              </div>
                          </div>
                          <div id="selecione4">
                              <div class="text-center category-box">
                                  <p class="">Reciba recetas y envié <br> análisis o imágenes su <br>medico tratante </p>
                                  <button type="button" class="btn" id="boton4" onclick="ocultar4();">
                                      <img src="views/assets/images/mios/arriba.png" alt="">
                                  </button>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-4">
                          <div class="category-box">
                              <div>
                                  <img src="views/assets/images/mios/mensaje.png" alt="celular">
                              </div>
                              <div class="category-content">
                                  <span>Recordamos las citas</span> <br>
                                  <button type="button" class="btn" id="boton5" onclick="mostrar5();">
                                      <img src="views/assets/images/mios/abajo.png" alt="">
                                  </button>
                              </div>
                          </div>
                          <div id="selecione5">
                              <div class="text-center category-box">
                                  <p class="">Reciba recetas y envié <br> análisis o imágenes su <br>medico tratante </p>
                                  <button type="button" class="btn" id="boton5" onclick="ocultar5();">
                                      <img src="views/assets/images/mios/arriba.png" alt="">
                                  </button>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-4">
                          <div class="category-box">
                              <div>
                                  <img src="views/assets/images/mios/bd.png" alt="celular">
                              </div>
                              <div class="category-content">
                                  <span>Información encriptada</span> <br>
                                  <button type="button" class="btn" id="boton6" onclick="mostrar6();">
                                      <img src="views/assets/images/mios/abajo.png" alt="">
                                  </button>
                              </div>
                          </div>
                          <div id="selecione6">
                              <div class="text-center category-box">
                                  <p class="">Reciba recetas y envié <br> análisis o imágenes su <br>medico tratante </p>
                                  <button type="button" class="btn" id="boton6" onclick="ocultar6();">
                                      <img src="views/assets/images/mios/arriba.png" alt="">
                                  </button>
                              </div>
                          </div>
                      </div>

                  </div>
              </div><!-- online -->
              <div class="tab-pane fade pills-contet-profile">
                  <div class="tab-pane fade show active pills-contet-home">
                      <div class="row">
                          <div class="col-lg-4">
                              <div class="category-box">
                                  <div>
                                      <img src="views/assets/images/mios/medico2.png" alt="celular">
                                  </div>
                                  <div class="category-content">
                                      <span>Selecione un medico</span> <br>
                                      <button type="button" class="btn" id="boton7" onclick="mostrar7();">
                                          <img src="views/assets/images/mios/abajo.png" alt="">
                                      </button>
                                  </div>
                              </div>
                              <div id="selecione7">
                                  <div class="text-center category-box">
                                      <p class="">Seleccione por nombre o <br> por especialidad </p>
                                      <button type="button" class="btn" id="boton6" onclick="ocultar7();">
                                          <img src="views/assets/images/mios/arriba.png" alt="">
                                      </button>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="category-box">
                                  <div>
                                      <img src="views/assets/images/mios/calendario.png" alt="celular">
                                  </div>
                                  <div class="category-content">
                                      <span>Variedad de horarios</span><br>
                                      <button type="button" class="btn" id="boton8" onclick="mostrar8();">
                                          <img src="views/assets/images/mios/abajo.png" alt="">
                                      </button>
                                  </div>
                              </div>
                              <div id="selecione8">
                                  <div class="text-center category-box">
                                      <p class="">Busque el horario mas <br> conveniente para usted </p>
                                      <button type="button" class="btn" id="boton8" onclick="ocultar8();">
                                          <img src="views/assets/images/mios/arriba.png" alt="">
                                      </button>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="category-box">
                                  <div>
                                      <img src="views/assets/images/mios/ubicacion2.png" alt="celular">
                                  </div>
                                  <div class="category-content">
                                      <span>Ubicacion de consultoria</span><br>
                                      <button type="button" class="btn" id="boton9" onclick="mostrar9();">
                                          <img src="views/assets/images/mios/abajo.png" alt="">
                                      </button>
                                  </div>
                              </div>
                              <div id="selecione9">
                                  <div class="text-center category-box">
                                      <p class="">Busque por provincia y <br>distrito el consultorio <br>mas cercano</p>
                                      <button type="button" class="btn" id="boton9" onclick="ocultar9();">
                                          <img src="views/assets/images/mios/arriba.png" alt="">
                                      </button>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="category-box">
                                  <div class="text-center">
                                      <img src="views/assets/images/mios/carpeta.png" alt="celular">
                                  </div>
                                  <div class="category-content">
                                      <span>Historia clínica digital</span><br>
                                      <button type="button" class="btn" id="boton10" onclick="mostrar10();">
                                          <img src="views/assets/images/mios/abajo.png" alt="">
                                      </button>
                                  </div>
                              </div>
                              <div id="selecione10">
                                  <div class="text-center category-box">
                                      <p class="">Reciba recetas y envié <br>análisis o imágenes su <br>medico tratante </p>
                                      <button type="button" class="btn" id="boton10" onclick="ocultar10();">
                                          <img src="views/assets/images/mios/arriba.png" alt="">
                                      </button>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="category-box">
                                  <div>
                                      <img src="views/assets/images/mios/mensaje.png" alt="celular">
                                  </div>
                                  <div class="category-content">
                                      <span>Recordamos las citas</span><br>
                                      <button type="button" class="btn" id="boton11" onclick="mostrar11();">
                                          <img src="views/assets/images/mios/abajo.png" alt="">
                                      </button>
                                  </div>
                              </div>
                              <div id="selecione11">
                                  <div class="text-center category-box">
                                      <p class="">Recibirá mensajes para <br>recordar su cita<br>evitando el olvido</p>
                                      <button type="button" class="btn" id="boton11" onclick="ocultar11();">
                                          <img src="views/assets/images/mios/arriba.png" alt="">
                                      </button>
                                  </div>
                              </div>
                          </div>
                          <div class="col-lg-4">
                              <div class="category-box">
                                  <div>
                                      <img src="views/assets/images/mios/bd.png" alt="celular">
                                  </div>
                                  <div class="category-content">
                                      <span>Información encriptada</span>
                                      <br>
                                      <button type="button" class="btn" id="boton12" onclick="mostrar12();">
                                          <img src="views/assets/images/mios/abajo.png" alt="">
                                      </button>
                                  </div>
                              </div>
                              <div id="selecione12">
                                  <div class="text-center category-box">
                                      <p class="">Protocolo HIPPA, el mas <br>alto estándar de <br>seguridad internacional</p>
                                      <button type="button" class="btn" id="boton12" onclick="ocultar12();">
                                          <img src="views/assets/images/mios/arriba.png" alt="">
                                      </button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div><!-- visita -->
          </div>
      </div>
  </section>
  <!-- Category Section -->

  <!-- Availabe Features -->
  <section class="section home-tile-section lapopt">
      <div class="container">
          <div class="text-center ">
              <p class="h3 vide">Prueba nuestro video consulta</p>
              <center>
                  <img src="views/assets/images/mios/laptop.jpg.png" class="img-fluid" alt="Responsive image">
                  <img src="views/assets/images/mios/osito.gif" alt="video con el doctor" class="mx-auto rounded video_doc img-fluid d-block">
              </center>
              <div class="text-center">
                  <button type="button" class="btn btn-secondary start"><a href="https://meet.google.com/tbf-wnug-edx">Iniciar</a></button>
              </div>
          </div>
      </div>
  </section>
  <!-- /Availabe Features -->


  <section class="section home-tile-section section_4">
      <!--incio carrusel-->
      <div class="container">
          <center>
              <div class="slider ">
                  <div class="slides c">
                      <input type="radio" name="radio-btn" id="radio1">
                      <input type="radio" name="radio-btn" id="radio2">
                      <input type="radio" name="radio-btn" id="radio3">

                      <div class="slide first">
                          <p>! Experiencia absolutamente maravillosa ! el médico fue cortes y profesional!</p>
                      </div>
                      <div class="slide">
                          <p>Me encanto la eficiencia y la simplicidad, pude completar mi video consulta fácilmente y recibí mi receta inmediatamente
                          </p>
                      </div>
                      <div class="slide">
                          <p>Muy buenos profesionales atención de primera y sin complicaciones</p>
                      </div>

                      <div class="navigation-auto">
                          <div class="auto-btn1"></div>
                          <div class="auto-btn2"></div>
                          <div class="auto-btn3"></div>
                      </div>
                  </div>
                  <div class="navegation-manual">
                      <label for="radio1" class="manual-btn"></label>
                      <label for="radio2" class="manual-btn"></label>
                      <label for="radio3" class="manual-btn"></label>
                  </div>
              </div>
          </center>
      </div>
      <!--final carrusel-->
      <div class="text-center">
          <h2 class="preguntas">Preguntas frecuentes</h2>
      </div>
      <div class="container ">
          <div class="accordion" id="accordionExample">
              <div class="row gx-5">
                  <div class="col-sm">
                      <div class="card">
                          <div class="card-header" id="headingOne">
                              <h2 class="mb-0">
                                  <button class="text-left btn btn-link btn-block" type="button" data-toggle="collapse" data-target="#collapseOne"
                                      aria-expanded="true" aria-controls="collapseOne">
                                      ¿Qué problemas de salud puedo consultar pro video consulta?
                                  </button>
                              </h2>
                          </div>

                          <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                              <div class="card-body">
                                  Puedes plantear a nuestros médicos la mayor parte de las consultas que realizarías de forma presencial. El médico
                                  evaluará cada caso y decidirá si el caso a consultar puede ser resuelto vía tele consulta o si requiere atención
                                  presencial. En ambos casos de atenciones, el médico podrá gestionar toda la información médica incluyendo la
                                  historia clínica y visualización de archivos desde nuestra plataforma.
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm">
                      <div class="card">
                          <div class="card-header" id="headingTwo">
                              <h2 class="mb-0">
                                  <button class="text-left btn btn-link btn-block collapsed" type="button" data-toggle="collapse"
                                      data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                      ¿Puedo instalar Médicos en Directo en mi <br> celular?
                                  </button>
                              </h2>
                          </div>
                          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                              <div class="card-body">
                                  En su celular busque medicosendirecto.com en su navegador al abrir la página le preguntara si quiere agregarlo a su
                                  página de inicio acepte y se instalara en su celular.
                                  ¿Qué necesito tener para usar médicos en directo en mi computadora, laptop o celular?
                                  En las computadoras personales o laptops necesita internet, cámara y micrófono regularmente incorporados y conexión
                                  a internet.
                                  En el celular solo conexión a internet.

                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="row gx-5">
                  <div class="col-sm">
                      <div class="card">
                          <div class="card-header" id="headingTwo">
                              <h2 class="mb-0">
                                  <button class="text-left btn btn-link btn-block collapsed" type="button" data-toggle="collapse"
                                      data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                      ¿Por qué debo ingresar mi número telefónico?
                                  </button>
                              </h2>
                          </div>
                          <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                              <div class="card-body">
                                  Si su visita se interrumpe por algún motivo, el medico puede usar ese número telefónico para devolverle la llamada y
                                  finalizar su cita.
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm">
                      <div class="card">
                          <div class="card-header" id="headingTwo">
                              <h2 class="mb-0">
                                  <button class="text-left btn btn-link btn-block collapsed" type="button" data-toggle="collapse"
                                      data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                                      ¿cuánto dura una consulta por video consulta al médico?
                                  </button>
                              </h2>
                          </div>
                          <div id="collapsefour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                              <div class="card-body">
                                  Cada médico configura el tiempo de duración el mínimo es de 30 minutos
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="row gx-5">
                  <div class="col-sm">
                      <div class="card">
                          <div class="card-header" id="headingTwo">
                              <h2 class="mb-0">
                                  <button class="text-left btn btn-link btn-block collapsed" type="button" data-toggle="collapse"
                                      data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                                      ¿Se pueden cargar, fotos, pruebas clínicas o informes?
                                  </button>
                              </h2>
                          </div>
                          <div id="collapsefive" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                              <div class="card-body">
                                  Sí. Nuestra plataforma médica permite subir y guardar fotos, documentos con resultados de pruebas o análisis
                                  clínicos para una valoración más completa de cada caso. Esta documentación quedará vinculada a la historia clínica
                                  electrónica.
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm">
                      <div class="card">
                          <div class="card-header" id="headingTwo">
                              <h2 class="mb-0">
                                  <button class="text-left btn btn-link btn-block collapsed" type="button" data-toggle="collapse"
                                      data-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix">
                                      ¿Dónde y cómo se guarda mi historia clínica?
                                  </button>
                              </h2>
                          </div>
                          <div id="collapsesix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                              <div class="card-body">
                                  Todos los datos de la historia clínica se encuentran encriptados en la nube donde se guarda y gestiona el acceso
                                  solo por el Doctor elegido.
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="row gx-5">
                  <div class="col-sm">
                      <div class="card">
                          <div class="card-header" id="headingTwo">
                              <h2 class="mb-0">
                                  <button class="text-left btn btn-link btn-block collapsed" type="button" data-toggle="collapse"
                                      data-target="#collapseseven" aria-expanded="false" aria-controls="collapseseven">
                                      ¿Cuánto cuesta el servicio de consulta presencial o video consulta?
                                  </button>
                              </h2>
                          </div>
                          <div id="collapseseven" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                              <div class="card-body">
                                  El costo de cada atención, sea presencial o por video consulta, está establecido por cada profesional médico. Este
                                  valor esta visible en el perfil de cada profesional disponible publicado en nuestra plataforma.
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="col-sm">
                      <div class="card">
                          <div class="card-header" id="headingTwo">
                              <h2 class="mb-0">
                                  <button class="text-left btn btn-link btn-block collapsed" type="button" data-toggle="collapse"
                                      data-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                                      ¿Cómo pago la consulta presencial o video consulta al médico?
                                  </button>
                              </h2>
                          </div>
                          <div id="collapseEight" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                              <div class="card-body">
                                  Hay dos modalidades
                                  A.-al momento de hacer la reserva de la cita le solicitaremos el pago a través de la pasarela de pago segura de
                                  Mercado Pago donde puede usar los siguientes medios de pago:
                                  1.- Tarjetas de crédito o divito Visa y MasterCard.
                                  2.- Pago en efectivo en agentes bancarios (al momento de con firmar la cita le enviaran un código para que pueda ir
                                  a pagar al agente bancario que le sea más cómodo) BCP, BBVA Continental, Interbank, Scotiabank y pago efectivo.
                                  3.-En efectivo por banca por internet, al momento de pagar le dirán como hacerlo online, no necesita hacer colas en
                                  una agencia bancaria, BCP, BBVA Continental, Interbank y Scotiabank.
                                  B.- Los médicos pueden optar por cobrar directamente las consultas en este caso siga las instrucciones que están en
                                  el perfil del facultativo.
                                  No he recibido el correo electrónico con un enlace para activar mi cuenta.
                                  Consulta la carpeta Spam de su bandeja de entrada. Puede ser que esté ahí, ya que a veces los emails automáticos
                                  llegan a dicha carpeta
                                  No puedo acceder a mi cuenta / No recuerdo mi contraseña
                                  Cuando esto ocurre asegúrate en primer lugar de que la dirección de correo electrónico con la que has intentado
                                  acceder es la misma que con la que te registraste. Si es así, utiliza la opción de la recordar contraseña para
                                  recibir un email con las instrucciones para recuperarla y poder iniciar sesión.

                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div><!-- accordion -->
      </div>
  </section>
  <script>
$(document).ready(function() {
    $('#myTab a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        let target = $(e.target).data('target');
        console.log(target);
        $(target)
            .addClass('active show')
            .siblings('.tab-pane.active')
            .removeClass('active show')
    });
});
// Mostrar
function mostrar() {
    document.getElementById('selecione').style.display = 'block';
}

function mostrar2() {
    document.getElementById('selecione2').style.display = 'block';
}

function mostrar3() {
    document.getElementById('selecione3').style.display = 'block';
}

function mostrar4() {
    document.getElementById('selecione4').style.display = 'block';
}

function mostrar5() {
    document.getElementById('selecione5').style.display = 'block';
}

function mostrar6() {
    document.getElementById('selecione6').style.display = 'block';
}

function mostrar7() {
    document.getElementById('selecione7').style.display = 'block';
}

function mostrar8() {
    document.getElementById('selecione8').style.display = 'block';
}

function mostrar9() {
    document.getElementById('selecione9').style.display = 'block';
}

function mostrar10() {
    document.getElementById('selecione10').style.display = 'block';
}

function mostrar11() {
    document.getElementById('selecione11').style.display = 'block';
}

function mostrar12() {
    document.getElementById('selecione12').style.display = 'block';
}
// Ocultar
function ocultar() {
    document.getElementById('selecione').style.display = 'none';
}

function ocultar2() {
    document.getElementById('selecione2').style.display = 'none';
}

function ocultar3() {
    document.getElementById('selecione3').style.display = 'none';
}

function ocultar4() {
    document.getElementById('selecione4').style.display = 'none';
}

function ocultar5() {
    document.getElementById('selecione5').style.display = 'none';
}

function ocultar6() {
    document.getElementById('selecione6').style.display = 'none';
}

function ocultar7() {
    document.getElementById('selecione7').style.display = 'none';
}

function ocultar8() {
    document.getElementById('selecione8').style.display = 'none';
}

function ocultar9() {
    document.getElementById('selecione9').style.display = 'none';
}

function ocultar10() {
    document.getElementById('selecione10').style.display = 'none';
}

function ocultar11() {
    document.getElementById('selecione11').style.display = 'none';
}

function ocultar12() {
    document.getElementById('selecione12').style.display = 'none';
}
//carrusel
var counter = 1;
setInterval(function() {
    document.getElementById('radio' + counter).checked = true;
    counter++;
    if (counter > 3) {
        counter = 1;
    }
    divText: [
        '<svg width="50" height="50" viewBox="0 0 24 24"><path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z"/></svg>',
        '<svg width="50" height="50" viewBox="0 0 24 24"><path d="M5 3l3.057-3 11.943 12-11.943 12-3.057-3 9-9z"/></svg>'
    ]
}, 5000)
  </script>