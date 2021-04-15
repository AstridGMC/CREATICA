<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <title>Creatica-Nuevo Usuario</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="./CSS/estiloElegirUsuario.css" rel="stylesheet" type="text/css">
</head>

<body style="background: url('./CSS/fondo4.jpg');">
    <?php include 'header.php'; ?>
    <H1 style=" text-align:center; padding-top:70px;">INICIAR SESION COMO: </H1>
    <div class="cuadro">

        <div>
            <form class="form-horizontal" action="login.php" method="post">
                <input name="tupoUser"  value="Profesor" style="display: none;">
                <button type="submit" class="btn btn-lg btn-block btn-warning" id="boton">PROFESOR</button>
            </form>
            <form class="form-horizontal" action="login.php" method="post">
                <input name="tupoUser"  value="Estudiante" style="display: none;">
                <button type="submit" class="btn btn-info btn-lg btn-block" id="boton">ESTUDIANTE</button>
            </form>
            <form class="form-horizontal" action="login.php" method="post">
                <input name="tupoUser"  value="Administrador" style="display: none;">
                <button type="submit" class="btn btn-danger btn-lg btn-block" id="boton">ADMINISTRADOR</button>
            </form>
        </div>

    </div>
</body>