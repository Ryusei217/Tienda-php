<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Tienda de Articulos</title>

    <!-- Bootstrap -->
    <link href="../../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/main.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
            <li><a href="php/clientes/index.php">Clientes</a></li>
            <li><a href="php/articulos/index.php">Articulos</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
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
                <form>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4><span class="glyphicon glyphicon-plus"></span> Nuevo Cliente</h4>
                        </div>
                        <div class="panel-body">
                           <p id="respuesta"></p>
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

                                $id = $_GET["id"];

                                $sql = "SELECT * FROM cliente WHERE idCliente='".$id."';";

                                $result = $conn->query($sql);

                                if($result->num_rows > 0) {
                                    if($row = $result->fetch_assoc()) {
                                        echo "<input type='hidden' value='".$row["idCliente"]."' name='id' id='id'>";
                                        echo "<div class='form-group'>
                                                <label>DPI</label><div>".$row["dpi"]."
                                            </div></div>";
                                        echo "<div class='form-group'>
                                                <label>Nombre</label><div>".$row["nombre"]."
                                            </div></div>";
                                    }
                                }
                                else {
                                    echo "0 Resultados";
                                }

                                $conn->close();
                            ?>
                        </div>
                        <div class="panel-footer">
                            <button id="btnEliminar" class="btn btn-danger" type="button"><span class="glyphicon glyphicon-remove-sign"></span> Eliminar</button>
                            <a class="btn btn-default" href="index.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Volver</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../../js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../js/bootstrap.js"></script>
    <script type="text/javascript">
        $('#btnEliminar').click(function () {
            $.ajax({
                url: 'borrar.php',
                type: 'POST',
                data: {
                    'id': $('#id').val()
                },
                success: function (data) {
                    $('#respuesta').html(data);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#respuesta').html(errorThrown);
                }
            });
        });
    </script>
  </body>
</html>
