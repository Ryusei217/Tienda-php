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
            <li><a href="../articulos/index.php">Articulos</a></li>
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
	<div class="col-md-12">
                <a class="btn btn-primary" href="nuevo.php"><span class="glyphicon glyphicon-plus"></span> Nuevo Articulo</a>
                <br />
                <br />
                  <div class="panel panel-primary">
                        <div class="panel-heading">
                            Clientes
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                   <th>
                                       No. Serie
                                   </th>
                                    <th>
                                        Articulo
                                    </th>
                                    <th>
                                        Precio
                                    </th>
                                    <th>
                                        Cantidad
                                    </th>
                                    <th>
                                        Total
                                    </th>
                                </thead>
                                <tbody>
                                    <?php
                                        if (!isset($_SESSION['idUsuario']))
                                            die('No ha iniciado sesion.');

                                        if(count($_SESSION["carrito"]) > 0) {
                                            while($row = next($_SESSION["carrito"])) {
                                                echo "<tr>";
                                                echo "<td>".$row["articulo"]["numeroSerie"]."</td>";
                                                echo "<td>".$row["articulo"]["nombre"]."</td>";
                                                echo "<td>".$row["articulo"]["precio"]."</td>";
                                                echo "<td>".$row["cantidad"]."</td>";
                                                $precio = $row["articulo"]["precio"] * $row["cantidad"];
                                                echo "<td>".$precio."</td>";
                                            }
                                        }
                                        else {
                                            echo "0 Resultados";
                                        }
                                    ?>
                                </tbody>

                            </table>

                        </div>
                       </div>
                      </div>
    </div>
    </div>

</body>
</html>
