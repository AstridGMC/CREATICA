<?php
  session_start();
  
  // Controlo si el usuario ya está logueado en el sistema.
  if(isset($_SESSION['email'])){
    // Le doy la bienvenida al usuario.
    echo 'Bienvenido <strong>' . $_SESSION['email'] . '</strong>, <a href="cerrarSesion.php">Cerrar Sesión</a>';
  }else{
    // Si no está logueado lo redireccion a la página de inicio.
    header("HTTP/1.1 302 Moved Temporarily"); 
    header("Location: login.php"); 
  }
?>
