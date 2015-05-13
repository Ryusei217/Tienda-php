<?php
    session_start();
    if (!isset($_SESSION['idUsuario']))
        die('No ha iniciado sesion.');
    $servername = "localhost";
    $username = "tienda";
    $password = "Tienda.2014";
    $db = "tienda";
    $jsondata = array();

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Fallo la conexion: " . $conn->connect_error);
    }

    if(isset($_POST["id"]){
        $id = $_POST["id"];

        $consulta = $conn->prepare("DELETE FROM articulo WHERE idArticulo = ? ");
        $consulta->bind_param("i", $id);

        $consulta->execute();

        $consulta->close();
        $conn->close();
        $jsondata['success'] = true;
        $jsondata['message'] = 'Articulo Eliminado';
    }
    else {
        $jsondata['success'] = false;
        $jsondata['message'] = 'Error: no se ha definido un articulo valido.';
    };

    //Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
    header('Content-type: application/json; charset=utf-8');

    echo json_encode($jsondata);
?>
