<?php
    session_start();
    if (!isset($_SESSION['idUsuario']))
        die('No ha iniciado sesion.');
    $servername = "localhost";
    $username = "tienda";
    $password = "Tienda.2014";
    $db = "tienda";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        die("Fallo la conexion: " . $conn->connect_error);
    }

    $consulta = $conn->prepare("INSERT INTO Articulo (numeroSerie, nombre, precio) values(?,?,?)");
    $consulta->bind_param("ssd", $numeroSerie, $nombre, $precio);

    $numeroSerie = $_POST["numeroSerie"];
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];

    $consulta->execute();
    $consulta->close();
    $conn->close();

    echo json_encode(array('msj' =>'Articulo guardado'));
?>
