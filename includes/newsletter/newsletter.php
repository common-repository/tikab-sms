<?php
	include_once("../../../../../wp-load.php");
	
	$name	= trim($_REQUEST['name']);
	$mobile	= trim($_REQUEST['mobile']);
	$group	= trim($_REQUEST['group']);
	$type	= $_REQUEST['type'];
	
	if($name && $mobile) {
		if( (strlen($mobile) >= 11) && (substr($mobile, 0, 2) == get_option('wp_sms_mcc')) && (preg_match("([a-zA-Z])", $mobile) == 0) ) {
		
			global $wpdb, $table_prefix, $obj, $date;
			
			$check_mobile = $wpdb->query("SELECT * FROM {$table_prefix}ts_subscribes WHERE mobile='{$mobile}'");
			
			if(!$check_mobile || $type != 'subscribe') {
			
				if($type == 'subscribe') {
				
					$get_current_date = date('Y-m-d H:i:s' ,current_time('timestamp',0));

					if(get_option('wp_subscribes_activation')) {
					
						$key = rand(1000, 9999);
						$check = $wpdb->query("INSERT INTO {$table_prefix}ts_subscribes (date, name, mobile, status, activate_key, group_ID) VALUES ('".$get_current_date."', '{$name}', '{$mobile}', '0', '{$key}', '{$group}')");

						$obj->to = array($mobile);
						$obj->msg = __('Your activation code', 'tikab-sms') . ': ' . $key;
						
						if( $obj->send_sms() ) {
						
							$to = implode($wpdb->get_col("SELECT mobile FROM {$table_prefix}ts_subscribes"), ",");
							
							$wpdb->query("INSERT INTO {$table_prefix}ts_send (date, sender, message, recipient) VALUES ('{$date}', '{$obj->from}', '{$obj->msg}', '{$to}')");
						}

						if($check) {
							echo '<span id="result-activation">' . __('You will join the newsletter, Activation code sent to your number.', 'tikab-sms') . '</span>';
						}
							echo '<br />' . __('Please enter the activation code:', 'tikab-sms');
							echo '<input type="text" id="wpsms-ativation" name="get_activation"/><button class="wpsms-submit" id="activation">فعال سازی</button>';
							
					} else {
					
						$check = $wpdb->query("INSERT INTO {$table_prefix}ts_subscribes (date, name, mobile, status, group_ID) VALUES ('{$get_current_date}', '{$name}', '{$mobile}', '1', '{$group}')");

						if($check) {
							echo '<span id="result-register">' . __('You will join the newsletter', 'tikab-sms') . '</span>';
						} else {
							echo '<span id="result-register">' . __('Error communicating with the database!', 'tikab-sms') . '</span>';
						}
						
						exit(0);
					}
				} else if($type == 'unsubscribe') {
					if($check_mobile) {
						$check = $wpdb->query("DELETE FROM {$table_prefix}ts_subscribes WHERE mobile='{$mobile}'");
						if($check) {
							echo '<span id="result-register">' . __('Your subscription was canceled.', 'tikab-sms') . '</span>';
						}
					} else {
						echo '<span id="result-register">' . __('Nothing found!', 'tikab-sms') . '</span>';
					}
				}
			} else {
				echo '<span id="result-register">' . __('Phone number is repeated', 'tikab-sms') . '</span>';
			}
		} else {
			echo '<span id="result-register">' . __('Please enter a valid mobile number', 'tikab-sms') . '</span>';
		}
	} else {
		echo '<span id="result-register">' . __('Please complete all fields', 'tikab-sms') . '</span>';
	}
?>