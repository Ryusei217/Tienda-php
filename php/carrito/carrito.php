<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Articulo</title>

	<link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/main.css">
</head>

<body>
	 <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Tienda</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/Tienda">Inicio</a></li>
            <li><a href="../clientes/index.php">Clientes</a></li>
            <li><a href="#">Articulos</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
              <li><a href="lista.php"><i class="fa fa-shopping-cart"></i> Carrito</a></li>
               <?php
                    session_start();
                    echo "<p class='navbar-text'>";

                    if(isset($_SESSION['nick']))
                        echo 'Bienvenido '.$_SESSION['nick'];
                    else
                       echo "Bienvenido Anonimo";

                    echo "</p>";

                    if(isset($_SESSION['idUsuario']))
                        echo "<li><a href='../usuarios/cerrar.php'>Cerrar</a></li>";
                    else
                        echo "<li><a href='../usuarios/login.php'>Entrar</a></li>";
                ?>
            </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<div class="container">

    <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <form class="form">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4><span class="fa fa-search"></span> Detalle del Articulo</h4>
                        </div>
                        <div class="panel-body">
                           <p id="respuesta"></p>
                            <?php
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

                                $id = $_GET["id"];

                                $sql = "SELECT * FROM articulo WHERE idArticulo='".$id."';";

                                $result = $conn->query($sql);

                                if($result->num_rows > 0) {
                                    if($row = $result->fetch_assoc()) {
                                        echo "<input type='hidden' value='".$row["idArticulo"]."' name='id' id='id'>";
                                        echo "<div class='form-group'>
                                                <label>numeroSerie</label><div>".$row["numeroSerie"]."
                                            </div></div>";
                                        echo "<div class='form-group'>
                                                <label>Nombre</label><div>".$row["nombre"]."
                                            </div></div>";
                                        echo "<div class='form-group'>
                                                <label>precio</label><div>".$row["precio"]."
                                            </div></div>";
                                    }
                                }
                                else {
                                    echo "0 Resultados";
                                }

                                $conn->close();
                                echo "<input id='id' type='hidden' name='id' value='".$id."'>";
                            ?>
                            <!-- input escondido para el id -->


                            <div class="form-group">
                                <label>Cantidar:</label>
                                <input id="cantidad" class="form-control" name="cantidad" type="number" min="1" value="1">
                            </div>
                        </div>
                        <div class="panel-footer">
                            <button id="btnAgregar" class="btn btn-success" type="button"><span class="fa fa-plus-circle"></span> Agregar</button>
                            <a class="btn btn-default" href="../articulos/index.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Volver</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../../js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../js/bootstrap.js"></script>
    <script type="text/javascript">
        $('#btnAgregar').click(function () {
            $.ajax({
                url: 'agregar.php',
                type: 'POST',
                data: {
                    'id': $('#id').val(),
                    'cantidad': $('#cantidad').val()
                },
                success: function (data) {

                        $('#respuesta').html(data.message);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#respuesta').html(errorThrown);
                }
            });
        });
    </script>

</body>
</html>
