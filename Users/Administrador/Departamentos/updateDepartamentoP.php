<?php
if(isset($_POST['input'])) {
    include("../../../class/User.php");

    $conn = mysqli_connect("localhost", "root", "", "sicppi");

        
    $id = mysqli_real_escape_string($conn, $_POST["id"]);     
    $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
  

    $sql="UPDATE departamentos SET nombre='$nombre'  WHERE id_departamento = '$id';";
        


    $query = mysqli_query($conn,$sql);
    if ($query) {
        header("Location: showDepartamento.php?e=3");
    }
    else {
        header("Location:updateDepartamento.php?id=".$id."&e=1");
    }
}
?>