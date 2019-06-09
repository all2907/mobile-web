<?php
class Util
{

  function __construct()
  {

  }

  // euqualdian dst
  public function getdistance($vector1, $vector2)
  {
    $n = count($vector1);
    $lat = ($vector1['lat'] - $vector2['lat']) * ($vector1['lat'] - $vector2['lat']);
    $lng = ($vector1['lng'] - $vector2['lng']) * ($vector1['lng'] - $vector2['lng']);
    $sum = $lat+$lng;

    return sqrt($sum);
  }

// haversine
  public function distance($vector1, $vector2)
    {
      $earthRadius = 6371000;
      // convert from degrees to radians
      $latFrom = deg2rad($vector1['lat']);
      $lonFrom = deg2rad($vector1['lng']);
      $latTo = deg2rad($vector2['lat']);
      $lonTo = deg2rad($vector2['lng']);

      $latDelta = $latTo - $latFrom;
      $lonDelta = $lonTo - $lonFrom;

      $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
      cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
      return ($angle * $earthRadius)/1000;
    }

  public function jarakTitik($jlr){
      $jarak = 0;
      for($j=1;$j<(count($jlr)-3);$j++){
        $k = $j+1;

        $jalur = array();
        $jalur2 = array();
        $jalur = json_decode($jlr[$j]);
        $jalur2 = json_decode($jlr[$k]);

        $vector1 = array();
        $vector1['lat'] = $jalur[0];
        $vector1['lng'] = $jalur[1];

        $vector2 = array();
        $vector2['lat'] = $jalur2[0];
        $vector2['lng'] = $jalur2[1];

        $jarak = $jarak+$this->distance($vector2, $vector1);
      }
      return $jarak;
    }


    public function locToString($graph){
      $result = array();
      array_push($result, $graph['lat']);
      array_push($result, $graph['lng']);
      return json_encode($result);
    }
}
?>
