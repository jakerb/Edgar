<?php

    namespace Edgar;

    class MetaBox {

        public $metabox_template_path = null;
        public $screen = null;
        public $title = null;
        public $slug = null;
        public $path = '';
        public $context = 'advanced'; // normal, side, advanced
        public $priority = 'default'; // high, core, default, low
        public $callback_args = null;

        public $post_types = [];

        public $styles = [];
        public $scripts = [];
        public $localize_scripts = [];

        function __construct($title = null, $slug = null, $metabox_template_path = null, $post_types = array()) {
            $this->title = $title;
            $this->slug = $slug;
            $this->metabox_template_path = $metabox_template_path;
            $this->post_types = $post_types;

            $this->styles[] = [
                'slug' => EDGAR_TEXT_DOMAIN . '_metabox_style',
                'path' => plugin_dir_url( EDGAR_ROOT_PATH ) . '/resources/css/edgar.css'
            ];

            $this->scripts[] = [
                'slug' => EDGAR_TEXT_DOMAIN . '_angular',
                'path' => plugin_dir_url( EDGAR_ROOT_PATH ) . '/resources/js/angular-js/angular.min.js',
                'args' => array(),
                'version' => '1.8.2'
            ];

            $this->scripts[] = [
                'slug' => EDGAR_TEXT_DOMAIN . '_edgar_model_field',
                'path' => plugin_dir_url( EDGAR_ROOT_PATH ) . '/resources/js/edgar/field_model.js',
                'args' => array(),
                'version' => '1.0.0'
            ];

            $this->scripts[] = [
                'slug' => EDGAR_TEXT_DOMAIN . '_edgar_model_field_type',
                'path' => plugin_dir_url( EDGAR_ROOT_PATH ) . '/resources/js/edgar/field_type_model.js',
                'args' => array(),
                'version' => '1.0.0'
            ];

            $this->scripts[] = [
                'slug' => EDGAR_TEXT_DOMAIN . '_js',
                'path' => plugin_dir_url( EDGAR_ROOT_PATH ) . '/resources/js/edgar/edgar.js',
                'args' => array(),
                'version' => '1.0.0'
            ];

            $this->localize_scripts[] = [
                'slug' => EDGAR_TEXT_DOMAIN . '_js',
                'data' => [
                    'admin_url' => admin_url( 'admin-ajax.php' )
                ]
            ];

            $this->scripts[] = [
                'slug' => EDGAR_TEXT_DOMAIN . '_metabox_js',
                'path' => plugin_dir_url( EDGAR_ROOT_PATH ) . '/resources/js/edgar/metabox.js',
                'args' => array('jquery'),
                'version' => '1.0.0'
            ];

            add_action( 'admin_enqueue_scripts', array( $this, 'render_scripts' ) );
            add_action( 'admin_enqueue_scripts', array( $this, 'render_styles' ) );
            add_action( 'wp_ajax_' . EDGAR_TEXT_DOMAIN . '_fields', array( $this, 'get_fields_action' ) );
            add_action( 'wp_ajax_' . EDGAR_TEXT_DOMAIN . '_field_type', array( $this, 'get_field_types_action' ) );
            add_action( 'add_meta_boxes', [ $this, 'render' ] );

        }

        public function get_field_types_action() {
            global $edgar;
            echo json_encode(array(
                'success' => true,
                'field_types' => array_map(function($item) {

                    return $item->toArray();

                }, $edgar->get_field_types())
            ));

            die();
        }

        public function get_fields_action() {
            echo json_encode(array(
                'success' => true,
                'fields' => array()
            ));

            die();
        }

        public function render() {
            
            if(!empty($this->post_types)) {
                foreach($this->post_types as $post_type) {
                    add_meta_box(
                        $this->slug,
                        $this->title,
                        array($this, 'render_metabox_template'),
                        $post_type
                    );
                }
            }
        }

        public function render_metabox_template() {
            if(file_exists($this->metabox_template_path)) {
                require $this->metabox_template_path;
            }
        }

        public function render_styles($hook) {
            if (!in_array($hook, array('post.php', 'post-new.php'))) { return; }

            if(!empty($this->styles)) {
                foreach($this->styles as $item) {
                    wp_enqueue_style(
                        $item['slug'],
                        $item['path'] 
                    );
                }
            }

            return $hook;
        }

        public function render_scripts($hook) {
            
            if (!in_array($hook, array('post.php', 'post-new.php'))) { return; }

            global $post;

            if(!empty($this->scripts)) {
                foreach($this->scripts as $item) {
                    wp_enqueue_script(
                        $item['slug'],
                        $item['path'],
                        $item['args'],
                        $item['version']
                    );
                }
            }

            if(!empty($this->localize_scripts)) {
                foreach($this->localize_scripts as $item) {

                    $item['data']['post_id'] = is_object($post) ? $post->ID : null;

                    wp_localize_script(
                        $item['slug'],
                        $item['slug'],
                        $item['data']
                    );
                }
            }

            return $hook;
        }

    }