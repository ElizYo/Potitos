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
    <link rel="stylesheet" href="css/about-us.css">
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
        <div id="title-bar" class="col-12 text-center">
            <h1>Sobre nosotros</h1>
        </div>
    </div>
    <div class="container marketing">

<!--Trabajadores-->
<div class="row">
  <div class="col-lg-6 mt-5 text-center">
  <img class="bd-placeholder-img rounded-circle" src="img/nina2.jpg" width="140" height="140" alt="Perfil">
    <h2>Lucia</h2>
    <p>Programadora y diseñadora de interfaces de usuario.</p>
  </div>
  <div class="col-lg-6 mt-5 text-center">
  <img class="bd-placeholder-img rounded-circle" src="img/hombre.jpg" width="140" height="140" alt="Perfil">
    <h2>Danel</h2>
    <p>Desarrollador de software.</p>
  </div>
  <div class="col-lg-6 mt-5 text-center">
  <img class="bd-placeholder-img rounded-circle" src="img/nina.jpg" width="140" height="140" alt="Perfil">
    <h2>Yohanna</h2>
    <p>Ingeniera de calidad de software.</p>
    
  </div>
  <div class="col-lg-6  mt-5 text-center">
  <img class="bd-placeholder-img rounded-circle" src="img/perfil.jpg" width="140" height="140" alt="Perfil">
    <h2>Iuls</h2>
    <p>Analista comercial y R.H.</p>
    
  </div>
</div>
<!-- FIN trabajadores -->

<hr class="featurette-divider">

<div class="row featurette">
  <div class="col-md-7">
    <h2 class="featurette-heading">Soluciones personalizadas de desarrollo de software para empresas y startups. <span class="text-muted">Para un comienzo facil y seguro.</span></h2>
    <p class="lead">En nuestra página web, ofrecemos soluciones de desarrollo de software personalizadas y asequibles para empresas y startups. Con un enfoque en la calidad, la eficiencia y la innovación, nos aseguramos de que su negocio tenga la ventaja competitiva que necesita en un mercado cada vez más digital.</p>
  </div>
  <div class="col-md-5">
  <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" src="img/info.png" width="500" height="500" alt="about">
  </div>
</div>

<hr class="featurette-divider">

<div class="row featurette">
  <div class="col-md-7 order-md-2">
    <h2 class="featurette-heading">Creatividad y técnica combinadas. <span class="text-muted">Sé diferente.</span></h2>
    <p class="lead">Combinamos la creatividad con la técnica para ofrecer soluciones de software a medida que impulsan su negocio hacia adelante. Desde la planificación hasta la implementación y el mantenimiento continuo, trabajamos estrechamente con nuestros clientes para asegurarnos de que su software sea exactamente lo que necesita.</p>
  </div>
  <div class="col-md-5 order-md-1">
  <img class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" src="img/info2.png" width="500" height="500" alt="aboutus">

  </div>
</div>
</div>

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
</html>