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
    //realizamos busqueda de cursos a cargo
    $resultado = mysqli_query($conn, "
    SELECT  AREA.Nombre , CURSO.idCurso, CURSO.Nombre ,CURSO.duracion , DETALLE_CURSO.fechaInicio ,
    DETALLE_CURSO.fechaFinal , DETALLE_CURSO.DPIProfesor
    FROM AREA
    INNER JOIN CURSO ON AREA.idArea = CURSO.idArea 
    INNER JOIN DETALLE_CURSO ON CURSO.idCurso = DETALLE_CURSO.idCurso
    WHERE DETALLE_CURSO.DPIProfesor = '".$valorDPI."' ");

    if(mysqli_num_rows($resultado)>0){
    } else{
        // no tiene cusos asignados
        echo '
        <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </head>
        <body>
          <div class="alert alert-success" role="alert"  style="margin-left:300px; margin-right:300px;">
              <h4 class="alert-heading">Error  </h4>
              <p> No se encontraron cursos del catedratico </p>
              <hr>
              <form class="form-horizontal" action="perfilP.php" >
                <button type="submit" class="btn btn-danger btn-lg btn-block" id="boton">Regresar</button>
              </form>
          </div> 
        </body>'; //si hay error en busqueda de cursos 
    }
   }else{
    // Si no está logueado cerrar sesion por precaucion
    header("Location: cerrarSesion.php"); 
  }
?>



<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <title>CURSOS PROFESOR </title>
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
        <h1 class="text-center"> CURSOS DE : </h1>
        <h2 class="text-center"> <?php echo $_SESSION['nombre'];?></h2>
       	<br></br>
   	    <br></br>
        <?php foreach ($resultado as $fila) : ?>
            <table class="table table-striped table-sm table-primary">
            <tr >
                <th> AREA : </th>
                <th> CODIGO CURSO : </th>
                <th> CURSO : </th>
                <th> DURACION : </th>
                <th> FECHA INICIO : </th>
                <th> FECHA FIN : </th>
                <th> PROFESOR : </th>
                <th> VER : </th>
            </tr>
            <tr>
                <td><?php echo $fila['Nombre'] ?></td>
                <td><?php echo $fila['idCurso'] ?></td>
                <td><?php echo $fila['Nombre'] ?></td>
                <td><?php echo $fila['duracion'] ?></td>
                <td><?php echo $fila['fechaInicio'] ?></td>
                <td><?php echo $fila['fechaFinal'] ?></td>
                <td><?php echo $fila['DPIProfesor'] ?></td>
                <td> <form action="verCursoP.php" method="post">
                    <input type="hidden" name="idC" value="<?php echo $fila['idCurso'] ?>">
                    <input type="submit" value="  VER CLASE " class="btn btn-sm btn-warning">
                </form></td>
          </tr>
        </table>
        <br></br>
        <?php endforeach; ?>
        <br></br>
        <form action="pantallaProfesor.php">
            <input type="submit" value="  Regresar a pantalla principal de profesor " class="btn btn-sm btn-warning">
        </form>        
        <br></br>
    </div>
  </body>
</html>
