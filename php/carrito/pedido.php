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

    //Verificamos si no existe el carrito y creamos uno nuevo
    if (!isset($_SESSION['carrito']) && !isset($_SESSION['idUsuario']))
        die("Error al intentar guardar.");

    if(isset($_POST["idCliente"])){
        $id = $_POST["idCliente"];

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
        die("Error cliente invalido.");
    };

?>
