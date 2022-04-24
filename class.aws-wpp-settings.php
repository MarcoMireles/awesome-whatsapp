<?php
if (!class_exists('Awesome_Whatsapp_Settings')){
	class Awesome_Whatsapp_Settings{
		public static $options;

		public function  __construct(){
			self::$options = get_option('aws_wpp_options');
			add_action('admin_init',array($this, 'admin_init'));
		}

		public function admin_init(){

			register_setting(
				'aws_wpp_group',
				'aws_wpp_options',
				array($this,'aws_wpp_validate')
			);

			add_settings_section(
				'aws_wpp_main_section',
				esc_html__('Keep it Simple','aws-wpp'),
				null,
				'aws_wpp_page1'
			);

			add_settings_section(
				'aws_wpp_second_section',
				esc_html__('Style plugin options','aws-wpp'),
				null,
				'aws_wpp_page2'
			);


			add_settings_field(
				'aws_wpp_number',
				esc_html__('Add whatsapp number','aws-wpp'),
				array($this,'aws_wpp_number_callback'),
				'aws_wpp_page1',
				'aws_wpp_main_section',
				array(
					'label_for' => 'aws_wpp_number'
				)
			);

			add_settings_field(
				'aws_wpp_popup_title',
				esc_html__('Add a title to the popup','aws-wpp'),
				array($this,'aws_wpp_popup_title_callback'),
				'aws_wpp_page1',
				'aws_wpp_main_section',
				array(
					'label_for' => 'aws_wpp_popup_title'
				)
			);

			add_settings_field(
				'aws_wpp_welcome_message',
				esc_html__('Add a welcome message','aws-wpp'),
				array($this,'aws_wpp_welcome_message_callback'),
				'aws_wpp_page1',
				'aws_wpp_main_section',
				array(
					'label_for' => 'aws_wpp_welcome_message'
				)
			);

			add_settings_field(
				'aws_wpp_default_message',
				esc_html__('Add a default message','aws-wpp'),
				array($this,'aws_wpp_default_message_callback'),
				'aws_wpp_page1',
				'aws_wpp_main_section',
				array(
					'label_for' => 'aws_wpp_default_message'
				)
			);

			add_settings_field(
				'aws_wpp_text_button',
				esc_html__('Add a text to the submit button','aws-wpp'),
				array($this,'aws_wpp_text_button_callback'),
				'aws_wpp_page1',
				'aws_wpp_main_section',
				array(
					'label_for' => 'aws_wpp_text_button'
				)
			);


		}

		public function aws_wpp_number_callback($args){
			?>
			<input
				type="number"
				name="aws_wpp_options[aws_wpp_number]"
				id="aws_wpp_number"
				value="<?php echo isset(self::$options['aws_wpp_number']) ? esc_attr(self::$options['aws_wpp_number']) : ''; ?>"
			>
			<?php
		}

		public function aws_wpp_popup_title_callback($args){
			?>
			<input
				type="text"
				name="aws_wpp_options[aws_wpp_popup_title]"
				id="aws_wpp_popup_title"
				value="<?php echo isset(self::$options['aws_wpp_popup_title']) ? esc_attr(self::$options['aws_wpp_popup_title']) : ''; ?>"
			>
			<?php
		}

		public function aws_wpp_welcome_message_callback($args){
			?>
			<textarea
				rows="4"
				name="aws_wpp_options[aws_wpp_welcome_message]"
				id="aws_wpp_welcome_message"><?php echo isset(self::$options['aws_wpp_welcome_message']) ? esc_attr(self::$options['aws_wpp_welcome_message']) : ''; ?></textarea>

			<?php
		}

		public function aws_wpp_default_message_callback($args){
			?>
			<textarea
				rows="4"
				name="aws_wpp_options[aws_wpp_default_message]"
				id="aws_wpp_default_message"><?php echo isset(self::$options['aws_wpp_default_message']) ? esc_attr(self::$options['aws_wpp_default_message']) : ''; ?></textarea>

			<?php
		}

		public function aws_wpp_text_button_callback($args){
			?>
			<input
				type="text"
				name="aws_wpp_options[aws_wpp_text_button]"
				id="aws_wpp_text_button"
				value="<?php echo isset(self::$options['aws_wpp_text_button']) ? esc_attr(self::$options['aws_wpp_text_button']) : ''; ?>"
			>
			<?php
		}


	}
}