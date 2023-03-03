<?php
session_start();
require_once 'bbdd.php';

if(isset($_POST['nif']) && isset($_POST['password']) && isset($_POST['type'])) {
    $pass = $_POST['password'];
    $type = $_POST['type'];

    if ($type == 'trabajador') {
        // Validar login para trabajador con DNI
        $data_user = validar_login_usuario_trabajador($_POST['nif'], $pass);
    } else if ($type == 'proveedor') {
        // Validar login para proveedor con NIF
        $data_user = validar_login_usuario($_POST['nif'], $pass);
    } else {
        // Tipo de usuario inválido
        header("Location: ../index.php?errno=3");
        exit;
    }

    if(empty($data_user)) {
        // Usuario no encontrado
        header("Location: ../login.php?errno=1");
        exit;
    } else {
        // Login exitoso
        if (isset($data_user['id_trabajador'])) {
            $_SESSION['id_trabajador'] = $data_user['id_trabajador'];
            $_SESSION['user_id'] = $data_user['id_trabajador'];
            $_SESSION['nombre'] = $data_user['nombre'];
        }

        if (isset($data_user['id_proveedor'])) {
            $_SESSION['id_proveedor'] = $data_user['id_proveedor'];
            $_SESSION['user_id'] = $data_user['id_proveedor'];
            $_SESSION['nombre'] = $data_user['nombre'];
        }

        header("Location: ../index.php");
        exit;
    }
} else {
    // Datos de login incompletos
    header("Location: ../index.php?errno=2");
    exit;
}
