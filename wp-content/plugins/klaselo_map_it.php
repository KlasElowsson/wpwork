<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/*
Plugin Name: Klas Map It for WP
Plugin URL: http://www.klaselo.se/plugins/MapIt
Description: Denna plugin är en shortcut för att få in kartor 
Author: Klas Elowsson
Version: 1.0
Author URI: http://KlasElo.se 
*/
/*  Copyright YEAR  PLUGIN_AUTHOR_NAME  (email : PLUGIN AUTHOR EMAIL)

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
function smp_map_it($atts,$content=null)
{	
	shortcode_atts( array( 'title' => 'Your Map:', 'address' => ''), $atts);
	$base_map_url = 'http://maps.google.com/maps/api/staticmap?sensor=false&size=256x256&format=png&center=';
	return '
	<h2>' . $atts['title'] . '</h2>
	<img width="256" height="256"
		src="' . $base_map_url . urlencode($atts['address']) . '" />';
}
	
add_shortcode('map-it','smp_map_it');?>