<?php

    namespace Edgar;

    class PostType {

        public $slug = null;
        public $taxonomies = [];
        public $label = null;
        public $label_plural = null;
        public $description = null;
        public $public = false;
        public $publicly_queryable = false;
        public $exclude_from_search = false;
        public $show_ui = true;
        public $show_in_nav_menus = true;
        public $show_in_menu = true;
        public $show_in_admin_bar = false;
        public $show_in_rest = false;
        public $rest_base = false;
        public $menu_position = false;
        public $menu_icon = false;
        public $capability_type = 'post';
        public $capabilities = ['post'];
        public $map_meta_cap = false;
        public $hierarchical = false;
        public $supports = [ 'title' ];
        public $has_archive = false;
        public $rewrite = false;
        public $query_var = false;
        public $labels = [
            'name'               => '$0',
			'singular_name'      => '$1',
			'add_new'            => 'Add $1',
			'add_new_item'       => 'Adding $1',
			'edit_item'          => 'Edit $1',
			'new_item'           => 'New $1',
			'view_item'          => 'See $0',
			'search_items'       => 'Search $0',
			'not_found'          => 'Not Found',
			'parent_item_colon'  => '',
			'menu_name'          => '$0',
        ];

        function __construct($options = array()) {

            if(!empty($options)) {

                foreach($options as $key => $value) {
                    $this->{$key} = $value;
                }

                foreach($this->labels as $key => $value) {
                    $this->labels[$key] = str_replace(
                        ['$0', '$1'], 
                        [$this->label_plural, $this->label], 
                        $value
                    );
                }
            }

            add_action( 'init', [ $this, 'render' ] );

        }

        public function render() {
            register_post_type(
                $this->slug,
                [
                    'taxonomies'            => $this->taxonomies,
                    'label'                 => $this->label, 
                    'labels'                => $this->labels,
                    'description'           => $this->description,
                    'public'                => $this->public,
                    'publicly_queryable'    => $this->publicly_queryable,
                    'exclude_from_search'   => $this->exclude_from_search,
                    'show_ui'               => $this->show_ui,
                    'show_in_nav_menus'     => $this->show_in_nav_menus,
                    'show_in_menu'          => $this->show_in_menu,
                    'show_in_admin_bar'     => $this->show_in_admin_bar,
                    'show_in_rest'          => $this->show_in_rest,
                    'rest_base'             => $this->rest_base,
                    'menu_position'         => $this->menu_position,
                    'menu_icon'             => $this->menu_icon,
                    'capability_type'       => $this->capability_type,
                    'hierarchical'          => $this->hierarchical,
                    'supports'              => $this->supports,
                    'has_archive'           => $this->has_archive,
                    'rewrite'               => $this->rewrite,
                    'query_var'             => $this->query_var
                ]
            );

        }

    }