<?php

//$conexion = new mysqli("servidor","usuario","clave","bd")
$conexion = new mysqli("localhost", "labmia", "Astrid.19972020", "CREATICA_PROYECTO");
if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
}
    $ir_a = "../verCursosAdmin.php"; 

    $sql= "INSERT INTO CURSO (Nombre, idArea, duracion, monto, descripcion) VALUES ('".$_POST['nombreCurso']."' , ".$_POST['idArea'].",". $_POST['duracion'].", 
    ". $_POST['monto'].", '".$_POST['decripcion']."')";

    if (!$conexion->query($sql)) {
      $ir_a = "../error.php";
      echo "Falló 2: (" . $conexion->errno . ") " . $conexion->error;
  }
   
    $rs = mysqli_query($conexion, "SELECT MAX(idCurso)as id FROM CURSO");
    $id = $rs->fetch_array(MYSQLI_ASSOC);

    $sql2= "INSERT INTO DETALLE_CURSO VALUES (".$id['id'].",'". $_POST['fechaInicio']."','".$_POST['fechaFin']."','". $_POST['CUI_PROFESOR']."')";
    
    if (!$conexion->query($sql2)) {
        $ir_a = "../error.php";
        echo "Falló 1: (" . $conexion->errno . ") " . $conexion->error;
    }

    header("location: ".$ir_a);
    
?>