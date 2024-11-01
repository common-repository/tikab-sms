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

<div class="wrap">
	<h2><?php _e('Posted SMS', 'tikab-sms'); ?> (<?php echo $total . ' ' . __('SMS', 'tikab-sms'); ?>)</h2>
	<form action="" method="post">
		<table class="widefat fixed" cellspacing="0">
			<thead>
				<tr>
					<th id="cb" scope="col" class="manage-column column-cb check-column"><input type="checkbox" name="checkAll" value=""/></th>
					<th scope="col" class="manage-column column-name" width="10%"><?php _e('Post Date', 'tikab-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="10%"><?php _e('Sender', 'tikab-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="50%"><?php _e('Message', 'tikab-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="30%"><?php _e('Recipient', 'tikab-sms'); ?></th>
				</tr>
			</thead>
			
			<tbody>
				<?php
				
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
				$get_result = $wpdb->get_results("SELECT * FROM `{$table_prefix}ts_send` ORDER BY `{$table_prefix}ts_send`.`ID` DESC  LIMIT {$start}, {$end}");

				if(count($get_result ) > 0)
				{
					foreach($get_result as $gets)
					{
						$i++;
				?>
				<tr class="<?php echo $i % 2 == 0 ? 'alternate':'author-self'; ?>" valign="middle" id="link-2">
					<th class="check-column" scope="row"><input type="checkbox" name="column_ID[]" value="<?php echo $gets->ID ; ?>" /></th>
					<td class="column-name"><?php echo $gets->date; ?></td>
					<td class="column-name"><?php echo $gets->sender; ?></td>
					<td class="column-name"><?php echo $gets->message; ?></td>
					<td class="column-name"><?php echo $gets->recipient; ?></td>
				</tr>
				<?php
					}
				} else { ?>
					<tr>
						<td colspan="5"><?php _e('Not Found!', 'tikab-sms'); ?></td>
					</tr>
				<?php } ?>
			</tbody>
			
			<tfoot>
				<tr>
					<th id="cb" scope="col" class="manage-column column-cb check-column"><input type="checkbox" name="checkAll" value=""/></th>
					<th scope="col" class="manage-column column-name" width="10%"><?php _e('Post Date', 'tikab-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="10%"><?php _e('Sender', 'tikab-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="50%"><?php _e('Message', 'tikab-sms'); ?></th>
					<th scope="col" class="manage-column column-name" width="30%"><?php _e('Recipient', 'tikab-sms'); ?></th>
				</tr>
			</tfoot>
		</table>
		
		<div class="tablenav">
			<div class="alignleft actions">
				<select name="action" id="action">
					<option selected="selected"><?php _e('Bulk Actions', 'tikab-sms'); ?></option>
					<option value="trash"><?php _e('Remove', 'tikab-sms'); ?></option>
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
</div>