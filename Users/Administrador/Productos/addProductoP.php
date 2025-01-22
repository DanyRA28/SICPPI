<?php
    if(isset($_POST['enviar'])) {
        $conn = mysqli_connect("localhost", "root", "", "sicppi");

   
        
        $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
        $descripcion = mysqli_real_escape_string($conn, $_POST["descripcion"]);
        $precio = mysqli_real_escape_string($conn, $_POST["precio"]);
        $stock = mysqli_real_escape_string($conn, $_POST["stock"]);
        $departamento = mysqli_real_escape_string($conn, $_POST["id_departamento"]);

        $sql="INSERT INTO productos(nombre, descripcion, precio, stock, id_departamento) VALUES ('$nombre', '$descripcion', '$precio', '$stock', '$departamento');";


        $query = mysqli_query($conn,$sql);
        if ($query) {
            header("Location: showProducto.php?e=2");
        }
        else {
            echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
        }
    }
?>