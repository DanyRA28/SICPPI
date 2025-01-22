<?php
    if(isset($_POST['enviar'])) {
        $conn = mysqli_connect("localhost", "root", "", "sicppi");

   
        
        $fecha = mysqli_real_escape_string($conn, $_POST["fecha_pedido"]);
        $total = mysqli_real_escape_string($conn, $_POST["total"]);
        $entregado = mysqli_real_escape_string($conn, $_POST["entregado"]);
        $rfc = mysqli_real_escape_string($conn, $_POST["rfc"]);
       

        $sql="INSERT INTO pedidos(fecha_pedido, total, entregado, rfc) VALUES ('$fecha', '$total', '$entregado', '$rfc');";


        $query = mysqli_query($conn,$sql);
        if ($query) {
            header("Location: showPedido.php?e=2");
        }
        else {
            echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
        }
    }
?>