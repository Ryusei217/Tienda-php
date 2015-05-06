<?php
    session_start();
    if (isset($_SESSION['idUsuario'])) {
        unset($_SESSION['idUsuario']);
        unset($_SESSION['nick']);
        unset($_SESSION['email']);
        echo "Ha cerrado Sesion.";
    }
    else {
        die('No ha iniciado sesion.');
    }
?>
