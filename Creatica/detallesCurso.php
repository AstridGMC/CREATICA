<?php
session_start();

//$conexion = new mysqli("servidor","usuario","clave","bd")
include "./DB/conexion.php";
$sql = "SELECT * FROM CURSO JOIN DETALLE_CURSO ON CURSO.idCurso= DETALLE_CURSO.idCurso WHERE CURSO.idCurso = " . $_POST['idCurso'];
if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
}
$resultado = mysqli_query($conexion, $sql);
$curso = $resultado->fetch_array(MYSQLI_ASSOC);
$sql2 = "SELECT * FROM PROFESOR WHERE DPI = " . $curso['DPIProfesor'];
$resultado2 = mysqli_query($conexion, $sql2);
$profesor = $resultado2->fetch_array(MYSQLI_ASSOC);
?>



<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <title>Detalles Curso</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./CSS/estiloDetalleCurso.css">
</head>

<?php include 'header.php'; ?>

<body>
    <div class="container">
        <h1 class= "tituloP"><?php echo $curso['Nombre'] ?></h1>
        <br>
        <br>
        <div class="card" id="Tcurso">

            <h3 class="card-header"> Inicia del : <b><?php echo date("d/m/Y", strtotime($curso['fechaInicio'] ))?></b>   Al: <b><?php echo date("d/m/Y", strtotime($curso['fechaFinal'] )) ?></b></h3>
            <div class="card-body">
                <h3 class="card-title">Duracion : <?php echo $curso['duracion']?> Dias </h3>
                <p class="card-text"><?php echo $curso['descripcion'] ?></p>
                <?php 
                    if ($_SESSION['rango'] == "Estudiante") {
                        echo '
                        <form class="form-horizontal" action="inscribirCurso.php" method="post">
                            <input  name="idCurso"  style="display: none;" value="'.$curso['idCurso'].'" >
                            <input  name="dpi"  style="display: none;" value="'.$_SESSION['DPI'].'" >
                            <button type="submit" class="btn btn-primary" style="self-align: center">INSCRIBIRME</button>
                        </form>
                        ';
                    }
                ?>
            </div>
        </div>
        <br>
        <br>
        <h1>Profesor</h1>
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <img src="./CSS/Profesor.jpg" class="card-img" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><b>Nombre: </b> <?php echo $profesor['nombres'].' '.$profesor['apellidos'] ?> </h5>
                        <p class="card-text" style="text-align: justify; font-size:1.3rem; "><?php echo $profesor['descripcion']?></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>