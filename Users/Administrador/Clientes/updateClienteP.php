<?php
if(isset($_POST['input'])) {
   

    $conn = mysqli_connect("localhost", "root", "", "sicppi");
    $conn->set_charset("utf8");

        
  
    $id = mysqli_real_escape_string($conn, $_POST["rfc"]);
    $nombre = mysqli_real_escape_string($conn, $_POST["nombre"]);
    $latitud = mysqli_real_escape_string($conn, $_POST["latitud"]);
    $longitud = mysqli_real_escape_string($conn, $_POST["longitud"]);
    $deuda = mysqli_real_escape_string($conn, $_POST["deuda"]);
    $calle = mysqli_real_escape_string($conn, $_POST["calle"]);
    $colonia = mysqli_real_escape_string($conn, $_POST["colonia"]);
    $municipio = mysqli_real_escape_string($conn, $_POST["municipio"]);
    $telefono = mysqli_real_escape_string($conn, $_POST["telefono"]);


    $sql="UPDATE clientes SET rfc='$id', nombre='$nombre', latitud='$latitud', longitud='$longitud', deuda='$deuda', calle='$calle', colonia='$colonia', municipio='$municipio', telefono='$telefono' WHERE rfc = '$id' ;";
        


    $query = mysqli_query($conn,$sql);
    if ($query) {
        header("Location: showCliente.php?e=3");
    }
    else {
        header("Location:updateCliente.php?id=".$id."&e=1");
    }
}
?>