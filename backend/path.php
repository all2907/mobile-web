<?php
include "../koneksi.php";
$array_graph = array();

$koneksi = new Koneksi();
$h = $koneksi->connect();
$query_graph = mysqli_query($h, "SELECT * FROM graph");
while ($row = $query_graph->fetch_array(MYSQLI_ASSOC)) {
  $temp_graph = array();
  $temp_graph["id"] = $row["id"];
  $temp_graph["simpul_awal"] = $row["simpul_awal"];
  $temp_graph["simpul_tujuan"] = $row["simpul_tujuan"];
  // $temp_graph["jalur"] = $row["jalur"];
  $temp_graph["bobot"] = $row["bobot"];
  $temp_point = json_decode($row["jalur"], true);
  $temp_graph["lat"] = $temp_point["coordinates"][0][0];
  $temp_graph["lng"] = $temp_point["coordinates"][0][1];
  // echo $temp_point["coordinates"][0][0];
  array_push($array_graph, $temp_graph);
}
echo json_encode($array_graph);
?>
