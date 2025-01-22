<?php
    if(isset($_POST['enviar'])) {
        $conn = mysqli_connect("localhost", "root", "", "sicppi");

   
        
        $fecha = mysqli_real_escape_string($conn, $_POST["fecha_pago"]);
        $monto = mysqli_real_escape_string($conn, $_POST["monto"]);
        $id_pedido = mysqli_real_escape_string($conn, $_POST["id_pedido"]);
       

        $sql="INSERT INTO pagos(fecha_pago, monto, id_pedido) VALUES ('$fecha', '$monto', '$id_pedido');";


        $query = mysqli_query($conn,$sql);
        if ($query) {
            header("Location: showPago.php?e=2");
        }
        else {
            echo "<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al agregar</div>";
        }
    }
?>