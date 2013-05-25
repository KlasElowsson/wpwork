<?php

/*
Plugin Name: CC Comment Plugin
Plugin URI: http://www.klaselo.se/plugins
Description: This plugin will CC us when a post is commented
Author: Klas Elowsson
Version: 1.0
Author URI: http://klaselo.se

*/
/*  Copyright 2012  Klas Elowsson  (email : Klas.Elowsson@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


// Denna funktion registrerar våra options settngs så de är i samma binge som alla övriga 
function cccomm_init()
{
	register_setting('cccomm_options','cccomm_cc_email');
}
add_action('admin_init','cccomm_init');

function cccomm_option_page()
{
	?>
	<div class="wrap"><?php screen_icon(); ?>
	<h2>CC Comments Option Page</h2>
	<p>Welcome to the CC Comments Plugin. Here you can edit the email(s) you
	wish to have your comments CC'd to.</p>
	<form action="options.php" method="post" id="cc-comments-email-options-form">
	<?php settings_fields('cccomm_options'); ?>
	<h3><label for="cccomm_cc_email">Email to send CC to: </label> <input
		type="text" id="cccomm_cc_email" name="cccomm_cc_email"
		value="<?php echo esc_attr( get_option('cccomm_cc_email') ); ?>" /></h3>
	<p><input type="submit" name="submit" value="Update Email" /></p>
	</form>
	</div>
	<?php
}

function cccomm_plugin_menu()
{
	add_menu_page('CC Comments', 'CC Comments', 'manage_options', 'cc_comments-plugin', 'cccomm_option_page', 
					plugin_dir_url(__FILE__).'cc_icon.png',30);
	add_submenu_page('cc_comments-plugin','CC Comments Options 2', 'CC Comments Options 2', 'manage_options', 
					'cc_comments-plugin2', 'cccomm_option_page');
}
add_action('admin_menu', 'cccomm_plugin_menu');

function cc_comment()
{
	global $_REQUEST;
	
	$to = get_option('cccomm_cc_email');
	$subject = "New comment posted @ yourblog " . $_REQUEST['subject'];
	$message = "Message from: " . $_REQUEST['name'] . " at email: " . $_REQUEST['email'] . ": \n" . $_REQUEST['comments'];
	wp_mail($to,$subject,$message);
}

add_action('comment_post','cc_comment');

?>