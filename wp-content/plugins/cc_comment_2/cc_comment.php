<?php
/*
Plugin Name: CC Comment Plugin 2
Plugin URI: http://www.falkonproductions.com/ccComment/
Description: This plugin will CC us when a post is commented
Author: Drew Falkman
Version: 1.0
Author URI: http://www.falkonproductions.com/
 */

// Registrerar cccomm_cc_email som option i general settings
 function cccomm_init()
{
	register_setting('general','cccomm_cc_email');
}
add_action('admin_init','cccomm_init');



// Definition att addera till befintlig "Settings sida"

function cccomm_setting_field()
{
	?>
	<input type="text" name="cccomm_cc_email" id="cccomm_cc_email"
			value="<?php echo get_option('cccomm_cc_email'); ?>" />
	<?php 
}

// denna funktiona definierar en ny sektion i sidan 
function cccomm_setting_section()
{
	?>
	<p>Settings for the CC Comments plugin 2:</p>
	<?php 
}

function cccomm_plugin_menu()
{ 	
	// Lägger till Section i sida
	add_settings_section('cccomm','CC Comments','cccomm_setting_section','general');
	//Lägger till fältet i sida
	add_settings_field('cccomm_cc_email', 'CC Comments Email','cccomm_setting_field','general','cccomm');
}
add_action('admin_menu', 'cccomm_plugin_menu');

// Detta är det egentliga jobbet .. Man skickar email när .. comment skrivs in på post
function cc_comment()
{
	global $_REQUEST;
	
	$to = get_option('cccomm_cc_email');
	$subject = "New comment posted @ yourblog " . $_REQUEST['subject'];
	$message = "Message from: " . $_REQUEST['name'] . " at email: " . $_REQUEST['email'] . ": \n" . $_REQUEST['comments'];
	wp_mail($to,$subject,$message);
}

add_action('comment_post','cc_comment');