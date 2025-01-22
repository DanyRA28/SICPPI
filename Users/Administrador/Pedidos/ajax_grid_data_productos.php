<?php

//$Connector = new Connector();
$conn = mysqli_connect("localhost", "root", "", "sicppi");
$conn->set_charset("utf8");

// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;

$columns = array(
// datatable column index  => database column name
    0 => 'id_producto',
    1 => 'nombre',
    2 => 'descripcion',
    3 => 'precio',
    4 => 'stock',
    5 => 'id_departamento'
);

$sql = "SELECT productos.id_producto, productos.nombre, productos.descripcion, productos.precio, productos.stock, productos.id_departamento, departamentos.id_departamento, departamentos.nombre AS nomdep";
$sql.=" FROM departamentos INNER JOIN productos ON departamentos.id_departamento = productos.id_departamento";
$query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

if( !empty($requestData['search']['value']) ) {
    // if there is a search parameter
    $sql = "SELECT productos.id_producto, productos.nombre, productos.descripcion, productos.precio, productos.stock, productos.id_departamento, departamentos.id_departamento, departamentos.nombre AS nomdep";
    $sql.=" FROM departamentos INNER JOIN productos ON departamentos.id_departamento = productos.id_departamento";
    $sql.=" WHERE productos.nombre LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR productos.id_producto LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR productos.descripcion LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR productos.precio LIKE '%".$requestData['search']['value']."%' ";
    $sql.=" OR departamentos.nombre LIKE '%".$requestData['search']['value']."%' ";
    
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO");
    $totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query

    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO"); // again run query with limit

} else {
    $sql = "SELECT productos.id_producto, productos.nombre, productos.descripcion, productos.precio, productos.stock, productos.id_departamento, departamentos.id_departamento, departamentos.nombre AS nomdep";
    $sql.=" FROM departamentos INNER JOIN productos ON departamentos.id_departamento = productos.id_departamento";
    $sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
    $query=mysqli_query($conn, $sql) or die("ajax_grid_data.php: get PO");

}

$data = array();
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
    $nestedData=array();

    $nestedData[] = $row["id_producto"];//0
    $nestedData[] = $row["nombre"];//1
    $nestedData[] = $row["descripcion"];//2
    $nestedData[] = $row["precio"];//3
    $nestedData[] = $row["stock"];//4
    $nestedData[] = $row["nomdep"];//5
    $nestedData[] = '<td><center>
                        <button id="agregar_producto"><i class="fa fa-fw fa-plus"></i></button>
				     </center></td>';//6
    $nestedData[] = '<td><center>
                        <input type="text" id="cantidad" name="cantidad"  placeholder="Cantidad" >
				     </center></td>';//6

    $data[] = $nestedData;
}


$json_data = array(
    "draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
    "recordsTotal"    => intval( $totalData ),  // total number of records
    "recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
    "data"            => $data   // total data array
);

echo json_encode($json_data);  // send data as json format

?>