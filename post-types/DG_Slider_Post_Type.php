<?php

if ( ! class_exists( 'DG_Slider_Post_Type' ) ) {
	class DG_Slider_Post_Type {
		public function __construct() {
			add_action( 'init', array( $this, 'create_post_type' ) );
			add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
			add_action( 'save_post', array( $this, 'save_post' ), 10, 2 );
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
			require_once( DG_SLIDER_PATH . 'views/DG_Slider_Metabox.php' );
		}

		public function save_post( $post_id ): void {
			// nonce is set and matching
			if ( isset( $_POST[ 'dg_slider_nonce' ] ) && ! wp_verify_nonce( $_POST[ 'dg_slider_nonce' ],
					'dg_slider_nonce' ) ) {
				return;
			}

			// autosave cannot save to the DB
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}

			// correct screen for custom post-type
			if ( isset( $_POST[ 'post_type' ] ) && $_POST[ 'post_type' ] === 'dg-slider' ) {
				// check if user can edit page
				if ( ! current_user_can( 'edit_page', $post_id ) ) {
					return;
				}

				// check if user can edit post
				if ( ! current_user_can( 'edit_post', $post_id ) ) {
					return;
				}
			}

			if ( isset( $_POST[ 'action' ] ) && $_POST[ 'action' ] === 'editpost' ) {
				$old_link_text = get_post_meta( $post_id, 'dg_slider_link_text', true );
				$new_link_text = sanitize_text_field( $_POST[ 'dg_slider_link_text' ] );
				$old_link_url  = get_post_meta( $post_id, 'dg_slider_link_url', true );
				$new_link_url  = sanitize_text_field( $_POST[ 'dg_slider_link_url' ] );

				if ( empty( $new_link_text ) ) {
					update_post_meta( $post_id, 'dg_slider_link_text', 'Add some text' );
				} else {
					update_post_meta( $post_id, 'dg_slider_link_text', $new_link_text, $old_link_text );
				}

				if ( empty( $new_link_url ) ) {
					update_post_meta( $post_id, 'dg_slider_link_url', '#' );
				} else {
					update_post_meta( $post_id, 'dg_slider_link_url', $new_link_url, $old_link_url );
				}
			}
		}
	}
}