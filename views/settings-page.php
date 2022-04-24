<div id="aws-wpp-container" class="wrap">
	<h1><?php echo esc_html(get_admin_page_title());?></h1>
	<?php
	$actve_tab = isset($_GET['tab']) ? $_GET['tab'] : 'main_options';
	?>
	<h2 class="nav-tab-wrapper">
		<a href="?page=aws_wpp_admin&tab=main_options" class="nav-tab <?php echo $actve_tab == 'main_options' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Main Options','aws_wpp') ?></a>
		<a href="?page=aws_wpp_admin&tab=additional_options" class="nav-tab <?php echo $actve_tab == 'additional_options' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('Additional Options','aws_wpp') ?></a>
	</h2>
	<form action="options.php" method="post">

		<?php
		if ($actve_tab == 'main_options'){
			settings_fields('aws_wpp_group');
			do_settings_sections('aws_wpp_page1');
		}else{
			settings_fields('aws_wpp_group');
			do_settings_sections('aws_wpp_page2');
		}


		submit_button(esc_html__('Save Settings','aws_wpp'));
		?>

	</form>
</div>