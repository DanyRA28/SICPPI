<?php
if(isset($_POST['input'])) {

    $conn = mysqli_connect("localhost", "root", "", "sicppi");
    $conn->set_charset("utf8");
        
    $id = mysqli_real_escape_string($conn, $_POST["id"]);    
    $fecha = mysqli_real_escape_string($conn, $_POST["fecha_pedido"]);
    $total = mysqli_real_escape_string($conn, $_POST["total"]);
    $status = mysqli_real_escape_string($conn, $_POST["entregado"]);

    $rfc = mysqli_real_escape_string($conn, $_POST["rfc"]);


    $sql="UPDATE pedidos SET fecha_pedido='$fecha', total='$total', entregado='$status', rfc='$rfc' WHERE id_pedido = '$id' ;";
        

    echo $sql;

    $query = mysqli_query($conn,$sql);
    if ($query) {
        header("Location: showPedido.php?e=3");
    }
    else {
        header("Location:updatePedido.php?id=".$id."&e=1");
    }
}
?>