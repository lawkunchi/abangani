<?php

    class Circle extends ObjectTypes {

        public $radius;

        public function __construct($type, $radius) {
            $this->type = $type;
            $this->radius = $radius;
        }

        public function area() {
            return $this->radius * 2;
        }
    }
?>