<script type="text/javascript">
	function openwin() {
		var url=document.form.wp_webservice.value;
		if(url==1) {
			document.location.href="<?php echo $sms_page['about']; ?>";
		}
	}
</script>

<style>
	p.register{
		float: <?php echo is_rtl() == true? "right":"left"; ?> 
	}
</style>

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
				<th><?php _e('Web Service', 'tikab-sms'); ?>:</th>
				<td><a href="http://panel.sms.tikab.org/" target="_blank"><?php _e('Tikab SMS', 'tikab-sms'); ?></a></td>
			</tr>
			
			<tr>
				<th><?php _e('Username', 'tikab-sms'); ?>:</th>
				<td>
					<input type="text" dir="ltr" style="width: 200px;" name="wp_username" value="<?php echo get_option('wp_username'); ?>"/>
					<p class="description"><?php _e('Your username in', 'tikab-sms'); ?>: <code>panel.sms.tikab.org</code></p>
				</td>
			</tr>

			<tr>
				<th><?php _e('Password', 'tikab-sms'); ?>:</th>
				<td>
					<input type="password" dir="ltr" style="width: 200px;" name="wp_password" value="<?php echo get_option('wp_password'); ?>"/>
					<p class="description"><?php _e('Your password in', 'tikab-sms'); ?>: <code>panel.sms.tikab.org</code></p>
				</td>
			</tr>

			<tr>
				<th><?php _e('Number', 'tikab-sms'); ?>:</th>
				<td>
					<input type="text" dir="ltr" style="width: 200px;" name="wp_number" value="<?php echo get_option('wp_number'); ?>"/>
					<p class="description"><?php _e('Your SMS sender number in', 'tikab-sms'); ?>: <code>panel.sms.tikab.org</code></p>
				</td>
			</tr>

			<tr>
				<th><?php _e('Credit', 'tikab-sms'); ?>:</th>
				<td>
				<?php global $obj; echo $obj->get_credit() . " " . $obj->unit; ?>
				</td>
			</tr>

			<tr>
				<th><?php _e('Status', 'tikab-sms'); ?>:</th>
				<td>
					<?php if($obj->get_credit()) { ?>
						<img src="<?php bloginfo('url'); ?>/wp-content/plugins/tikab-sms/images/1.png" alt="Active" align="absmiddle"/><span style="font-weight: bold;"><?php _e('Active', 'tikab-sms'); ?></span>
					<?php } else { ?>
						<img src="<?php bloginfo('url'); ?>/wp-content/plugins/tikab-sms/images/0.png" alt="Deactive" align="absmiddle"/><span style="font-weight: bold;"><?php _e('Deactive', 'tikab-sms'); ?></span>
					<?php } ?>
				</td>
			</tr>
			
			<tr>
				<td>
					<p class="submit">
						<input type="hidden" name="action" value="update" />
						<input type="hidden" name="page_options" value="wp_webservice,wp_username,wp_password,wp_number" />
						<input type="submit" class="button-primary" name="Submit" value="<?php _e('Update', 'tikab-sms'); ?>" />
					</p>
				</td>
			</tr>
		</form>	
	</table>
</div>