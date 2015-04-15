<?php
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

    $consulta = $conn->prepare("INSERT INTO cliente (dpi, nombre) values(?,?)");
    $consulta->bind_param("ss", $dpi, $nombre);

    $dpi = $_POST["dpi"];
    $nombre = $_POST["nombre"];

    $consulta->execute();

    $consulta->close();
    $conn->close();

    echo json_encode(array('msj' => 'Cliente guardado'));
?>
