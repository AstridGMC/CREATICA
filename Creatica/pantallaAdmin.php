<?php
session_start(); 
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
    
    <div class="container" style="padding-top: 5rem;">
        <h1 style="font-size: 6rem;">BIENVENIDO ADMINISTRADOR</h1>
        <h1 style="font-size: 6rem;"><?php echo $_SESSION['nombre'] ?></h1>
    <br>
    </div>
</body>