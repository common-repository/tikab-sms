<script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery('#wp_subscribes_send').click(function() {
			jQuery('#wp_subscribes_stats').fadeToggle();
		});
		
		jQuery('#wpsms-nrnu-stats').click(function() {
			jQuery('#wpsms-nrnu').fadeToggle();
		});
		
		jQuery('#wpsms-gnc-stats').click(function() {
			jQuery('#wpsms-gnc').fadeToggle();
		});
		
		jQuery('#wpsms-ul-stats').click(function() {
			jQuery('#wpsms-ul').fadeToggle();
		});
		
		jQuery('#wpsms-wc-no-stats').click(function() {
			jQuery('#wpsms-wc-no').fadeToggle();
		});
		
		jQuery('#wpsms-edd-no-stats').click(function() {
			jQuery('#wpsms-edd-no').fadeToggle();
		});
	});
</script>

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
			<tr valign="top">
				<th scope="row" colspan="2"><h3><?php _e('Wordpress Notifications', 'tikab-sms'); ?></h3></th>
			</tr>
			
			<tr>
				<th><?php _e('Published new posts', 'tikab-sms'); ?></th>
				<td>
					<input type="checkbox" name="wp_subscribes_send" id="wp_subscribes_send" <?php echo get_option('wp_subscribes_send') ==true? 'checked="checked"':'';?>/>
					<label for="wp_subscribes_send"><?php _e('Active', 'tikab-sms'); ?></label>
					<p class="description"><?php _e('Send a sms to subscribers When published new posts.', 'tikab-sms'); ?></p>
				</td>
			</tr>
			
			<?php if( get_option('wp_subscribes_send') ) { $hidden=""; } else { $hidden=" style='display: none;'"; }?>
			<tr valign="top"<?php echo $hidden;?> id='wp_subscribes_stats'>
				<td scope="row">
					<label for="wpsms-text-template"><?php _e('Text template', 'tikab-sms'); ?>:</label>
				</th>
				
				<td>
					<textarea id="wpsms-text-template" cols="50" rows="7" name="wp_sms_text_template"><?php echo get_option('wp_sms_text_template'); ?></textarea>
					<p class="description"><?php _e('Enter the contents of the sms message.', 'tikab-sms'); ?></p>
					<p class="description data">
						<?php _e('Input data:', 'tikab-sms'); ?>
						<?php _e('Title post', 'tikab-sms'); ?>: <code>%title_post%</code>
						<?php _e('URL post', 'tikab-sms'); ?>: <code>%url_post%</code>
						<?php _e('Date post', 'tikab-sms'); ?>: <code>%date_post%</code>
					</p>
				</td>
			</tr>
			
			<tr>
				<th><?php _e('The new release of WordPress', 'tikab-sms'); ?></th>
				<td>
					<input type="checkbox" name="wp_notification_new_wp_version" id="wp_notification_new_wp_version" <?php echo get_option('wp_notification_new_wp_version') ==true? 'checked="checked"':'';?>/>
					<label for="wp_notification_new_wp_version"><?php _e('Active', 'tikab-sms'); ?></label>
					<p class="description"><?php _e('Send a sms to you When the new release of WordPress.', 'tikab-sms'); ?></p>
				</td>
			</tr>
			
			<tr>
				<th><?php _e('Register a new user', 'tikab-sms'); ?></th>
				<td>
					<input type="checkbox" name="wpsms_nrnu_stats" id="wpsms-nrnu-stats" <?php echo get_option('wpsms_nrnu_stats') ==true? 'checked="checked"':'';?>/>
					<label for="wpsms-nrnu-stats"><?php _e('Active', 'tikab-sms'); ?></label>
					<p class="description"><?php _e('Send a sms to you When register a new wordpress user.', 'tikab-sms'); ?></p>
				</td>
			</tr>
			
			<?php if( get_option('wpsms_nrnu_stats') ) { $hidden=""; } else { $hidden=" style='display: none;'"; }?>
			<tr valign="top"<?php echo $hidden;?> id="wpsms-nrnu">
				<td scope="row">
					<label for="wpsms-nrnu-tt"><?php _e('Text template', 'tikab-sms'); ?>:</label>
				</th>
				
				<td>
					<textarea id="wpsms-nrnu-tt" cols="50" rows="7" name="wpsms_nrnu_tt"><?php echo get_option('wpsms_nrnu_tt'); ?></textarea>
					<p class="description"><?php _e('Enter the contents of the sms message.', 'tikab-sms'); ?></p>
					<p class="description data">
						<?php _e('Input data:', 'tikab-sms'); ?>
						<?php _e('Username', 'tikab-sms'); ?>: <code>%user_login%</code>
						<?php _e('User email', 'tikab-sms'); ?>: <code>%user_email%</code>
						<?php _e('Date register', 'tikab-sms'); ?>: <code>%date_register%</code>
					</p>
				</td>
			</tr>
			
			<tr>
				<th><?php _e('New comment', 'tikab-sms'); ?></th>
				<td>
					<input type="checkbox" name="wpsms_gnc_stats" id="wpsms-gnc-stats" <?php echo get_option('wpsms_gnc_stats') ==true? 'checked="checked"':'';?>/>
					<label for="wpsms-gnc-stats"><?php _e('Active', 'tikab-sms'); ?></label>
					<p class="description"><?php _e('Send a sms to you When get a new comment.', 'tikab-sms'); ?></p>
				</td>
			</tr>
			
			<?php if( get_option('wpsms_gnc_stats') ) { $hidden=""; } else { $hidden=" style='display: none;'"; }?>
			<tr valign="top"<?php echo $hidden;?> id="wpsms-gnc">
				<td scope="row">
					<label for="wpsms-gnc-tt"><?php _e('Text template', 'tikab-sms'); ?>:</label>
				</th>
				
				<td>
					<textarea id="wpsms-gnc-tt" cols="50" rows="7" name="wpsms_gnc_tt"><?php echo get_option('wpsms_gnc_tt'); ?></textarea>
					<p class="description"><?php _e('Enter the contents of the sms message.', 'tikab-sms'); ?></p>
					<p class="description data">
						<?php _e('Input data:', 'tikab-sms'); ?>
						<?php _e('Comment author', 'tikab-sms'); ?>: <code>%comment_author%</code>
						<?php _e('Comment author email', 'tikab-sms'); ?>: <code>%comment_author_email%</code>
						<?php _e('Comment author url', 'tikab-sms'); ?>: <code>%comment_author_url%</code>
						<?php _e('Comment author IP', 'tikab-sms'); ?>: <code>%comment_author_IP%</code>
						<?php _e('Comment date', 'tikab-sms'); ?>: <code>%comment_date%</code>
						<?php _e('Comment content', 'tikab-sms'); ?>: <code>%comment_content%</code>
					</p>
				</td>
			</tr>
			
			<tr>
				<th><?php _e('User login', 'tikab-sms'); ?></th>
				<td>
					<input type="checkbox" name="wpsms_ul_stats" id="wpsms-ul-stats" <?php echo get_option('wpsms_ul_stats') ==true? 'checked="checked"':'';?>/>
					<label for="wpsms-ul-stats"><?php _e('Active', 'tikab-sms'); ?></label>
					<p class="description"><?php _e('Send a sms to you When user is login.', 'tikab-sms'); ?></p>
				</td>
			</tr>
			
			<?php if( get_option('wpsms_ul_stats') ) { $hidden=""; } else { $hidden=" style='display: none;'"; }?>
			<tr valign="top"<?php echo $hidden;?> id="wpsms-ul">
				<td scope="row">
					<label for="wpsms-ul-tt"><?php _e('Text template', 'tikab-sms'); ?>:</label>
				</th>
				
				<td>
					<textarea id="wpsms-ul-tt" cols="50" rows="7" name="wpsms_ul_tt"><?php echo get_option('wpsms_ul_tt'); ?></textarea>
					<p class="description"><?php _e('Enter the contents of the sms message.', 'tikab-sms'); ?></p>
					<p class="description data">
						<?php _e('Input data:', 'tikab-sms'); ?>
						<?php _e('User login', 'tikab-sms'); ?>: <code>%user_login%</code>
						<?php _e('Display name', 'tikab-sms'); ?>: <code>%display_name%</code>
					</p>
				</td>
			</tr>
			
			<tr valign="top">
				<th scope="row" colspan="2"><h3><?php _e('Contact form 7 plugin', 'tikab-sms'); ?></h3></th>
			</tr>
			
			<tr>
				<th><?php _e('SMS meta box', 'tikab-sms'); ?></th>
				<td>
					<input type="checkbox" name="wps_add_wpcf7" id="wps_add_wpcf7" <?php echo get_option('wps_add_wpcf7') ==true? 'checked="checked"':'';?>/>
					<label for="wps_add_wpcf7"><?php _e('Active', 'tikab-sms'); ?></label>
					<p class="description"><?php _e('Added Wordpress SMS meta box to Contact form 7 plugin when enable this option.', 'tikab-sms'); ?></p>
				</td>
			</tr>
			
			<tr valign="top">
				<th scope="row" colspan="2"><h3><?php _e('WooCommerce plugin', 'tikab-sms'); ?></h3></th>
			</tr>
			
			<tr>
				<th><?php _e('New order', 'tikab-sms'); ?></th>
				<td>
					<input type="checkbox" name="wpsms_wc_no_stats" id="wpsms-wc-no-stats" <?php echo get_option('wpsms_wc_no_stats') ==true? 'checked="checked"':'';?>/>
					<label for="wpsms-wc-no-stats"><?php _e('Active', 'tikab-sms'); ?></label>
					<p class="description"><?php _e('Send a sms to you When get new order.', 'tikab-sms'); ?></p>
				</td>
			</tr>
			
			<?php if( get_option('wpsms_wc_no_stats') ) { $hidden=""; } else { $hidden=" style='display: none;'"; }?>
			<tr valign="top"<?php echo $hidden;?> id="wpsms-wc-no">
				<td scope="row">
					<label for="wpsms-wc-no-tt"><?php _e('Text template', 'tikab-sms'); ?>:</label>
				</th>
				
				<td>
					<textarea id="wpsms-wc-no-tt" cols="50" rows="7" name="wpsms_wc_no_tt"><?php echo get_option('wpsms_wc_no_tt'); ?></textarea>
					<p class="description"><?php _e('Enter the contents of the sms message.', 'tikab-sms'); ?></p>
					<p class="description data">
						<?php _e('Input data:', 'tikab-sms'); ?>
						<?php _e('Order ID', 'tikab-sms'); ?>: <code>%order_id%</code>
					</p>
				</td>
			</tr>
			
			<tr valign="top">
				<th scope="row" colspan="2"><h3><?php _e('Easy Digital Downloads plugin', 'tikab-sms'); ?></h3></th>
			</tr>
			
			<tr>
				<th><?php _e('New order', 'tikab-sms'); ?></th>
				<td>
					<input type="checkbox" name="wpsms_edd_no_stats" id="wpsms-edd-no-stats" <?php echo get_option('wpsms_edd_no_stats') ==true? 'checked="checked"':'';?>/>
					<label for="wpsms-edd-no-stats"><?php _e('Active', 'tikab-sms'); ?></label>
					<p class="description"><?php _e('Send a sms to you When get new order.', 'tikab-sms'); ?></p>
				</td>
			</tr>
			
			<?php if( get_option('wpsms_edd_no_stats') ) { $hidden=""; } else { $hidden=" style='display: none;'"; }?>
			<tr valign="top"<?php echo $hidden;?> id="wpsms-edd-no">
				<td scope="row">
					<label for="wpsms-edd-no-tt"><?php _e('Text template', 'tikab-sms'); ?>:</label>
				</th>
				
				<td>
					<textarea id="wpsms-edd-no-tt" cols="50" rows="7" name="wpsms_edd_no_tt"><?php echo get_option('wpsms_edd_no_tt'); ?></textarea>
					<p class="description"><?php _e('Enter the contents of the sms message.', 'tikab-sms'); ?></p>
				</td>
			</tr>

			<tr>
				<td>
					<p class="submit">
						<input type="hidden" name="action" value="update" />
						<input type="hidden" name="page_options" value="wp_subscribes_send,wp_sms_text_template,wp_notification_new_wp_version,wpsms_nrnu_stats,wpsms_nrnu_tt,wpsms_gnc_stats,wpsms_gnc_tt,wpsms_ul_stats,wpsms_ul_tt,wps_add_wpcf7,wpsms_wc_no_stats,wpsms_wc_no_tt,wpsms_edd_no_stats,wpsms_edd_no_tt" />
						<input type="submit" class="button-primary" name="Submit" value="<?php _e('Update', 'tikab-sms'); ?>" />
					</p>
				</td>
			</tr>
		</form>	
	</table>
</div>