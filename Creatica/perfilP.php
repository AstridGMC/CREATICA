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

  // Verificando si el usuario existe en la base de datos.
  if(mysqli_num_rows($result )>0){
    $usuario =  $result->fetch_array(MYSQLI_ASSOC);
   }else{
    // Si no está logueado cerrar sesion por precaucion
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
      <h1 class="text-center"> PERFIL DE : </h1>
      <h2 class="text-center"> <?php echo $_SESSION['nombre'];?></h2>
    	<br></br>
      <table class="table table-striped table-sm table-primary">
        <tr >
          <th> DPI: </th>
          <th>NOMBRE: </th>
          <th>APELLIDO: </th>
          <th>CORREO: </th>
          <th>TELEFONO: </th>
        </tr>
          <tr>
            <td><?php echo $usuario['DPI'] ?></td>
            <td><?php echo $usuario['nombres'] ?></td>
            <td><?php echo $usuario['apellidos'] ?></td>
            <td><?php echo $usuario['correo'] ?></td>
            <td><?php echo $usuario['Telefono'] ?></td>
          </tr>
        </table>
        <br></br>
        <form action="editarPerfilProf.php" method="post">
            <input type="hidden" name="dpi" value="<?php echo $usuario['DPI'] ?>">
            <input type="submit" value="  Editar Perfil " class="btn btn-sm btn-warning">
        </form>
        <br></br>
        <form action="eliminarProfesor.php" method="post">
            <input type="hidden" name="dpi" value="<?php echo $usuario['DPI'] ?>">
            <input type="submit" value="  Eliminar Cuenta " class="btn btn-sm btn-warning">
        </form>
        <br></br>
        <form action="pantallaProfesor.php" >
        <input type="submit" value="  Regresar a pantalla principal de profesor  " class="btn btn-sm btn-warning">
      </form>
      <br></br>
    </div>
  </body>
</html>
