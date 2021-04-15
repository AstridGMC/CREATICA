<?php

session_start();
//$conexion = new mysqli("servidor","usuario","clave","bd")
$nombreServidor = "localhost";
$nombreUsuario = "labmia";
$passwordBaseDeDatos = "Astrid.19972020";
$nombreBaseDeDatos = "CREATICA_PROYECTO";

// Crear conexión con la base de datos.
$conexion = new mysqli($nombreServidor, $nombreUsuario, $passwordBaseDeDatos, $nombreBaseDeDatos);
$hoy = date("Y-m-d");
$ir_a = "../cursosEstudiante.php";
$sql = "INSERT INTO INSCRIPCION  (DPIEstudiante, idCurso, estadoCurso,  fechaInscripcion )
 VALUES ('" .  $_SESSION['DPI']  . "'," . $_POST['idCurso'] . ",'Sin finalizar', '" . $hoy . "')";
if (!$conexion->query($sql)) {
    $ir_a = "error.php";
    echo "Falló 1: (" . $conexion->errno . ") " . $conexion->error;
} else {
    $rs = mysqli_query($conexion, "SELECT MAX(idInscripcion)as id FROM INSCRIPCION");
    $id = $rs->fetch_array(MYSQLI_ASSOC);
    $sql2 = "INSERT INTO PAGOS VALUES (" . $id['id'] . ",'1', '" . $hoy . "')";
    if (!$conexion->query($sql2)) {
        $ir_a = "error.php";
        echo "Falló 2: (" . $conexion->errno . ") " . $conexion->error;
    }else{
        print '<script language="JavaScript">';
        print 'alert("comprado con exito");';
        print '</script>';
        header("location: " . $ir_a);
    }
    
}



