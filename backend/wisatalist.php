<?php
  include "../koneksi.php";
  $koneksi = new Koneksi();
  $h = $koneksi->connect();

  if(isset($_POST["page"])){
    $first = ($_POST["page"]*5);
    $limit = $first-5;

    $query_wisata = mysqli_query($h, "SELECT * from wisata
                                      ORDER BY wisata.nama_wisata ASC LIMIT 5 OFFSET ".$limit);
    $jumlah = mysqli_query($h, "SELECT * from wisata
                                      ORDER BY wisata.nama_wisata ASC LIMIT 5 OFFSET ".$limit);
    $jumlah_data = $jumlah->num_rows;

    $wisatas = array();
    $result = array();

    if($jumlah_data>0){
      $result["code"] = 200;
      while ($row = $query_wisata->fetch_array(MYSQLI_ASSOC)) {
        $wisata = array();
        $wisata["id_wisata"] = $row["id_wisata"];
        $wisata["nama_wisata"] = $row["nama_wisata"];
        $wisata["lat"] = $row["lat"];
        $wisata["lng"] = $row["lng"];
        $wisata["alamat_wisata"] = $row["alamat_wisata"];
        $wisata["foto"] = $row["foto"];
        array_push($wisatas, $wisata);
      }
    } else {
      $result["code"] = 204;
    }
    $result["wisata"] = $wisatas;

    echo json_encode($result);
  }
?>
