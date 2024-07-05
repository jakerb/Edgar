<?php

    namespace Edgar;

    class BaseFieldType {
        public $name;
        public $slug;
        public $properties = array();
        public $category = 'basic';
        public $className;
        public $type_category = null;

        function __construct() {

        }   

        function toArray() {
            $this->type_category = (new FieldTypeCategories($this->category))->get_category();
            return get_object_vars($this);
        }

    }