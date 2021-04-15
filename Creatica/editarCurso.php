<?php
session_start();

//$conexion = new mysqli("servidor","usuario","clave","bd")
$nombreServidor = "localhost";
$nombreUsuario = "labmia";
$passwordBaseDeDatos = "Astrid.19972020";
$nombreBaseDeDatos = "CREATICA_PROYECTO";

// Crear conexión con la base de datos.
$conexion = new mysqli($nombreServidor, $nombreUsuario, $passwordBaseDeDatos, $nombreBaseDeDatos);

$sql = "call BuscarCursosPor(" . $_POST['idCurso'] . ");";
if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
}
if (!$conexion->query("SET @msg =" . $_POST['idCurso']) || !$conexion->multi_query("CALL BuscarCursosPor(@msg)")) {
    echo "Falló CALL: (" . $conexion->errno . ") " . $conexion->error;
}
do {
    if ($resultado = $conexion->store_result()) {
        $curso = $resultado->fetch_assoc();
        $resultado->free();
    } else {
        if ($conexion->errno) {
            echo "Store failed: (" . $conexion->errno . ") " . $conexion->error;
        }
    }
} while ($conexion->more_results() && $conexion->next_result());

$sql2 = "SELECT * FROM PROFESOR WHERE DPI = " . $curso['DPIProfesor'];
$resultado2 = mysqli_query($conexion, $sql2);
$profesor = $resultado2->fetch_array(MYSQLI_ASSOC);
$sql2 = "SELECT * FROM AREA";
$resultado3 = $conexion->query($sql2);
?>



<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <title>Editar Curso</title>
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
        <h1 class="tituloP"><?php echo $curso['Nombre'] ?></h1>
        <br>
        <br>
        <div>

            <div style="margin-top:50px">
                <form action="./Administrador/actualizarCurso.php" method="post">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nombre del Curso</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="nombreCurso" value="<?php echo $curso['Nombre'] ?>" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Precio Q.</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="monto" value="<?php echo $curso['monto'] ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Descripcion</label>
                        <textarea class="form-control" name="decripcion" rows="3" required> <?php echo $curso['descripcion'] ?>" </textarea>
                    </div>
                    <div class="form-row align-items-center">
                        <div class="col-sm-3 my-1">
                            <label class="sr-only" for="inlineFormInputGroupUsername">inicio</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Del</div>
                                </div>
                                <input type="date" name="fechaInicio" id="FInicio" class="form-control" value="<?php echo $curso['fechaInicio'] ?>">
                            </div>
                        </div>

                        <div class="col-sm-3 my-1">
                            <label class="sr-only" for="inlineFormInputGroupUsername">fin</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Al</div>
                                </div>
                                <input type="date" name="fechaFin" id="FFin" onclick="calcularDuracion()" class="form-control" value="<?php echo $curso['fechaFinal'] ?>">
                            </div>
                        </div>

                    </div>
                    <div class="form-group row" style="padding-top:20px;">
                        <label class="col-sm-2 control-label" id="cui1">CUI DEL PROFESOR</label>
                        <div class="col">
                            <input style="display:inline-block; width:80%;" class="form__input" type="number" value="<?php echo $curso['DPIProfesor'] ?>" pattern=".{13}" required oninput="maxLengthCheck(this)" maxlength="13" required name="CUI_PROFESOR" id="cui">
                            <span class="icon" style="display:inline-block;"></span>
                        </div>
                    </div>
                    <div class="mb-3" style="width: 60%; ">
                        <div class="input-group is-invalid">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="validatedInputGroupSelect">Area a la que pertenece el curso:</label>
                            </div>
                            <select class="custom-select" id="validatedInputGroupSelect" required name="idArea">
                                <?php foreach ($resultado3 as $area) : 
                                    if($area['idArea']==$curso['idArea'] ){
                                        echo "<option selected value=".$area['idArea']."> ".$area['Nombre']."</option>";
                                    }else{
                                        echo "<option value=".$area['idArea']."> ".$area['Nombre']."</option>";
                                    } endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <input type="text" id="idCurso" name="idCurso" style="display: none;" value=<?php echo $curso['idCurso'] ?>>
                    <input type="text" class="form-control" value="<?php echo $curso['duracion'] ?>" id="duracionid" name="duracion" style="display: none;">
                    <button type="submit" class="btn btn-primary mb-2" style="margin-left: 45%;">Actualizar</button>

                </form>
            </div>
            <br>
            <br>
            <h1>Profesor</h1>
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="./CSS/Profesor.jpg" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><b>Nombre: </b> <?php echo $profesor['nombres'] . ' ' . $profesor['apellidos'] ?> </h5>
                            <p class="card-text" style="text-align: justify; font-size:1.3rem;"><?php echo $profesor['descripcion'] ?></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
</body>

</html>