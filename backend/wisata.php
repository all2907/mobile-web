<?php
  include "../koneksi.php";
  $koneksi = new Koneksi();
  $h = $koneksi->connect();

  $query_wisata = mysqli_query($h, "SELECT * FROM wisata");
  $wisatas = array();
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

  echo json_encode($wisatas);
?>
