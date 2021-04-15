<?php
  session_start();
  if(isset($_POST['nota'])){
    $ir_a = "cursosP.php";
    $conexion = new mysqli("localhost","labmia","Astrid.19972020","CREATICA_PROYECTO");
    $sql = "UPDATE INSCRIPCION SET nota='".$_POST['nota']."' WHERE idInscripcion='".$_POST['idIns']."'";

    if(!$conexion->query($sql)) {
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
            <h4 class="alert-heading">Error en Actualizacion </h4>
            <p> No se actualizo la nota por favor verificar los datos </p>
            <hr>
            <form class="form-horizontal" action="pantallaProfesor.php" >
              <button type="submit" class="btn btn-danger btn-lg btn-block" id="boton">Regresar</button>
            </form>
        </div> 
      </body>'; //si hay error en la actualizacion  
    }
    else{
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
            <h4 class="alert-heading">Actualizado </h4>
            <hr>
            <form class="form-horizontal" action="verCursoP.php" >
              <button type="submit" class="btn btn-danger btn-lg btn-block" id="boton">Regresar</button>
            </form>
        </div> 
      </body>'; //si hay error en la actualizacion  
    }
  }
?>