<?php
/**
 * Plugin Name:       Visual User Description Editor
 * Description:       Replaces the user "Biographical Info" profile field with a TinyMCE visual editor.
 * Version:           1.1.1
 * Requires at least: 3.3
 * Requires PHP:      5.3
 * Author:            Kevin Leary, zwwuu
 * Author URI:        https://zwwuu.dev
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       visual_user_description_editor
 *
 * @package VUDE
 */

/*
This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

namespace VUDE;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'VUDE' ) ) {
	class VUDE {
		public function __construct() {
			if ( function_exists( 'wp_editor' ) ) {
				add_action( 'show_user_profile', array( $this, 'vude_load_visual_editor' ) );
				add_action( 'edit_user_profile', array( $this, 'vude_load_visual_editor' ) );
				add_action( 'admin_init', array( $this, 'vude_save_filters' ) );
			} else {
				add_action( 'admin_notices', array( $this, 'vude_notice_no_wp_editor' ) );
				add_action( 'admin_init', array( $this, 'vude_deactivate_self' ) );
			}
		}

		/**
		 * Deactivate self.
		 *
		 * @return void
		 */
		public function vude_deactivate_self() {
			deactivate_plugins( plugin_basename( __FILE__ ) );
		}

		/**
		 * Notice if wp_editor does not exists.
		 *
		 * @return void
		 */
		public function vude_notice_no_wp_editor() {
			?>
            <div class="notice notice-error">
                <p><strong>Visual User Description Editor</strong> plugin requires WordPress 3.3 or higher.</p>
            </div>
			<?php
			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}
		}

		/**
		 * Create the visual editor.
		 *
		 * @return void
		 */
		public function vude_load_visual_editor() {
			$use_visual_editor = current_user_can( 'edit_posts' );
			$use_visual_editor = apply_filters( 'vude_use_visual_editor', $use_visual_editor );
			$asset_file        = include( plugin_dir_path( __FILE__ ) . 'build/index.asset.php' );

			if ( ! $use_visual_editor ) {
				return;
			}

			wp_enqueue_editor();
			wp_enqueue_media();
			wp_enqueue_script(
				'visual-user-description-editor',
				plugins_url( 'build/index.js', __FILE__ ),
				$asset_file['dependencies'],
				$asset_file['version']
			);
		}

		/**
		 * Change pre_user_description filters to allow html code
		 *
		 * @return void
		 */
		public function vude_save_filters() {
			$use_visual_editor = current_user_can( 'edit_posts' );
			$use_visual_editor = apply_filters( 'vude_use_visual_editor', $use_visual_editor );

			if ( ! $use_visual_editor ) {
				return;
			}

			remove_filter( 'pre_user_description', 'wp_filter_kses' );
			add_filter( 'pre_user_description', 'wp_filter_post_kses' );
		}
	}

	new VUDE();
}
