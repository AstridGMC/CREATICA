<?php
session_start();

//$conexion = new mysqli("servidor","usuario","clave","bd")
$conexion = new mysqli("localhost", "labmia", "Astrid.19972020", "CREATICA_PROYECTO");
$sql = "SELECT * FROM CURSO ";
$sql .= " ORDER BY nombre";
$resultado = $conexion->query($sql);
$cont = 1;
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <title>Creatica-Nuevo Usuario</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="./CSS/estiloRegistrarse.css" rel="stylesheet" type="text/css">
</head>

<body style="background: url('./CSS/fondo4.jpg');">
    <div id="cuadro">
        <div id="superior">
            <h1 id="titulo">CREA TU CUENTA </h1>
            <h3 id="titulo2">Completamente Gratis!!</h3>
        </div>

        <div id="centro">
            <div id="inferior">
                <form method="POST" action="GuardaUsuario.php" class="form-horizontal">
                    <div id="div0">
                        <div class="caja_inline">
                            <label class="col-sm-2 control-label" id="cui1">CUI </label>
                            <div class="col">
                                <input style="display:inline-block; width:80%;" class="form__input" type="number" pattern=".{13}" required oninput="maxLengthCheck(this)" maxlength="13" required name="CUI_ES" id="cui" placeholder="">
                                <span class="icon" style="display:inline-block;"></span>
                            </div>
                        </div>
                        <div class="caja_inline">
                            <label class="col-sm-2 control-label" id="telefono">Telefono </label>
                            <div class="col">
                                <input style="display:inline-block; width:80%;" style="display:inline" " class=" form__input" type="number" required name="telefono" id="Telefono" placeholder="Telefono">
                                <span class="icon" style="display:inline-block;"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="div1">
                        <label class="col-sm-2 control-label" id="as">Nombres </label>
                        <div class="col">
                            <input type="text" class="form__input" pattern=".{1,}" required name="nombre" id="nombre" placeholder="Nombres completos">
                            <span class="icon"></span>
                        </div>
                    </div>
                    <div class="form-group" id="div2">
                        <label class="col-sm-2 control-label">Apellidos </label>
                        <div class="col">
                            <input type="text" class="form__input" pattern=".{1,}" required name="apellido" id="apellidos" placeholder="Apellidos completos">
                            <span class="icon"></span>
                        </div>
                    </div>
                    <div class="form-group" id="div5">
                        <label class="col-sm-2 control-label" id="correo">Correo</label>
                        <div class="col">
                            <input type="email" class="form__input" pattern=".{1,}" required name="email" id="usuario" placeholder="Nombre De Usuario">
                            <span class="icon"></span>
                        </div>
                    </div>
                    <div class="form-group" id="div4">
                        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                        <div class="col">
                            <input type="password" name="password" class="form__input" pattern=".{1,}" required id="url" placeholder="Password">
                            <span class="icon"></span>
                        </div>
                    </div>
                    <?php

                    if ($_SESSION['rango'] == 'Administrador') {
                        echo '
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Descripcion Profesor</label>
                            <textarea class="form-control" name="descripcion" rows="3" ></textarea>
                        </div>
                        <div >
                            <div class="radio">
                                <label>
                                    <input type="radio" name="rango" id="optionsRadios1" value="Profesor" checked>
                                    Profesor
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="rango" id="optionsRadios2" value="Administrador">
                                    Administrador
                                </label>
                            </div
                        </div
                        div>
                        <div class="form-group">
                            <div class="col">
                                <button type="submit" class="btn btn-success pull-right" id="registrarse">Guardar</button>
                            </div>
                        </div>
                        </div>
                        ';
                    } else {
                        echo '
                        <div class="form-group" id="div3">
                            <label id="user">Pais de Origen</label>
                            <div class="col">
                                <input type="text" class="form__input" pattern=".{1,}" required name="pais" id="pais" placeholder="Pais de Origen">
                                <span class="icon"></span>
                            </div>
                        </div>
                        <div class="col-sm-10">
                            Fecha de Nacimiento <input class="fechas" type="date" name="fecha" size="20" required>
                        </div>
                        <input type="radio" name="rango"  id="optionsRadios2" value="Estudiante"style= "display:none;" >
                        
                        <div>
                            <div class="form-group">
                                <div class="col">
                                    <button type="submit" class="btn btn-success pull-right" id="registrarse">Registrarme</button>
                                </div>
                            </div>
                        </div>';
                    }
                    ?>
                    <

                </form>
            </div>
        </div>
    </div>
</body>

</html>