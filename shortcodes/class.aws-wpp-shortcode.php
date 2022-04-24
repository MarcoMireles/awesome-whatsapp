<?php

if (!class_exists('ASW_WPP_Shortcode')){

	class ASW_WPP_Shortcode{

		public function __construct(){

//			add_action('wp_footer',array($this,'show_awesome_whatsapp'),100);
			add_shortcode('aws-wpp',array($this,'add_shortcode'));
		}
		public function add_shortcode($atts = array(), $content = null,$tag = ''){
			$atts = array_change_key_case((array) $atts,CASE_LOWER);

			ob_start();
			require (AWESOME_WHATSAPP_PATH . 'views/aws-wpp_shortcode.php');
			aws_wpp_options();
			return ob_get_clean();
		}

	}

}