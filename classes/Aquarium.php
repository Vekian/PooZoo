<?php
    class Aquarium extends Fence {
        public static $types = ["Eau"];


        public function __construct (array $data){
            $this->hydrate($data);
        }
        public function hydrate ($data) {
            parent::hydrate($data);
        }
    }
?>