<?php
session_start();

if(!isset($_SESSION['id_proveedor'])) {
    header("location: /index.php");
}

include_once "bbdd.php";

$ubicacionImgs= '../img/productos/';
$ubicacionDeseada='../img/productos/'.basename($_FILES['file']['name']);
//obtenemos los datos enviados del formulario y los guardamos en variables
$nombre_form = $_POST['nombre'];
$precio_form = $_POST['precio'];
$stock_form = $_POST['stock'];
$id_tipo_componente = $_POST['tipo_componente'];
$id_componente = $_POST['id_componente'];


move_uploaded_file($_FILES['file']['tmp_name'],$ubicacionDeseada);
$valid_update = update_componente_con_foto($nombre_form, $precio_form, $stock_form, $id_tipo_componente ,basename($_FILES['file']['name']), $id_componente);

var_dump($valid_update);

if($valid_update) {
    header("location: ../modificar_componente.php?id_componente=".$id_componente."&success=1");
} else {
    header("location: ../modificar_componente.php?id_componente=".$id_componente."&errno=1");
}

?>