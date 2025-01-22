<?php
    if(isset($_POST['enviar'])) {
        $conn = mysqli_connect("localhost", "root", "", "sicppi");

   
        
        $cantprod = mysqli_real_escape_string($conn, $_POST["cantprod"]);
        $subtotal = mysqli_real_escape_string($conn, $_POST["subtotal"]);
        $id_producto = mysqli_real_escape_string($conn, $_POST["id_producto"]);
        $id_pedido = mysqli_real_escape_string($conn, $_POST["id_pedido"]);

      
       

        $sql="INSERT INTO detalle_pedido(cantprod, subtotal, id_producto, id_pedido) VALUES ('$cantprod', '$subtotal', '$id_producto', '$id_pedido');";


        $query = mysqli_query($conn,$sql);
        if ($query) {
            header("Location: showDetPedido.php?e=2");
        }
        else {
            echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
        }
    }
?>