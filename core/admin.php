<?php

/**
 * CustomPress Core Admin Class
 **/
if ( !class_exists('CustomPress_Core_Admin') ):
class CustomPress_Core_Admin extends CustomPress_Core {


    function CustomPress_Core_Admin() {
        $this->init();
    }

    /**
     * Setup plugin hooks.
     *
     * @return void
     **/
    function init() {
        add_action( 'admin_menu', array( &$this, 'admin_menu' ) );
        add_action( 'admin_init', array( &$this, 'admin_head' ) );
    }

    /**
     * Register all admin menues.
     */
    function admin_menu() {
        add_menu_page( __('CustomPress', 'custompress'), __('CustomPress', 'custompress'), 'activate_plugins', 'cp_main', array( &$this, 'handle_admin_requests' ) );
    //  add_submenu_page( 'cp_main', __('Settings', 'custompress'), __('Settings', 'custompress'), 'edit_users', 'cp_main', array( &$this, 'handle_admin_requests' ) );
    }

    /**
     * Get page hook and hook ct_core_enqueue_styles() and ct_core_enqueue_scripts() to it.
     */
    function admin_head() {
        $page = ( isset( $_GET['page'] ) ) ? $_GET['page'] : NULL;
        $hook = get_plugin_page_hook( $page, 'cp_main' );
        /** @todo CustomPress specific hook. Move to CustomPress package. */
        if ( $page == 'cp_main' )
            add_action( 'admin_head-' . $hook, array( &$this, 'ajax_actions' ) );
    }

    /**
     * Loads admin page templates based on $_GET request values and passes variables.
     */
    function handle_admin_requests() {
        if ( $_GET['page'] == 'cp_main' ) {
            if ( isset( $_POST['save'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'verify' ) ) {
                /* Set network-wide content types */
                if ( is_multisite() && is_super_admin() ) {
                    if ( !empty( $_POST['allow_per_site_content_types'] ) )
                        update_site_option( 'allow_per_site_content_types', true );
                    else
                        update_site_option( 'allow_per_site_content_types', false );
                    /* Create template file */
                    if ( !empty( $_POST['post_type_file'] ) ) {
                        $this->create_post_type_files( $_POST['post_type_file'] );
                    }
                }

                /* Process post types display */
                $args = array( 'page' => 'home', 'post_type' => ( isset( $_POST['post_type'] ) ) ? $_POST['post_type'] : NULL );
                $options = $this->get_options();
                $options = array_merge( $options , array( 'display_post_types' => array( $args['page'] => $args ) ) );
                update_option( $this->options_name, $options );
            }
            $this->render_admin('settings');
        }
    }
}
endif;

?>