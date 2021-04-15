<?php
  session_start();

  if(isset($_POST['dpi']))
  {
    $conexion = new mysqli("localhost","labmia","Astrid.19972020","CREATICA_PROYECTO");
    $sql = "SELECT * FROM PROFESOR WHERE DPI = '".$_POST['dpi']."' LIMIT 1";
    $resultado = $conexion->query($sql);
    foreach($resultado as $fila) $usuario=$fila;
  }else{
    header("location: perfilP.php");
  }
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <title>Editar Perfil Profesor</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </head>
  <body style="background-color:#6CB0A5;">
  <?php include "header.php"; ?>
    <div class="container">
    <br></br>
      <h1>Actualizar Datos : <?php echo $usuario['nombres'] ?> <?php echo $usuario['apellidos'] ?> </h1>
      <br></br>
      <form action="actualizarProfesor.php" method="post">
        <input type="hidden" name="oldDPI" value="<?php echo $usuario['DPI'] ?>">
        <b> DPI (Solo 13 caracteres): </b>
        <input class="form-control" type="text" name="dpi" value="<?php echo $usuario['DPI'] ?>" required>
        <b> NOMBRES: </b>
        <input class="form-control" type="text" name="nombres" value="<?php echo $usuario['nombres'] ?>" required>
        <b> APELLIDOS: </b>
        <input class="form-control" type="text" name="apellidos" value="<?php echo $usuario['apellidos'] ?>" required>
        <b> CORREO: </b>
        <input class="form-control" type="email" name="correo" value="<?php echo $usuario['correo'] ?>" required>
        <b> PASSWORD: </b>
        <input class="form-control" type="text" name="clave" value="<?php echo $usuario['password'] ?>" required>
        <b> TELEFONO (solo numeros): </b>
        <input class="form-control" type="number" name="telefono" value="<?php echo $usuario['Telefono'] ?>" required>
        <br></br>
        <input type="submit" value="ACTUALIZAR DATOS" style="background-color:yellow;">
        <br></br>
        </form>
        <form action="perfilP.php" >
        <input type="submit" value="  Regresar  " class="btn btn-sm btn-warning">
        </form>
        <br></br>
    </div>
  </body>
</html>
