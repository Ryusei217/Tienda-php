<?php
    session_start();
    if (isset($_SESSION['carrito'])) {
        unset($_SESSION['carrito']);
        echo "Carrito vacio.";
    }
    else {
        die('No hay elementos en el carrito.');
    }
?>
