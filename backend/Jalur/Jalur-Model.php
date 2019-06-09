<?php
  class Model
  {
      public $result_graph; // berisi jalur didapat
      public $graph; // berisi seluruh data graph
      public $tujuan; // Berisi data wisata tujuan
      public $lokasiku; //titik lokasi pengguna
      public $result; //hasil untuk dideliver

      private $koneksi;

      public function __construct($koneksi){
          $this->result_graph = array();
          $this->graph = array();
          $this->tujuan = array();
          $this->lokasiku = array();
          $this->result = array();
          // $this->lokasi_tujuan = array();

          $this->koneksi = $koneksi;
      }

      public function setLokasiSaya($lat, $lng){
        $this->lokasiku['lat'] = $lat;
        $this->lokasiku['lng'] = $lng;
      }

      public function setTujuan($tujuan){
        $this->tujuan = $tujuan;
        // $this->lokasi_tujuan["lat"] = $tujuan["lat"];
        // $this->lokasi_tujuan["lng"] = $tujuan["lng"];
      }

      public function initGraph(){
        $query_graph = mysqli_query($this->koneksi, "SELECT * FROM graph");
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
          $temp_graph["lat2"] = $temp_point["coordinates"][1][0];
          $temp_graph["lng2"] = $temp_point["coordinates"][1][1];

          $jalur1 = array();
          $jalur1["lat"] = $temp_graph["lat"];
          $jalur1["lng"] = $temp_graph["lng"];

          $jalur2 = array();
          $jalur2["lat"] = $temp_graph["lat2"];
          $jalur2["lng"] = $temp_graph["lng2"];

          $temp_graph["jalur1"] = json_encode($temp_point["coordinates"][0]);
          $temp_graph["jalur2"] = json_encode($temp_point["coordinates"][1]);

          array_push($this->graph, $temp_graph);
        }
      }

  }
?>
