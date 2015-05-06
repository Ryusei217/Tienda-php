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
    <link href="../../css/font-awesome.min.css" rel="stylesheet">
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
                    <li class="active"><a href="/Tienda">Inicio</a>
                    </li>
                    <li><a href="#">Clientes</a>
                    </li>
                    <li><a href="../articulos/index.php">Articulos</a>
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
                            echo "<li><a href='cerrar.php'>Cerrar</a></li>";
                        else
                            echo "<li><a href='login.php'>Entrar</a></li>";
                    ?>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>

    <div class="container">

        <div class="row">
           <form class="form" method="POST" action="guardar.php">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h5><i class="fa fa-key"></i> Registrarse</h4>
               </div>
               <div class="panel-body">

                        <div class="form-group">
                            <label>Nombre de Usuario</label>
                            <input type="text" required name="nick" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Correo Electronico</label>
                            <input type="email" required name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" required name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Confirmar Contraseña</label>
                            <input type="password" required name="password1" class="form-control">
                        </div>

               </div>
               <div class="panel-footer">
                   <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Enviar</button>
                   <a class="btn btn-default" href="../../index.html"><i class="fa fa-arrow-circle-left"></i> Regresar</a>
               </div>
           </div>
           </form>
        </div>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../../js/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../../js/bootstrap.js"></script>
</body>

</html>
