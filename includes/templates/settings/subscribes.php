<script type="text/javascript">
	jQuery(document).ready(function() {
	
		jQuery('#doaction').click(function() {
			var action = jQuery('#action').val();
			
			if(action == 'trash') {
				var agree = confirm('<?php _e('Are you sure?', 'tikab-sms'); ?>');
				
				if(agree)
					return true;
				else
					return false;
			}
		})
	});
</script>

<?php function wpsms_group_pointer() { ?>
<script type="text/javascript">
jQuery(document).ready( function($) {
	$('#wpsms_groups').pointer({
		content: '<h3><?php _e('Group', 'tikab-sms'); ?></h3><p><?php _e('Outset Create group to better manage the subscribers.', 'tikab-sms'); ?></p>',
		position: {
			my: '<?php echo is_rtl() ? 'right':'left'; ?> top',
			at: 'center bottom',
			offset: '-25 0'
		},
		/*close: function() {
			setUserSetting('wpsms_p1', '1');
		}*/
	}).pointer('open');
});
</script>
<?php } ?>

<div class="wrap">
	<h2><?php _e('Members Newsletter', 'tikab-sms'); ?> (<?php echo $total . ' ' . __('Subscriber', 'tikab-sms'); ?>)</h2>
	<?php if(!$_GET['action'] == 'edit') { ?>
	<form action="" method="post">
		<table class="widefat fixed" cellspacing="0">
			<thead>
				<tr>
					<th id="cb" scope="col" class="manage-column column-cb check-column"><input type="checkbox" name="checkAll" value=""/></th>
					<th scope="col" class="manage-column column-name" width="30%"><?php _e('Register date', 'tikab-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="30%"><?php _e('Name', 'tikab-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="20%"><?php _e('Mobile', 'tikab-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="20%"><?php _e('Group', 'tikab-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="10%"><?php _e('Status', 'tikab-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="10%"><?php _e('Edit', 'tikab-sms'); ?></th>
				</tr>
			</thead>
		

			<tbody>
				<?php
				global $wpdb, $table_prefix;
				
				// Instantiate pagination object with appropriate arguments
				$pagesPerSection = 10;
				$options = array(25, "All");
				$stylePageOff = "pageOff";
				$stylePageOn = "pageOn";
				$styleErrors = "paginationErrors";
				$styleSelect = "paginationSelect";

				$Pagination = new Pagination($total, $pagesPerSection, $options, false, $stylePageOff, $stylePageOn, $styleErrors, $styleSelect);

				$start = $Pagination->getEntryStart();
				$end = $Pagination->getEntryEnd();

				// Retrieve MySQL data
				$get_result = $wpdb->get_results("SELECT * FROM `{$table_prefix}ts_subscribes` ORDER BY `{$table_prefix}ts_subscribes`.`ID` DESC  LIMIT {$start}, {$end}");

				if(count($get_result ) > 0)
				{
					foreach($get_result as $gets)
					{
						$i++;
				?>
				<tr class="<?php echo $i % 2 == 0 ? 'alternate':'author-self'; ?>" valign="middle" id="link-2">
					<th class="check-column" scope="row"><input type="checkbox" name="column_ID[]" value="<?php echo $gets->ID ; ?>" /></th>
					<td class="column-name"><?php echo $gets->date; ?></td>
					<td class="column-name"><?php echo $gets->name; ?></td>
					<td class="column-name"><?php echo $gets->mobile; ?></td>
					<td class="column-name">
						<?php
							$result = $wpdb->get_row("SELECT `name` FROM {$table_prefix}ts_subscribes_group WHERE `ID` = '{$gets->group_ID}'");
							
							echo $result->name;
						?>
					</td>
					<td class="column-name"><img src="<?php echo bloginfo('url') . '/wp-content/plugins/tikab-sms/images/' . $gets->status; ?>.png" align="middle"/></td>
					<td class="column-name"><a href="?page=tikab-sms/subscribe&action=edit&ID=<?php echo $gets->ID; ?>"><?php _e('Edit', 'tikab-sms'); ?></a></td>
				</tr>
				<?php
					}
				} else { ?>
					<tr>
						<td colspan="7"><?php _e('Not Found!', 'tikab-sms'); ?></td>
					</tr>
				<?php } ?>
			</tbody>

			<tfoot>
				<tr>
					<th id="cb" scope="col" class="manage-column column-cb check-column"><input type="checkbox" name="checkAll" value=""/></th>
					<th scope="col" class="manage-column column-name" width="30%"><?php _e('Register date', 'tikab-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="30%"><?php _e('Name', 'tikab-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="20%"><?php _e('Mobile', 'tikab-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="20%"><?php _e('Group', 'tikab-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="10%"><?php _e('Status', 'tikab-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="10%"><?php _e('Edit', 'tikab-sms'); ?></th>
				</tr>
			</tfoot>
		</table>

		<div class="tablenav">
			<div class="alignleft actions">
				<select name="action" id="action">
					<option selected="selected"><?php _e('Bulk Actions', 'tikab-sms'); ?></option>
					<option value="trash"><?php _e('Remove', 'tikab-sms'); ?></option>
					<option value="active"><?php _e('Active', 'tikab-sms'); ?></option>
					<option value="deactive"><?php _e('Deactive', 'tikab-sms'); ?></option>
				</select>
				<input value="<?php _e('Apply', 'tikab-sms'); ?>" name="doaction" id="doaction" class="button-secondary action" type="submit"/>
			</div>
			<br class="clear">
		</div>
	</form>
	
	<?php if($get_result) { ?>
	<div class="pagination-log">
		<?php echo $Pagination->display(); ?>
		<p id="result-log">
			<?php echo ' ' . __('Page', 'tikab-sms') . ' ' . $Pagination->getCurrentPage() . ' ' . __('From', 'tikab-sms') . ' ' . $Pagination->getTotalPages(); ?>
		</p>
	</div>
	<?php } ?>
	
	<?php if($get_group_result) : ?>
	<form action="" method="post">
		<table>
			<tr><td colspan="2"><h3><?php _e('Add new subscribe:', 'tikab-sms'); ?></h4></td></tr>
			<tr>
				<td><span class="label_td" for="wp_subscribe_name"><?php _e('Name', 'tikab-sms'); ?>:</span></td>
				<td><input type="text" id="wp_subscribe_name" name="wp_subscribe_name"/></td>
			</tr>

			<tr>
				<td><span class="label_td" for="wp_subscribe_mobile"><?php _e('Mobile', 'tikab-sms'); ?>:</span></td>
				<td><input type="text" name="wp_subscribe_mobile" id="wp_subscribe_mobile" class="code"/></td>
			</tr>
			
			<tr>
				<td><span class="label_td" for="wpsms_group_name"><?php _e('Group', 'tikab-sms'); ?>:</span></td>
				<td>
					<select name="wpsms_group_name" id="wpsms_group_name">
						<?php foreach($get_group_result as $items): ?>
						<option value="<?php echo $items->ID; ?>"><?php echo $items->name; ?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>

			<tr>
				<td colspan="2"><input type="submit" class="button-primary" name="wp_add_subscribe" value="<?php _e('Add', 'tikab-sms'); ?>" /></td>
			</tr>
		</table>
	</form>
	<?php endif; ?>
	
	<form action="" method="post">
		<table>
			<tr><td colspan="2"><h3 id="wpsms_groups"><?php _e('Add new Group:', 'tikab-sms'); ?></h4></td></tr>
			<tr>
				<td><span class="label_td" for="wpsms_group_name"><?php _e('Group name', 'tikab-sms'); ?>:</span></td>
				<td><input type="text" id="wpsms_group_name" name="wpsms_group_name"/></td>
			</tr>
			
			<tr>
				<td colspan="2"><input type="submit" class="button-primary" name="wpsms_add_group" value="<?php _e('Add', 'tikab-sms'); ?>" /></td>
			</tr>
		</table>
	</form>
	
	<?php if($get_group_result) : ?>
	<form action="" method="post">
		<table>
			<tr><td colspan="2"><h3><?php _e('Delete Group:', 'tikab-sms'); ?></h4></td></tr>
			<tr>
				<td><span class="label_td" for="wpsms_group_name"><?php _e('Group name', 'tikab-sms'); ?>:</span></td>
				<td>
					<select name="wpsms_group_name" id="wpsms_group_name">
						<?php foreach($get_group_result as $items): ?>
						<option value="<?php echo $items->ID; ?>"><?php echo $items->name; ?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
			
			<tr>
				<td colspan="2"><input type="submit" class="button-primary" name="wpsms_delete_group" value="<?php _e('Remove', 'tikab-sms'); ?>" /></td>
			</tr>
		</table>
	</form>
	<?php endif; ?>

	<?php } else { ?>

	<?php
		$get_result = $wpdb->get_results("SELECT * FROM {$table_prefix}ts_subscribes WHERE ID = '".$_GET['ID']."'");
	?>
	<form action="" method="post">
		<table>
			<tr><td colspan="2"><h3><?php _e('Edit subscribe:', 'tikab-sms'); ?></h4></td></tr>
			<tr>
				<td><span class="label_td" for="wp_subscribe_name"><?php _e('Name', 'tikab-sms'); ?>:</span></td>
				<td><input type="text" id="wp_subscribe_name" name="wp_subscribe_name" value="<?php echo $get_result[0]->name; ?>"/></td>
			</tr>

			<tr>
				<td><span class="label_td" for="wp_subscribe_mobile"><?php _e('Mobile', 'tikab-sms'); ?>:</span></td>
				<td><input type="text" name="wp_subscribe_mobile" id="wp_subscribe_mobile" class="code" value="<?php echo $get_result[0]->mobile; ?>"/></td>
			</tr>
			
			<tr>
				<td><span class="label_td" for="wpsms_group_name"><?php _e('Group name', 'tikab-sms'); ?>:</span></td>
				<td>
					<select name="wpsms_group_name" id="wpsms_group_name">
						<?php foreach($get_group_result as $items): ?>
						<option value="<?php echo $items->ID; ?>" <?php selected($get_result[0]->group_ID, $items->ID); ?>><?php echo $items->name; ?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>

			<tr>
				<td><span class="label_td" for="wp_subscribe_mobile"><?php _e('Status', 'tikab-sms'); ?>:</span></td>
				<td>
					<select name="wp_subscribe_status">
						<option value="1" <?php selected($get_result[0]->status, '1'); ?>><?php _e('Active', 'tikab-sms'); ?></option>
						<option value="0" <?php selected($get_result[0]->status, '0'); ?>><?php _e('Deactive', 'tikab-sms'); ?></option>
					</select>
				</td>
			</tr>

			<tr>
				<td colspan="2"><input type="submit" class="button-primary" name="wp_edit_subscribe" value="<?php _e('Edit', 'tikab-sms'); ?>" /></td>
			</tr>
		</table>
	</form>

	<h4><a href="<?php echo admin_url(); ?>admin.php?page=tikab-sms/subscribe"><?php _e('Back', 'tikab-sms'); ?></a></h4>
	
	<?php } ?>
</div>