<?php

if ( ! class_exists( "DG_Slider_Settings" ) ) {
	class DG_Slider_Settings {
		public static mixed $options;

		public function __construct() {
			self::$options = get_option( 'dg_slider_options' );
			add_action( 'admin_init', array( $this, 'admin_init' ) );
		}

		public function admin_init(): void {
			register_setting( 'dg_slider_group', 'dg_slider_options' );
			add_settings_section(
				'dg_slider_main_section',
				'How does it work?',
				null,
				'dg_slider_page1'
			);

			add_settings_field(
				'dg_slider_shortcode',
				'Shortcode',
				array( $this, 'dg_slider_shorcode_callback' ),
				'dg_slider_page1',
				'dg_slider_main_section'
			);
		}

		public function dg_slider_shorcode_callback(): void {
			?>
			<span>Use the shortcode <strong>[dg_slider]</strong> to display the slider on any page / post / widget</span>
			<?php
		}
	}
}