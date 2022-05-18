<?php

@include('./models/ObjectTypes.php');
@include('./models/Circle.php');
@include('./models/Square.php');

@include('./models/Container.php');
@include('./models/Calculation.php');

    $containers  = [];
    $containersArray = array();
    $containersArray1 = array();

    $containersArra2 = array();
    $containersArray3 = array();
    
    $circle = new Circle('circle', '5');
    $square = new Square('square', '5');

    $containers[] = new Container('1 big container', 300, 200);
    $containers[] = new Container('1 small container', 100, 100);

    foreach ($containers as $key => $container) {
        $containersArray[$key] =  $container;
        $containersArray[$key]->area =  $container->getArea();
    }
    $area = array_column($containersArray, 'area');
    array_multisort($area, SORT_ASC, $containersArray);

    $containersArray1 = $containersArray;
    $area = array_column($containersArray1, 'area');
    array_multisort($area, SORT_DESC, $containersArray1);

    $containersArray2[] = $containers[1];

    $containersArray3[] = $containers[0];



    $transport = array();
    $transport[1]['name'] = "Transport 1";
    $transport[1]['objects'][] = new Circle('circle', '50');
    $transport[1]['objects'][]  = new Circle('circle', '100');
    $transport[1]['objects'][]  = new Square('sqaure', '100');

    $transport[2]['name'] = "Transport 2";
    $transport[2]['objects'][] = new Circle('circle', '100');
    $transport[2]['objects'][]  = new Square('sqaure', '400');

    $transport[3]['name'] = "Transport 3";
    $transport[3]['objects'][] = new Square('sqaure', '100');
    $transport[3]['objects'][]  = new Square('sqaure', '50');
    $transport[3]['objects'][]  = new Circle('circle', '50');


    function calculateTotalItems($area, $areaToCompare) {
        $returnAray['total'] = floor($area/$areaToCompare);
        $returnAray['totalRaw'] = $area/$areaToCompare;
        $returnAray['remeinder'] = $area%$areaToCompare;

        return $returnAray;
    }
    foreach($transport as $key => $value) {
        $totalArea = 0;
        foreach($value['objects'] as $valueKey => $objectValue) {
            $area = $objectValue->area();
            $transport[$key]['objects'][$valueKey]->area = $area;
            $totalArea += $area;
        }
        
        $calculation = new Calculation($containersArray, $totalArea);
        $transport[$key]['smallAndBig'] = $calculation->calculate();

        $calculation = new Calculation($containersArray1, $totalArea);
        $transport[$key]['bigAndSmall'] = $calculation->calculate();

        $calculation = new Calculation($containersArray2, $totalArea);
        $transport[$key]['small'] = $calculation->calculate();

        $calculation = new Calculation($containersArray3, $totalArea);
        $transport[$key]['big'] = $calculation->calculate();

        // var_dump($calculation->calculate()); die('xs');

    }


  //  var_dump($transport[2], $containersArray);
//    die('dsds');
?>

<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

.card:nth-child(odd) {
  background-color: #dddddd;

}
.card {
    display: flex; 
    justify-content: space-between;
  }
</style>
</head>
<body>


<h2>Transport Objects Table Contents</h2>
<h5>Abbreviation:  </br>
SWB : Starting With Big Container</br>
SWS : Starting With Small Container</br>

key: container_name|quantity(rounded or float)</h5>

<div class="card">

<div>
  <h5>Transport</h5>
  </div>



  <div>
  <h5>Small Container Only</h5>

  </div>

 <div>
    <h5>Big Container Only</h5>

 
 </div>

  <div>
          <h5>Mixed Containers SWB</h5>


  </div>
  
  <div>
    <h5>Mixed Containers SWS</h5>
          
  </div>
</div>
<?php foreach($transport as $key => $value): ?>



  <div class="card">

      <div>
          <h6><?php echo($value['name'])?></h6> </br>
        </div>



        <div>

          <?php foreach($value['small'] as $conatinerName => $conatinerValues): ?>
          <h6><?php echo($conatinerName." | ". $conatinerValues['total'] ); ?> (rounded) <br/>  
            or </br>
          <?php echo($conatinerName." | ". $conatinerValues['totalRaw'] ); ?> (float) </h6></br>
          <?php endforeach; ?>
        </div>

       <div>

          <?php foreach($value['big'] as $conatinerName => $conatinerValues): ?>
          <h6><?php echo($conatinerName."|". $conatinerValues['total'] ); ?>(rounded) <br/>  
            or </br>
          <?php echo($conatinerName." | ". $conatinerValues['totalRaw'] ); ?> (float) </h6>
          <?php endforeach; ?>
       </div>

        <div>

        <?php foreach($value['bigAndSmall'] as $conatinerName => $conatinerValues): ?>
        <h6><?php echo($conatinerName."|". $conatinerValues['total'] ); ?>(rounded) <br/>  
            or </br>
          <?php echo($conatinerName." | ". $conatinerValues['totalRaw'] ); ?> (float) </h6>
        <?php endforeach; ?>
        </div>
        
        <div>
          <?php foreach($value['smallAndBig'] as $conatinerName => $conatinerValues): ?>
          <h6><?php echo($conatinerName."|". $conatinerValues['total'] ); ?>(rounded) <br/>  
            or </br>
          <?php echo($conatinerName." | ". $conatinerValues['totalRaw'] ); ?> (float) </h6>
          <?php endforeach; ?>          
        </div>
  </div>
<?php endforeach; ?>

</body>
</html>

