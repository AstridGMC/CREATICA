<?php
session_start();

//$conexion = new mysqli("servidor","usuario","clave","bd")
$conexion = new mysqli("localhost", "labmia", "Astrid.19972020", "CREATICA_PROYECTO");
$sql = "SELECT * FROM INSCRIPCION JOIN PAGOS ON INSCRIPCION.idInscripcion = PAGOS.idInscripcion 
 JOIN REGISTRO_NOTA ON INSCRIPCION.idInscripcion = REGISTRO_NOTA.idInscripcion 
 JOIN CURSO ON INSCRIPCION.idCurso = CURSO.idCurso
 WHERE INSCRIPCION.DPIEstudiante= '" . $_SESSION['DPI'] . "' AND PAGOS.estadoPago = 1 ";

 
$resultado = $conexion->query($sql);

$sql2 = "SELECT * FROM INSCRIPCION JOIN PAGOS ON INSCRIPCION.idInscripcion = PAGOS.idInscripcion
 JOIN CURSO ON INSCRIPCION.idCurso = CURSO.idCurso
 WHERE INSCRIPCION.DPIEstudiante= '" . $_SESSION['DPI'] . "' AND PAGOS.estadoPago = 1 ";
$resultado2 = $conexion->query($sql2);




?>

<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <title>Mis Cursos</title>
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
        <div>
            <h1>CURSOS ASIGNADOS</h1>
            <br>
            <br>
            <?php foreach ($resultado2 as $fila) : ?>
                <div class="card">
                    <h5 class="card-header"><?php echo $fila['Nombre'] ?></h5>
                    <div class="card-header"> <a>link</a> </div>
                    <div class="card-body">
                        <h5 class="card-title">fechaPago: <?php echo $fila['fechaPago'] ?></h5>
                        <p class="card-text"><?php echo $fila['descripcion'] ?></p>
                        <h5 class="card-title">estado: <?php echo "En curso" ?></h5>
                    </div>
                </div>
                <br>
                <br>
            <?php endforeach; ?>
        </div>

        <div>
            <h1>CURSOS CURSADOS</h1>
            <br>
            <br>
            <?php foreach ($resultado as $fila) : ?>
                <div class="card">
                    <h5 class="card-header"><?php echo $fila['Nombre'] ?></h5>
                    <div class="card-header"> <?php echo $fila['nota'] ?> </div>
                    <div class="card-body">
                        <h5 class="card-title">fechaPago: <?php echo $fila['fechaPago'] ?></h5>
                        <h5 class="card-title">duracion: <?php echo $fila['duracion']." dias" ?></h5>
                        <p class="card-text"><?php echo $fila['descripcion'] ?></p>
                        <h5 class="card-title">estado: <?php echo $fila['estadoCurso']  ?></h5>
                    </div>
                </div>
                <br>
                <br>
            <?php endforeach; ?>
        </div>
    </div>

</body>