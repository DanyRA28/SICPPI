<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Abarrotes RAGA</title>

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
include ("updateProductoP.php");
session_start();

if (isset($_GET["e"])){
    $error=$_GET["e"];
    if($error==1){
        echo "<div class='alert alert-danger alert-dismissable  mb-0'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Error al editar</div>";
    }
}


?>
 <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

<a class="navbar-brand mr-1" href="../index.php">Abarrotes RAGA</a>

<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
  <i class="fas fa-bars"></i>
</button>

<!-- Navbar Search -->


<!-- Navbar -->
<ul class="navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0">
  <li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-user-circle fa-fw"></i>
        <i><?php echo $_SESSION["nombre"] ?></i>
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
            <
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
    
        <li class="nav-item">
            <a class="nav-link" href="../Reportes/generarReporte.php">
                <i class="fas fa-fw fa-book"></i>
                <span>Reportes</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../Maps/Mapa.php">
                <i class="fas fa-fw fa-map"></i>
                <span>Mapas</span></a>
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
                    <a href="showProducto.php">Productos</a>
                </li>
                <li class="breadcrumb-item active">Editar</li>
            </ol>

            <!-- Registrar nuevo Producto-->
            <?php
            $conn = mysqli_connect("localhost", "root", "", "sicppi");
            $id = $_GET['id'];
            $sql = mysqli_query($conn, "SELECT * FROM productos WHERE id_producto='$id'");
            if(mysqli_num_rows($sql) == 0){
                header("Location:showProducto.php");
            }else{
                $row = mysqli_fetch_assoc($sql);
            }
            ?>
            <div class="card card-register mx-auto">
                <div class="card-header">Modificar nuevo producto</div>
                <div class="card-body">
                    <form action="updateProducto.php" method="post" name="formProductos">
                    
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="text" id="id" name="id" value="<?php echo $row['id_producto']; ?>" hidden="hidden">
                                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Producto" required value="<?php echo $row['nombre']; ?>">
                                        <label for="nombre">Nombre</label>
                                        <div id="checkuser" class=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                       
                                        <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Descripcion" required value="<?php echo $row['descripcion']; ?>">
                                        <label for="descripcion">Descripcion</label>
                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="number" step="0.01" id="precio" name="precio" class="form-control" placeholder="Precio" required value="<?php echo $row['precio']; ?>" >
                                        <label for="precio">Precio</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <input type="number" id="stock" name="stock" class="form-control" placeholder="Stock" required value="<?php echo $row['stock']; ?>" >
                                        <label for="stock">Stock</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                           
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <div class="form-label-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="id_departamento" >Departamento</label>
                                            </div>

                                            <?php
                                            $sql = mysqli_query($conn, "SELECT id_departamento FROM departamentos");
                                            $option = '';
                                            if(mysqli_num_rows($sql) == 0){
                                                header("Location: showProducto.php");
                                            }else{
                                                while($rows = mysqli_fetch_assoc($sql)){
                                                    if($row['id_departamento']==$rows['id_departamento']){
                                                        $option .= '<option value = "'.$rows['id_departamento'].'" selected="selected">'.$rows['id_departamento'].'</option>';
                                                    }
                                                    else{
                                                        $option .= '<option value = "'.$rows['id_departamento'].'">'.$rows['id_departamento'].'</option>';
                                                    }
                                                }
                                            }
                                            ?>
                                            <select class="custom-select" id="id_departamento" name="id_departamento" autofocus="autofocus" required>
                                                <?php echo $option; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" name="input" id="input" class="btn btn-sm btn-primary">Modificar</button>
                                <a href="showProducto.php" class="btn btn-sm btn-danger">Cancelar</a>
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


</body>

</html>
