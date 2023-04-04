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

			add_settings_section(
				'dg_slider_second_section',
				'Other Plugin Options',
				null,
				'dg_slider_page2'
			);

			add_settings_field(
				'dg_slider_shortcode',
				'Shortcode',
				array( $this, 'dg_slider_shorcode_callback' ),
				'dg_slider_page1',
				'dg_slider_main_section'
			);

			add_settings_field(
				'dg_slider_title',
				'Slider Title',
				array( $this, 'dg_slider_title_callback' ),
				'dg_slider_page2',
				'dg_slider_second_section',
				array(
					'label_for' => 'dg_slider_title',
				)
			);

			add_settings_field(
				'dg_slider_bullets',
				'Display Bullets',
				array( $this, 'dg_slider_bullets_callback' ),
				'dg_slider_page2',
				'dg_slider_second_section',
				array(
					'label_for' => 'dg_slider_bullets',
				)
			);

			add_settings_field(
				'dg_slider_style',
				'Slider Style',
				array( $this, 'dg_slider_style_callback' ),
				'dg_slider_page2',
				'dg_slider_second_section',
				array(
					'items'     => array(
						'style-1',
						'style-2',
					),
					'label_for' => 'dg_slider_style',
				)
			);
		}

		public function dg_slider_shorcode_callback(): void {
			?>
			<span>Use the shortcode <strong>[dg_slider]</strong> to display the slider on any page / post / widget</span>
			<?php
		}

		public function dg_slider_title_callback(): void {
			?>
			<input
				type="text"
				name="dg_slider_options[dg_slider_title]"
				id="dg_slider_title"
				value="<?= esc_attr( self::$options[ 'dg_slider_title' ] ?? '' ) ?>"
			/>
			<?php
		}

		public function dg_slider_bullets_callback(): void {
			?>
			<input
				type="checkbox"
				name="dg_slider_options[dg_slider_bullets]"
				id="dg_slider_bullets"
				value="1"
				<?php
				if ( isset( self::$options[ 'dg_slider_bullets' ] ) ) {
					checked( "1", self::$options[ 'dg_slider_bullets' ], );
				}
				?>
			/>
			<label for="dg_slider_bullets">Display bullets</label>
			<?php
		}

		public function dg_slider_style_callback( $args ): void {
			?>
			<select
				id="dg_slider_style"
				name="dg_slider_options[dg_slider_style]">
				<?php
				foreach ( $args[ 'items' ] as $item ): ?>
					<option value="<?= esc_attr( $item ) ?>"
						<?php
						isset( self::$options[ 'dg_slider_style' ] )
							? selected( $item, self::$options[ 'dg_slider_style' ], true )
							: '';
						?>
					>
						<?= esc_html( ucfirst( $item ) ) ?>
					</option>
				<?php
				endforeach; ?>
			</select>
			<?php
		}
	}
}