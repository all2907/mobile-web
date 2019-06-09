<?php
  include 'Util.php';
  require("algorithm/Dijkstra.php");

  class Controller
  {
      private $model;
      private $util;


      public function __construct($model){
          $this->model = $model;
          $this->util = new Util();
          $this->model->result_graph = array();
          $this->model->result = array();
      }

      public function getResult() {
        $this->result["tujuan"] = $this->model->tujuan;
        $this->result["jalur"] = $this->model->result_graph;
        $this->result["jarak"] = $this->getJarak($this->model->result_graph);
        return $this->result;
      }

      public function getJarak($jlr){
        $jarak = 0;
        for($j=1;$j<(count($jlr)-1);$j++){
          $k = $j+1;

          // $jalur = array();
          // $jalur2 = array();
          // $jalur = json_decode($jlr[$j]);
          // $jalur2 = json_decode($jlr[$k]);

          $vector1 = array();
          $vector1['lat'] = $jlr[$j][0];
          $vector1['lng'] = $jlr[$j][1];

          $vector2 = array();
          $vector2['lat'] = $jlr[$k][0];
          $vector2['lng'] = $jlr[$k][1];

          $jarak = $jarak+$this->util->distance($vector2, $vector1);
        }
        return $jarak;
      }


      public function prosesPembuatanJalur($user, $tujuan){
        $this->model->setLokasiSaya($user['lat'], $user['lng']);
        $this->model->setTujuan($tujuan);
        $this->model->initGraph();
        $this->buatJalur($tujuan);

        // echo json_encode($this->nearestPoint());
        // echo "".$this->nearestPoint()["id"];
      }

      // #2
      private function terdekatDariUser(){
        $jarak = 9999999;
        $result = array();
        for($a=0; $a<count($this->model->graph); $a++){
          $vector1['lat'] = $this->model->graph[$a]["lat"];
          $vector1['lng'] = $this->model->graph[$a]["lng"];

          $vector2['lat'] = $this->model->lokasiku["lat"];
          $vector2['lng'] = $this->model->lokasiku["lng"];
          if($this->util->distance($vector2, $vector1) < $jarak){
            $result = $this->model->graph[$a];
            $jarak = $this->util->distance($vector2, $vector1);
            // echo $result['id']."-asal-";
          }
        }
        // echo json_encode($result);
        return $result;
      }

      private function terdekatDariTujuan($tujuan){
        $jarak = 9999999;
        $result = array();
        for($a=0; $a<count($this->model->graph); $a++){
          $vector1['lat'] = $this->model->graph[$a]["lat"];
          $vector1['lng'] = $this->model->graph[$a]["lng"];

          $vector2['lat'] = $tujuan["lat"];
          $vector2['lng'] = $tujuan["lng"];
          if($this->util->distance($vector2, $vector1) < $jarak){
            $result = $this->model->graph[$a];
            // echo $result['id']."-tujuan-";
            $jarak = $this->util->distance($vector2, $vector1);
          }
        }
        return $result;
      }

      // #4
      // Membuat rute
      private function buatJalur($tujuan){

        $this->jalur = new Graph();
        // echo $this->util->parseTitik($this->model->titik_awal);
        $this->jalur->addedge("asal", $this->util->locToString($this->model->lokasiku),
                                      0);
        $this->jalur->addedge($this->util->locToString($this->model->lokasiku),
                                      $this->terdekatDariUser()['jalur1'],
                                      $this->util->distance($this->terdekatDariUser(), $this->model->lokasiku));


        for($a=0; $a<count($this->model->graph); $a++){
          $titikKedua = array();
          $titikKedua['lat'] = $this->model->graph[$a]['lat2'];
          $titikKedua['lng'] = $this->model->graph[$a]['lng2'];

          // echo $this->model->graph[$a]['jalur1']." ".$this->model->graph[$a]['jalur2']." ".$this->util->distance($this->model->graph[$a], $titikKedua);
          $this->jalur->addedge($this->model->graph[$a]['jalur1'],
                                            $this->model->graph[$a]['jalur2'],
                                            $this->util->distance($this->model->graph[$a], $titikKedua));
        }
        $this->jalur->addedge($this->terdekatDariTujuan($tujuan)['jalur1'],
                                      $this->util->locToString($tujuan),
                                      $this->util->distance($tujuan, $this->terdekatDariTujuan($tujuan)));
        $this->jalur->addedge($this->util->locToString($tujuan), "akhir", 0);
        $this->jalur->addedge("akhir", "akhir",0);

         list($distances, $prev) = $this->jalur->paths_from("asal");
	       $path = $this->jalur->paths_to($prev, "akhir");

        for($j=1;$j<(count($path)-1);$j++){
          array_push($this->model->result_graph, json_decode($path[$j]));
        }
      }
  }
?>
