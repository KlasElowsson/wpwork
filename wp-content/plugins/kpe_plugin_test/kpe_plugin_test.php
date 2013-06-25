<?php
/*
Plugin Name: kpe plugin för Test
Version: 0.1
Plugin URI: http://www.klaselo.se/plugins
Description: Ett testprojekt 
Author: Klas Elowsson
Author URI: http://klaselo.se

Copyright 2012  Klas Elowsson  (email : Klas.Elowsson@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

// Denna funktion registrerar våra options settngs så de är i samma binge som alla övriga 
function kpe_plugin_test_init()
{
  register_setting('kpe_options','kpe_cc_email');
}
add_action('admin_init','kpe_plugin_test_init');


?>