<?php
    session_start();

    if(!isset($_SESSION['id_proveedor'])) 
    {
        header("location: index.php");
    }

    include_once "bbdd.php";

    session_start();

    //obtenemos los datos enviados del formulario y los guardamos en variables de los datos que vamos a editar
    $id_proveedor_form = $_POST['id_proveedor'];
    $nombre_form = $_POST['nombre'];
    $password_form = $_POST['password'];
    $email_form = $_POST['email'];
    $telefono_form = $_POST['telefono'];
    $direccion_form = $_POST['direccion'];
    $poblacion_form = $_POST['poblacion'];
    $pais_form = $_POST['pais'];

    $valid_modify = modify_user($id_proveedor_form,$nombre_form, $password_form, $email_form, $telefono_form, $direccion_form, $poblacion_form, $pais_form);

    if($valid_modify==1)
    {
        $data_user = get_data_user($_SESSION['id_proveedor']);

        $_SESSION['nombre'] = $data_user['nombre'];

        header("location: ../perfil.php?success=1");

    } else {
        header("location: ../perfil.php?errno=1");
    }


?>
