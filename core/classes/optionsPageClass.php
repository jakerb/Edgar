<?php

    namespace Edgar;

    class OptionsPage {

        public $title = null;
        public $menu_title = null;
        public $capability = 'manage_options';
        public $slug = null;
        public $options_page_template_path = null;
        public $icon = 'dashicons-images-alt2';
        public $position = 4;
        public $submenus = array();


        function __construct($options = array()) {

            foreach($options as $key => $value) {
                $this->{$key} = $value;
            }

            add_action( 'admin_menu', array( $this, 'render' ) );
        }

        public function render() {

            add_menu_page(
                __( $this->title, EDGAR_TEXT_DOMAIN ),
                __( $this->menu_title, EDGAR_TEXT_DOMAIN ),
                $this->capability,
                $this->slug,
                array( $this, 'render_options_page_template' ),
                $this->icon,
                $this->position
            );

            foreach($this->submenus as $item) {
                add_submenu_page(
                    $this->slug, 
                    $item['label_plural'], 
                    $item['label'],
                    $item['capability'],
                    $item['menu_slug'],
                    $item['callback'],
                    $item['position']
                );
            }

        }

        public function render_options_page_template() {
            if(file_exists($this->options_page_template_path)) {
                require $this->options_page_template_path;
            }
        }

    }