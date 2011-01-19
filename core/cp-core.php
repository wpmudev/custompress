<?php

/**
 * CustomPress Core Class
 **/
if ( !class_exists('CustomPress_Core') ):
class CustomPress_Core {

    /** @var plugin version */
    var $plugin_version = CP_VERSION;
    /** @var plugin database version */
    var $plugin_db_version = CP_DB_VERSION;
    /** @var string $plugin_url Plugin URL */
    var $plugin_url    = CP_PLUGIN_URL;
    /** @var string $plugin_dir Path to plugin directory */
    var $plugin_dir    = CP_PLUGIN_DIR;
    /** @var string $text_domain The text domain for strings localization */
    var $text_domain   = 'classifieds';

    function CustomPress_Core() {
        /* Hook the init class method to WordPress init hook */
        add_action( 'init', array( &$this, 'init' ) );
    }

    /**
     * Intiate plugin.
     *
     * @return void
     **/
    function init() {
        add_action( 'admin_menu', array( &$this, 'admin_menu' ) );
        add_action( 'admin_init', array( &$this, 'core_hook' ) );
        add_action( 'init', array( &$this, 'process_update_settings') );
        add_filter( 'pre_get_posts', array( &$this, 'display_custom_post_types' ) );
        add_action( 'wp_ajax_cp_get_post_types', array( &$this, 'ajax_action_callback' ) );
        add_action( 'cp_loaded', array( &$this, 'cp_init' ) );
        //add_action( 'init', array( &$this, 'roles' ) );
    }

    /**
     * Initiate variables.
     *
     * @return void
     **/
    function init_vars() {
        
    }

    /**
     * Register all admin menues.
     */
    function admin_menu() {
        add_menu_page( __('CustomPress', 'custompress'), __('CustomPress', 'custompress'), 'edit_users', 'cp_main', array( &$this, 'load_admin_ui' ) );
        add_submenu_page( 'cp_main', __('Settings', 'custompress'), __('Settings', 'custompress'), 'edit_users', 'cp_main', array( &$this, 'load_admin_ui' ) );
    }

    /**
     * Get page hook and hook ct_core_enqueue_styles() and ct_core_enqueue_scripts() to it.
     */
    function core_hook() {
        $page = ( isset( $_GET['page'] ) ) ? $_GET['page'] : NULL;
        if ( function_exists( 'get_plugin_page_hook' ))
            $hook = get_plugin_page_hook( $page, 'cp_main' );
        else
            $hook = 'custom-manager' . '_page_' . $page; /** @todo Make hook plugin specific */

        /** @todo CustomPress specific hook. Move to CustomPress package. */
        if ( $page == 'cp_main' )
            add_action( 'admin_head-' . $hook, array( &$this, 'ajax_actions' ) );
    }

    /**
     * Loads admin page templates based on $_GET request values and passes variables.
     */
    function load_admin_ui() {

        // load CustomPress settings ui
        if ( $_GET['page'] == 'cp_main' ) {
            $post_types = get_site_option( 'ct_custom_post_types' );
            cp_admin_ui_settings( $post_types );
        }
    }

    /**
     * Saves the main plugin settings.
     */
    function process_update_settings() {

        // check whether form is submited
        if ( !isset( $_POST['cp_submit_settings'] ))
            return;

        // verify wp_nonce
        if ( !wp_verify_nonce( $_POST['cp_submit_settings_secret'], 'cp_submit_settings_verify' ))
            return;

        $args = array(
            'page'      => 'home',
            'post_type' => $_POST['post_type']
        );

        $this->create_post_type_files( $_POST['post_type_file'] );

        if ( !get_site_option( 'cp_main_settings' )) {
            $new_settings = array( $args['page'] => $args );
        } else {
            $old_settings = get_site_option( 'cp_main_settings' );
            $new_settings = array_merge( $old_settings, array( $args['page'] => $args ));
        }

        update_site_option('cp_main_settings', $new_settings );
    }

    /**
     * Display custom post types on home page.
     *
     * @param object $query
     * @return object $query
     *
     * @todo Resolve bug with query_posts resetings the is_home() function.
     */
    function display_custom_post_types( $query ) {
        $settings = get_site_option('cp_main_settings');

        if ( is_array( $settings['home']['post_type'] )) {
            if ( is_home() && !in_array( 'default', $settings['home']['post_type'] ) && false == $query->query_vars['suppress_filters'] )
                $query->set( 'post_type', $settings['home']['post_type'] );
        }

        return $query;

        /** @todo Resolve bug with is_home reset for pages
        global $post;
        wp_reset_query();
        if ( is_home() && !in_array( 'default', $settings['home']['post_type'] ))
            query_posts( array( 'post_type' => $settings['home']['post_type'] ));
        elseif ( $settings[$post->post_name]['page'] == $post->post_name )
            query_posts( array( 'post_type' => $settings[$post->post_name]['post_type'] ));
         */
    }

    // @todo
    // add_action( 'template_redirect', 'cp_display_custom_post_types', 10 );

    /**
     * Make AJAX POST request for getting the post type info associated with
     * a particular page.
     */
    function ajax_actions() { ?>
        <script type="text/javascript" >
            jQuery(document).ready(function($) {
                // bind event to function
                $(window).bind('load', cp_ajax_post_process_request);
                //$('#cp-select-page').bind('change', cp_ajax_post_process_request)

                function cp_ajax_post_process_request() {
                    // clear attributes
                    //$('.cp-main input[name="post_type[]"]').attr( 'checked', false );
                    // assign variables
                    var data = {
                        action: 'cp_get_post_types',
                        cp_ajax_page_name: 'home'
                        //@todo
                        //cp_ajax_page_name: $('#cp-select-page option:selected').val()
                    };
                    // make the post request and process the response
                    $.post(ajaxurl, data, function(response) {
                        $.each(response, function(i,item) {
                            $('.cp-main input[name="post_type[]"][value="' + item + '"]').attr( 'checked', true );
                        });
                    });
                }
            });
        </script> <?php
    }

    /**
     * Ajax callback which gets the post types associated with each page.
     */
    function ajax_action_callback() {

        $page_name = $_POST['cp_ajax_page_name'];
        $settings  = get_site_option('cp_main_settings');

        // json encode the response
        $response = json_encode( $settings[$page_name]['post_type'] );
        //$settings[$page_name]['page'] => $settings[$page_name]['post_type']

        // response output
        header( "Content-Type: application/json" );

        echo $response;
        die();
    }


    /**
     * Create a copy of the single.php file with the post type name added
     *
     * @param string $post_type
     */
    function create_post_type_files( $post_type ) {
        $file = TEMPLATEPATH . '/single.php';

        if ( !empty( $post_type )) {
            foreach ( $post_type as $post_type ) {
                $newfile = TEMPLATEPATH . '/single-' .  strtolower( $post_type ) . '.php';
                if ( !file_exists( $newfile )) {
                    if ( !copy( $file, $newfile ))
                        echo "failed to copy $file...\n";
                }
            }
        }
    }

    /**
     * Roles.
     **/
    function roles() {
        global $wp_roles;
        if ( $wp_roles ) {
            $wp_roles->add_cap( 'administrator', 'manage_terms' );
            $wp_roles->add_cap( 'administrator', 'manage_categories' );
            $wp_roles->add_cap( 'administrator', 'edit_terms' );
            $wp_roles->add_cap( 'administrator', 'delete_terms' );
            $wp_roles->add_cap( 'administrator', 'assign_terms' );
        }
    }

    /**
     * Allow components to initialize themselves cleanly
     */
    function cp_init() {
        do_action( 'cp_init' );
    }


}
endif;

/* Initiate Class */
if ( class_exists('CustomPress_Core') )
	$custompress_core = new CustomPress_Core();

?>