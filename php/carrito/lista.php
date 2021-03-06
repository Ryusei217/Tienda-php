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
              <li><a href="#"><i class="fa fa-shopping-cart"></i> Carrito</a></li>
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
                <a class="btn btn-primary" href="../articulos/index.php"><span class="glyphicon glyphicon-plus"></span> Lista de Articulos</a>
                <br />
                <br />
                <div id="alerta" class="alert alert-danger" role="alert">
                    Error
                </div>
                 <form id="formulario" method="post" action="pedido.php">
                   <h2>Datos del cliente</h2>
                   <input type="hidden" id="idCliente" name="idCliente">
                    <div class="form-group">
                     <label>DPI</label>
                     <input id="dpi" type="text" name="dpi" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <input id="nombre" type="text" name="nombre" class="form-control" required readonly>
                    </div>
                    <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i> Enviar</button>
                    <button id="btnBuscar" class="btn btn-default" type="button"><i class="fa fa-search"></i> Buscar</button>
                 </form>
                 <br/>
                  <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h5><i class="fa fa-shopping-cart"></i> Carrito</h5>
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

                                        if(!isset($_SESSION["carrito"]))
                                            die('No hay elementos en el carrito');

                                        if(count($_SESSION["carrito"]) > 0) {
                                            $total = 0;
                                            while($row = next($_SESSION["carrito"])) {
                                                echo "<tr>";
                                                echo "<td>".$row["articulo"]["numeroSerie"]."</td>";
                                                echo "<td>".$row["articulo"]["nombre"]."</td>";
                                                echo "<td>".$row["articulo"]["precio"]."</td>";
                                                echo "<td>".$row["cantidad"]."</td>";
                                                $precio = $row["articulo"]["precio"] * $row["cantidad"];
                                                echo "<td>".$precio."</td></tr>";
                                                $total += $precio;
                                            }
                                            echo "<tr class='success'><td></td><td><strong>Total</strong></td><td></td><td></td><td><strong>".$total."</strong></td></tr>";
                                        }
                                        else {
                                            echo "0 Resultados";
                                        }
                                    ?>
                                </tbody>

                            </table>
                            <a href="limpiar.php" class="btn btn-danger"><i class="fa fa-times-circle"></i> Vaciar Carrito</a>
                        </div>
                       </div>
                      </div>
    </div>
    </div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../../js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../js/bootstrap.js"></script>
    <script type="text/javascript">
        //Prevent key enter event on form
        function stopRKey(evt) {
            var evt = (evt) ? evt : ((event) ? event : null);
            var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
            if ((evt.keyCode == 13) && (node.type == "text")) { return false; }
        }

        //Register stopRkey
        document.onkeypress = stopRKey;

        $( document ).ready(function() {
            $('#alerta').hide();
        });

        $('#btnBuscar').click(function () {
            buscarCliente();
        });

        $('#dpi').keypress(function(e) {
            if(e.which == 13)
                buscarCliente();
        });

        function buscarCliente(){
            $.ajax({
                url: '../clientes/buscar.php',
                type: 'POST',
                data: {
                    'dpi': $('#dpi').val()
                },
                success: function (data) {
                    if(data.success === true){
                        $('#nombre').val(data.cliente.nombre);
                        $('#idCliente').val(data.cliente.idCliente);
                        $('#alerta').hide();
                    }
                    else {
                        $('#alerta').show();
                        $('#nombre').val("");
                        $('#idCliente').val("");
                        $('#alerta').html("<strong><i class='fa fa-exclamation-circle'></i> Error:</strong> " + data.message);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#respuesta').html(errorThrown);
                }
            });
        };
    </script>
</body>
</html>
