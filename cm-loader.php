<?php
/*
Plugin Name: Custom Manager
Plugin URI: 
Description: The "Custom Manager" plugin lets you add and manage custom post types, custom taxonomies and custom fields. 
Version: 1.0.0
Author: Ivan Shaovchev
Author URI: http://ivan.sh
License: GNU General Public License (Version 2 - GPLv2)
*/

/*
Copyright 2010 Incsub, (http://incsub.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License (Version 2 - GPLv2) as published by
the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/

/* Define plugin version */ 
define ( 'CM_VERSION', '1.0.0' );
define ( 'CM_DB_VERSION', '1.0' );

include_once 'cm-admin/cm-admin-core.php';

/**
 * cm_loaded()
 *
 * Allow dependent plugins and core actions to attach themselves in a safe way.
 *
 * See cm-admin-core.php for the following core actions: cm_init
 */
function cm_loaded() {
	do_action( 'cm_loaded' );
}
add_action( 'init', 'cm_loaded', 20 );

/**
 * cm_loader_activate()
 * 
 * Update plugin version
 */
function cm_loader_activate() {
	$options = array( 'version' => CM_VERSION, 'db_version' => CM_DB_VERSION );
	update_site_option( 'cm_options', $options );
}
register_activation_hook( __FILE__, 'cm_loader_activate' );

?>
