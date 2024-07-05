<?php

    namespace Edgar;

    class FieldTypeText extends BaseFieldType {

        function __construct() {

            $this->name = 'Text';
            $this->slug = 'text';
            $this->category = 'basic';
            $this->className = 'FieldTypeText';
            $this->properties = [
                [
                    'name' => 'Default Value',
                    'slug' => 'default_value',
                    'type' => 'text',
                    'required' => false,
                ],
                [
                    'name' => 'Placeholder',
                    'slug' => 'placehlder',
                    'type' => 'text',
                    'required' => false
                ]
            ];

        }

    }

    add_filter('edgar/register/field_type', function($field_types) {
        $field_types[] = (new FieldTypeText());
        return $field_types;
    });