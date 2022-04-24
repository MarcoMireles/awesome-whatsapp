<?php
if (!function_exists('aws_wpp_options')){

	function aws_wpp_options(){


		$test = isset(Awesome_Whatsapp_Settings::$options['aws_wpp_number']) ? true : false;

		wp_enqueue_script( 'aws-wpp-scripts', AWESOME_WHATSAPP_URL . 'vendor/js/aws-wpp-scripts.js', array( 'jquery' ), AWESOME_WHATSAPP_VERSION, true );

		wp_localize_script('aws-wpp-scripts','TEST_DATA', array(
			'text' => $test
		) );

	}
}

if (!function_exists('aws_wpp_get_whatsapp_logo')) {
	function aws_wpp_get_whatsapp_logo()
	{
		return "<img src='".AWESOME_WHATSAPP_URL."assets/images/un.jpg' class='wp-post-image'>";
	}
}