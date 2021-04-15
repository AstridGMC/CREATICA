<?php
  session_start();
  
  // Controlo si el usuario ya está logueado en el sistema.
  if(isset($_SESSION['DPI'])){

	  $conexion = new mysqli("localhost", "labmia", "Astrid.19972020", "CREATICA_PROYECTO");
    $sql =  "SELECT * FROM ESTUDIANTE WHERE DPI = '".$_SESSION['DPI']."'"; 
    $resultado = $conexion->query($sql);
 }else{
    // Si no está logueado lo redireccion a la página de inicio.
    header("Location: index.php"); 
  }
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <title>PORTAL ESTUDIANTE </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </head>
  <body>
  <?php include "header.php"; ?>
    <div class="container">
      <h2 class="text-center"> Bienvenido <?php echo $_SESSION['nombre'];?></h2>
	<br></br>
      <table class="table table-striped table-sm table-primary">
        <tr>
          <th>DPI: </th>
          <th>Nombre: </th>
          <th>Apellido: </th>
          <th>Correo: </th>
        </tr>
        <?php foreach ($resultado as $fila): ?>
          <tr>
            <td><?php echo $fila['DPI'] ?></td>
            <td><?php echo $fila['nombres'] ?></td>
            <td><?php echo $fila['apellidos'] ?></td>
            <td><?php echo $fila['correo'] ?></td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </body>
</html>
