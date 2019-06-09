<?php
  include "../koneksi.php";
  include "Jalur/Jalur-Controller.php";
  include "Jalur/Jalur-Model.php";

  $koneksi = new Koneksi();
  $h = $koneksi->connect();

  $model = new Model($h);
  $controller = new Controller($model);

  if(isset($_POST["lokasiku"]) && isset($_POST["id_tujuan"])){
    $iddata = $_POST['id_tujuan'];
    $hasil = mysqli_query($h, "SELECT * from wisata where id_wisata = '$iddata'");
    $row = mysqli_fetch_assoc($hasil);

    $wisatas = array();
    $wisatas["id_wisata"] = $row["id_wisata"];
    $wisatas["nama_wisata"] = $row["nama_wisata"];
    $wisatas["alamat_wisata"] = $row["alamat_wisata"];
    $wisatas["detail"] = $row["detail"];
    $wisatas["foto"] = $row["foto"];
    $wisatas["lat"] = $row["lat"];

    $wisatas["lng"] = $row["lng"];

    $user = json_decode($_POST["lokasiku"], true);
    // echo json_decode($controller->getWisata($row), true);
    $controller->prosesPembuatanJalur($user, $row);

    $result = array();
    $result["tujuan"] = $row;
    $result["jalur"] = $model->result_graph;

    echo json_encode($controller->getResult());
  }
?>
