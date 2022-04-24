<?php
/**
 * Plugin Name:  Awesome Whatsapp
 * Plugin URI:   https://marcode.tech/plugins/awesome-whatsapp
 * Description:  Show a whatsapp bubble on your website.
 * Version:      1.0
 * Requires at least: 5.6
 * Author:       Marco Mireles (MarCode)
 * Author URI:   https://marcomireles.com
 * License:      GPL2
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:  aws-wpp
 * Domain Path: /languages
 */

/**
Awesome Whatsapp is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Awesome Whatsapp is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Awesome Whatsapp. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 **/

if( ! defined( 'ABSPATH') ){
	exit;
}
if (!class_exists('Awesome_Whatsapp')){
	class Awesome_Whatsapp{

		function __construct(){
			$this->define_constants();
			$this->load_textdomain();

			require_once (AWESOME_WHATSAPP_PATH . 'functions/functions.php');

			add_action('admin_menu', array($this,'add_menu'));
//			add_action('wp_footer', array($this,'add_test'));

			require_once (AWESOME_WHATSAPP_PATH . 'class.aws-wpp-settings.php');
			$Awesome_Whatsapp_Settings = new Awesome_Whatsapp_Settings();

			require_once (AWESOME_WHATSAPP_PATH . 'shortcodes/class.aws-wpp-shortcode.php');
			$ASW_WPP_Shortcode = new ASW_WPP_Shortcode();


			add_action('wp_enqueue_scripts', array($this,'register_scripts'), 999);
			add_action('admin_enqueue_scripts', array($this,'register_admin_scripts'), 999);

			add_action('wp_footer',array($this,'show_awesome_whatsapp'),100);
		}

		public function define_constants(){
			define ('AWESOME_WHATSAPP_PATH',plugin_dir_path(__FILE__));
			define ('AWESOME_WHATSAPP_URL',plugin_dir_url(__FILE__));
			define ('AWESOME_WHATSAPP_VERSION','1.0.0');
		}

		public static function activate(){
//      flush_rewrite_rules();
			update_option('rewrite_rules','');
		}

		public static function deactivate(){
			flush_rewrite_rules();
		}

		public static function uninstall(){

		}

		public function load_textdomain(){
			load_plugin_textdomain(
				'mv-slider',
				false,
				dirname(plugin_dir_path(__FILE__)).'/languages',
            );
		}

		public function add_menu(){
			add_menu_page(
				esc_html__('Awesome Whatsapp Options','aws-wpp'),
				'Awesome Whatsapp',
				'manage_options',
				'aws_wpp_admin',
				array($this,'aws_wpp_settings_page'),
				'dashicons-whatsapp',
            );

		}

		public function aws_wpp_settings_page(){
			if (!current_user_can('manage_options')){
				return;
			}
			if (isset($_GET['settings-updated'])){
				add_settings_error('aws_wpp_options','aws_wpp_message',esc_html__('Settings Saved','aws-wpp'),'success');
			}
			settings_errors('aws_wpp_options');
			require_once (AWESOME_WHATSAPP_PATH . 'views/settings-page.php');
		}


		public function register_scripts(){
			wp_register_script( 'aws-wpp-scripts', AWESOME_WHATSAPP_URL . 'vendor/js/aws-wpp-scripts.js', array( 'jquery' ), AWESOME_WHATSAPP_VERSION, true );
			wp_register_style( 'aws-wpp-style-css', AWESOME_WHATSAPP_URL . 'assets/css/aws-wpp-styles.css', array(), AWESOME_WHATSAPP_VERSION, 'all' );


			wp_enqueue_style('aws-wpp-style-css');
		}

		public function register_admin_scripts(){

			if ( isset($_GET['page']) ) {
				if( $_GET['page'] == 'aws_wpp_admin'){
					wp_enqueue_style( 'aws-wpp-admin', AWESOME_WHATSAPP_URL . 'assets/css/admin.css',array(), 1.2, 'all' );
				}
			}

		}

		public function show_awesome_whatsapp(){
			echo do_shortcode('[aws-wpp]');
		}

	}
}

if (class_exists('Awesome_Whatsapp')){
	register_activation_hook(__FILE__, array('Awesome_Whatsapp','activate'));
	register_deactivation_hook(__FILE__, array('Awesome_Whatsapp','deactivate'));
	register_uninstall_hook(__FILE__, array('Awesome_Whatsapp','uninstall'));

	$aws_wpp = new Awesome_Whatsapp();
}