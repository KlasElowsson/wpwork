<?php
/*
Plugin Name: CC Comment Plugin 3 w Ajax
Plugin URI: http://www.falkonproductions.com/ccComment/
Description: This plugin will CC us when a post is commented
Author: Drew Falkman
Version: 1.0
Author URI: http://www.falkonproductions.com/
 */

function cc_comment()
{
	global $_REQUEST;
	
	$to = get_option('cccomm_cc_email');
	$subject = "New comment posted @ yourblog " . $_REQUEST['subject'];
	$message = "Message from: " . $_REQUEST['name'] . " at email: " . $_REQUEST['email'] . ": \n" . $_REQUEST['comments'];
	wp_mail($to,$subject,$message);
}

add_action('comment_post','cc_comment');

function cccomm_init()
{
	register_setting('general','cccomm_cc_email');
}
add_action('admin_init','cccomm_init');

// Kontrollerar att rätt format för email används
function cccomm_email_check()
{
	$email =isset($_POST['cccomm_cc_email'])?$_POST['cccomm_cc_email']:null;
	$msg = 'invalid';
	if ( $email )
	{
		if ( is_email($email) )
		{
			$msg = 'valid';
		}
	}
	echo $msg;
	die();
}
add_action('wp_ajax_cccomm_email_check','cccomm_email_check');
add_action('admin_print_scripts-options-general.php', 'cccomm_email_check_script');

// här ser vi till att java scripen finns med i sidan
function cccomm_email_check_script()
{
  wp_enqueue_script( "cc-comments", path_join(WP_PLUGIN_URL, basename( dirname( __FILE__ ) )."/cc_comments.js"), array( 'jquery' ) );
	
}

function cccomm_setting_field()
{
	?>
	<input type="text" name="cccomm_cc_email" id="cccomm_cc_email"
			value="<?php echo get_option('cccomm_cc_email'); ?>" /> 
	<div id="emailInfo" align="left"></div>
	<?php 
}

function cccomm_setting_section()
{
	?>
	<p>Settings for the CC Comments plugin 3 m ajax:</p>
	<?php 
}

//Här skapas raderna i den generella inställningssidan
/*
 * Här finns ien bugg. Om man går direkt från bytt email till spara så hinner inte logiken med.
 * Ibland ändras addressen tillbaks till gamla värdet. Allt beror på att inte kontrollen hinner med innan 
 * värdet skickas och det nya värdet diskas
 */
function cccomm_plugin_menu()
{ 	
	add_settings_section('cccomm','CC Comments','cccomm_setting_section','general');
	add_settings_field('cccomm_cc_email', 'CC Comments Email','cccomm_setting_field','general','cccomm');
}
add_action('admin_menu', 'cccomm_plugin_menu');


// Här har vi en rad som plockar bort addressen om man avregistrerar vårt tillägg
register_uninstall_hook(__FILE__,'cccomm_uninstall');

function cccomm_uninstall()
{
	delete_option('cccomm_cc_email');
}