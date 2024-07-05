<?php
    /*
     * FieldClass
     * Used to construct editor fields
     */
    namespace Edgar;

    class FieldClass {

        public $id;
        public $components = array();
        public $name;
        public $slug;
        public $type;
        public $options = array();
        public $default;
        public $placeholder;
        public $value;
        public $conditional_logic = array();
        public $classes = array();
        public $ui_width = 100;
        public $ui_position = 0;

        function __construct($options = array()) {

            if(!empty($options)) {
                $this->init($options);
            }
        }

        private function init($options = array()) {
            foreach($options as $key => $value) {
                $this->{$key} = $value;
            }
        }

        public function toArray() {
            return get_object_vars($this);
        }

    }