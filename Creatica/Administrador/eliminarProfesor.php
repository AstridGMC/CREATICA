<?php
  if(isset($_POST['dpi']))
  {
    $ir_a = "../verUsuarios.php";
    //$conexion = new mysqli("servidor","usuario","clave","bd")
    $conexion = new mysqli("localhost", "labmia", "Astrid.19972020", "CREATICA_PROYECTO");
    $sql = "DELETE FROM PROFESOR WHERE idCurso='".$_POST['dpi']."'";

    if(!$conexion->query($sql)) $ir_a = "../error.php";

    header("location: ".$ir_a);
  }
?>
