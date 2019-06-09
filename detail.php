<?php
  include "koneksi.php";

  $koneksi = new Koneksi();
  $h = $koneksi->connect();

  $iddata=$_GET['id'];
  $hasil=mysqli_query($h, "SELECT * from wisata where id_wisata = '$iddata'");
  $query_foto_wisata = mysqli_query($h, "select * from foto_wisata where id_wisata= '$iddata'");
  $query_indicator = mysqli_query($h, "select * from foto_wisata where id_wisata= '$iddata'");
  $jumlah = mysqli_query($h, "select * from foto_wisata where id_wisata= '$iddata'");
  $row = mysqli_fetch_assoc($hasil);
  $jumlah_foto_wisata = $jumlah->num_rows;
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
    <!-- <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
    <header class="s-header" style="height: 64px;padding: 0px;margin: 0px;">
        <div class="row" style="height: 64px;">
          <div class="header-logo" style="margin-top: 0px;">
            <a href="index.php" style="color:white">
              <i class="fas fa-arrow-left"></i>
            </a>&nbsp;&nbsp;&nbsp;&nbsp;<span style="color:white;white-space: nowrap;"><?php echo $row['nama_wisata'];  ?></span>
          </div>
        </div>

    </header> <!-- end header -->

<!-- background-image: url('photos/<?php echo $row['foto'];  ?>'); -->
<!-- s-detail -->
    <section id="about" class="bg target-section">
        <div class="wide about-desc" data-aos="fade-up">
          <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <?php $no = 0; ?>
              <?php
              if($jumlah_foto_wisata==0){
                ?>
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <?php
              }else{
                while($x = $query_indicator->fetch_array()){
                  ?>
                  <li data-target="#myCarousel" data-slide-to="<?php echo $no; ?>" class="<?php if($no==0) echo"active" ?>"></li>
                  <?php
                  $no = $no+=1;
                }
              }
              ?>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">

              <?php $no = 0; ?>
              <?php
              if($jumlah_foto_wisata==0){
                ?>
                <div class="item active">
                  <section class="bg s-detail target-section" style="padding-bottom:60px;width:100%;background-image: url('images/no-images.png');"></section>
                  </div>
                </div>
                <?php
              }else{
                while($r = $query_foto_wisata->fetch_array()){
                  ?>
                  <div class="item <?php if($no==0) echo"active" ?>">
                    <section class="bg s-detail target-section" style="padding-bottom:60px;width:100%;background-image: url('photos/<?php echo $r['nama_foto'];  ?>');"></section>
                  </div>
                  <?php
                  $no = $no+=1;
                }
              }
              ?>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div> <!-- end about-desc -->

    </section> <!-- end s-about -->
    <section id="wisata" class="s-pricing target-section col-md-12" style="padding-top:50px">
      <div class="w-100" style="font-size:23px">
        <span class="centerHorizontal"><?php echo $row['nama_wisata'];  ?></span>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="w-100" style="font-size:14px;text-align:center">
            <span class="" ><?php echo $row['alamat_wisata'];  ?></span>
          </div>
          <div class="w-100" style="text-align:center;">
            <a href="map.php?id=<?php echo $row['id_wisata']; ?>" class="centerHorizontal btn btn-rounded btn-info col-md-4" style="padding:8px;border-radius:100px"><i class="fas fa-map marg10-right"></i> Menuju Lokasi</a>
          </div>
          <div class="w-100 marg30-top">
            <p style="text-align:justify">
              <?php echo $row['detail'];  ?>
            </p>
          </div>
        </div>
      </div>

    </section> <!-- end s-pricing -->


    <!-- footer
    ================================================== -->
    <!-- <footer class="s-footer footer" style="height:0px">
        <div class="row" style="padding-bottom:20px;padding-top:20px">
            <div class="col-md-12" style="text-align:center">
                <span>© Copyright Amin 2018</span>
            </div>

        </div>

    </footer> -->


    <!-- Java Script
    ================================================== -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    <script src="js/style.js"></script>

</body>
