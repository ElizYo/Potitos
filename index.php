<?php
    include_once "php/check_session.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/0c9793c46c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="img/logo.png">
    <title>Potitos</title>
</head>
<body>
<div class="row" style="background-color: #1d212b;min-height: 150px;">
        <div id="menu-bar" class="col-12">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <img src="img/logo.png" width="190px" height="auto">
                    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="navbar-collapse collapse justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="index.php">Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="about-us.php">Sobre nosotros</a>
                            </li>
                            <?php
                            if(isset($_SESSION['id_trabajador'])){

                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="registro.php">Registrar Proveedor</a>
                            </li>
                            <?php
                            }
                            ?>
                            <?php
                            if(isset($_SESSION['id_proveedor'])) {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="componentes.php">Componentes</a>
                            </li>
                            <?php
                            }
                            ?>
                            <?php
                            if(isset($_SESSION['id_proveedor'])) {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="registrar_componente.php">Alta Componente</a>
                            </li>
                            <?php
                            }
                            ?>
                            <?php
                            if(isset($_SESSION['id_proveedor'])) {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="modificar_componentes.php">Modificar Componente</a>
                            </li>
                            <?php
                            }
                            ?>
                            <?php
                            if(!isset($_SESSION['id_proveedor']) && !isset($_SESSION['id_trabajador'])) {
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="login.php"><i class="fa-solid fa-user"></i>Iniciar sesion</a>
                                </li>
                                <?php
                            } else if(isset($_SESSION['id_proveedor'])) {
                                ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-user"></i><span><?php echo $_SESSION['nombre']; ?></span>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="perfil.php">Editar perfil</a></li>
                                        <li><a class="dropdown-item" href="php/close_session.php">Cerrar sesión</a></li>
                                    </ul>
                                </li>
                                <?php
                            } else if(isset($_SESSION['id_trabajador'])) {
                                ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-user"></i><span><?php echo $_SESSION['nombre']; ?></span>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="php/close_session.php">Cerrar sesión</a></li>
                                    </ul>
                                </li>
                                <?php
                            } 
                            ?> 
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div id="slider-bar" class="col-12">
            <div class="row mx-0 justify-content-around slide active">
                <div class="col-12 col-lg-7 info">
                    <h2>Servicio para todos</h2>
                    <p>Desarrollo de software hecho a tu medida.</p>
                </div>
                <div class="col-12 col-lg-5 text-center">
                    <img src="img/carrousel0-removebg-preview.png" alt="">
                </div>
            </div>
            <div class="row mx-0 justify-content-around slide">
                <div class="col-12 col-lg-7 info">
                    <h2>Empresas</h2>
                    <p>Construimos soluciones de software que se adaptan a tus necesidades empresariales y ayudan a mejorar la productividad.</p>
                </div>
                <div class="col-12 col-lg-5 text-center">
                    <img src="img/carrousel1-removebg-preview.png" alt="">
                </div>
            </div>
            <div class="row mx-0 justify-content-around slide">
                <div class="col-12 col-lg-7 info">
                    <h2>Negocios</h2>
                    <p>Nuestros expertos en tecnología trabajan contigo para ofrecer soluciones de software innovadoras y personalizadas que impulsan tu negocio.</p>
                </div>
                <div class="col-12 col-lg-5 text-center">
                    <img src="img/carrousel2-removebg-preview (1).png" alt="">
                </div>
            </div>
            <div class="row mx-0 justify-content-around slide">
                <div class="col-12 col-lg-7 info">
                    <h2>Experiencia en el sector</h2>
                    <p>Aprovecha nuestra experiencia en desarrollo de software para obtener soluciones rápidas y eficientes</p>
                </div>
                <div class="col-12 col-lg-5 text-center">
                    <img src="img/carrousel3-removebg-preview.png" alt="">
                </div>
            </div>
            <div class="row mx-0 justify-content-around slide">
                <div class="col-12 col-lg-7 info">
                    <h2>Particulares</h2>
                    <p>Estamos aquí para ayudarte a aprovechar al máximo la tecnología, con soluciones de software que mejoran tu vida.</p>
                </div>
                <div class="col-12 col-lg-5 text-center">
                    <img src="img/carrousel4-removebg-preview.png" alt="">
                </div>
            </div>
            <div class="navigation">
              <div class="btn active"></div>
              <div class="btn"></div>
              <div class="btn"></div>
              <div class="btn"></div>
              <div class="btn"></div>
            </div>
        </div>
        </div>
    </div>
    <div>
        <div class="three_box">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="box_text">
                            <i><img src="img/ram.png" alt="#"/></i>
                            <h3>Kingston FURY Beast DDR4 3200 MHz 8GB CL16</h3>
                            <p>Kingston FURY Beast DDR4 3200 MHz 8GB CL16 es un módulo de memoria RAM de alta velocidad diseñado para computadoras de escritorio que requieren un rendimiento rápido y confiable. Tiene una capacidad de 8GB y una velocidad de reloj de 3200 MHz, lo que permite un procesamiento de datos más rápido y una mejora en el rendimiento general del sistema. Además, su tiempo de latencia CL16 ayuda a reducir la cantidad de tiempo que tarda la memoria en responder a una solicitud, lo que mejora aún más su capacidad de respuesta. Es compatible con sistemas que utilizan tecnología DDR4 y tiene un diseño de disipador de calor para una disipación térmica eficiente.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box_text">
                            <i><img src="img/procesador.png" alt="#"/></i>
                            <h3>Intel socket LGA1200 10Gen</h3>
                            <p>El socket LGA1200 es una interfaz de conexión de la placa base que permite la instalación de procesadores Intel 10Gen. Es el sucesor del socket LGA1151 utilizado en las generaciones anteriores de procesadores Intel. El LGA1200 está diseñado para admitir una amplia gama de procesadores, incluyendo los procesadores Core i9, Core i7, Core i5 y Core i3. Ofrece una mayor capacidad de ancho de banda y un mejor soporte de memoria en comparación con su predecesor, lo que permite un mejor rendimiento y una mayor eficiencia energética en general. Los procesadores que se insertan en el socket LGA1200 están diseñados para ordenadores de escritorio, portatiles y consolas de alto rendimiento.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="box_text">
                            <i><img src="img/ram.png" alt="#"/></i>
                            <h3>Corsair Vengeance LPX DDR4 3200MHz PC4-25600 32GB 2x16GB CL16</h3>
                            <p>Corsair Vengeance LPX DDR4 3200MHz PC4-25600 32GB 2x16GB CL16 es una memoria RAM de alta velocidad diseñado para ordenadores de alto rendimiento. El incluye dos módulos de memoria RAM de 16GB cada uno, un total de 32GB de capacidad. Cada módulo tiene una velocidad de 3200 MHz, lo que permite un procesamiento de datos más rápido y una mejora en el rendimiento general del sistema. Además, su tiempo de latencia CL16 ayuda a reducir la cantidad de tiempo en responder a una solicitud, mejorando aún más su capacidad de respuesta. Es compatible con sistemas que utilizan tecnología DDR4 y un diseño de disipador de calor bajo pero con térmica eficiente.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div></div>
    <div></div>

      <!-- Footer -->
<div id="footer" style="padding-top:25px">
  <footer class="text-center text-white pt-5" style="background-color: #212529">
    <div class="container">
      <!--Texto-->
      <section class="mb-5">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-8">
            <p>
            Mantente actualizado con todas las noticias y novedades de nuestros productos siguiéndonos en nuestras redes sociales.
            </p>
          </div>
        </div>
      </section>
      <!--FIN Texto-->

      <!-- Redes Sociales -->
      <section class="text-center mb-5">
        <a href="" class="text-white me-4">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="" class="text-white me-4">
          <i class="fab fa-instagram"></i>
        </a>
      </section>
      <!--FIN Redes Sociales -->
    </div>

    <!-- Copyright -->
    <div
         class="text-center p-3"
         style="background-color: rgba(0, 0, 0, 0.2)"
         >
      © 2020 Copyright:
      <a class="text-white" href="#"
         >Potitos</a
        >
    </div>
    <!--FIN Copyright -->
  </footer>
</div>
  <!--FIN Footer -->
</body>
<script type="text/javascript">
    //Slider de imagenes manual y automático.
    var slides = document.querySelectorAll('.slide');
    var btns = document.querySelectorAll('.btn');
    let currentSlide = 1;
    
     y luego se agregan a la diapositiva y el botón correspondientes.
    var manualNav = function(manual){
        //funcion de flecha que ejecuta una funcion para cada uno de los slides y botones
      slides.forEach((slide) => {
        //Se eliminan las clases "active" de todas las diapositivas y botones
        slide.classList.remove('active');
    
        btns.forEach((btn) => {
          btn.classList.remove('active');
        });
      });
      //Y se agregan a la diapositiva y el botón correspondiente
      slides[manual].classList.add('active');
      btns[manual].classList.add('active');
    }
    //Se agrega un listener de eventos a cada botón para detectar cuando se hace clic en ellos.
    btns.forEach((btn, i) => {
      btn.addEventListener("click", () => {
        //Se llama a la función manualNav con el indice i para navegar a la diapositiva correspondiente
        manualNav(i);
        //Se actualiza currentSlide con el indice actual
        currentSlide = i;
      });
    });
    
    //Funcion repeat que se utiliza para navegar automaticamente entre las diapositivas
    var repeat = function(activeClass){
      let active = document.getElementsByClassName('active');
      let i = 1;

        //La funcion utiliza un temporizador para ejecutar repetidamente una función que cambia la diapositiva actual
      var repeater = () => {
        setTimeout(function(){
          [...active].forEach((activeSlide) => {
            activeSlide.classList.remove('active');
          });
        //Eliminando la clase "active" de todas las diapositivas activas y agregarla a la siguiente diapositiva
        slides[i].classList.add('active');
        btns[i].classList.add('active');
        i++;
        //Si se ha llegado a la ultima diapositiva  comenzara desde la primera 
        if(slides.length == i){
          i = 0;
        }
        //Si i ha superado el numero de diapositivas finaliza con return y la navegacion automatica se detiene.
        if(i >= slides.length){
          return;
        }
        //Tiempo de espera en 10 segundos antes de que la función repeater() se ejecute de nuevo y cambie a la siguiente diapositiva
        //Para que vaya mas rapido cambiariamos de aqui
        repeater();
      }, 10000);
      }
      repeater();
    }
    repeat();
</script>
</html>