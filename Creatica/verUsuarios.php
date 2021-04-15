<?php
//$conexion = new mysqli("servidor","usuario","clave","bd")
$conexion = new mysqli("localhost", "labmia", "Astrid.19972020", "CREATICA_PROYECTO");
// hay dos clases mysql mysqli

$sql = "SELECT * FROM PROFESOR ORDER BY nombres;";
$resultado = $conexion->query($sql);

$sql2 = "SELECT * FROM ADMINISTRADOR ORDER BY nombres;";
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

    <div class="" style="margin-top:50px">
        <div>
            <h1 class="text-center">Listado de Profesores</h1>
            <table class="table table-striped table-sm table-primary" style="font-size: 1.4rem">
                <tr>
                    <th>CUI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Descripcion</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Accion</th>
                </tr>
                <?php foreach ($resultado as $fila) : ?>
                    <tr>

                        <td><?php echo $fila['DPI'] ?></td>
                        <td><?php echo  $fila['nombres'] ?></td>
                        <td><?php echo $fila['apellidos'] ?></td>
                        <td><?php echo $fila['descripcion'] ?></td>
                        <td><?php echo $fila['Telefono'] ?></td>
                        <td><?php echo $fila['correo'] ?></td>
                        <td>
                            <form name="eliminarProfesor.php" action="./Administrador/eliminarCurso.php" method="post" style="display: inline;" id="formularioEliminar">
                                <input type="hidden" name="dpi" value="<?php echo $fila['DPI'] ?>">
                                <input type="submit" value="Eliminar" name="B1" class="btn btn-sm btn-danger">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <div style="padding-top: 50px;">
            <h1 class="text-center">Listado de Administradores</h1>
            <table class="table table-striped table-sm table-primary" style="font-size: 1.4rem">
                <tr>
                    <th>CUI</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                </tr>
                <?php foreach ($resultado as $fila) : ?>
                    <tr>

                        <td><?php echo $fila['DPI'] ?></td>
                        <td><?php echo  $fila['nombres'] ?></td>
                        <td><?php echo $fila['apellidos'] ?></td>
                        <td><?php echo $fila['correo'] ?></td>
                        
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
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