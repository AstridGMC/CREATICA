<?php 
    session_start();
    echo $_POST['rango'];
    //$conexion = new mysqli("servidor","usuario","clave","bd")
    //$conexion = new mysqli("servidor","usuario","clave","bd")
    $nombreServidor = "localhost";
    $nombreUsuario = "labmia";
    $passwordBaseDeDatos = "Astrid.19972020";
    $nombreBaseDeDatos = "CREATICA_PROYECTO";

    // Crear conexión con la base de datos.
    $conexion = new mysqli($nombreServidor, $nombreUsuario, $passwordBaseDeDatos, $nombreBaseDeDatos);
    $cui = $_POST['CUI_ES'];
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $apellido = $_POST['apellido'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $pais =  $_POST['pais'];
    $fecha =  $_POST['fecha'];
    $rango= $_POST['rango'];
    //descripcion del maestro para darlo a conocer
    $descripcion =  $_POST['descripcion'];
    //GUARDANDO USUARIO SEGUN SU RANGO
    if($rango=='Administrador'){

        $sql = "INSERT INTO ADMINISTRADOR VALUES ('".$cui."','".$email."','".$nombre."','". $apellido."','".$password."')" ;
        if (!$conexion->query($sql)) {
            $ir_a = "error.php";
            echo "Falló CALL: (" . $conexion->errno . ") " . $conexion->error;
        }

    }else if($rango=='Profesor'){
        $sql = "INSERT INTO PROFESOR VALUES ('".$cui."','".$nombre."','". $apellido."','". $telefono."','". $email."','".$password." ','".$descripcion."')" ;
        if (!$conexion->query($sql)) {
            $ir_a = "error.php";
            echo "Falló CALL: (" . $conexion->errno . ") " . $conexion->error;
        }
    }else{
        $sql = "INSERT INTO ESTUDIANTE VALUES ('".$cui."','".$nombre."', '".$apellido."', '".$email."', '".$password."','".$pais."','".$fecha."')' ";
        if (!$conexion->query($sql)) {
            $ir_a = "error.php";
            echo "Falló CALL: (" . $conexion->errno . ") " . $conexion->error;
        }
    }
    $ir_a = "pantallaAdmin.php";
    echo $sql;

    header("location: ".$ir_a);
