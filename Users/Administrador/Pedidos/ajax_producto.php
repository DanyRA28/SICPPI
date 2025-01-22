<?php
    $conn = mysqli_connect("localhost", "root", "", "sicppi");
    $conn->set_charset("utf8");


    if ($_POST['action']=='buscarProducto') {
        $id_producto = $_POST["p"];

        $sql = mysqli_query($conn,"SELECT * FROM productos WHERE id_producto = $id_producto");
        $numRows = mysqli_num_rows($sql);

        if($numRows>0){
            $data = mysqli_fetch_assoc($sql);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            exit;
        }
        echo 'error';
        exit;
    }

    if ($_POST['action']=='addDetalleProducto') {
        if(empty($_POST['idProd']) || empty($_POST['cantidad']) || empty($_POST['subTotal'])){
            echo 'error';
        }
        else{
            $id_producto = $_POST['idProd'];
            $cantidad = $_POST['cantidad'];
            $subTotal = $_POST['subTotal'];

            $sqlDetalleTemp = mysqli_query($conn,"CALL add_detalle_temp($id_producto,$cantidad, $subTotal)");
            $numRows = mysqli_num_rows($sqlDetalleTemp);

            $precio=0;
            $subTotal=0;
            $total=0;
            $detalleTabla='';
            $detalleTotales='';
            $arrayData = array();

            if($numRows>0){
                while($data = mysqli_fetch_assoc($sqlDetalleTemp)){
                    //echo json_encode($data);
                    //exit;
                    $precio=round($data['cantprod'] * $data['precio'],2);
                    $subTotal=round($subTotal+$precio,2);
                    $total = round($total+$precio,2);

                    $detalleTabla.='<tr>
                            <td>'.$data['id_producto'].'</td>
                            <td id="nombre">'.$data['nombre'].'</td>
                            <td id="descripcion">'.$data['descripcion'].'</td>
                            <td id="stock"></td>
                            <td>'.$data['cantprod'].'</td>
                            <td id="precioUnitario">'.$data['precio'].'</td>
                            <td id="subTotal">'.$precio.'</td>
                            <td><a href="#"  style="display: none;"><i class="fa fa-fw fa-plus"></i></a></td>
                        </tr>';

                    $detalleTotales='<tr>
                            <td>TOTAL</td>
                            <td>'.$total.'</td>
                        </tr>';
                }

                $arrayData['detalle']=$detalleTabla;
                $arrayData['totales']=$detalleTotales;

                echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);

            }
            else{
                echo 'error';

            }

        }

        //print_r($_POST);
        exit;
    }

    if ($_POST['action']=='getCliente') {
        $rfc = $_POST["rfc"];

        $sql = mysqli_query($conn,"SELECT * FROM clientes WHERE rfc = $rfc");
        $numRows = mysqli_num_rows($sql);

        if($numRows>0){
            $data = mysqli_fetch_assoc($sql);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
            exit;
        }
        echo 'error';
        exit;
    }

    if ($_POST['action']=='getDetalle') {

        $sql = mysqli_query($conn,"SELECT tmp.id_dpedido, tmp.id_producto, p.nombre, p.descripcion, p.precio, tmp.cantprod, tmp.subtotal 
            FROM detalle_pedido_temp tmp
            INNER JOIN productos p
            ON tmp.id_producto = p.id_producto;");
        $numRows = mysqli_num_rows($sql);

        $precio=0;
        $subTotal=0;
        $total=0;
        $detalleTabla='';
        $detalleTotales='';
        $arrayData = array();

        if($numRows>0){
            while($data = mysqli_fetch_assoc($sql)){
                //echo json_encode($data);
                //exit;
                $precio=round($data['cantprod'] * $data['precio'],2);
                $subTotal=round($subTotal+$precio,2);
                $total = round($total+$precio,2);

                $detalleTabla.='<tr>
                            <td>'.$data['id_producto'].'</td>
                            <td id="nombre">'.$data['nombre'].'</td>
                            <td id="descripcion">'.$data['descripcion'].'</td>
                            <td id="stock"></td>
                            <td>'.$data['cantprod'].'</td>
                            <td id="precioUnitario">'.$data['precio'].'</td>
                            <td id="subTotal">'.$precio.'</td>
                            <td><a href="#"  style="display: none;"><i class="fa fa-fw fa-plus"></i></a></td>
                        </tr>';

                $detalleTotales='<tr>
                            <td>TOTAL</td>
                            <td>'.$total.'</td>
                        </tr>';
            }

            $arrayData['detalle']=$detalleTabla;
            $arrayData['totales']=$detalleTotales;

            echo json_encode($arrayData, JSON_UNESCAPED_UNICODE);
        }
        else{
            echo 'error';
            exit;
        }
        exit;
    }


?>