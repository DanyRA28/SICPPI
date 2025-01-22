<?php
if(isset($_POST['input'])) {
   

    $conn = mysqli_connect("localhost", "root", "", "sicppi");
    $conn->set_charset("utf8");

        
  
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
    $descripcion = mysqli_real_escape_string($conn, $_POST["descripcion"]);
    $precio = mysqli_real_escape_string($conn, $_POST["precio"]);
    $stock = mysqli_real_escape_string($conn, $_POST["stock"]);
    $departamento = mysqli_real_escape_string($conn, $_POST["id_departamento"]);


    $sql="UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio='$precio', stock='$stock', id_departamento='$departamento' WHERE id_producto = '$id' ;";
        


    $query = mysqli_query($conn,$sql);
    if ($query) {
        header("Location: showProducto.php?e=3");
    }
    else {
        header("Location:updateProducto.php?id=".$id."&e=1");
    }
}
?>