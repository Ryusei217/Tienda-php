<?php
    //Iniciamos la sesion y verificamos que el usuario este logueado
    session_start();

    $servername = "localhost";
    $username = "tienda";
    $password = "Tienda.2014";
    $db = "tienda";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $db);

    // Check connection
    if ($conn->connect_error) {
        echo json_encode(array("success" => false, "message" => "Fallo la conexion: " . $conn->connect_error));
    }

    //Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
    header('Content-type: application/json; charset=utf-8');

    if (!isset($_SESSION['idUsuario']))
        echo json_encode(array("success" => false, "message" => "Usuario Invalido."));

    if(isset($_POST["dpi"])){
        $dpi = $_POST["dpi"];

        $sql = "SELECT * FROM cliente WHERE dpi='".$dpi."';";

        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            if($row = $result->fetch_assoc()) {

                $conn->close();

                echo json_encode(array("success" => true, "cliente" => $row));
            }
        }
        else {
            $conn->close();
            echo json_encode(array("success" => false, "message" => "Cliente invalido."));
        }
    }
    else {
        echo json_encode(array("success" => false, "message" => "Cliente invalido."));
    };

?>
