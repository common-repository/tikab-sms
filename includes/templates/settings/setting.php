<div class="wrap">
	<h2 class="nav-tab-wrapper">
		<a href="?page=tikab-sms/setting" class="nav-tab<?php if($_GET['tab'] == '') { echo " nav-tab-active";} ?>"><?php _e('General', 'tikab-sms'); ?></a>
		<a href="?page=tikab-sms/setting&tab=web-service" class="nav-tab<?php if($_GET['tab'] == 'web-service') { echo " nav-tab-active"; } ?>"><?php _e('Web Service', 'tikab-sms'); ?></a>
		<a href="?page=tikab-sms/setting&tab=newsletter" class="nav-tab<?php if($_GET['tab'] == 'newsletter') { echo " nav-tab-active"; } ?>"><?php _e('Newsletter', 'tikab-sms'); ?></a>
		<a href="?page=tikab-sms/setting&tab=features" class="nav-tab<?php if($_GET['tab'] == 'features') { echo " nav-tab-active"; } ?>"><?php _e('Features', 'tikab-sms'); ?></a>
		<a href="?page=tikab-sms/setting&tab=notification" class="nav-tab<?php if($_GET['tab'] == 'notification') { echo " nav-tab-active"; } ?>"><?php _e('Notification', 'tikab-sms'); ?></a>
	</h2>
	
	<table class="form-table">
		<form method="post" action="options.php" name="form">
			<?php wp_nonce_field('update-options');?>
			<tr>
				<td><?php _e('Your Mobile Number', 'tikab-sms'); ?>:</td>
				<td>
					<input type="text" dir="ltr" style="width: 200px;" name="wp_admin_mobile" value="<?php echo get_option('wp_admin_mobile'); ?>"/>
				</td>
			</tr>
			
			<tr>
				<td><?php _e('Your mobile country code', 'tikab-sms'); ?>:</td>
				<td>
					<input type="text" dir="ltr" style="width: 200px;" name="wp_sms_mcc" value="<?php echo get_option('wp_sms_mcc'); ?>"/>
					<p class="description"><?php _e('Enter your mobile country code. (For example: Iran 09, Australia 61)', 'tikab-sms'); ?></p>
				</td>
			</tr>
			
			<tr>
				<td>
					<p class="submit">
						<input type="hidden" name="action" value="update" />
						<input type="hidden" name="page_options" value="wp_admin_mobile,wp_sms_mcc" />
						<input type="submit" class="button-primary" name="Submit" value="<?php _e('Update', 'tikab-sms'); ?>" />
					</p>
				</td>
			</tr>
		</form>	
	</table>
</div>