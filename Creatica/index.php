<?php
session_start();

//$conexion = new mysqli("servidor","usuario","clave","bd")
//$conexion = new mysqli("servidor","usuario","clave","bd")
$nombreServidor = "localhost";
$nombreUsuario = "labmia";
$passwordBaseDeDatos = "Astrid.19972020";
$nombreBaseDeDatos = "CREATICA_PROYECTO";

// Crear conexión con la base de datos.
$conexion = new mysqli($nombreServidor, $nombreUsuario, $passwordBaseDeDatos, $nombreBaseDeDatos);
$sql = "SELECT * FROM CURSO ";
$sql .= " ORDER BY nombre";
$resultado = $conexion->query($sql);
$cont = 1;
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <title>Creatica</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<?php include 'header.php'; ?>
<body>
    
    <div class="container">
        <h1>CURSOS DISPONIBLES EN CREATICA</h1>
    <br>
    <br>
        <?php foreach ($resultado as $fila) : ?>
            <div class="card">
                <h5 class="card-header"><?php echo $fila['Nombre'] ?></h5>
                <div class="card-body">
                    <h5 class="card-title">Duracion : <?php echo $fila['duracion'].' dias' ?></h5>
                    <p class="card-text"><?php echo $fila['descripcion'] ?></p>
                    <form class="form-horizontal" action="detallesCurso.php" method="post">
                        <input  name="idCurso"  style="display: none;" value= <?php echo  $fila['idCurso']?> >
                        <button type="submit" class="btn btn-primary">Ver Detalles</button>
                    </form>
                </div>
            </div>
            <br>
            <br>
        <?php endforeach; ?>
    </div>
</body>