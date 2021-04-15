<?php
session_start();

//$conexion = new mysqli("servidor","usuario","clave","bd")
$conexion = new mysqli("localhost", "labmia", "Astrid.19972020", "CREATICA_PROYECTO");
$sql2 = "SELECT * FROM AREA";
$resultado2 = $conexion->query($sql2);
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <title>Nuevo Curso</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<?php include 'header.php'; ?>

<body>
    <div style="margin-left: 20%; margin-right: 20%; margin-top:50px">
        <h1 style="text-align: center;">CREAR CURSO</h1>
        <form  method="POST" action="./Administrador/gurardarCurso.php">
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Nombre del Curso</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nombreCurso" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Precio </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="monto" required>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Descripcion</label>
                <textarea class="form-control" name="decripcion" rows="3" required></textarea>
            </div>
            <div class="form-row align-items-center">
                <div class="col-sm-3 my-1">
                    <label class="sr-only" for="inlineFormInputGroupUsername">inicio</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Del</div>
                        </div>
                        <input type="date" name="fechaInicio" id="FInicio" class="form-control" value="<?php echo date("Y-m-d"); ?>">
                    </div>
                </div>

                <div class="col-sm-3 my-1">
                    <label class="sr-only" for="inlineFormInputGroupUsername">fin</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">Al</div>
                        </div>
                        <input type="date" name="fechaFin" id="FFin" onclick="calcularDuracion()" class="form-control" value="<?php echo date("Y-m-d"); ?>">
                    </div>
                </div>

            </div>
            <div class="form-group row" style="padding-top:20px;">
                <label class="col-sm-2 control-label" id="cui1">CUI DEL PROFESOR</label>
                <div class="col">
                    <input style="display:inline-block; width:80%;" class="form__input" type="number" pattern=".{13}" required oninput="maxLengthCheck(this)" maxlength="13" required name="CUI_PROFESOR" id="cui" placeholder="">
                    <span class="icon" style="display:inline-block;"></span>
                </div>
            </div>
            <div class="mb-3" style="width: 60%; ">
                <div class="input-group is-invalid">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="validatedInputGroupSelect">Area a la que pertenece el curso:</label>
                    </div>
                    <select class="custom-select" id="validatedInputGroupSelect" required name="idArea">
                        <?php foreach ($resultado2 as $area) : ?>
                            <option value="<?php echo $area['idArea']; ?>"> <?php echo $area['Nombre']; ?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <input type="text" class="form-control" id="duracionid" name="duracion" style="display: none;">
            <button type="submit" class="btn btn-primary mb-2" style="margin-left: 45%;">Publicar</button>
        </form>
    </div>
</body>

</html>

<script>
    function calcularDuracion() {
        var fechaini = new Date(document.getElementById('FInicio').value);
        var fechafin = new Date(document.getElementById('FFin').value);
        var diasdif = fechafin.getTime() - fechaini.getTime();
        var contdias = Math.round(diasdif / (1000 * 60 * 60 * 24));

        document.getElementById('duracionid').value = contdias;
    }
</script>