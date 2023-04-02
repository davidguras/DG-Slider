<?php

if ( ! class_exists( 'DG_Slider_Post_Type' ) ) {
	class DG_Slider_Post_Type {
		public function __construct() {
			add_action( 'init', array( $this, 'create_post_type' ) );
			add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		}

		public function create_post_type(): void {
			register_post_type(
				'dg-slider',
				array(
					'label'               => 'Slider',
					'description'         => 'Sliders',
					'labels'              => array(
						'name'          => 'Sliders',
						'singular_name' => 'Slider',
					),
					'public'              => true,
					'supports'            => array( 'title', 'editor', 'thumbnail' ),
					'hierarchical'        => false,
					'show_ui'             => true,
					'show_in_menu'        => true,
					'menu_position'       => 5,
					'show_in_admin_bar'   => true,
					'show_in_nav_menus'   => true,
					'can_export'          => true,
					'has_archive'         => false,
					'exclude_from_search' => false,
					'publicly_queryable'  => true,
					'show_in_rest'        => true,
					'menu_icon'           => 'dashicons-images-alt2',
				)
			);
		}

		public function add_meta_boxes(): void {
			add_meta_box(
				'dg_slider_meta_box',
				'Link Options',
				array( $this, 'add_inner_meta_boxes' ),
				'dg-slider',
				'normal',
				'high',
			);
		}

		public function add_inner_meta_boxes( $post ): void {
		}
	}
}