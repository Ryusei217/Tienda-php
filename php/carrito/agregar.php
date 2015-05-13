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
        die("Fallo la conexion: " . $conn->connect_error);
    }

    //Aunque el content-type no sea un problema en la mayoría de casos, es recomendable especificarlo
    header('Content-type: application/json; charset=utf-8');

    if (!isset($_SESSION['idUsuario']))
        echo json_encode(array("success" => false, "message" => "Usuario Invalido."));

    //Verificamos si no existe el carrito y creamos uno nuevo
    if (!isset($_SESSION['carrito']))
        $_SESSION['carrito'] = array();

    if(isset($_POST["id"]) && isset($_POST["cantidad"])){
        $id = $_POST["id"];
        $cantidad = $_POST["cantidad"];

        $sql = "SELECT * FROM articulo WHERE idArticulo='".$id."';";

        $result = $conn->query($sql);

        if($result->num_rows > 0) {
            if($row = $result->fetch_assoc()) {

                $detalle = array("articulo" => $row, "cantidad" => $cantidad);
            }
        }
        else {
            $conn->close();
            echo json_encode(array("success" => false, "message" => "Articulo invalido."));
        }

        $conn->close();

        array_push($_SESSION["carrito"], $detalle);

        echo json_encode(array("success" => true, "message" => "Articulo agregado."));
    }
    else {
        echo json_encode(array("success" => false, "message" => "Articulo invalido."));
    };

?>
