<?php
    if(isset($_POST['enviar'])) {
        $conn = mysqli_connect("localhost", "root", "", "sicppi");

   
        $rfc = mysqli_real_escape_string($conn, $_POST["rfc"]);
        $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
        $latitud = mysqli_real_escape_string($conn, $_POST["latitud"]);
        $longitud = mysqli_real_escape_string($conn, $_POST["longitud"]);
        $deuda = mysqli_real_escape_string($conn, $_POST["deuda"]);
        $calle = mysqli_real_escape_string($conn, $_POST["calle"]);
        $colonia = mysqli_real_escape_string($conn, $_POST["colonia"]);
        $municipio = mysqli_real_escape_string($conn, $_POST["municipio"]);
        $telefono = mysqli_real_escape_string($conn, $_POST["telefono"]);
        

        $sql="INSERT INTO clientes(rfc, nombre, latitud, longitud, deuda, calle, colonia, municipio, telefono) VALUES ('$rfc','$nombre', '$latitud', '$longitud', '$deuda', '$calle', '$colonia', '$municipio', '$telefono');";


        $query = mysqli_query($conn,$sql);
        if ($query) {
            header("Location: showCliente.php?e=2");
        }
        else {
            echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
        }
    }
?>