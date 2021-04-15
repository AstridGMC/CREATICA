<?php
  session_start();
  
  // Datos para conectar a la base de datos.
  $nombreServidor = "localhost";
  $nombreUsuario = "labmia";
  $passwordBaseDeDatos = "Astrid.19972020";
  $nombreBaseDeDatos = "CREATICA_PROYECTO";

  // Crear conexión con la base de datos.
  $conn = new mysqli($nombreServidor, $nombreUsuario, $passwordBaseDeDatos, $nombreBaseDeDatos);
  
  // Validar la conexión de base de datos.
  if ($conn ->connect_error) {
    die("Connection failed: ".$conn->connect_error);
  }


  $valorDPI = $_SESSION['DPI'];
  $result = mysqli_query($conn, "SELECT * FROM PROFESOR WHERE DPI = '".$valorDPI."' ");

  if(mysqli_num_rows($result )>0){
    $usuario =  $result->fetch_array(MYSQLI_ASSOC);
   }else{   
    header("Location: cerrarSesion.php"); 
  }
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <title>PANTALLA PROFESOR </title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
      .container{margin-top:100px}
    </style>
  </head>
  <body style="background-color:#6CB0A5;">
  <?php include "header.php"; ?>
    <div class="container">
      <h1 class="text-center">BIENVENID@: <?php echo $_SESSION['nombre'];?></h1>
	<br></br>
      <ul id="menu">
      <li><a href="perfilP.php">PERFIL</a></li>
      <li><a href="cursosP.php">CURSOS A CARGO</a></li>
      </ul>
    </div>
  </body>
</html>
