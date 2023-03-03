<?php
session_start();

if(!isset($_SESSION['id_trabajador'])) {
    header("location: /index.php");
}

include_once "bbdd.php";

//obtenemos los datos enviados del formulario y los guardamos en variables
$nif_form = $_POST['nif'];
    if(!empty($_POST['password'])){
        $password_form = $_POST['password'];
    }else{
        header("location: ../registro.php?errno=2");
    }
$nombre_form = $_POST['nombre'];
$email_form = $_POST['email'];
$telefono_form = $_POST['telefono'];
$direccion_form = $_POST['direccion'];
$poblacion_form = $_POST['poblacion'];
$pais_form = $_POST['pais'];

$valid_register = registrar_proveedor($nif_form, $password_form, $nombre_form,  $email_form, $telefono_form, $direccion_form, $poblacion_form, $pais_form);

if($valid_register) {
    header("location: ../registro.php?success=1");
} else {
    header("location: ../registro.php?errno=1");
}

?>