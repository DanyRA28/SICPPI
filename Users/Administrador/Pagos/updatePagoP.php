<?php
if(isset($_POST['input'])) {

    $conn = mysqli_connect("localhost", "root", "", "sicppi");
    $conn->set_charset("utf8");

        
    $id = mysqli_real_escape_string($conn, $_POST["id"]);    
    $fecha = mysqli_real_escape_string($conn, $_POST["fecha_pago"]);
    $monto = mysqli_real_escape_string($conn, $_POST["monto"]);
    $id_pedido = mysqli_real_escape_string($conn, $_POST["id_pedido"]);




    $sql="UPDATE pagos SET fecha_pago='$fecha', monto='$monto', id_pedido='$id_pedido' WHERE id_pago = '$id' ;";
        

    echo $sql;

    $query = mysqli_query($conn,$sql);
    if ($query) {
        header("Location: showPago.php?e=3");
    }
    else {
        header("Location:updatePago.php?id=".$id."&e=1");
    }
}
?>