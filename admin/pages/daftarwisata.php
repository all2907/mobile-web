<?php
$jumlah = mysqli_num_rows(mysqli_query($h, "SELECT * from wisata"));
$banyak_data = floor($jumlah/5)+1;
$limit = 0;
if(isset($_GET["r"])){
  $active_list = $_GET["r"];
  $first = ($_GET["r"]*5);
  $limit = $first-5;
  $query_wisata = mysqli_query($h, "SELECT * from wisata
                                    ORDER BY wisata.nama_wisata ASC LIMIT 5 OFFSET ".$limit);
}else{
  if($banyak_data>1){
      $query_wisata = mysqli_query($h, "SELECT * from wisata
                                        ORDER BY wisata.nama_wisata ASC LIMIT 5");
    }else{
      $query_wisata = mysqli_query($h, "SELECT * from wisata
                                        ORDER BY wisata.nama_wisata ASC");
    }
}
if($query_wisata){
	$no = $limit;
}
?>
<div class="dashboard-ecommerce" style="
    min-height: 565px;">
  <div class="container-fluid dashboard-content ">
    <!-- ============================================================== -->
    <!-- pageheader  -->
    <!-- ============================================================== -->
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
          <h2 class="pageheader-title">Daftar Wisata </h2>
          <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
          <div class="page-breadcrumb">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Wisata</a></li>
                <li class="breadcrumb-item active" aria-current="page">Daftar Wisata</li>
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
            <h5 class="card-header">Wisata yang sudah ditambahkan</h5>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table">
                  <thead class="bg-light">
                    <tr class="border-0">
                      <th class="border-0 centerHorizontal" style="width:20px">No</th>
                      <th class="border-0">Nama Wisata</th>
                      <th class="border-0">Foto</th>
                      <th class="border-0">Alamat</th>
                      <th class="border-0">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while($row = $query_wisata->fetch_array()){
                      $no++;
                      ?>

                      <tr>
                        <td class="centerHorizontal">
                          <?php echo $no;?>
                        </td>
                        <td>
                          <?php echo $row['nama_wisata'];?>
                        </td>
                        <td>
                          <div class="m-r-10"><img src="../photos/<?php echo $row['foto'];?>" alt="<?php echo $row['foto'];?>" class="rounded" width="45"></div>
                        </td>
                        <td>
                          <?php echo $row['alamat_wisata'];?>
                        </td>
                        <td>
                          <a href="index.php?page=edit&id=<?php echo $row['id_wisata']?>">
                            <i class="fas fa-edit"></i>
                          </a> &nbsp;&nbsp;
                          <a href="#" onclick="hapusWisata('index.php?delete=<?php echo $row['id_wisata']; ?>')">
                            <i class="fas fa-trash"></i>
                          </a>
                        </td>
                      </tr>

                      <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="col-md-12">
                <nav aria-label="Page navigation">
                  <ul class="pagination">
                    <?php
                    if($banyak_data>1){
                      for($i=1;$i<=$banyak_data;$i++){
                        if(isset($active_list)){
                          if($active_list==$i){
                            echo '<li class="page-item active"><a class="page-link">'.$i.'</a></li>';
                          }else{
                            echo "<li class='page-item'><a class='page-link' href='?r=".$i."'>".$i."</a></li>";
                          }
                        }else{
                          if($i==1){
                            echo '<li class="active page-item"><a class="page-link">'.$i.'</a></li>';
                          }else{
                            echo "<li class='page-item'><a class='page-link' href='?r=".$i."'>".$i."</a></li>";
                          }
                        }
                      }
                    }
                    ?>
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
if (isset($_GET['delete'])) {
  $id=$_GET['delete'];
  $del=mysqli_query($h,"DELETE FROM wisata WHERE id_wisata = '$id'");
  if ($del) {
    ?>
    <script type="text/javascript">
    // alert("berhasil menghapus wisata");
    window.location.href="index.php";
    </script>
    <?php
  }else {
    ?>
    <script language="javascript">
    alert ("Wisata gagal Di Hapus"); document.location="index.php?page=toko";
    </script>
    <?php
  }
}
?>
<script>
function hapusWisata(url){
  var x = confirm("Apakah Anda ingin menghapus data ini?");
  if(x){
    window.location.href = url;
  }
}
</script>
