<?php
if(isset($_POST['input'])) {

    $conn = mysqli_connect("localhost", "root", "", "sicppi");
    $conn->set_charset("utf8");

        $id = mysqli_real_escape_string($conn, $_POST["id"]);    
        $cantprod = mysqli_real_escape_string($conn, $_POST["cantprod"]);
        $subtotal = mysqli_real_escape_string($conn, $_POST["subtotal"]);
        $id_producto = mysqli_real_escape_string($conn, $_POST["id_producto"]);
        $id_pedido = mysqli_real_escape_string($conn, $_POST["id_pedido"]);




    $sql="UPDATE detalle_pedido SET cantprod='$cantprod', subtotal='$subtotal', id_producto='$id_producto', id_pedido='$id_pedido' WHERE id_dpedido = '$id' ;";
        

    echo $sql;

    $query = mysqli_query($conn,$sql);
    if ($query) {
       header("Location: showDetPedido.php?e=3");
    }
    else {
        header("Location:updateDetPedido.php?id=".$id."&e=1");
    }
}
?>