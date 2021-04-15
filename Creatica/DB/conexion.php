<?php
$nombreServidor = "localhost";
$nombreUsuario = "id15296995_labmia";
$passwordBaseDeDatos = "31649220";
$nombreBaseDeDatos = "id15296995_creatica_proyecto";
//$conexion = new mysqli("localhost", "id15296995_labmia", "Astrid.19972020", "id15296995_creatica_proyecto");
// Crear conexión con la base de datos.
global $conexion ;
$conn  = new mysqli($nombreServidor, $nombreUsuario, $passwordBaseDeDatos, $nombreBaseDeDatos);
 $conexion  = new mysqli($nombreServidor, $nombreUsuario, $passwordBaseDeDatos, $nombreBaseDeDatos);

 $conn = new mysqli("localhost", "id15296995_labmia", "Astrid.19972020", "id15296995_creatica_proyecto");
?>