<?php
session_start();

//$conexion = new mysqli("servidor","usuario","clave","bd")
$conexion = new mysqli("localhost", "labmia", "Astrid.19972020", "CREATICA_PROYECTO");
$sql = "SELECT * FROM CURSO JOIN DETALLE_CURSO ON CURSO.idCurso= DETALLE_CURSO.idCurso WHERE CURSO.idCurso = " . $_POST['idCurso'];
if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
}
$resultado = mysqli_query($conexion, $sql);
$curso = $resultado->fetch_array(MYSQLI_ASSOC);
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
                <h3 class="card-title"> Desea Comprar Ahora ?</h3>
                <?php 
                        echo '
                        <form class="form-horizontal" action="./Estudiante/comprarCurso.php" method="post">
                            <input  name="idCurso"  style="display: none;" value="'.$_POST['idCurso'].'" >
                            <input  name="dpi"  style="display: none;" value="'.$_SESSION['DPI'].'" >
                            <button type="submit" class="btn btn-primary">COMPRAR CURSO</button>
                        </form>
                        ';
                ?>
            </div>
        </div>
        
    </div>
</body>

</html>