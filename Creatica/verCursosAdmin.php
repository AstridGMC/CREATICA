<?php
//$conexion = new mysqli("servidor","usuario","clave","bd")
$conexion = new mysqli("localhost", "labmia", "Astrid.19972020", "CREATICA_PROYECTO");
// hay dos clases mysql mysqli
if (isset($_POST['idArea']) && $_POST['idArea'] != 0) {
    $sql = "SELECT * FROM CURSO JOIN DETALLE_CURSO ON CURSO.idCurso= DETALLE_CURSO.idCurso WHERE idArea = " . $_POST['idArea'];
    $resultado = $conexion->query($sql);
} else if (isset($_POST['nombre'])) {
    $sql = "SELECT * FROM CURSO JOIN DETALLE_CURSO ON CURSO.idCurso= DETALLE_CURSO.idCurso WHERE Nombre LIKE '%" . $_POST['nombre'] . "%'";
    $resultado = $conexion->query($sql);
} else {

    $sql = "SELECT * FROM CURSO JOIN DETALLE_CURSO ON CURSO.idCurso= DETALLE_CURSO.idCurso ;";
    $resultado = $conexion->query($sql);
}
$sql2 = "SELECT * FROM AREA";
$resultado2 = $conexion->query($sql2);
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <title>Cursos de Creatica</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <?php include 'header.php'; ?>
    
    <div class="container" style="margin-top:50px">
        <h1 class="text-center">Listado de Cursos</h1>
        <div style="padding-top: 25px;">
            <form action="verCursosAdmin.php" method="post">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Filtrar por nombre del curso:</span>
                    </div>
                    <input type="text" class="form-control rounded-right"  name="nombre" id="buscar" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>" required>
                    <input style="margin-left: 30px;" type="submit" value="Buscar"class="btn btn-primary">
                </div>
                
            </form>
        </div>
        <div style="padding-top: 25px;">
            <form action="verCursosAdmin.php" method="post">
                <div class="mb-3" style="width: 60%;">
                    <div class="input-group is-invalid">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="validatedInputGroupSelect">Filtrar por areas</label>
                        </div>
                        <select class="custom-select" id="validatedInputGroupSelect" required name="idArea">
                            <option value="0" selected>Todos </option>

                            <?php foreach ($resultado2 as $area) : ?>
                                <option value="<?php echo $area['idArea']; ?>"> <?php echo $area['Nombre']; ?> </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="submit" value="Filtrar">
                    </div>
                </div>
            </form>
        </div>
        <table class="table table-striped table-sm table-primary" style="font-size: 1.4rem">
            <tr>
                <th>Nombre</th>
                <th>periodo</th>
                <th>monto</th>
                <th>Accion</th>
            </tr>
            <?php foreach ($resultado as $fila) : ?>
                <tr>
                    
                    <td><?php echo $fila['Nombre'] ?></td>
                    <td><?php echo 'Del: ' .date("d/m/Y", strtotime($fila['fechaInicio'] )) . '  Al: ' . date("d/m/Y", strtotime($fila['fechaFinal'])) ?></td>
                    <td><?php echo 'Q.' . $fila['monto'] ?></td>
                    <td>
                        <form action="editarCurso.php" method="post" style="display: inline;">
                            <input type="hidden" name="idCurso" value="<?php echo $fila['idCurso'] ?>">
                            <input type="submit" value="Editar" class="btn btn-sm btn-warning">
                        </form>
                        <form name = "eliminarRegistro" action="./Administrador/eliminarCurso.php" method="post" style="display: inline;" id="formularioEliminar">
                            <input type="hidden" name="idCurso" value="<?php echo $fila['idCurso'] ?>">
                            <input type="submit" value="Eliminar" name="B1"  class="btn btn-sm btn-danger">    
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>


</html>

<script type="text/javascript">
       (function() {
         var form = document.getElementById('formularioEliminar');
         form.addEventListener('submit', function(event) {
           // si es false entonces que no haga el submit
           if (!confirm('Realmente desea eliminar?')) {
             event.preventDefault();
           }
         }, false);
       })();
</script>