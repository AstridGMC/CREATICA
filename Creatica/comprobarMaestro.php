<?php
session_start();

// Obtengo los datos cargados en el formulario de login.
$email = $_POST['email'];
$password = $_POST['password'];

// Datos para conectar a la base de datos.
$nombreServidor = "localhost";
$nombreUsuario = "labmia";
$passwordBaseDeDatos = "Astrid.19972020";
$nombreBaseDeDatos = "CREATICA_PROYECTO";

// Crear conexión con la base de datos.
$conn = new mysqli($nombreServidor, $nombreUsuario, $passwordBaseDeDatos, $nombreBaseDeDatos);

// Validar la conexión de base de datos.
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Consulta segura para evitar inyecciones SQL.
$result = mysqli_query($conn, "SELECT * FROM PROFESOR WHERE correo = '$email' AND password= '$password'");


// Verificando si el usuario existe en la base de datos.
if ($result) {
  // Guardo en la sesión el email del usuario.
  $_SESSION['email'] = $email;
  $sql = "SELECT * FROM PROFESOR WHERE correo = '$email' AND password= '$password'";
  $resultado = $conn->query($sql);
  $usuario =  $resultado->fetch_array(MYSQLI_ASSOC);
  $_SESSION['DPI'] = $usuario['DPI'];
  
  $sql2 = "SELECT * FROM USUARIO JOIN RANGO  ON USUARIO.idRango= RANGO.idRango WHERE DPI = ".$usuario['DPI'];
  $resultado2 = $conn->query($sql);
  $usuario2 =  $resultado2->fetch_array(MYSQLI_ASSOC);
  $_SESSION['rango1'] = $usuario2['rango'];

  // Redirecciono al usuario a la página principal del sitio.
  header("HTTP/1.1 302 Moved Temporarily");
  header("Location: pantallaProfesor.php");
} else {
  echo 'El email o password es incorrecto, <a href="index.php"> vuelva a intenarlo </a>.<br/>'; //si no existe el usuario
}
