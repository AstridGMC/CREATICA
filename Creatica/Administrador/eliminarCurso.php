<?php
  if(isset($_POST['idCurso']))
  {
    $ir_a = "../verCursosAdmin.php";
    //$conexion = new mysqli("servidor","usuario","clave","bd")
    $conexion = new mysqli("localhost", "labmia", "Astrid.19972020", "CREATICA_PROYECTO");
    $conexion = new mysqli("localhost", "labmia", "Astrid.19972020", "CREATICA_PROYECTO");
    $sql = "DELETE FROM CURSO WHERE idCurso='".$_POST['idCurso']."'";

    if(!$conexion->query($sql)) $ir_a = "../error.php";

    header("location: ".$ir_a);
  }
?>
