<?php
session_start();

if(!isset($_SESSION['id_proveedor'])) {
    header("location: /index.php");
}

include_once "bbdd.php";

$id_componente = $_GET['id_componente'];

if($id_componente==""){
    header("location: ../modificar_componentes.php?errno=3");
}

$valid_delete = delete_componente($id_componente);

if($valid_delete) {
    header("location: ../modificar_componentes.php?success=1");
} else {
    header("location: ../modificar_componentes.php?errno=1");
}

?>