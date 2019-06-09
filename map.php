<?php
  include "koneksi.php";

  $koneksi = new Koneksi();
  $h = $koneksi->connect();

  $iddata=$_GET['id'];
  $hasil=mysqli_query($h, "SELECT * from wisata where id_wisata = '$iddata'");
  $row = mysqli_fetch_assoc($hasil);
?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>Wisata Bantul</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS
    ================================================== -->
    <!-- <link rel="stylesheet" href="css/concept/style-concept.css"> -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendor/fonts/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">

    <link rel="stylesheet" href="css/style-skripsi.css">
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="css/main.css">

    <!-- script
    ================================================== -->
    <script src="js/modernizr.js"></script>
    <script src="js/pace.min.js"></script>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCj7R-T2Tg5aC93TvxH03x4LGTL_VZ1m38"></script>

</head>

<body id="top" style="margin-top: -60px;">

    <!-- preloader
    ================================================== -->
    <div id="preloader">
        <div id="loader" class="dots-jump">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- header
    ================================================== -->
    <header class="s-header" style="height: 64px;padding: 0px;margin: 0px;position:fixed">
        <div class="row" style="height: 64px;">
          <div class="header-logo" style="margin-top: 0px;">
            <a href="detail.php?id=<?php echo $row['id_wisata']; ?>" style="color:white">
              <i class="fas fa-arrow-left"></i>
            </a>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:white;white-space: nowrap;"><?php echo $row['nama_wisata'];  ?></span>
          </div>
        </div>
    </header> <!-- end header -->

    <input type="hidden" id="id_wisata" value="<?php echo $row['id_wisata'];  ?>"/>
    <section id="map-canvas" class="target-section heightWindow" style="padding-bottom:60px;">
        <div class="row wide about-desc" data-aos="fade-up">

        </div> <!-- end about-desc -->

    </section> <!-- end s-about -->
    <div style="float:left; margin-top:-80px; padding:0px; text-align:center" class="centerHorizontal sticky col-md-12">
      <div id="jarak" class="card centerHorizontal" style="width:200px;background-color:#000;color:white">
        ping
      </div>
    </div>
    <!-- footer
    ================================================== -->
    <footer class="s-footer footer" style="height:0px">
        <div class="row">
            <div class="col-md-12" style="text-align:center">
                <span>© Copyright Amin 2018</span>
            </div>

        </div> <!-- end footer__bottom -->

    </footer>


    <!-- Java Script
    ================================================== -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    <script src="js/style.js"></script>

    <script src="js/map/object/WisataBantul.js"></script>
    <script src="js/map/object/Lokasiku.js"></script>
    <script src="js/map/object/marker.js"></script>
    <script src="js/map/object/markers.js"></script>
    <script src="js/map/objects.js"></script>
    <script src="js/map/initial-map.js"></script>
    <script src="js/map/map-controller.js"></script>
    <script src="js/map/map-view.js"></script>

</body>
