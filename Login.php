<?php
    session_start();

    $conn = mysqli_connect("localhost", "root", "", "sicppi");

    $user = mysqli_real_escape_string($conn, $_POST["inputUser"]);
    $pass = mysqli_real_escape_string($conn, $_POST["inputPassword"]);
            

    //$sql = "SELECT * FROM usuarios WHERE usuario='$usr' and contra=md5('$pass')";
    $sql = "SELECT * FROM usuarios WHERE usuario='$user' and contra='$pass'";
    
    $query=mysqli_query($conn, $sql);
    //$totalData = mysqli_num_rows($query);
    //$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

    $row = mysqli_fetch_array($query);
    //$_SESSION["name"]=$row['nombre']." ".$row['apellidos'];
    $_SESSION["nombre"]=$row['nombre'];
    //$_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s");
    //$_SESSION["autentificado"]= "SI";

    switch($row['tipo']) {
        case "administrador":
            header("Location:Users/Administrador/index.php");
            break;
        case "empleado":
            header("Location:Users/Empleado/index.php");
            break;
        default:
            $error="UserNotFound";
            header("Location:index.php?error=".$error);
}
?>