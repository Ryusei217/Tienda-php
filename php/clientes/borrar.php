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

    $consulta = $conn->prepare("DELETE FROM cliente WHERE idCliente = ? ");
    $consulta->bind_param("i", $id);

    $consulta->execute();

    $consulta->close();
    $conn->close();

    echo json_encode(array('msj' => 'Cliente eliminado'));
?>
