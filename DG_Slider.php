<?php

/*
 * Plugin Name: DG Slider
 * Plugin URI: https://www.wordpress.org/mv-slider
 * Description: Plugin description
 * Version: 1.0
 * Requires at least: 5.6
 * Author: David Guras
 * Author URI: https://www.wordpress.org
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain: dg-slider
 * Domain Path: /languages
 */

/*
MV Slider is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

MV Slider is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with MV Slider. If not, see {URI to Plugin License}.
*/

// The following line prevents direct access to the plugin file.
defined( 'ABSPATH' ) or die( 'Direct access not allowed.' );

if ( ! class_exists( 'DG_Slider' ) ) {
	class DG_Slider {
		public function __construct() {
			$this->define_constants();
		}

		public function define_constants(): void {
			define( 'DG_SLIDER_PATH', plugin_dir_path( __FILE__ ) );
			define( 'DG_SLIDER_URL', plugin_dir_url( __FILE__ ) );
			define( 'DG_SLIDER_VERSION', '1.0.0' );
		}
	}
}

if ( class_exists( 'DG_Slider' ) ) {
	$dg_slider = new DG_Slider();
}