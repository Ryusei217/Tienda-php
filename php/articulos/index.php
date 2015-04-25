<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Articulo</title>

	<link href="../../css/bootstrap.min.css" rel="stylesheet">
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
                                        ID
                                    </th>

                                    <th>
                                        numeroSerie
                                    </th>
                                        
                                    <th>
                                        Nombre
                                    </th>

                                    <th>
                                        Precio
                                    </th>
                                </thead>
                                <tbody>
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

                                        $sql = "SELECT * FROM Articulo";

                                        $result = $conn->query($sql);

                                        if($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $row["idArticulo"] . "</td>";
                                                echo "<td>" . $row["numeroSerie"] . "</td>";
                                                echo "<td>" . $row["nombre"] . "</td>";
                                                echo "<td>" . $row["precio"] . "</td>";
                                                echo "<td><a class='btn btn-xs btn-danger' href='eliminar.php?id=".$row["idArticulo"]."'>Borrar</a>";
                                                echo "</th>";
                                            }
                                        }
                                        else {
                                            echo "0 Resultados";
                                        }

                                        $conn->close();
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
