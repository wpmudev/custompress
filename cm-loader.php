<?php
/*
Plugin Name: CustomPress
Plugin URI: http://premium.wpmudev.org/project/custompress
Description: CustomPress - Custom Post, Taxonomy and Field Manager.
Version: 1.0.3
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

/*
 * Enable error repporting if in debug mode
*/
//error_reporting( E_ALL ^ E_NOTICE );
//ini_set( 'display_errors', 1 );


/* Define plugin version */ 
define ( 'CM_VERSION', '1.0.3' );
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
function cm_plugin_activate() {
	$options = array( 'version' => CM_VERSION, 'db_version' => CM_DB_VERSION );
	update_site_option( 'cm_options', $options );
}
register_activation_hook( __FILE__, 'cm_plugin_activate' );

/**
 * cm_plugin_deactivate()
 *
 * Deactivate plugin. If $flush_cm_data is set to "true"
 * all plugin data will be deleted
 */
function cm_plugin_deactivate() {

    // set this to "true" if you want to delete all of the plugin stored data
    $flush_cm_data = false;

    // if $flush_cm_data is true it will delete all plugin data
    if ( $flush_cm_data ) {
        delete_site_option( 'cm_options' );
        delete_site_option( 'cm_main_settings' );
        delete_site_option( 'cm_custom_post_types' );
        delete_site_option( 'cm_custom_taxonomies' );
        delete_site_option( 'cm_custom_fields' );
        delete_site_option( 'cm_flush_rewrite_rules' );
    }
}
register_deactivation_hook( __FILE__, 'cm_plugin_deactivate' );

?>