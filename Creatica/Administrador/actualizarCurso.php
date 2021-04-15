<?php

//$conexion = new mysqli("servidor","usuario","clave","bd")
$conexion = new mysqli("localhost", "labmia", "Astrid.19972020", "CREATICA_PROYECTO");
if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
}
echo $_POST['idCurso'];
  if(isset($_POST['idCurso']))
  {
    $ir_a = "../verCursosAdmin.php"; 
    $sql= "CALL editarCurso('".$_POST['nombreCurso']."' , ".$_POST['idArea'].",". $_POST['duracion'].", 
    ". $_POST['monto'].", '".$_POST['decripcion']."',".$_POST['idCurso'].",'". $_POST['fechaInicio']."','".$_POST['fechaFin']."','". $_POST['CUI_PROFESOR']."')";
    echo $sql;
    if (!$conexion->query($sql)) {
        $ir_a = "../error.php";
        echo "Falló CALL: (" . $conexion->errno . ") " . $conexion->error;
    }

   header("location: ".$ir_a);
   
    /*
    $sql = "UPDATE CURSOS SET Nombre =". $_POST['nombreCurso'].", idArea=".$_POST['idArea'].", duracion=
    ".$_POST['duracion'].", monto=".$_POST['monto'].", descripcion=".$_POST['decripcion']."
    WHERE idCurso= ".$_POST['idCurso'];
    if(!$conexion->query($sql)) 

    $sql = "UPDATE DETALLE_CURSO SET  fechaInicio  = ".$_POST['fechaInicio']." , fechaFinal =".$_POST['fechaFin']." ,
    DPIProfesor =".$_POST['CUI_PROFESOR']." WHERE idCurso =".$_POST['idCurso'];
    */

  }
?>
