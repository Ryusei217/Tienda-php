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

    $nick = $_POST["nick"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password1 = $_POST["password1"];

    if($password !== $password1)
        die("Error los password no coinciden");

    $password = hash('sha256', $password, false);
    echo $password;

    $consulta = $conn->prepare("INSERT INTO usuario (nick, email, password) values(?,?,?)");
    $consulta->bind_param("sss", $nick, $email, $password);

    $consulta->execute();

    $consulta->close();
    $conn->close();

    echo json_encode(array('msj' => 'Usuario guardado'));
?>
