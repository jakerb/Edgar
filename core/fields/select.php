<?php

    namespace Edgar;

    class FieldTypeSelect extends BaseFieldType {

        function __construct() {

            $this->name = 'Select';
            $this->slug = 'select';
            $this->category = 'basic';
            $this->className = 'FieldTypeSelect';
            $this->properties = [
                [
                    'name' => 'Default Value',
                    'slug' => 'default_value',
                    'type' => 'text',
                    'required' => false,
                ],
                [
                    'name' => 'Choices',
                    'slug' => 'choices',
                    'type' => 'textarea',
                    'required' => true,
                    'instruction' => 'Enter each choice per line in the format value : key (red : Red Balloon)'
                ]
            ];

        }

    }

    add_filter('edgar/register/field_type', function($field_types) {
        $field_types[] = (new FieldTypeSelect());
        return $field_types;
    });