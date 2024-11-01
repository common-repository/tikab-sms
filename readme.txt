=== Tikab SMS ===
Contributors: mostafa.s1990,tikab
Donate link: http://sms.tikab.org/
Tags: sms, wordpress, send, subscribe, sms subscribe, message, register, notification, webservice, sms panel
Requires at least: 3.0
Tested up to: 3.9
Stable tag: 1.0

Send a SMS via WordPress, Subscribe for SMS newsletter and send an SMS to the subscriber newsletter.

== Description ==
Tikab SMS WordPress Plugin allows SMS sending with own Sender ID from your website.
You just have to install plugin, activate Tikab SMS widget and paste your account information from following details:
Offical Website: [sms.tikab.org](http://sms.tikab.org)

= Features =
* Send SMS to number and numbers
* Send SMS to Subscribes
* Subscribe SMS
* Show Credit
* Send SMS via FLASH
* Widget Support
* Support Short code
* Support suggestion post by SMS.
* Send activation from subscribe.
* Metabox SMS to Contact Form 7 plugin.
* Notification SMS when get new order from Woocommerce plugin
* Notification SMS when get new order from Easy Digital Downloads plugin.
* Notification SMS when published new post to subscribers.
* Notification SMS when the new release of WordPress.
* Notification SMS when registering a new user.
* Notification SMS when get new comment.
* Notification SMS when user login.

= Translators =

* English
* Persian
* Arabic (Thanks Hamad Al-Shammari)
* Portuguese (Thanks Matt Moxx)

Send email for Translation files: mst404[a]gmail[dot].com
for translate, please open langs/default.po by Poedit and translate strings.

== Installation ==
1. Upload `tikab-sms` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. To display Subscribe goto Themes -> Widgets, and adding `Subscribe to SMS` into your sidebar Or using this functions: `<?php wp_subscribes(); ?>` into theme.
4. Using this functions for send manual SMS:

* First: `global $obj;`
* Enter the recipient's mobile number: `$obj->to = array('MobileNumber');`
* Enter the SMS text: `$obj->msg = "YourMessage";`
* Send SMS: `$obj->send_sms();`

or using this Shortcode `[subscribe]` in Posts pages or Widget.

== Screenshots ==
1. Screen shot (screenshot-1.png) in SMS Setting Page.
2. Screen shot (screenshot-2.png) in Webservice page.
3. Screen shot (screenshot-3.png) in Newslleter page.
4. Screen shot (screenshot-4.png) in Features page.
5. Screen shot (screenshot-5.png) in Notifications page.
6. Screen shot (screenshot-6.png) in Send SMS Page.
7. Screen shot (screenshot-7.png) in SMS Posted Page.
8. Screen shot (screenshot-8.png) in Subscribe list Page.
9. Screen shot (screenshot-9.png) in Dashboard right now.
10. Screen shot (screenshot-10.png) in SMS Subscribe widget.
11. Screen shot (screenshot-11.png) in Subscribe new-post.php.
12. Screen shot (screenshot-12.png) in Suggestion post in single.
13. Screen shot (screenshot-13.png) in Contact Form 7 page.

== Upgrade Notice ==

== Changelog ==
= 1.0 =
* Start plugin