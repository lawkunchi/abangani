<?php
    class Container {

        public $name;
        public $length;
        public $width;

        function __construct($name, $width, $length) {
            $this->name = $name;
            $this->width = $width;
            $this->length = $length;
        }

        function getArea() {
            return $this->length *  $this->width;
        }
    }
?>