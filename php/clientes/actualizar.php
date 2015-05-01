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

    $id = $_POST["id"];
    $dpi = $_POST["dpi"];
    $nombre = $_POST["nombre"];

    $consulta = $conn->prepare("UPDATE cliente SET dpi=?, nombre=? WHERE idCliente = ? ");
    $consulta->bind_param("ssi", $dpi, $nombre, $id);

    $consulta->execute();

    $consulta->close();
    $conn->close();

    echo json_encode(array('msj' => 'Cliente editado'));
?>
