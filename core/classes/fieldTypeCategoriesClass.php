<?php

    namespace Edgar;

    class FieldTypeCategories {
        public $category_slug = null;
        public $categories = [
            [
                'name' => 'Basic',
                'slug' => 'basic'
            ],
            [
                'name' => 'Relational',
                'slug' => 'relational'
            ]
        ];
        

        function __construct($category_slug = null) {
            if($category_slug) {
                $this->category_slug = $category_slug;
            }
        }

        public function get_category() {
            foreach($this->categories as $category) {
                if($category['slug'] == $this->category_slug) {
                    return $category;
                }
            }

            return null;
        }

        public function get_categories() {
            return $this->categories;
        }

    }