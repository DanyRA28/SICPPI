<?php
    if(isset($_POST['enviar'])) {
        $conn = mysqli_connect("localhost", "root", "", "sicppi");

   
        
        $user = mysqli_real_escape_string($conn, $_POST["usuario"]);
        $pass = mysqli_real_escape_string($conn, $_POST["pass"]);
        $tipo = mysqli_real_escape_string($conn, $_POST["tipo"]);
        $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
        $telefono = mysqli_real_escape_string($conn, $_POST["telefono"]);

        $sql="INSERT INTO usuarios(usuario, contra, nombre, telefono, tipo) VALUES ('$user',md5('$pass'), '$nombre', '$telefono', '$tipo');";


        $query = mysqli_query($conn,$sql);
        if ($query) {
            header("Location: showUser.php?e=2");
        }
        else {
            echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
        }
    }
?>