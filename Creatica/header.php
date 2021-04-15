<?php
session_start(); ?>

<link rel="stylesheet" type="text/css" href="./CSS/CSSHeader.css">
<div class="container1">
  <div class="item1">
    <h3 id="h3">Creatica </h3>
    <h1 id="h1">Sitio de Cursos en linea</h1>
  </div>
</div>

<nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
  <a class="navbar-brand" href="">CREATICA</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Ver Cursos <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <?php
        if (!isset($_SESSION['rango'])) {
          echo '<a href="RegistrarNuevoUsuario.php" class="nav-link" >Crear Cuenta <span class="sr-only">(current)</span></a>';
        } 
        ?>
      </li>
        <?php
        if (isset($_SESSION['rango'])) {
          if ($_SESSION['rango'] == "Estudiante") {
            echo '
            <li class="nav-item ">
              <a class="nav-link" href="cursosEstudiante.php">Mis Cursos <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="pantallaEstudiante.php">Mi Perfil <span class="sr-only">(current)</span></a>
            </li>
            ';
          }
        }
        ?>
      
        <?php
        if (isset($_SESSION['rango'])) {
           if ($_SESSION['rango'] == "Profesor") {
            echo '
            <li class="nav-item ">
              <a class="nav-link" href="pantallaProfesor.php">Mi Inicio <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="perfilP.php">Mis Perfil <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="verCursos.php">Mis Clases <span class="sr-only">(current)</span></a>
            </li>
            ';
          } 
        } else {
        }
        ?>
      
     
        <?php 
        if(isset($_SESSION['rango'])){
          if($_SESSION['rango']=="Administrador"){
            echo '
            <li class="nav-item ">
              <a class="nav-link" href="VerInscripciones.php">ver Inscripciones <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="nuevoCurso.php">Crear Nuevo Curso<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="verCursosAdmin.php">Administrar Cursos<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="RegistrarNuevoUsuario.php">Crear Usuario<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="verUsuarios.php">Ver Usuarios<span class="sr-only">(current)</span></a>
            </li>
            ';
          }
        }?>
      
    </ul>

    <?php
    if (!isset($_SESSION['rango'])) {
      echo '<a href="ElegirUsuario.php" class="btn btn-danger">Inicio Sesion</a>';
    } else if(isset($_SESSION['rango'])){
      echo '<a href="cerrarSesion.php" class="btn btn-danger">Cerrar Sesion</a>';
    }
    ?>
  </div>

</nav>