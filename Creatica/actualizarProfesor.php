<?php
  if(isset($_POST['dpi']))
  {
    $ir_a = "perfilP.php";
    $conexion = new mysqli("localhost","labmia","Astrid.19972020","CREATICA_PROYECTO");
    $sql = "UPDATE PROFESOR SET DPI='".$_POST['dpi']."', nombres='".$_POST['nombres']."',
    apellidos='".$_POST['apellidos']."', correo='".$_POST['correo']."', password='".$_POST['clave']."'
    , Telefono='".$_POST['telefono']."' WHERE DPI='".$_POST['oldDPI']."'";

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
            <p> No se actualizo el usuario, por favor verificar los datos </p>
            <hr>
            <form class="form-horizontal" action="perfilP.php" >
              <button type="submit" class="btn btn-danger btn-lg btn-block" id="boton">Regresar</button>
            </form>
        </div> 
      </body>'; //si hay error en la actualizacion  
    }
    else{
      header("location: ".$ir_a);
    }
  }
?>
