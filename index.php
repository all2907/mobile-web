<?php
  include "koneksi.php";

  $koneksi = new Koneksi();
  $h = $koneksi->connect();
  $query_wisata = mysqli_query($h, "SELECT * FROM wisata ORDER BY RAND() LIMIT 4");
  $query_allwisata = mysqli_query($h, "SELECT * from wisata")
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

<body id="top">

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
    <header class="s-header">
        <div class="row">
          <div class="header-logo">
            <a class="site-logo" href="#">
              <img src="images/baaantul.png" alt="Homepage" style="height:125px">
            </a>
          </div>

          <nav class="header-nav-wrap">
            <ul class="header-main-nav">
              <li><a class="smoothscroll" href="#about" title="about">Slideshow</a></li>
              <li><a class="smoothscroll" href="#tentang" title="features">Tentang</a></li>
              <li><a class="smoothscroll" href="#peta" title="features">Sebaran Wisata</a></li>
              <li><a class="smoothscroll" href="#wisata" title="pricing">Daftar Wisata</a></li>
            </ul>
          </nav> <!-- end header-nav-wrap -->

          <a class="header-menu-toggle" href="#"><span>Menu</span></a>
        </div>

    </header> <!-- end header -->


    <!-- about
    ================================================== -->
    <section id="about" class="s-about target-section" style="padding-bottom:60px;background-image: url('images/hero-bg.jpg');">
        <div class="row wide about-desc" data-aos="fade-up">

            <div class="col-full slick-slider about-desc__slider">
              <?php
              while($row = $query_wisata->fetch_array()){
                ?>
                <div class="about-desc__slide">
                  <div class="card">
                    <div class="card-body">
                      <div class="bg w-100 bg-card" style="background-image: url('photos/<?php echo $row['foto'];?>');">

                      </div>
                      <h4 class="card-title"><?php echo $row['nama_wisata'];?></h4>
                      <p class="card-text text-concat"><?php echo strip_tags($row['detail']);?></p>
                      <div class="w-100 kanan-text">
                        <a href="detail.php?id=<?php echo $row['id_wisata']; ?>" class="">Selengkapnya</a>
                      </div>
                    </div>
                  </div>
                </div>  <!-- end about-desc__slide -->

                <?php
              }
              ?>
            </div> <!-- end about-desc__slider -->

        </div> <!-- end about-desc -->

    </section> <!-- end s-about -->

    <!-- features
    ================================================== -->
    <section id="tentang" class="s-features target-section">

        <div class="row section-header has-bottom-sep" data-aos="fade-up">
            <div class="col-full">
                <h3 class="display-1">
                    Tentang Aplikasi
                </h3>
            </div>
        </div> <!-- end section-header -->

        <div class="row features block-1-3 block-m-1-2">
          <p class="lead tengah-text" data-aos="fade-up">
              Et nihil atque ex. Reiciendis et rerum ut voluptate. Omnis molestiae nemo est.
              Ut quis enim rerum quia assumenda repudiandae molestiae cumque qui. Amet repellat
              omnis ea.
          </p>
        </div> <!-- end features -->

    </section> <!-- end s-features -->

    <section id="peta" class="s-features target-section" style="background-color:#CCCCCC;padding:0px">
        <div class="w-100 heightWindow" id="map-canvas">
        </div>
    

    </section> <!-- end s-features -->


    <!-- pricing
    ================================================== -->
    <section id="wisata" class="s-pricing target-section col-md-12" style="padding-top:50px;padding-bottom:0px">
      <div class="row section-header has-bottom-sep" data-aos="fade-up">
          <div class="col-full">
              <h5 class="display-1" style="font-size:45px">
                  Daftar Wisata
              </h5>
          </div>
      </div> <!-- end section-header -->
      <div class="col-md-12">
        <table class="table table-hover" style="font-size:15px">
          <thead>
            <tr class="">
              <th scope="col">
                <div class="row">
                  Nama Wisata
                </div>
                </th>
              <th scope="col">Alamat</th>
              <th scope="col" style="width:50px"></th>
            </tr>
          </thead>
          <tbody id="listwisata">

          </tbody>
        </table>
      </div>

    </section> <!-- end s-pricing -->
    <section id="loadmore" class="w-100" style="background-color:white;padding-bottom:10px">
      <div id="btn_loadmore" class="btn btn-danger centerHorizontal">
        Load More...
      </div>
    </section>
    <section id="loading" class="w-100" style="background-color:white;padding-bottom:30px;visibility:hidden">
      <img width="60" class="centerHorizontal" src="images/loader.gif"/>
    </section>

    <!-- footer
    ================================================== -->
    <footer class="s-footer footer" style="height:0px;margin-top:40px">
        <div class="row" style="padding-bottom:20px">
          <div class="col-md-12" style="text-align:center">
              <span>© Copyright Amin 2018</span>
          </div>

        </div>

        <div class="go-top link-is-visible">
            <a class="smoothscroll" title="Back to Top" href="#top"></a>
        </div>

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
    <script src="js/map/wisata-view.js"></script>
</body>
<script>
function toDetailWisata(url){
  window.location.href = url;
}
</script>


<!-- <?php
while($row = $query_allwisata->fetch_array()){
  ?>
<tr class="pointer" onclick="toDetailWisata('detail.php?id=<?php echo $row['id_wisata']; ?>')">
  <td>
    <div class="row">
      <?php echo $row['nama_wisata'];?>
    </div>
  </td>
  <td>
    <?php echo $row['alamat_wisata'];?>
  </td>
  <td>
      <div style="margin-right:10px" class="m-r-10 centerVertical"><img src="photos/<?php echo $row['foto'];?>" alt="<?php echo $row['foto'];?>" class="rounded" width="50"></div>
  </td>
</tr>
<?php
}
?> -->
