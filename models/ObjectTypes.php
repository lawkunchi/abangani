<?php
    class ObjectTypes {

        public $type;

        function __construct($type) {
            $this->type = $type;
        }

        function getType() {
            return $this->type;
        }
    }
?>