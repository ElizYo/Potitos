<?php
session_start();

if(!isset($_SESSION['id_proveedor'])) {
    header("location: /index.php");
}

include_once "bbdd.php";

$ubicacionImgs= '../img/productos/';
$ubicacionDeseada='../img/productos/'.basename($_FILES['file']['name']);

$temp = '../img/default.png';

//obtenemos los datos enviados del formulario y los guardamos en variables
$nombre_form = $_POST['nombre'];
$precio_form = $_POST['precio'];
$stock_form = $_POST['stock'];
$tipo_componente = $_POST['tipo_componente'];

if(!empty($_FILES['file']['name'])){
    move_uploaded_file($_FILES['file']['tmp_name'],$ubicacionDeseada);
    $imagen = $_FILES['file']['name'];
} else {
    $imagen = null;
}

$valid_register = registrar_componente($nombre_form, $precio_form, $stock_form, $tipo_componente, $imagen, $_SESSION['id_proveedor']);

if($valid_register) {
    header("location: ../registrar_componente.php?success=1");
} else {
    header("location: ../registrar_componente.php?errno=1");
}
?>
