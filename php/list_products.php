<?php

if(!isset($_SESSION['id_proveedor'])) {
    header("location: ../index.php");
}

include_once "bbdd.php";

$data_componentes = get_componentes($_SESSION['id_proveedor']);

$template = "";

if (is_array($data_componentes)) {
    foreach ($data_componentes as $componente) {

        $template .= '<div class="col-3 border">
            <div class="product-title text-center"><span>'. $componente['NOMBRE'] .'</span></div>';
        
        if($componente['IMAGEN']!=""){
            $template.='<div class="product-stock text-end"><img width="400px" height="250px" src="img/productos/'. $componente['IMAGEN'] .'"/></div>';
        } else {
            $template.='<div class="product-stock text-end"><img src="img/default.png"/></div>';

        }

        $template .= '
            <div class="product-precio text-end">Precio: '. $componente['PRECIO'] .'€</div>
            <div class="product-stock text-end">Stock: '. $componente['STOCK'] .'</div>
            <div class="product-type text-end">Tipo: '. $componente['NOMBRE_COMPONENTE'] .'</div>
        </div>';
    }
} else {
    $template = '<p>No hay componentes disponibles.</p>';
}

echo $template;

?>
