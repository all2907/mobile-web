
<div class="dashboard-ecommerce">
  <div class="container-fluid dashboard-content ">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
          <h2 class="pageheader-title">Tambah Wisata </h2>
          <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Wisata</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Wisata</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- end pageheader  -->
    <!-- ============================================================== -->
    <div class="ecommerce-widget">
      <div class="row">
        <!-- ============================================================== -->

        <!-- ============================================================== -->

        <!-- recent orders  -->
        <!-- ============================================================== -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="card">
            <h5 class="card-header">Masukkan seluruh data dengan benar!</h5>
            <div class="card-body">
              <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Nama Wisata</label>
                  <input required name="nama" id="inputText3" type="text" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Alamat Wisata</label>
                  <input required name="alamat" type="text" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Latitude</label>
                  <input required name="latitude" type="number" step="any" class="form-control">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Longitude</label>
                  <input required name="longitude" type="number" step="any" class="form-control">
                </div>

                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Detail Informasi</label>
                  <textarea required name="detail" class="form-control" id="editor1" rows="3"></textarea>
                </div>
                <div class="custom-file mb-3">
                  <input required name="foto" type="file" class="custom-file-input" id="customFile">
                  <label class="custom-file-label" for="customFile">Masukkan gambar wisata</label>
                </div>
                <div class="custom-file mb-3">
                  <input type="submit" href="#" class="centerHorizontal btn btn-primary" value="Tambahkan"></a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php
  if(isset($_POST['nama']) && !empty($_FILES["foto"]["name"])){
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $detail = $_POST['detail'];

    $namaFile = $_FILES["foto"]["name"];
    $tmp_file = $_FILES['foto']['tmp_name'];
    $path = "../photos/".$namaFile;
    move_uploaded_file($tmp_file, $path);

    $hasil= mysqli_query($h, "INSERT INTO wisata(nama_wisata, alamat_wisata, detail, foto, lat, lng)
                              values('$nama','$alamat', '$detail', '$namaFile', '$latitude', '$longitude')");
    if($hasil){
        echo "
        <script>
          window.alert('Berhasil menambahkan data wisata');
          window.location='index.php'
        </script>";
      }else{
        echo "
        <script>
          window.alert('Gagal menambah wisata karena ".mysqli_error($h)."'');
        </script>";
        echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
      }
  }
?>
