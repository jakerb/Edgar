<?php

    namespace Edgar;

    class EdgarLoader {

        protected   $menu = [];
        protected   $post_types = [];
        protected   $field_types = [];
        protected   $menus = [];
        public      $field_type_categories;

        function __construct() {

            $this->menu = [
                'title'                         => EDGAR_TEXT_NAME,
                'menu_title'                    => EDGAR_TEXT_NAME,
                'slug'                          => EDGAR_TEXT_DOMAIN,
                'options_page_template_path'    => EDGAR_ROOT_DIR . '/templates/mainMenu.php',
                'submenus'                      => []
            ];

            $this->register_post_types();
            $this->register_meta_boxes();
            $this->register_menu();

            $this->register_field_types();

        }

        public function register_field_types() {
            $this->field_types = apply_filters(EDGAR_TEXT_DOMAIN . '/register/field_type', array());
        }

        public function get_field_types() {
            return $this->field_types;
        }

        public function get_field_categories() {
            return (new FieldTypeCategories())->get_categories();
        }

        public function register_post_types() {

            $type = new PostType([
                'slug'              => EDGAR_TEXT_DOMAIN . '_component',
                'label'             => 'Component',
                'label_plural'      => 'Components',
                'show_ui'           => true,
                'show_in_nav_menus' => false,
                'show_in_menu'      => false,
                'show_in_admin_bar' => true
            ]);

            $this->menu['submenus'][] = [
                'label'         => $type->label_plural,
                'label_plural'  => $type->label_plural,
                'capability'    => 'manage_options',
                'menu_slug'     => 'edit.php?post_type=' . $type->slug,
                'callback'      => '',
                'position'      => 1
            ];

            $this->post_types['components'] = $type;

            $type = new PostType([
                'slug'              => EDGAR_TEXT_DOMAIN . '_partial',
                'label'             => 'Partial',
                'label_plural'      => 'Partials',
                'show_ui'           => true,
                'show_in_nav_menus' => false,
                'show_in_menu'      => false,
                'show_in_admin_bar' => true
            ]);

            $this->menu['submenus'][] = [
                'label'         => $type->label_plural,
                'label_plural'  => $type->label_plural,
                'capability'    => 'manage_options',
                'menu_slug'     => 'edit.php?post_type=' . $type->slug,
                'callback'      => '',
                'position'      => 2
            ];

            $this->post_types['partials'] = $type;

        }

        public function register_menu() {
            $this->menus['edgar'] = new OptionsPage($this->menu);
        }

        public function register_meta_boxes() {

            $this->meta_boxes['component_fields'] = new MetaBox(
                $title = 'Component Fields', 
                $slug = EDGAR_TEXT_DOMAIN . '_component_fields', 
                $template_path = EDGAR_ROOT_DIR . '/core/templates/templateEditor.php', 
                $post_types = array( $this->post_types['components']->slug )
            );
        }
    }