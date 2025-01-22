<?php
session_start();
if($_SESSION){
    if ($_SESSION["autentificado"] != "SI") {
        header("Location:http://localhost/CisWeb/index.php");
        //echo "<script>window.location='http://localhost/CisWeb/index.php';</script>";
    }
    else {
        $fechaGuardada = $_SESSION["ultimoAcceso"];
        $ahora = date("Y-n-j H:i:s");
        $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));

        if($tiempo_transcurrido >= 3000) {
            session_destroy();
            header("Location:http://localhost/CisWeb/index.php");
            //echo "<script>window.location='http://localhost/CisWeb/index.php';</script>";
        }
        else{
            $_SESSION["ultimoAcceso"] = $ahora;
        }
    }
}
else{
    header("Location:http://localhost/CisWeb/index.php");
    //echo "<script>window.location='http://localhost/CisWeb/index.php';</script>";
}
?>