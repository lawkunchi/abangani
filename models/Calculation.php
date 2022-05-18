<?php
    class Calculation {

        public $containerArray;
        public $area;

        function __construct($containerArray, $area) {
            $this->containerArray = $containerArray;
            $this->area = $area;
        }

        function calculate() {
            $returnAray = [];

            $usedArea = 0;
            foreach($this->containerArray as $coKey => $coValue) {

                $containerArea = $coValue->area-$usedArea;
                $responseArray = $this->calculateTotalObjects($this->area, $containerArea);

                $returnAray[$coValue->name]['total'] = $responseArray['total'];
                $returnAray[$coValue->name]['totalRaw'] =  number_format((float)$responseArray['totalRaw'], 2, '.', '');

                if($returnAray[$coValue->name]['total'] <1) {
                    $usedArea  = 0;
                }
                else {
                    $usedArea = $containerArea-$this->area*$responseArray['total'];
                }
    
            }
            
           return $returnAray;
        }

        function calculateTotalObjects($area, $areaToCompare) {

            $returnAray['total'] = floor($area/$areaToCompare);
            $returnAray['totalRaw'] =$area/$areaToCompare;
            $returnAray['remeinder'] = $area%$areaToCompare;
            return $returnAray;
        }
    }
?>