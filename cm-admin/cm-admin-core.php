<?php

/* define the plugin folder url */
define ( 'CM_PLUGIN_URL', WP_PLUGIN_URL . '/' . str_replace( basename(__FILE__), '', plugin_basename(__FILE__) ));

/* tmp debug func */
function cm_debug( $param ) {
    echo '<pre>';
    print_r ( $param );
    echo '</pre>';
}

/**
 * cm_admin_menu()
 *
 * Register all admin menues
 */
function cm_admin_menu() {
	add_menu_page( __('CustomPress', 'custompress'), __('CustomPress', 'custompress'), 'edit_users', 'cm_main', 'cm_admin_load_page_templates' );
    add_submenu_page( 'cm_main', __('Content Types', 'custompress'), __('Content Types', 'custompress'), 'edit_users', 'cm_content_types', 'cm_admin_load_page_templates' );
}
add_action( 'admin_menu', 'cm_admin_menu', 10 );

/**
 * cm_admin_hook()
 *
 * Get page hook and hook cm_scripts() to it.
 */
function cm_admin_hook() {
	if ( function_exists( 'get_plugin_page_hook' ))
		$hook = get_plugin_page_hook( $_GET['page'], 'cm_main' );
	else
		$hook = 'custom-manager_page_' . $_GET['page'];

	add_action( 'admin_print_styles-' .  $hook, 'cm_admin_styles' );
    add_action( 'admin_print_scripts-' . $hook, 'cm_admin_scripts' );

    if ( $_GET['page'] == 'cm_main' )
        add_action( 'admin_head-' . $hook, 'cm_ajax_actions');
}
add_action( 'admin_init', 'cm_admin_hook', 10 );

/**
 * cm_admin_styles()
 *
 * Load styles on plugin admin pages only
 */
function cm_admin_styles() {
    wp_enqueue_style(  'cm-admin-styles',
                        CM_PLUGIN_URL . 'css/cm-admin-styles.css');
}

/**
 * cm_admin_custom_fields_styles()
 *
 * Load styles on add/edit post type pages only
 */
function cm_admin_custom_fields_styles() {
    wp_enqueue_style(  'cm-admin-styles',
                        CM_PLUGIN_URL . 'css/cm-admin-custom-fields-styles.css');
}
add_action( 'admin_print_styles-post.php', 'cm_admin_custom_fields_styles', 10 );
add_action( 'admin_print_styles-post-new.php', 'cm_admin_custom_fields_styles', 10 );

/**
 * cm_admin_scripts()
 *
 * Load scripts on plugin admin pages only
 */
function cm_admin_scripts() {
    wp_enqueue_script( 'cm-admin-scripts',
                        CM_PLUGIN_URL . 'js/cm-admin-scripts.js',
                        array( 'jquery' ) );
}

/**
 * cm_admin_load_page_templates()
 * 
 * Loads admin page templates based on $_GET request values and passes variables
 */
function cm_admin_load_page_templates() {

    // load main template
    if ( $_GET['page'] == 'cm_main' ) {
        include_once 'pages/cm-admin-main-page.php';
        $post_types    = get_site_option( 'cm_custom_post_types' );
        cm_admin_main_page( $post_types );
    }

    // load content type template ( which loads all the content type templates )
    if ( $_GET['page'] == 'cm_content_types' ) {
        include_once 'pages/cm-admin-content-types-page.php';
        cm_admin_content_types_page();
    }
}

/**
 * cm_admin_page_redirect()
 *
 * Hooks itself after the add/update/delete functions and redirects to the
 * appropriate pages
 *
 * @global bool $cm_redirect Switch turning redirect on/off
 */
function cm_admin_page_redirect() {
    global $cm_redirect;

    // after post type is added redirect back to the post types page
    if ( isset( $_POST['cm_submit_add_post_type'] ) && $cm_redirect )
        wp_redirect( admin_url( 'admin.php?page=cm_content_types&cm_content_type=post_type' ));

    // after post type is edited/deleted redirect back to the post types page
    if ( isset( $_POST['cm_submit_update_post_type'] ) || isset( $_REQUEST['cm_delete_post_type_secret'] ))
        wp_redirect( admin_url( 'admin.php?page=cm_content_types&cm_content_type=post_type' ));

    // redirect to add post type page
    if ( isset( $_POST['cm_redirect_add_post_type'] ))
        wp_redirect( admin_url( 'admin.php?page=cm_content_types&cm_content_type=post_type&cm_add_post_type=true' ));

    // after taxonomy is added redirect back to the taxonomies page
    if ( isset( $_POST['cm_submit_add_taxonomy'] ) && $cm_redirect )
        wp_redirect( admin_url( 'admin.php?page=cm_content_types&cm_content_type=taxonomy' ));

    // after taxonomy is edited/deleted redirect back to the taxonomies page
    if ( isset( $_POST['cm_submit_update_taxonomy'] ) || isset( $_REQUEST['cm_delete_taxonomy_secret'] ))
        wp_redirect( admin_url( 'admin.php?page=cm_content_types&cm_content_type=taxonomy' ));

    // redirect to add taxonomy page
    if ( isset( $_POST['cm_redirect_add_taxonomy'] ))
        wp_redirect( admin_url( 'admin.php?page=cm_content_types&cm_content_type=taxonomy&cm_add_taxonomy=true' ));

    // after custom field is added redirect to custom fields page
    if ( isset( $_POST['cm_submit_add_custom_field'] ) && $cm_redirect )
        wp_redirect( admin_url( 'admin.php?page=cm_content_types&cm_content_type=custom_field' ));

    // after custom field add/update/deleted redirect back to the custom fields page 
    if ( isset( $_POST['cm_submit_update_custom_field'] ) || isset( $_REQUEST['cm_delete_custom_field_secret'] ))
        wp_redirect( admin_url( 'admin.php?page=cm_content_types&cm_content_type=custom_field' ));

    // redirect to add custom field page
    if ( isset( $_POST['cm_redirect_add_custom_field'] ))
        wp_redirect( admin_url( 'admin.php?page=cm_content_types&cm_content_type=custom_field&cm_add_custom_field=true' ));
}
add_action( 'init', 'cm_admin_page_redirect', 10 );

/**
 * cm_admin_process_add_update_post_type_requests()
 *
 * Intercept $_POST request and processes the custom post type submissions
 *
 * @global bool $cm_redirect
 */
function cm_admin_process_add_update_post_type_requests() {
    global $cm_redirect;

    // stop execution and return if no add/update request is made
    if ( !( isset( $_POST['cm_submit_add_post_type'] ) || isset( $_POST['cm_submit_update_post_type'] )))
        return;

    // verify wp_nonce 
    if ( !wp_verify_nonce( $_POST['cm_submit_post_type_secret'], 'cm_submit_post_type_verify'))
        return;

    // validate input fields and set redirect bool
    if ( isset( $_POST['cm-admin-add-post-type-page'] )) {
        if ( cm_validate_field( 'post_type', $_POST['post_type'] )) {
            $cm_redirect = true;
        } else {
            $cm_redirect = false;
            return;
        }
    }

    $post_type = ( isset( $_POST['post_type'] )) ? $_POST['post_type'] : $_GET['cm_edit_post_type'];
    
    $labels = array(
        'name'               => $_POST['labels']['name'],
        'singular_name'      => $_POST['labels']['singular_name'],
        'add_new'            => $_POST['labels']['add_new'],
        'add_new_item'       => $_POST['labels']['add_new_item'],
        'edit_item'          => $_POST['labels']['edit_item'],
        'new_item'           => $_POST['labels']['new_item'],
        'view_item'          => $_POST['labels']['view_item'],
        'search_items'       => $_POST['labels']['search_items'],
        'not_found'          => $_POST['labels']['not_found'],
        'not_found_in_trash' => $_POST['labels']['not_found_in_trash'],
        'parent_item_colon'  => $_POST['labels']['parent_item_colon']
    );
    $args = array(
        'labels'              => $labels,
        'supports'            => $_POST['supports'],
        'capability_type'     => 'post',
        'description'         => $_POST['description'],
        'menu_position'       => (int)  $_POST['menu_position'],
        'public'              => (bool) $_POST['public'] ,
        'show_ui'             => (bool) $_POST['show_ui'],
        'show_in_nav_menus'   => (bool) $_POST['show_in_nav_menus'],
        'publicly_queryable'  => (bool) $_POST['publicly_queryable'],
        'exclude_from_search' => (bool) $_POST['exclude_from_search'],
        'hierarchical'        => (bool) $_POST['hierarchical'],
        'rewrite'             => (bool) $_POST['rewrite'],
        'query_var'           => (bool) $_POST['query_var'],
        'can_export'          => (bool) $_POST['can_export']
    );

    // if custom capability type is set use it
    if ( $_POST['capability_type_edit'] && !empty( $_POST['capability_type'] ))
        $args['capability_type'] = $_POST['capability_type'];

    // if custom rewrite slug is set use it 
    if ( $_POST['rewrite'] == 'advanced' && !empty( $_POST['rewrite_slug'] )) {
        $args['rewrite'] = array( 'slug' => $_POST['rewrite_slug'] );
        cm_set_flush_rewrite_rules( true );
    }

    // remove empty labels so we can use the defaults
    foreach( $args['labels'] as $key => $value ) {
        if ( empty( $value ))
            unset( $args['labels'][$key] );
    }
    // remove keys so we can use the defaults
    if ( $_POST['public'] == 'advanced' ) {
        unset( $args['public'] );
    }
    else {
        unset( $args['show_ui'] );
        unset( $args['show_in_nav_menus'] );
        unset( $args['publicly_queryable'] );
        unset( $args['exclude_from_search'] );
    }

    // store multiple custom post types in the same array and in a single wp_options entry
    if ( !get_site_option('cm_custom_post_types' )) {
        $new_post_types = array( $post_type => $args );
        // set the flush rewrite rules
        cm_set_flush_rewrite_rules( true );
    }
    else {
        $old_post_types = get_site_option( 'cm_custom_post_types' );
        $new_post_types = array_merge( $old_post_types, array( $post_type => $args ));
        // set the flush rewrite rules
        if ( count( $new_post_types ) > count( $old_post_types ))
            cm_set_flush_rewrite_rules( true );
    }

    // update wp_options with the post type options
    update_site_option( 'cm_custom_post_types', $new_post_types );
}
add_action( 'init', 'cm_admin_process_add_update_post_type_requests', 0 );

/**
 * cm_admin_delete_post_type()
 *
 * Intercepts delete $_POST request and removes the deleted post type
 * from the database post types array
 */
function cm_admin_delete_post_type() {

    // verify wp_nonce 
    if ( !wp_verify_nonce( $_REQUEST['cm_delete_post_type_secret'], 'cm_delete_post_type_verify' ))
        return;

    // get available post types from db
    $post_types = get_site_option( 'cm_custom_post_types' );

    // remove the deleted post type
    unset( $post_types[$_GET['cm_delete_post_type']] );

    // update the available post types
    update_site_option( 'cm_custom_post_types', $post_types );
}
add_action( 'init', 'cm_admin_delete_post_type', 0 );

/**
 * cm_admin_register_post_types()
 *
 * Get available custom post types from database and register them.
 * The function attach itself to the init hook and uses priority of 2.It loads
 * after the cm_admin_register_taxonomies() func which hook itself to the init
 * hook with priority of 1. 
 */
function cm_admin_register_post_types() {
    
    $post_types = get_site_option( 'cm_custom_post_types' );

    if ( !empty( $post_types )) {
        foreach ( $post_types as $post_type => $args )
            register_post_type( $post_type, $args );

        // flush the rewrite rules
        cm_flush_rewrite_rules();
    }
}
add_action( 'init', 'cm_admin_register_post_types', 2 );

/**
 * cm_admin_process_add_update_taxonomy_requests()
 *
 * Intercepts $_POST request and processes the taxonomy submissions
 *
 * @global bool $cm_redirect 
 */
function cm_admin_process_add_update_taxonomy_requests() {
    global $cm_redirect;

    // stop execution and return if no add/edit taxonomy request is made
    if ( !( isset( $_POST['cm_submit_add_taxonomy'] ) || isset( $_POST['cm_submit_update_taxonomy'] )))
        return;

    // verify wp_nonce
    if ( !wp_verify_nonce( $_POST['cm_submit_taxonomy_secret'], 'cm_submit_taxonomy_verify'))
        return;

    // validate input fields and set redirect rules
    if ( isset( $_POST['cm-admin-add-taxonomy-page'] )) {
        $field_taxonomy_valid    = cm_validate_field( 'taxonomy', $_POST['taxonomy'] );
        $field_object_type_valid = cm_validate_field( 'object_type', $_POST['object_type'] );
        
        if ( $field_taxonomy_valid && $field_object_type_valid ) {
            $cm_redirect = true;  
        } else {
            $cm_redirect = false;
            return;
        }
    }

    $taxonomy = ( isset( $_POST['taxonomy'] )) ? $_POST['taxonomy'] : $_GET['cm_edit_taxonomy'];
    
    $object_type = $_POST['object_type'];
    $labels = array(
        'name'                       => $_POST['labels']['name'],
        'singular_name'              => $_POST['labels']['singular_name'],
        'add_new_item'               => $_POST['labels']['add_new_item'],
        'new_item_name'              => $_POST['labels']['new_item_name'],
        'edit_item'                  => $_POST['labels']['edit_item'],
        'update_item'                => $_POST['labels']['update_item'],
        'search_items'               => $_POST['labels']['search_items'],
        'popular_items'              => $_POST['labels']['popular_items'],
        'all_items'                  => $_POST['labels']['all_items'],
        'parent_item'                => $_POST['labels']['parent_item'],
        'parent_item_colon'          => $_POST['labels']['parent_item_colon'],
        'add_or_remove_items'        => $_POST['labels']['add_or_remove_items'],
        'separate_items_with_commas' => $_POST['labels']['separate_items_with_commas'],
        'choose_from_most_used'      => $_POST['labels']['all_items']
    );
    $args = array(
        'labels'              => $labels,
        'public'              => (bool) $_POST['public'] ,
        'show_ui'             => (bool) $_POST['show_ui'],
        'show_tagcloud'       => (bool) $_POST['show_tagcloud'],
        'show_in_nav_menus'   => (bool) $_POST['show_in_nav_menus'],
        'hierarchical'        => (bool) $_POST['hierarchical'],
        'rewrite'             => (bool) $_POST['rewrite'],
        'query_var'           => (bool) $_POST['query_var']
    );

    // if custom rewrite slug is set use it
    if ( $_POST['rewrite'] == 'advanced' && !empty( $_POST['rewrite_slug'] )) {
        $args['rewrite'] = array( 'slug' => $_POST['rewrite_slug'] );
        cm_set_flush_rewrite_rules( true );
    }

    // remove empty values from labels so we can use the defaults
    foreach( $args['labels'] as $key => $value ) {
        if ( empty( $value ))
            unset( $args['labels'][$key] );
    }
    // if no advanced is set, unset values so we can use the defaults
    if ( $_POST['public'] == 'advanced' ) {
        unset( $args['public'] );
    }
    else {
        unset( $args['show_ui'] );
        unset( $args['show_tagcloud'] );
        unset( $args['show_in_nav_menus'] );
    }

    // store multiple custom taxonomies in the same array and in a single wp_options entry
    if ( !get_site_option( 'cm_custom_taxonomies' )) {
        $new_taxonomies = array( $taxonomy => array( 'object_type' => $object_type, 'args' => $args ));
        // set the flush rewrite rules 
        cm_set_flush_rewrite_rules( true );
    }
    else {
        $old_taxonomies = get_site_option( 'cm_custom_taxonomies' );
        $new_taxonomies = array_merge( $old_taxonomies, array( $taxonomy => array( 'object_type' => $object_type, 'args' => $args )));
        // set the flush rewrite rules 
        if ( count( $new_taxonomies ) > count( $old_taxonomies ))
            cm_set_flush_rewrite_rules( true );
    }

    // update wp_options with the taxonomies options
    update_site_option( 'cm_custom_taxonomies', $new_taxonomies );
}
add_action( 'init', 'cm_admin_process_add_update_taxonomy_requests', 0 );

/**
 * cm_admin_delete_taxonomy()
 *
 * Intercepts delete $_POST request and removes the deleted taxonomy
 * from the database taxonomies array
 */
function cm_admin_delete_taxonomy() {

    // verify wp_nonce
    if ( !wp_verify_nonce( $_REQUEST['cm_delete_taxonomy_secret'], 'cm_delete_taxonomy_verify' ))
        return;

    // get available taxonomies from db
    $taxonomies = get_site_option( 'cm_custom_taxonomies' );

    // remove the deleted taxonomy
    unset( $taxonomies[$_GET['cm_delete_taxonomy']] );

    // update the available taxonomies
    update_site_option( 'cm_custom_taxonomies', $taxonomies );
}
add_action( 'init', 'cm_admin_delete_taxonomy', 0 );

/**
 * cm_admin_register_taxonomies()
 *
 * Get available custom taxonomies from database and register them.
 * The function atach itself to the init hook and uses priority of 1. It loads
 * before the cm_admin_register_post_types() func which hook itself to the init
 * hook with priority of 2. 
 */
function cm_admin_register_taxonomies() {

    $taxonomies = get_site_option( 'cm_custom_taxonomies' );

    if ( !empty( $taxonomies )) {
        foreach ( $taxonomies as $taxonomy => $args )
            register_taxonomy( $taxonomy, $args['object_type'], $args['args'] );
    }
}
add_action('init', 'cm_admin_register_taxonomies', 1 );


/**
 * cm_admin_process_add_update_custom_fields_requests()
 *
 * Intercepts $_POST request and processes the custom fields submissions
 */
function cm_admin_process_add_update_custom_field_requests() {
    global $cm_redirect;

    // stop execution and return if no add/edit custom field request is made
    if ( !( isset( $_POST['cm_submit_add_custom_field'] ) || isset( $_POST['cm_submit_update_custom_field'] )))
        return;

    // verify wp_nonce
    if ( !wp_verify_nonce( $_POST['cm_submit_custom_field_secret'], 'cm_submit_custom_field_verify'))
        return;

    // validate fields data
    $field_title_valid        = cm_validate_field( 'field_title', $_POST['field_title'] );
    $field_object_type_valid  = cm_validate_field( 'object_type', $_POST['object_type'] );

    if ( in_array( $_POST['field_type'], array( 'radio', 'checkbox', 'selectbox', 'multiselectbox' ))) {
        $field_options_valid = cm_validate_field( 'field_options', $_POST['field_options'][1] );
        
        if ( $field_title_valid && $field_object_type_valid && $field_options_valid ) {
            $cm_redirect = true;
        } else {
            $cm_redirect = false;
            return;
        }
    } else {
        if ( $field_title_valid && $field_object_type_valid ) {
            $cm_redirect = true;
        } else {
            $cm_redirect = false;
            return;
        }
    }

    $field_id = ( empty( $_GET['cm_edit_custom_field'] )) ? $_POST['field_type'] . '_' . uniqid() : $_GET['cm_edit_custom_field'];

    $args = array(
        'field_title'          => $_POST['field_title'],
        'field_type'           => $_POST['field_type'],
        'field_sort_order'     => $_POST['field_sort_order'],
        'field_options'        => $_POST['field_options'],
        'field_default_option' => $_POST['field_default_option'],
        'field_description'    => $_POST['field_description'],
        'object_type'          => $_POST['object_type'],
        'required'             => $_POST['required'],
        'field_id'             => $field_id 
    );

    // unset if there are no options to be stored in the db
    if ( $args['field_type'] == 'text' || $args['field_type'] == 'textarea' )
        unset( $args['field_options'] );

    if ( !get_site_option( 'cm_custom_fields' )) {
        $new_custom_fields = array( $field_id => $args );
    }
    else {
        $old_custom_fields = get_site_option( 'cm_custom_fields' );
        $new_custom_fields = array_merge( $old_custom_fields, array( $field_id => $args ));
    }

    update_site_option('cm_custom_fields', $new_custom_fields );
}
add_action( 'init', 'cm_admin_process_add_update_custom_field_requests', 0 );

/**
 * cm_admin_delete_custom_fields()
 *
 * Delete custom fields
 */
function cm_admin_delete_custom_fields() {
    
    // verify wp_nonce
    if ( !wp_verify_nonce( $_REQUEST['cm_delete_custom_field_secret'], 'cm_delete_custom_field_verify' ))
        return;

    // get available custom fields from db
    $custom_fields = get_site_option( 'cm_custom_fields' );

    // remove the deleted custom field
    unset( $custom_fields[$_GET['cm_delete_custom_field']] );

    // update the available custom fields
    update_site_option( 'cm_custom_fields', $custom_fields );
}
add_action( 'init', 'cm_admin_delete_custom_fields', 0 );

/**
 * cm_create_custom_fields()
 *
 * Create the custom fields 
 */
function cm_create_custom_fields() {
    include_once 'pages/cm-display-custom-fields.php';
    
    $custom_fields = get_site_option( 'cm_custom_fields' );

    if ( !empty( $custom_fields )) {
        foreach ( $custom_fields as $custom_field ) {
            foreach ( $custom_field['object_type'] as $object_type )
                add_meta_box( 'cm-custom-fields', 'Custom Fields', 'cm_display_custom_fields', $object_type, 'normal', 'high' );
        }
    }
}
add_action( 'admin_menu', 'cm_create_custom_fields', 2 );

/**
 * cm_save_custom_fields()
 *
 * Save custom fields data
 *
 * @param int $post_id The post id of the post being edited
 */
function cm_save_custom_fields( $post_id ) {

    // prevent autosave from deleting the custom fields
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
        return;

    $prefix = '_cm_';
    $custom_fields = get_site_option( 'cm_custom_fields' );

    if ( !empty( $custom_fields )) {
        foreach ( $custom_fields as $custom_field ) {
            if ( isset( $_POST[$prefix . $custom_field['field_id']] ))
                update_post_meta( $post_id, $prefix . $custom_field['field_id'], $_POST[$prefix . $custom_field['field_id']] );
            else
                delete_post_meta( $post_id, $prefix . $custom_field['field_id'] );
        }
    }
}
add_action( 'save_post', 'cm_save_custom_fields', 1, 1 );

/**
 * cm_admin_process_update_settings()
 * 
 * Saves the main plugin settings
 */

function cm_process_update_settings() {

    // check whether form is submited 
    if ( !isset( $_POST['cm_submit_settings'] ))
        return;

    // verify wp_nonce
    if ( !wp_verify_nonce( $_POST['cm_submit_settings_secret'], 'cm_submit_settings_verify' ))
        return;
    
    $args = array(
        'page'      => 'home',
        'post_type' => $_POST['post_type']
    );
    
    cm_create_post_type_files( $_POST['post_type_file'] );

    if ( !get_site_option( 'cm_main_settings' )) {
        $new_settings = array( $args['page'] => $args );
    } else {
        $old_settings = get_site_option( 'cm_main_settings' );
        $new_settings = array_merge( $old_settings, array( $args['page'] => $args ));
    }
    
    update_site_option('cm_main_settings', $new_settings );
}
add_action( 'init', 'cm_process_update_settings' );

/**
 * @todo Resolve bug with query_posts resetings the is_home() function.
 * cm_get_posts()
 *
 * @param object $query
 * @return object $query
 */
function cm_get_posts() {
    //@todo
    //global $post;
    $settings = get_site_option('cm_main_settings');

    //@todo
    //wp_reset_query();
    
    if ( is_home() && !in_array( 'default', $settings['home']['post_type'] ))
        query_posts( array( 'post_type' => $settings['home']['post_type'] ));
    //@todo
    //elseif ( $settings[$post->post_name]['page'] == $post->post_name )
    //    query_posts( array( 'post_type' => $settings[$post->post_name]['post_type'] ));
}
add_action( 'template_redirect', 'cm_get_posts', 10 );

/**
 *
 * cm_ajax_actions()
 *
 * Make AJAX POST request for getting the post type info associated with
 * a particular page 
 */
function cm_ajax_actions() { ?>
    <script type="text/javascript" >
        jQuery(document).ready(function($) {
            // bind event to function
            $(window).bind('load', cm_ajax_post_process_request);
            //$('#cm-select-page').bind('change', cm_ajax_post_process_request)

            function cm_ajax_post_process_request() {
                // clear attributes 
                //$('.cm-main input[name="post_type[]"]').attr( 'checked', false );
                // assign variables
                var data = {
                    action: 'cm_get_post_types',
                    cm_ajax_page_name: 'home'
                    //@todo
                    //cm_ajax_page_name: $('#cm-select-page option:selected').val()
                };
                // make the post request and process the response
                $.post(ajaxurl, data, function(response) {
                    $.each(response, function(i,item) {
                        $('.cm-main input[name="post_type[]"][value="' + item + '"]').attr( 'checked', true );
                    });
                });
            }
        });
    </script> <?php
}

/**
 * cm_ajax_action_callback()
 *
 * 
 */
function cm_ajax_action_callback() {

	$page_name = $_POST['cm_ajax_page_name'];
    $settings  = get_site_option('cm_main_settings');

    // json encode the response
    $response = json_encode( $settings[$page_name]['post_type'] );
    //$settings[$page_name]['page'] => $settings[$page_name]['post_type']

	// response output
	header( "Content-Type: application/json" );
    
	echo $response;
	die();
}
add_action('wp_ajax_cm_get_post_types', 'cm_ajax_action_callback');

/**
 * cm_create_post_type_files()
 *
 * Create a copy of the single.php file with the post type name added
 *
 * @param string $post_type
 */
function cm_create_post_type_files( $post_type ) {
    $file = TEMPLATEPATH . '/single.php';

    if ( !empty( $post_type )) {
        foreach ( $post_type as $post_type ) {
            $newfile = TEMPLATEPATH . '/single-' .  $post_type . '.php';

            if ( !file_exists( $newfile )) {
                if ( !copy( $file, $newfile ))
                    echo "failed to copy $file...\n";
            }
        }
    }
}

/**
 * cm_validate_field()
 *
 * Validates input fields data
 *
 * @param string $field
 * @param mixed $value
 * @return bool true/false depending on validation outcome
 */
function cm_validate_field( $field, $value ) {

    if ( $field == 'taxonomy' || $field == 'post_type' ) {
        if ( preg_match('/^[a-zA-Z0-9_]{2,}$/', $value )) {
            return true;
        } else {
            if ( $field == 'post_type' )
                add_action( 'cm_invalid_field_post_type', 'cm_invalid_field_action' );
            if ( $field == 'taxonomy' )
                add_action( 'cm_invalid_field_taxonomy', 'cm_invalid_field_action' );
            return false;
        }
    }

    if ( $field == 'object_type' || $field == 'field_title' || $field == 'field_options' ) {
        if ( empty( $value )) {
            if ( $field == 'object_type' )
                add_action( 'cm_invalid_field_object_type', 'cm_invalid_field_action' );
            if ( $field == 'field_title' )
                add_action( 'cm_invalid_field_title', 'cm_invalid_field_action' );
            if ( $field == 'field_options' )
                add_action( 'cm_invalid_field_options', 'cm_invalid_field_action' );
            return false;
        } else {
            return true;
        }
    }
}

/**
 * cm_invalid_field_action()
 *
 * Prints the invalid field class in the templates
 */
function cm_invalid_field_action() {
    echo( 'form-invalid' );
}

/**
 * cm_set_flush_rewrite_rules()
 *
 * Set the flush rewrite rules and write then in db for later reference
 *
 * @param bool $bool
 */
function cm_set_flush_rewrite_rules( $bool ) {
    // set the flush rewrite rules
    update_site_option( 'cm_flush_rewrite_rules', $bool );
}

/**
 * cm_flush_rewrite_rules()
 *
 * Flush rewrite rules based on db options check
 */
function cm_flush_rewrite_rules() {
    // flush rewrite rules
    if ( get_site_option('cm_flush_rewrite_rules')) {
        flush_rewrite_rules();
        cm_set_flush_rewrite_rules( false );
    }
}

/**
 * cm_check_user_register()
 *
 * Check whether new users are registered, since we need to flush the rewrite
 * rules for them, and upadte the rewrite options
 */
function cm_check_user_register() {
    cm_set_flush_rewrite_rules( true );
}
add_action( 'user_register', 'cm_check_user_register' );

/**
 * cm_init()
 *
 * Allow components to initialize themselves cleanly
 */
function cm_init() {
	do_action( 'cm_init' );
}
add_action( 'cm_loaded', 'cm_init' );

?>