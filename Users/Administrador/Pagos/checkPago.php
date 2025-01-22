<?php
if (isset($_POST)){
    include("../../../SGBD/Connector.php");

    $Connector = new Connector();
    $ant = 0;

    $usuario = mysqli_real_escape_string($Connector->getCon(), $_POST["user"]);

    if(isset($_POST["user_act"])){
        $usuario_act = mysqli_real_escape_string($Connector->getCon(), $_POST["user_act"]);
        $ant = 1;
    }

    try{
        $Connector->select("usuario","usuario","'$usuario'");
        $query = $Connector->getQuery();
        $nr=mysqli_num_rows($query);
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }

    if($nr==0){
        echo "<div class='alert alert-success mb-0'><i class='fa fa-check'></i> Usuario disponible</div><input id='userchecker' type='hidden' value='1' name='ipchecker'>";
    }
    else{
        if($ant == 1){
            if($usuario==$usuario_act){
                echo "<div class='alert alert-success mb-0'><i class='fa fa-check'></i> Usuario disponible</div><input id='userchecker' type='hidden' value='1' name='ipchecker'>";
            }
            else{
                echo "<div class='alert alert-danger mb-0'><i class='fa fa-times'></i> Usuario ya utilizada</div><input id='userchecker' type='hidden' value='0' name='ipchecker'>";
            }
        }
        else{
            echo "<div class='alert alert-danger mb-0'><i class='fa fa-times'></i> Usuario ya utilizada</div><input id='userchecker' type='hidden' value='0' name='ipchecker'>";
        }
    }
}
?>