<?php
    session_start();
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

    //recuperamos los valores del formulario
    $nick = $_POST["nick"];
    $password = $_POST["password"];

    //Encriptamos de nuevo la contraseña para compararla con la contraseña guardada
    $password = hash('sha256', $password, false);

    //Buscamos al usuario en la BD
    $consulta = $conn->prepare("SELECT idUsuario, nick, email FROM usuario WHERE nick = ? AND password = ?");
    $consulta->bind_param("ss", $nick, $password);

    $consulta->execute();

    //Almacenamos la sesion si el usuario fue econtrado.
    /* obtenemos el resultado */
    $result = $consulta->get_result();

    /* obtenemos los resultados */
    if ($row = $result->fetch_assoc()) {
        if (!isset($_SESSION['idUsuario'])) {
            $_SESSION['idUsuario'] = $row['idUsuario'];
            $_SESSION['nick'] = $row['nick'];
            $_SESSION['email'] = $row['email'];
        }
        else {
            die('Ya inicio sesion con el usuario '.$_SESSION['nick']);
        }
    }
    else {
        die('usuario no encontrado');
    }

    $consulta->close();
    $conn->close();

    echo json_encode(array('msj' => 'Sesion iniciada'));
?>
