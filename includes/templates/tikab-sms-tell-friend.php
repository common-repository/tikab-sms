<span id="send_friend"><?php _e('Suggested by SMS', 'tikab-sms'); ?></span>
<form action="" method="post" id="tell_friend_form">
	<table width="100%">
		<tr>
			<td><label for="get_name"><?php _e('Your name', 'tikab-sms'); ?>:</label></td>
			<td><label for="get_fname"><?php _e('Your friend name', 'tikab-sms'); ?>:</label></td>
			<td><label for="get_fmobile"><?php _e('Your friend mobile', 'tikab-sms'); ?>:</label></td>
			<td></td>
		</tr>
		
		<tr>
			<td><input type="text" name="get_name" id="get_name"/></td>
			<td><input type="text" name="get_fname" id="get_fname"/></td>
			<td><input type="text" name="get_fmobile" id="get_fmobile" value="09"/></td>
			<td><input type="submit" name="send_post" value="<?php _e('Send', 'tikab-sms'); ?>"/></td>
		</tr>
	</table>
</form>