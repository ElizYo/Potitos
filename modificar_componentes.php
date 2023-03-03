<?php
    include_once "php/check_session.php";
    include_once "php/bbdd.php";
    if(!isset($_SESSION['id_proveedor'])) {
        header("location: /index.php");
    }

    $data_componentes = get_componentes($_SESSION['id_proveedor']);
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
            <h1>LISTADO COMPONENTES</h1>
        </div>
    </div>
    <div class="row justify-content-center text-center">
        <div class="col-7">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Modificar</th>
                    <th scope="col">Borrar</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach($data_componentes as $componente) {
                        echo '
                            <tr>
                            <td>' . $componente['NOMBRE'] . '</td>
                            <td>' . $componente['PRECIO'] . '</td>
                            <td>' . $componente['STOCK'] . '</td>
                            <td><a type="button" href="modificar_componente.php?id_componente=' . $componente['ID_COMPONENTE'] . '" class="btn btn-secondary">Modificar</a></td>
                            <td><a type="button" class="btn first" href="php/borrar_componente.php?id_componente=' . $componente['ID_COMPONENTE'] . '" class="btn btn-secondary">Borrar</a></td>
                            </tr>
                        ';
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>