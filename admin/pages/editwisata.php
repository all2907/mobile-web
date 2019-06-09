
<?php
  $iddata=$_GET['id'];
  $hasil=mysqli_query($h, "SELECT * from wisata where id_wisata = '$iddata'");
  $row = mysqli_fetch_assoc($hasil);

  $gbr_wisata = mysqli_query($h, "select * from foto_wisata where id_wisata = '$iddata'");
  $jumlah_gbr_wisata = mysqli_num_rows(mysqli_query($h, "select * from foto_wisata where id_wisata = '$iddata'"));
?>


<div class="dashboard-ecommerce">
  <div class="container-fluid dashboard-content ">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
          <h2 class="pageheader-title">Edit Wisata </h2>
          <p class="pageheader-text"></p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php" class="breadcrumb-link">Wisata</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo $row["nama_wisata"];  ?></li>
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
                <input name="id" type="hidden" class="form-control" value="<?php echo $row['id_wisata'];  ?>">
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Nama Wisata</label>
                  <input required name="nama" id="inputText3" type="text" class="form-control" value="<?php echo $row['nama_wisata'];  ?>">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Alamat Wisata</label>
                  <input required name="alamat" type="text" class="form-control" value="<?php echo $row['alamat_wisata'];  ?>">
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Latitude</label>
                  <input required name="latitude" type="number" step="any" class="form-control" value="<?php echo $row['lat'];  ?>" />
                </div>
                <div class="form-group">
                  <label for="inputText3" class="col-form-label">Longitude</label>
                  <input required name="longitude" type="number" step="any" class="form-control" value="<?php echo $row['lng'];  ?>" />
                </div>

                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Detail Informasi</label>
                  <textarea required name="detail" class="form-control" id="editor1" rows="3"><?php echo $row["detail"];  ?></textarea>
                </div>
                <!-- <div class="custom-file mb-3">
                  <input name="foto" type="file" class="custom-file-input" id="customFile">
                  <label class="custom-file-label" for="customFile">Ubah gambar wisata</label>
                </div>
                <div class="w-12">
                  <img src="../photos/<?php echo $row['foto'];?>" alt="<?php echo $row['foto'];?>" class="rounded" width="80">
                </div> -->
                <div class="custom-file mb-3">
                  <input type="submit" href="#" class="col-xl-4 centerHorizontal btn btn-primary" value="Ubah"></a>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
          <div class="card">
            <h5 class="card-header">Foto - foto wisata</h5>
            <div class="card-body">
              <div class="w-100">
                <?php
                  if($jumlah_gbr_wisata>0){
                    while($r = $gbr_wisata->fetch_array()){
                    ?>
                    <div class="col-md-2" style="float:left">
                      <div class="w-100 heightRect bayang layout-img-icon bg" style="background-image: url('../photos/<?php echo $r['nama_foto'];?>');">
                        <div class="pointer heightParent widthParent layout-hapus" onclick="deleteFoto('deleteFoto.php?idwisata=<?php echo $r['id_wisata']?>&id=<?php echo $r['id_foto']; ?>')">
                          <div class="col-md-12 tengah-text" style="padding-top:60px"><b>HAPUS</b></div>
                        </div>
                      </div>
                    </div>
                    <?php
                    }
                  } else {
                    ?>
                      <span class="centerHorizontal">
                        Data belum ada
                      </span>
                    <?php
                  }
                ?>
              </div>
              <form action="" method="post" enctype="multipart/form-data">
                <input name="id_wisata" type="hidden" class="form-control" value="<?php echo $row['id_wisata'];  ?>">
                <div class="custom-file mb-3" style="margin-top:20px">
                  <input name="foto_wisata" type="file" class="custom-file-input" id="customFile">
                  <label class="custom-file-label" for="customFile" style="text-align:center">Klik untuk memilih gambar wisata</label>
                </div>
                <div class="custom-file mb-3">
                  <input type="submit" href="#" class="col-xl-4 centerHorizontal btn btn-primary" value="Tambahkan gambar"></a>
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
  if(isset($_POST['nama'])){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $detail = $_POST['detail'];

    if(!empty($_FILES["foto"]["name"])){
      $name_before = "../photos/".$row['foto'];
      if (file_exists($name_before)) {
        chmod($name_before,0777);
	      unlink($name_before);
      }

      $namaFile = $_FILES["foto"]["name"];
      $tmp_file = $_FILES['foto']['tmp_name'];
      $path = "../photos/".$namaFile;
      move_uploaded_file($tmp_file, $path);
      $hasil = mysqli_query($h, "UPDATE wisata SET nama_wisata = '".$nama."', alamat_wisata = '".$alamat."', detail = '".$detail."', foto = '".$namaFile."', lat = '".$latitude."', lng = '".$longitude."' WHERE id_wisata= ".$id);
    }else {
      $hasil = mysqli_query($h, "UPDATE wisata SET nama_wisata = '".$nama."', alamat_wisata = '".$alamat."', lat = '".$latitude."', lng = '".$longitude."', detail = '".$detail."' WHERE id_wisata= ".$id);
    }
    if($hasil){
        echo "
        <script>
          window.alert('Berhasil mengupdate data wisata');
          window.location='index.php';
        </script>";
        // echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
      }else{
        echo "
        <script>
          window.alert('Gagal menambah wisata karena ".mysqli_error($h)."'');
        </script>";
        // echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
      }
  } else if(isset($_POST['id_wisata'])){
    $id = $_POST['id_wisata'];
    $name_file = $_FILES["foto_wisata"]["name"];
    $type_file = end(explode('.',$name_file));
    $tmp_file = $_FILES['foto_wisata']['tmp_name'];
    $q_foto = mysqli_query($h, "select * from foto_wisata WHERE id_wisata= '$id'");
    $jml_foto = $q_foto->num_rows;
    $jml_foto = ++$jml_foto;
    $nama_file = $jml_foto."_".$id.".".$type_file;
    $path = "../photos/".$nama_file;

    if($jml_foto==1){
      mysqli_query($h, "UPDATE wisata SET foto = '".$nama_file."' WHERE id_wisata= ".$id);
    }

    if(move_uploaded_file($tmp_file, $path)){
    $q_foto = mysqli_query($h, "INSERT INTO foto_wisata(id_wisata, nama_foto)
      values('$id', '$nama_file')");
      if($q_foto){
        echo "
          <script>
          window.alert('Berhasil Upload Gambar');
          </script>";
        echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
      }else{
        echo "
          <script>
          window.alert('Gagal upload Gambar');
          </script>";
        echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]'>";
      }
  }else {
  echo "
   <script>
   window.alert('Gagal Upload');
   </script>";
  }
}
?>
