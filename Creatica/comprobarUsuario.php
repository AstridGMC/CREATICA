<?php
  session_start();
  
  // Obtengo los datos cargados en el formulario de login.
  $email = $_POST['email'];
  $password = $_POST['password'];
  $rango= $_POST['tipoUsuario'];
  echo $rango;
  // Datos para conectar a la base de datos.
  $nombreServidor = "localhost";
  $nombreUsuario = "labmia";
  $passwordBaseDeDatos = "Astrid.19972020";
  $nombreBaseDeDatos = "CREATICA_PROYECTO";
 
  // Crear conexión con la base de datos.
  $conn = new mysqli($nombreServidor, $nombreUsuario, $passwordBaseDeDatos, $nombreBaseDeDatos);
  
  // Validar la conexión de base de datos.
  if ($conn ->connect_error) {
    die("Connection failed: " . $conn ->connect_error);
  }
  
  // Consulta segura para evitar inyecciones SQL.
  if($rango == "Estudiante"){
    $result = mysqli_query($conn, "SELECT * FROM ESTUDIANTE WHERE correo = '$email' AND password= '$password'");
  }else if($rango == "Profesor"){
    $result = mysqli_query($conn, "SELECT * FROM PROFESOR WHERE correo = '$email' AND password= '$password'");
  }else{
    $result = mysqli_query($conn, "SELECT * FROM ADMINISTRADOR WHERE correo = '$email' AND password= '$password'");
  }

  

  
  // Verificando si el usuario existe en la base de datos.
  if(mysqli_num_rows($result )>0){
    $usuario =  $result->fetch_array(MYSQLI_ASSOC);
    $_SESSION['DPI'] = $usuario['DPI'];
    $_SESSION['rango'] = $rango;
    $_SESSION['nombre'] = $usuario['nombres']." ".$usuario['apellidos'];
	// Guardo en la sesión el cui del usuario.
  
  echo $_SESSION['DPI'];
	// Redirecciono al usuario a la página principal del sitio.
    
      if($rango == "Estudiante"){
        header("Location: pantallaEstudiante.php"); 
      }else if($rango == "Profesor"){
        header("Location: pantallaProfesor.php"); 
      }else{
        header("Location: pantallaAdmin.php"); 
      }
  }else{
    
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
          <h4 class="alert-heading">Correo o Contraseña incorrecto</h4>
          <p> no se encuentra registrado como '.$rango.'</p>
          <hr>
          <form class="form-horizontal" action="login.php" method="post">
            <input name="tupoUser"  value="'.$rango.'" style="display: none;">
            <button type="submit" class="btn btn-danger btn-lg btn-block" id="boton">regresar</button>
          </form>
      </div> 
    </body>'; //si no existe el usuario
  }
