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
				<th><?php _e('Register?', 'tikab-sms'); ?></th>
				<td>
					<input type="checkbox" name="wp_subscribes_status" id="wp_subscribes_status" <?php echo get_option('wp_subscribes_status') ==true? 'checked="checked"':'';?>/>
					<label for="wp_subscribes_status"><?php _e('Active', 'tikab-sms'); ?></label>
				</td>
			</tr>

			<tr>
				<th><?php _e('Send activation code via SMS?', 'tikab-sms'); ?></th>
				<td>
					<input type="checkbox" name="wp_subscribes_activation" id="wp_subscribes_activation" <?php echo get_option('wp_subscribes_activation') ==true? 'checked="checked"':'';?>/>
					<label for="wp_subscribes_activation"><?php _e('Active', 'tikab-sms'); ?></label>
				</td>
			</tr>
			
			<tr>
				<th><?php _e('Calling jQuery in Wordpress?', 'tikab-sms'); ?></th>
				<td>
					<input type="checkbox" name="wp_call_jquery" id="wp_call_jquery" <?php echo get_option('wp_call_jquery') ==true? 'checked="checked"':'';?>/>
					<label for="wp_call_jquery"><?php _e('Active', 'tikab-sms'); ?></label>
					<p class="description">(<?php _e('Enable this option with JQuery is called in the theme', 'tikab-sms'); ?>)</p>
				</td>
			</tr>
			
			<tr>
				<td>
					<p class="submit">
						<input type="hidden" name="action" value="update" />
						<input type="hidden" name="page_options" value="wp_subscribes_status,wp_subscribes_activation,wp_subscribes_send,wp_call_jquery" />
						<input type="submit" class="button-primary" name="Submit" value="<?php _e('Update', 'tikab-sms'); ?>" />
					</p>
				</td>
			</tr>
		</form>	
	</table>
</div>