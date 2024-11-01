<?php
/*
Plugin Name: Tikab SMS
Plugin URI: http://sms.tikab.org/plugin
Description: Send a SMS via WordPress, Subscribe for SMS newsletter and send an SMS to the subscriber newsletter.
Version: 1.0
Author: Mostafa Soufi
Author URI: http://mostafa-soufi.ir/
Text Domain: tikab-sms
License: GPL2
*/

	define('WP_SMS_VERSION', '1.0');

	include_once dirname( __FILE__ ) . '/install.php';
	
	register_activation_hook(__FILE__, 'wp_sms_install');
	
	load_plugin_textdomain('tikab-sms', false, dirname( plugin_basename( __FILE__ ) ) . '/includes/languages');
	__('Send a SMS via WordPress, Subscribe for SMS newsletter and send an SMS to the subscriber newsletter.', 'tikab-sms');

	global $wp_sms_db_version, $wpdb;
	
	$date = date('Y-m-d H:i:s' ,current_time('timestamp',0));

	function wp_sms_page() {

		if (function_exists('add_options_page')) {

			add_menu_page(__('Tikab SMS', 'tikab-sms'), __('Tikab SMS', 'tikab-sms'), 'manage_options', __FILE__, 'wp_send_sms_page');
			add_submenu_page(__FILE__, __('Send SMS', 'tikab-sms'), __('Send SMS', 'tikab-sms'), 'manage_options', __FILE__, 'wp_send_sms_page');
			add_submenu_page(__FILE__, __('Posted SMS', 'tikab-sms'), __('Posted', 'tikab-sms'), 'manage_options', 'tikab-sms/posted', 'wp_posted_sms_page');
			add_submenu_page(__FILE__, __('Members Newsletter', 'tikab-sms'), __('Newsletter subscribers', 'tikab-sms'), 'manage_options', 'tikab-sms/subscribe', 'wp_subscribes_page');
			add_submenu_page(__FILE__, __('Setting', 'tikab-sms'), __('Setting', 'tikab-sms'), 'manage_options', 'tikab-sms/setting', 'wp_sms_setting_page');
			add_submenu_page(__FILE__, __('About', 'tikab-sms'), __('About', 'tikab-sms'), 'manage_options', 'tikab-sms/about', 'wp_about_setting_page');
		}

	}
	add_action('admin_menu', 'wp_sms_page');
	
	function wp_sms_icon() {
	
		global $wp_version;
		
		if( version_compare( $wp_version, '3.8-RC', '>=' ) || version_compare( $wp_version, '3.8', '>=' ) ) {
			wp_enqueue_style('wps-admin-css', plugin_dir_url(__FILE__) . 'css/admin.css', true, '1.0');
		} else {
			wp_enqueue_style('wps-admin-css', plugin_dir_url(__FILE__) . 'css/admin-old.css', true, '1.0');
		}
	}
	add_action('admin_head', 'wp_sms_icon');
	
	// Create Object
	include_once dirname( __FILE__ ) . "/includes/classes/tikab-sms.class.php";

	$obj = new Tikab_Webservice();
	
	$obj->user = get_option('wp_username');
	$obj->pass = get_option('wp_password');
	$obj->from = get_option('wp_number');

	if($obj->unitrial == true) {
		$obj->unit = __('Rial', 'tikab-sms');
	} else {
		$obj->unit = __('SMS', 'tikab-sms');
	}
	
	if( !get_option('wp_sms_mcc') )
		update_option('wp_sms_mcc', '09');
	
	function wp_subscribes() {
	
		global $wpdb, $table_prefix;
		
		$get_group_result = $wpdb->get_results("SELECT * FROM `{$table_prefix}ts_subscribes_group`");
		
		include_once dirname( __FILE__ ) . "/includes/newsletter/form.php";
	}
	add_shortcode('subscribe', 'wp_subscribes');
	
	function wp_sms_loader(){
	
		wp_enqueue_style('wpsms-css', plugin_dir_url(__FILE__) . 'css/style.css', true, '1.1');
		
		if( get_option('wp_call_jquery') )
			wp_enqueue_script('jquery');
	}
	add_action('wp_enqueue_scripts', 'wp_sms_loader');

	function wp_sms_adminbar() {
	
		global $wp_admin_bar;
		$get_last_credit = get_option('wp_last_credit');
		
		if(is_super_admin() || is_admin_bar_showing()) {
		
			if($get_last_credit) {
			
				global $obj;
				
				$wp_admin_bar->add_menu(array
					(
						'id'		=>	'wp-credit-sms',
						'title'		=>	 sprintf(__('Your Credit: %s %s', 'tikab-sms'), number_format($get_last_credit), $obj->unit),
						'href'		=>	get_bloginfo('url').'/wp-admin/admin.php?page=tikab-sms/setting'
					));
			}
			$wp_admin_bar->add_menu(array
				(
					'id'		=>	'wp-send-sms',
					'parent'	=>	'new-content',
					'title'		=>	__('SMS', 'tikab-sms'),
					'href'		=>	get_bloginfo('url').'/wp-admin/admin.php?page=tikab-sms/tikab-sms.php'
				));
		} else {
			return false;
		}
	}
	add_action('admin_bar_menu', 'wp_sms_adminbar');

	function wp_sms_rightnow_discussion() {
	
		global $obj;
		echo "<tr><td class='b'><a href='".get_bloginfo('url')."/wp-admin/admin.php?page=tikab-sms/tikab-sms.php'>".number_format(get_option('wp_last_credit'))."</a></td><td><a href='".get_bloginfo('url')."/admin.php?page=tikab-sms/tikab-sms.php'>".__('Credit', 'tikab-sms')." (".$obj->unit.")</a></td></tr>";
	}
	add_action('right_now_discussion_table_end', 'wp_sms_rightnow_discussion');

	function wp_sms_rightnow_content() {
	
		global $wpdb, $table_prefix;
		$users = $wpdb->get_var("SELECT COUNT(*) FROM {$table_prefix}ts_subscribes");
		echo "<tr><td class='b'><a href='".get_bloginfo('url')."/wp-admin/admin.php?page=tikab-sms/subscribe'>".$users."</a></td><td><a href='".get_bloginfo('url')."/wp-admin/admin.php?page=tikab-sms/subscribe'>".__('Newsletter Subscriber', 'tikab-sms')."</a></td></tr>";
	}
	add_action('right_now_content_table_end', 'wp_sms_rightnow_content');

	function wp_sms_enable() {
	
		$get_bloginfo_url = get_admin_url() . "admin.php?page=tikab-sms/setting&tab=web-service";
		echo '<div class="error"><p>'.sprintf(__('Please check the <a href="%s">SMS credit</a> the settings', 'tikab-sms'), $get_bloginfo_url).'</p></div>';
	}

	if(!get_option('wp_username') || !get_option('wp_password'))
		add_action('admin_notices', 'wp_sms_enable');
	
	function wp_sms_widget() {
	
		wp_register_sidebar_widget('wp_sms', __('Subscribe to SMS', 'tikab-sms'), 'wp_subscribe_show_widget', array('description'	=>	__('Subscribe to SMS', 'tikab-sms')));
		wp_register_widget_control('wp_sms', __('Subscribe to SMS', 'tikab-sms'), 'wp_subscribe_control_widget');
	}
	add_action('plugins_loaded', 'wp_sms_widget');
	
	function wp_subscribe_show_widget($args) {
	
		extract($args);
			echo $before_title . get_option('wp_sms_widget_name') . $after_title;
			wp_subscribes();
	}

	function wp_subscribe_control_widget() {
	
		if($_POST['wp_sms_submit_widget']) {
			update_option('wp_sms_widget_name', $_POST['wp_sms_widget_name']);
		}
		
		include_once dirname( __FILE__ ) . "/includes/templates/tikab-sms-widget.php";
	}
	
	function wp_sms_pointer($hook_suffix) {
	
		wp_enqueue_style('wp-pointer');
		wp_enqueue_script('wp-pointer');
		wp_enqueue_script('utils');
	}
	add_action('admin_enqueue_scripts', 'wp_sms_pointer');
	
	function wp_send_sms_page() {
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}
		
		global $wpdb, $table_prefix;
		
		wp_enqueue_style('wpsms-css', plugin_dir_url(__FILE__) . 'css/style.css', true, '1.1');
		$get_group_result = $wpdb->get_results("SELECT * FROM `{$table_prefix}ts_subscribes_group`");
		
		include_once dirname( __FILE__ ) . "/includes/templates/settings/send-sms.php";
	}
	
	function wp_posted_sms_page() {
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}
		
		global $wpdb, $table_prefix;
		
		wp_enqueue_style('pagination-css', plugin_dir_url(__FILE__) . 'css/pagination.css', true, '1.0');
		include_once dirname( __FILE__ ) . '/includes/classes/pagination.class.php';
		
		if($_POST['doaction']) {
		
			$get_IDs = implode(",", $_POST['column_ID']);
			$check_ID = $wpdb->query("SELECT * FROM {$table_prefix}ts_send WHERE ID='".$get_IDs."'");

			switch($_POST['action']) {
				case 'trash':
					if($check_ID) {
						$wpdb->query("DELETE FROM {$table_prefix}ts_send WHERE ID IN (".$get_IDs.")");
						echo "<div class='updated'><p>" . __('With success was removed', 'tikab-sms') . "</div></p>";
					} else {
						echo "<div class='error'><p>" . __('Not Found', 'tikab-sms') . "</div></p>";
					}
				break;
			}
		}
		
		$total = $wpdb->query("SELECT * FROM `{$table_prefix}ts_send`");
		
		include_once dirname( __FILE__ ) . "/includes/templates/settings/posted.php";
	}
	
	function wp_subscribes_page() {
	
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}
		
		global $wpdb, $table_prefix, $date;
		
		wp_enqueue_style('pagination-css', plugin_dir_url(__FILE__) . 'css/pagination.css', true, '1.0');
		include_once dirname( __FILE__ ) . '/includes/classes/pagination.class.php';
		
		if($_POST['doaction']) {
		
			$get_IDs = implode(",", $_POST['column_ID']);
			$check_ID = $wpdb->query("SELECT * FROM {$table_prefix}ts_subscribes WHERE ID='".$get_IDs."'");

			switch($_POST['action']) {
				case 'trash':
					if($check_ID) {
						$wpdb->query("DELETE FROM {$table_prefix}ts_subscribes WHERE ID IN (".$get_IDs.")");
						echo "<div class='updated'><p>" . __('With success was removed', 'tikab-sms') . "</div></p>";
					} else {
						echo "<div class='error'><p>" . __('Not Found', 'tikab-sms') . "</div></p>";
					}
				break;
				
				case 'active':
					if($check_ID) {
						$wpdb->query("UPDATE {$table_prefix}ts_subscribes SET `status` = '1' WHERE ID IN (".$get_IDs.")");
						echo "<div class='updated'><p>" . __('User actived.', 'tikab-sms') . "</div></p>";
					} else {
						echo "<div class='error'><p>" . __('Not Found', 'tikab-sms') . "</div></p>";
					}
				break;
				
				case 'deactive':
					if($check_ID) {
						$wpdb->query("UPDATE {$table_prefix}ts_subscribes SET `status` = '0' WHERE ID IN (".$get_IDs.")");
						echo "<div class='updated'><p>" . __('User deactived.', 'tikab-sms') . "</div></p>";
					} else {
						echo "<div class='error'><p>" . __('Not Found', 'tikab-sms') . "</div></p>";
					}
				break;
			}
		}
		
		$name	= trim($_POST['wp_subscribe_name']);
		$mobile	= trim($_POST['wp_subscribe_mobile']);
		$group	= trim($_POST['wpsms_group_name']);
		
		if(isset($_POST['wp_add_subscribe'])) {
		
			if($name && $mobile && $group) {
			
				if( (strlen($mobile) >= 11) && (substr($mobile, 0, 2) == '09') && (preg_match("([a-zA-Z])", $mobile) == 0) ) {
				
					$check_mobile = $wpdb->query("SELECT * FROM {$table_prefix}ts_subscribes WHERE mobile='{$mobile}'");
					
					if(!$check_mobile) {
						$check = $wpdb->query("INSERT INTO {$table_prefix}ts_subscribes (date, name, mobile, status, group_ID) VALUES ('{$date}', '{$name}', '{$mobile}', '1', '{$group}')");
						
						if($check) {
							echo "<div class='updated'><p>" . sprintf(__('User <strong>%s</strong> was added successfully.', 'tikab-sms'), $name) . "</div></p>";
						}
					} else {
						echo "<div class='error'><p>" . __('Phone number is repeated', 'tikab-sms') . "</div></p>";
					}
				} else {
					echo "<div class='error'><p>" . __('Please enter a valid mobile number', 'tikab-sms') . "</div></p>";
				}
			} else {
				echo "<div class='error'><p>" . __('Please complete all fields', 'tikab-sms') . "</div></p>";
			}
			
		}
		
		if(isset($_POST['wpsms_add_group'])) {
		
			if($group) {
			
				$check_group = $wpdb->query("SELECT * FROM {$table_prefix}ts_subscribes_group WHERE name='{$group}'");
				
				if(!$check_group) {
					$check = $wpdb->query("INSERT INTO {$table_prefix}ts_subscribes_group (name) VALUES ('{$group}')");
					
					if($check) {
						echo "<div class='updated'><p>" . sprintf(__('Group <strong>%s</strong> was added successfully.', 'tikab-sms'), $group) . "</div></p>";
					}
				} else {
					echo "<div class='error'><p>" . __('Group name is repeated', 'tikab-sms') . "</div></p>";
				}
			} else {
				echo "<div class='error'><p>" . __('Please complete field', 'tikab-sms') . "</div></p>";
			}
		}
		
		if(isset($_POST['wpsms_delete_group'])) {
		
			if($group) {
			
				$check_group = $wpdb->query("SELECT * FROM {$table_prefix}ts_subscribes_group WHERE `ID` = '{$group}'");
				
				if($check_group) {
					$group_name = $wpdb->get_row("SELECT * FROM {$table_prefix}ts_subscribes_group WHERE `ID` = '{$group}'");
					$check = $wpdb->query("DELETE FROM {$table_prefix}ts_subscribes_group WHERE `ID` = '{$group}'");
					
					if($check) {
						echo "<div class='updated'><p>" . sprintf(__('Group <strong>%s</strong> was successfully removed.', 'tikab-sms'), $group_name->name) . "</div></p>";
					}
				}
			} else {
				echo "<div class='error'><p>" . __('Nothing found!', 'tikab-sms') . "</div></p>";
			}
			
		}
		
		if(isset($_POST['wp_edit_subscribe'])) {
		
			if($name && $mobile && $group) {
				if( (strlen($mobile) >= 11) && (substr($mobile, 0, 2) == get_option('wp_sms_mcc')) && (preg_match("([a-zA-Z])", $mobile) == 0) ) {
				
					$check = $wpdb->query("UPDATE {$table_prefix}ts_subscribes SET `name` = '{$name}', `mobile` = '{$mobile}', `status` = '".$_POST['wp_subscribe_status']."', `group_ID` = '{$group}' WHERE `ID` = '".$_GET['ID']."'");
					
					if($check) {
						echo "<div class='updated'><p>" . sprintf(__('User <strong>%s</strong> was update successfully.', 'tikab-sms'), $name) . "</div></p>";
					}
					
				} else {
					echo "<div class='error'><p>" . __('Please enter a valid mobile number', 'tikab-sms') . "</div></p>";
				}
			} else {
				echo "<div class='error'><p>" . __('Please complete all fields', 'tikab-sms') . "</div></p>";
			}
			
		}
		
		$total = $wpdb->query("SELECT * FROM `{$table_prefix}ts_subscribes`");
		$get_group_result = $wpdb->get_results("SELECT * FROM `{$table_prefix}ts_subscribes_group`");
		
		if(!$get_group_result) {
			add_action('admin_print_footer_scripts', 'wpsms_group_pointer');
		}
		
		include_once dirname( __FILE__ ) . "/includes/templates/settings/subscribes.php";
	}
	
	function wp_sms_setting_page() {
	
		global $obj;
		
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.'));
			
			settings_fields('wp_sms_options');
		}
		
		wp_enqueue_style('css', plugin_dir_url(__FILE__) . 'css/style.css', true, '1.0');
		
		$sms_page['about'] = get_bloginfo('url') . "/wp-admin/admin.php?page=tikab-sms/about";
		
		switch($_GET['tab']) {
			case 'web-service':
				include_once dirname( __FILE__ ) . "/includes/templates/settings/web-service.php";
				break;
			
			case 'newsletter':
				include_once dirname( __FILE__ ) . "/includes/templates/settings/newsletter.php";
				break;
			
			case 'features':
				include_once dirname( __FILE__ ) . "/includes/templates/settings/features.php";
				break;
			
			case 'notification':
				include_once dirname( __FILE__ ) . "/includes/templates/settings/notification.php";
				break;
			
			default:
				include_once dirname( __FILE__ ) . "/includes/templates/settings/setting.php";
				break;
		}
	}
	
	function wp_about_setting_page() {
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}
		
		include_once dirname( __FILE__ ) . "/includes/templates/settings/about.php";
	}
	
	include_once dirname( __FILE__ ) . '/includes/admin/tikab-sms-newslleter.php';
	include_once dirname( __FILE__ ) . '/includes/admin/tikab-sms-features.php';
	include_once dirname( __FILE__ ) . '/includes/admin/tikab-sms-notifications.php';
?>