

<!DOCTYPE html>
<html>
  <head>
    <title>LOGIN  </title>
    <meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
      .container{margin-top:100px}
    </style>
  </head>
  <body>
    <?php include 'header.php'; ?>
    <div class="container">
      <h1 style="text-align: center; padding-bottom:70px;">LOGIN  <?php echo $_POST['tupoUser']?></h1>
      
      <form class="form-horizontal" action="comprobarUsuario.php" method="post">
      <input  name="tipoUsuario"  style="display: none;" value=<?php echo $_POST['tupoUser']?> >
        <div class="form-group">
          <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" name="email" id="inputEmail3" placeholder="Email" required>
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" name="password" id="inputPassword3" placeholder="Password" required>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">Iniciar Sesion</button>
          </div>
        </div>
      </form>
    </div>
  </body>
</html>
