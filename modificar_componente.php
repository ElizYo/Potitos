<?php
    include_once "php/check_session.php";
    include_once "php/bbdd.php";
    if(!isset($_SESSION['id_proveedor'])) {
        header("location: /index.php");
    }

    $data_componente = get_componente($_GET['id_componente'], $_SESSION['id_proveedor']);

    $data_tipo_componente = get_tipo_componente($_SESSION['id_proveedor']);

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
            <h1>MODIFICAR COMPONENTE</h1>
        </div>
    </div>
    <div class="row mt-5 justify-content-center">
        <div class="col-12 col-md-5">
        <div>
            <?php
                if(isset($_GET['success'])&&$_GET['success']==1){
                    echo '<h3>Su producto se actulizo correctamente.</h3>';
                } elseif(isset($_GET['errno']) && $_GET['errno']==1){
                    echo '<h3>Hubo un error al actualizar su producto.</h3>';
                }
            ?>
        </div>
            <form method="post" enctype="multipart/form-data" action="php/update_product.php">
                <div class="mb-3">
                    <input type="hidden" id="id_componente" name="id_componente" value="<?php echo $_GET['id_componente'];?>">
                    <label class="form-label" for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $data_componente['NOMBRE'];?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Precio</label>
                    <input class="form-control" type="number" name="precio" step="000.00" id="precio" value="<?php echo str_replace(",",".",$data_componente['PRECIO']);?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Stock</label>
                    <input class="form-control" type="number" name="stock" id="stock" value="<?php echo $data_componente['STOCK'];?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tipo producto</label>
                    <select class="form-select" name="tipo_componente" id="tipo_componente">
                        <?php
                        foreach ($data_tipo_componente as $tipo_componente) {

                            $selected = "";

                            if($tipo_componente['ID_TIPO_COMPONENTE'] == $data_componente['ID_TIPO_COMPONENTE']) {
                                $selected = "selected";
                            }

                            echo '<option '.$selected.' value="'.$tipo_componente['ID_TIPO_COMPONENTE'].'">'.$tipo_componente['NOMBRE'].'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Imagen</label>
                    <input class="form-control" name="file" type="file" accept="image/*">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Cambiar</button> 
                </div>
            </form>
        </div>
    </div>
</body>