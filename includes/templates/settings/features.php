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
				<th><?php _e('Suggested post by SMS?', 'tikab-sms'); ?></th>
				<td>
					<input type="checkbox" name="wp_suggestion_status" id="wp_suggestion_status" <?php echo get_option('wp_suggestion_status') ==true? 'checked="checked"':'';?>/>
					<label for="wp_suggestion_status"><?php _e('Active', 'tikab-sms'); ?></label>
				</td>
			</tr>
			
			<tr>
				<td>
					<p class="submit">
						<input type="hidden" name="action" value="update" />
						<input type="hidden" name="page_options" value="wp_suggestion_status" />
						<input type="submit" class="button-primary" name="Submit" value="<?php _e('Update', 'tikab-sms'); ?>" />
					</p>
				</td>
			</tr>
		</form>	
	</table>
</div>