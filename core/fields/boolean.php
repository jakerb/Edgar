<?php

    namespace Edgar;

    class FieldTypeBoolean extends BaseFieldType {

        function __construct() {

            $this->name = 'Boolean';
            $this->slug = 'boolean';
            $this->category = 'basic';
            $this->className = 'FieldTypeBoolean';
            $this->properties = [
                [
                    'name' => 'Default Value',
                    'slug' => 'default_value',
                    'type' => 'checkbox',
                    'required' => false
                ]
            ];

        }

    }

    add_filter('edgar/register/field_type', function($field_types) {
        $field_types[] = (new FieldTypeBoolean());
        return $field_types;
    });