<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Nuevo Articulo</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Bootstrap -->
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
                    <li class="active"><a href="/Tienda">Inicio</a>
                    </li>
                    <li><a href="../clientes/index.php">Clientes</a>
                    </li>
                    <li><a href="#">Articulos</a>
                    </li>
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
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <form>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4><span class="glyphicon glyphicon-plus"></span> Nuevo Articulo</h4>
                        </div>
                        <div class="panel-body">
                            <p id="respuesta"></p>
                            <div class="form-group">
                                <label>Numero Serie</label>
                                <input class="form-control" required type="text" id="numeroSerie" name="numeroSerie">
                            </div>
                            <div class="form-group">
                                <label>Nombre</label>
                                <input class="form-control" required type="text" id="nombre" name="nombre">
                            </div>
                            <div class="form-group">
                                <label>Precio</label>
                                <input class="form-control" required type="text" id="precio" name="precio">
                            </div>
                        </div>
                        <div class="panel-footer">
                            <button id="btnGuardar" class="btn btn-primary" type="button"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                            <a class="btn btn-default" href="index.php"><span class="glyphicon glyphicon-circle-arrow-left"></span> Volver</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../../js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../js/bootstrap.js"></script>

    <script type="text/javascript">
        $('#btnGuardar').click(function () {
            $.ajax({
                url: 'guardar.php',
                type: 'POST',
                data: {
                    'numeroSerie': $('#numeroSerie').val(),
                    'nombre': $('#nombre').val(),
                    'precio': $('#precio').val()
                },
                success: function (data) {
                    $('#numeroSerie').val('');
                    $('#nombre').val('');
                    $('#precio').val('');
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
