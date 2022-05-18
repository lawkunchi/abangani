<?php

    class Square  {

        public $side;

        public function __construct($type, $side) {
            $this->type = $type;
            $this->side = $side;
        }

        public function area() {
            return $this->side * $this->side;
        }
    }
?>