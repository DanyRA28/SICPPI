<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("../include/head.php")
    ?>
    <title>DB Admin - PMI</title>
</head>

<body id="page-top">
<?php
session_start();
include("../include/navbar.php");
?>

<div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-folder"></i>
                <span>Información</span>
            </a>
              <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="../Productos/showProductos.php">Productos</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../Ventas/showVentas.php">Ventas</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="../User/showUser.php">Usuarios</a>
            
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
            <div class="row">
                <div class="col-md-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="../index.php">Inicio</a>
                        </li>
                        <li class="breadcrumb-item active">Mapas</li>
                    </ol>
                </div>
            </div>

            <!-- MAPA-->

            <div id="map" style="width:100%;height:70vh; position: relative;"></div>

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
include("../include/scripts.php");
?>

<script>
    var map;
    var panorama;
    var todos=0;
    var posicion;

    document.getElementById("sidebarToggle").click();

    function initMap() {

        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 20.6777639, lng: -103.3822003},
            zoom: 10,
            streetViewControl: false
        });

        var script = document.createElement('script');

        <?php
        if (isset($_GET["id_pmi"])){
            $id=$_GET["id_pmi"];
        ?>
            if(todos==1){
                script.src = 'GeoJson.php';
            }
            else{
                script.src = 'GeoJson.php?id=<?php echo($id);?>';
            }
        <?php
        }
        else{
        ?>
            script.src = 'GeoJson.php';
        <?php
        }
        ?>
        document.getElementsByTagName('head')[0].appendChild(script);

        panorama = map.getStreetView();

        panorama.setPov(/** @type {google.maps.StreetViewPov} */({
            heading: 265,
            pitch: 0
        }));
    }
    window.eqfeed_callback = function(results) {
        var infowindow;
        for (var i = 0; i < results.features.length; i++) {
            var coords = results.features[i].geometry.coordinates;
            var latLng = new google.maps.LatLng(coords[1],coords[0]);
            var nombre = results.features[i].properties.nombre;
            var colonia = results.features[i].properties.colonia;
            var deuda = results.features[i].properties.deuda;

            var marker = new google.maps.Marker({
                position: latLng,
                title: String(nombre),
                colonia: String(colonia),
                deuda: String(deuda),
                posicion: latLng,
                map: map,
            });

            google.maps.event.addListener(marker, 'click', function() {
                if (infowindow) {
                    infowindow.close();
                };
                makecontent(this);
            });
            google.maps.event.addListener(map, 'click', function() {
                if (infowindow) {
                    infowindow.close();
                };
            });
        }

        var contentString;
        function makecontent(marker) {
            posicion=marker.posicion;

            /*contentString =
                '<h6><b>ID PMI: </b>' + marker.title + '</h6>';
            for (j=0;j<marker.numcam;j++){
                cam=j+1;
                contentString += '<b>Camara ' + cam + ': ' + marker.camaras[j] + '</b><br>';
            }
            contentString += '<br>';
            contentString += '<a href="../Busqueda/search.php?id_pmi='+String(marker.title)+'" class="btn btn-outline-primary btn-sm mr-1" role="button"> Mas detalles </a>';
            contentString += '<button type="button" class="btn btn-outline-primary btn-sm" onclick="toggleStreetView()">StreetView</button>';*/
            contentString = "Nombre: "+ marker.title;
            contentString += '<br>';
            contentString += 'Colonia: '+marker.colonia;
            contentString += '<br>';
            contentString += 'Deuda: '+marker.deuda;

            infowindow = new google.maps.InfoWindow({
                content: contentString,
                maxWidth: 300
            });
            infowindow.open(map, marker);
        }

    }
    

    function toggleStreetView() {
        var toggle = panorama.getVisible();
        if (toggle == false) {
            panorama.setPosition(posicion);
            panorama.setVisible(true);
        } else {
            panorama.setVisible(false);
        }
    }

    function todo() {
        todos=1;
        initMap();
        //location.href ="Mapa.php";
    }

    function uno() {
        todos=0;
        initMap();
        //location.href ="Mapa.php";
    }


</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBl6mfoS8AE5woNLZSUdmVN5ZrSjM1WVn4&callback=initMap">
</script>



</body>

</html>
