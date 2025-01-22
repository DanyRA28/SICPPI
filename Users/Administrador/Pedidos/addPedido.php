<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Bicycle Style</title>

    <!-- Bootstrap core CSS-->
    <link href="../../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="../../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../../../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../../css/sb-admin.css" rel="stylesheet">

  </head>

<body id="page-top">
<?php 
    //include("../../caducarSesion.php"); 
    include("addPedidoP.php");
    session_start();

  ?>

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.php">Bicycle Style</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->


      <!-- Navbar -->
      <ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
           <!--   <i><?php echo $_SESSION["nombre"] ?></i>-->
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">Perfil</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Cerrar sesión</a>
          </div>
        </li>
      </ul>

    </nav>
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Información</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="../Productos/showProducto.php">Productos</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../Ventas/showVentas.php">Ventas</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../User/showUser.php">Usuarios</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../Departamentos/showDepartamento.php">Departamentos</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../Pedidos/showPedido.php">Pedidos</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../Pagos/showPago.php">Pagos</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../DetallePedido/showDetPedido.php">Detalle Pedido</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../Clientes/showCliente.php">Clientes</a>
            
          </div>
        </li>
      </ul>

    <div id="content-wrapper">

        <div class="container-fluid">

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="../index.php">Inicio</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="showPedido.php">Pedidos</a>
                </li>
                <li class="breadcrumb-item active">Agregar</li>
            </ol>

            <!-- Registrar nuevo pedido-->
            <div class="card mx-auto">
                <div class="card-header">Registrar nuevo pedido</div>
                <div class="card-body">
                    <form action="addPedido.php" method="post" name="formPedidos">
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6 mx-auto" >
                                    <div class="form-label-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="cliente" >Cliente a entregar</label>
                                            </div>
                                            <?php
                                            $conn = mysqli_connect("localhost", "root", "", "sicppi");
                                            $conn->set_charset("utf8");
                                            $sql = mysqli_query($conn, "SELECT *  FROM clientes");
                                            $option = '';
                                            if(mysqli_num_rows($sql) == 0){
                                                header("Location: showPedido.php");
                                            }else{
                                                while($row = mysqli_fetch_assoc($sql)){
                                                    $option .= '<option value = "'.$row['rfc'].'">'.$row['rfc']." | ".$row['nombre']." | ".$row['colonia'].'</option>';
                                                }
                                            }
                                            ?>
                                            <select class="custom-select" id="cliente" name="cliente" autofocus="autofocus" required>
                                                <?php echo $option; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="table-responsive">
                            <table class="table table-bordered" id="lookup" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Stock</th>
                                        <th>Cantidad</th>
                                        <th>Precio unitario</th>
                                        <th>Subtotal</th>
                                        <th>Acción</th>
                                    </tr>

                                </thead>

                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" id="id_producto" name="id_producto"  placeholder="ID del producto" required >
                                        </td>
                                        <td id="nombre">-</td>
                                        <td id="descripcion">-</td>
                                        <td id="stock">-</td>
                                        <td>
                                            <input type="text" id="cantidad" name="cantidad"  placeholder="Cantidad" disabled >
                                        </td>
                                        <td id="precioUnitario">0.00</td>
                                        <td id="subTotal">0.00</td>
                                        <td><a href="#" id="agregarProductoDetalle" style="display: none;"><i class="fa fa-fw fa-plus"></i></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="tablaDetalle" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Stock</th>
                                    <th>Cantidad</th>
                                    <th>Precio unitario</th>
                                    <th>Subtotal</th>
                                    <th>Acción</th>
                                </tr>

                                </thead>

                                <tbody id="detalleVenta">
                                <!--Contenido Ajax-->

                                </tbody>
                                <tfoot id="detalleTotales">

                                </tfoot>
                            </table>
                        </div>
                       
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" name="enviar" id="enviar" class="btn btn-sm btn-primary">Procesar pedido</button>
                                <a href="showPedido.php" class="btn btn-sm btn-danger">Cancelar pedido</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <?php
            include("../include/footer.php")
        ?>

    </div>
    <!-- /.content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<!-- Logout Modal-->
<!-- Scripts-->
<?php
include("../include/scroll.php");
include("../include/logoutModal.php");
include ("../include/scripts.php");
?>

<script>
    $(document).ready(function () {
        $("#id_producto").keyup(function (e) {
            e.preventDefault();

            var producto = $(this).val();
            var action = 'buscarProducto';

            if(producto){
                $.ajax({
                    url: 'ajax_producto.php',
                    type: "POST",
                    async: true,
                    data: ("p=" + producto+"&action="+action),
                    success: function (response) {
                        if(response != 'error'){
                            var info = JSON.parse(response);
                            //console.log(info);
                            $("#descripcion").html(info.descripcion);
                            $("#nombre").html(info.nombre);
                            $("#precio").html(info.precio);
                            $("#stock").html(info.stock);
                            $("#precioUnitario").html(info.precio);
                            $("#subTotal").html(info.precio);
                            $("#cantidad").val('1');
                            $("#cantidad").removeAttr('disabled');
                            $("#agregarProductoDetalle").slideDown();
                        }
                        else{
                            $("#nombre").html("-");
                            $("#descripcion").html("-");
                            $("#precio").html("-");
                            $("#stock").html("-");
                            $("#precioUnitario").html("0.00");
                            $("#subTotal").html("0.00");
                            $("#cantidad").val('0');
                            $("#cantidad").attr('disabled','disabled');
                            $("#agregarProductoDetalle").slideUp();
                        }
                    },

                    error: function (error) {

                    }
                });
            }
            else{
                $("#nombre").html("-");
                $("#descripcion").html("-");
                $("#precio").html("-");
                $("#stock").html("-");
                $("#precioUnitario").html("0.00");
                $("#subTotal").html("0.00");
                $("#cantidad").val('0');
                $("#cantidad").attr('disabled','disabled');
                $("#agregarProductoDetalle").slideUp();
            }
        });

        //Validar cantidad de producto antes de agregar
        $("#cantidad").keyup(function (e) {
            e.preventDefault();
            var precioTotal = $(this).val() * $('#precioUnitario').html();
            $("#subTotal").html(precioTotal);

            //Ocultar el boton Agregar si la cantidad es menor que 1
            var stock = parseInt($("#stock").html());
            if ($(this).val() > stock  || ($(this).val() < 1 || isNaN($(this).val())) ){
                $('#agregarProductoDetalle').slideUp();
            }
            else{
                $('#agregarProductoDetalle').slideDown();
            }
        });

        //Agregar el producto
        $("#agregarProductoDetalle").click(function (e) {
            e.preventDefault();
            if ($('#cantidad').val() > 0){
                var idProd = $("#id_producto").val();
                var cantidad = $("#cantidad").val();
                var subTotal = parseInt($("#subTotal").html());
                var action = 'addDetalleProducto';

                $.ajax({
                    url: 'ajax_producto.php',
                    type: "POST",
                    async: true,
                    data: ("action=" + action+"&idProd="+idProd+"&cantidad="+cantidad+"&subTotal="+subTotal),
                    success: function (response) {
                        if(response != 'error'){
                            var info = JSON.parse(response);
                            $('#detalleVenta').html(info.detalle);
                            $('#detalleTotales').html(info.totales);

                            $("#nombre").html("-");
                            $("#descripcion").html("-");
                            $("#precio").html("-");
                            $("#stock").html("-");
                            $("#precioUnitario").html("0.00");
                            $("#subTotal").html("0.00");
                            $("#cantidad").val('0');
                            $("#cantidad").attr('disabled','disabled');
                            $("#agregarProductoDetalle").slideUp();

                        }
                    },

                    error: function (error) {

                    }
                });
            }

        });


        $("#cliente").change(function (e) {
            e.preventDefault();
            var rfc = $(this).val();
            var action = 'getCliente';

            $.ajax({
                url: 'ajax_producto.php',
                type: "POST",
                async: true,
                data: ("action=" + action+"&rfc="+rfc),
                success: function (response) {
                    if(response != 'error'){

                        var info = JSON.parse(response);
                        console.log(info);

                    }
                },

                error: function (error) {

                }
            });


        });



    });//End Ready

    function getDetalle(){
        var action = 'getDetalle';

        $.ajax({
            url: 'ajax_producto.php',
            type: "POST",
            async: true,
            data: ("action=" + action),
            success: function (response) {
                if(response != 'error'){
                    var info = JSON.parse(response);
                    $('#detalleVenta').html(info.detalle);
                    $('#detalleTotales').html(info.totales);

                    $("#nombre").html("-");
                    $("#descripcion").html("-");
                    $("#precio").html("-");
                    $("#stock").html("-");
                    $("#precioUnitario").html("0.00");
                    $("#subTotal").html("0.00");
                    $("#cantidad").val('0');
                    $("#cantidad").attr('disabled','disabled');
                    $("#agregarProductoDetalle").slideUp();

                }
            },

            error: function (error) {

            }
        });
    }
</script>

<script>
    $(document).ready(function () {
        getDetalle();
    })
</script>

</body>

</html>
