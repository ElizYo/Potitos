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
    <link rel="stylesheet" href="css/componentes.css">
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
                            if(!isset($_SESSION['id_proveedor'])) {
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php"><i class="fa-solid fa-user"></i>Login</a>
                            </li>
                            <?php
                            } else {
                            ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user"></i><span> <?php echo $_SESSION['nombre']; ?></span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="perfil.php">Editar perfil</a></li>
                                    <li><a class="dropdown-item" href="php/close_session.php">Cerrar session</a></li>
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
            <h1>LOGIN</h1>
        </div>
    </div>
    <div class="row mt-5 justify-content-center">
        <div class="col-12 col-md-5">
        <form method="post" action="php/login.php">
        <div class="mb-3">
        <label for="login-type" class="form-label">Tipo de usuario</label>
        <select class="form-select" name="type" id="login-type">
            <option value="trabajador">Trabajador</option>
            <option value="proveedor">Proveedor</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="login-nif" class="form-label">NIF / DNI</label>
        <input type="text" class="form-control" name="nif" id="login-nif" aria-describedby="nifHelp">
        <div id="nifHelp" class="form-text">Ingrese un NIF o DNI válido.</div>
    </div>
    <div class="mb-3">
        <label for="login-password" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" id="login-password">
    </div>
    <div class="mb-3">
        <?php
            if(isset($_GET['errno'])) {
                echo "ERROR!! EL NIF/DNI O LA CONTRASEÑA NO SON CORRECTOS";
            }
        ?>
    </div>
    <button type="submit" class="btn btn-primary">Ingresar</button>
</form>

        </div>
    </div>
    <div id="footer"  style="padding-top: 20px">
        <!-- Footer -->
        <footer class="text-center text-white pt-5" style="background-color: #212529">
            <!-- Grid container -->
            <div class="container">
            <!-- Section: Text -->
            <section class="mb-5">
                <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <p>
                    Mantente actualizado con todas las noticias y novedades de nuestros productos siguiéndonos en nuestras redes sociales.
                    </p>
                </div>
                </div>
            </section>
            <!-- Section: Text -->

            <!-- Section: Social -->
            <section class="text-center mb-5">
                <a href="" class="text-white me-4">
                <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="text-white me-4">
                <i class="fab fa-twitter"></i>
                <a href="" class="text-white me-4">
                <i class="fab fa-instagram"></i>
                </a>
            </section>
            <!-- Section: Social -->
            </div>
            <!-- Grid container -->

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
            <!-- Copyright -->
        </footer>
        <!-- Footer -->
    </div>
</body>
</html>