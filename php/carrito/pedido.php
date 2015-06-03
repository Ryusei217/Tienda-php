<?php
    //Iniciamos la sesion y verificamos que el usuario este logueado
    session_start();
    date_default_timezone_set('America/Guatemala');

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
        $usuario = $_SESSION["idUsuario"];
        $valido = true;

        //Deshabilitamos el autocommit
        $conn->autocommit(false);

        //Consultas que no se guardan hasta confirmarlas
        $consulta = $conn->prepare("INSERT INTO Pedido (fecha, Cliente_idCliente, Usuario_idUsuario) values(?,?,?)");
        $fecha = new Datetime();
        $fecha = $fecha->format('Y-m-d H:i:s');
        $consulta->bind_param("sii", $fecha, $id, $usuario);

        $consulta->execute();

        //Verificamos que la consulta se ejecute correctamente
        if($consulta->errno){
            $valido = false;
            echo "Ocurrio un error: ".$consulta->error;
        }

        $pedidoId = $consulta->insert_id;

        //Insertamos todos los articulos que hayan en el carrito
        while($row = next($_SESSION["carrito"])) {
            $detalle = $conn->prepare("INSERT INTO DetallePedido (Articulo_idArticulo, Pedido_idPedido, cantidad) values(?,?,?)");
            $detalle->bind_param("iii", $row["articulo"]["idArticulo"], $pedidoId, $row["cantidad"]);
            $detalle->execute();

            //Si hay error terminamos con la ejecucion
            if($detalle->errno){
                $valido = false;
                echo "Ocurrio un error: ".$detalle->error;
                break;
            }
        }

        //Si no hubieron errores confirmamos, si no deshacemos los cambios
        if($valido) {
            $conn->commit();
            unset($_SESSION["carrito"]);
            echo "Se guardo el pedido";
        }
        else {
            $conn->rollback();
            echo "Se deshicieron los cambios";
        }


        $conn->close();
    }
    else {
        die("Error cliente invalido.");
    };

?>
