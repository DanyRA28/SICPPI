<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SICPPI System</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body class="bg-dark">

    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Iniciar Sesion</div>
        <div class="card-body">
          <form action="Login.php" method="post" name="login" id="login">
            <div class="form-group">
              <div class="form-label-group">
                <input type="email" id="inputUser" name="inputUser" class="form-control" placeholder="Usuario" required="required" autofocus="autofocus">
                <label for="inputUser">Usuario</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required="required" onkeypress="if(event.keyCode==13)document.login.submit()">
                <label for="inputPassword">Password</label>
              </div>
            </div>

            <a class="btn btn-primary btn-block" onclick="document.login.submit()">Login</a>

          </form>
          <div class="text-center">
            <?php

            if(isset($_GET["error"])){

            echo '<br><div class="alert alert-warning">
            <strong>Usuario o contraseña incorrectos</strong>
            </div>';
            }

            ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  </body>

</html>
