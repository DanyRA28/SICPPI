<?php
if(isset($_POST['input'])) {
    include("../../../class/User.php");

    $conn = mysqli_connect("localhost", "root", "", "sicppi");

        
    $id = mysqli_real_escape_string($conn, $_POST["id"]);    
    $user = mysqli_real_escape_string($conn, $_POST["usuario"]);
    $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
    $telefono = mysqli_real_escape_string($conn, $_POST["telefono"]);
    $tipo = mysqli_real_escape_string($conn, $_POST["tipo"]);


    $sql="UPDATE usuarios SET usuario='$user', nombre='$nombre', telefono='$telefono', tipo='$tipo' WHERE id_usuario = '$id' ;";
        


    $query = mysqli_query($conn,$sql);
    if ($query) {
        header("Location: showUser.php?e=3");
    }
    else {
        header("Location:updateUser.php?id=".$id."&e=1");
    }
}
?>