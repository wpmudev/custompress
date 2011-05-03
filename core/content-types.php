<?php

/**
 * CustomPress_Content_Types 
 * 
 * @uses CustomPress_Core
 * @copyright Incsub 2007-2011 {@link http://incsub.com}
 * @author Ivan Shaovchev (Incsub) {@link http://ivan.sh} 
 * @license GNU General Public License (Version 2 - GPLv2) {@link http://www.gnu.org/licenses/gpl-2.0.html}
 */
class CustomPress_Content_Types extends CustomPress_Core {

    /** @var array Avilable Post Types */
    var $post_types;
    /** @var array Avilable Taxonomies */
    var $taxonomies;
    /** @var array Avilable Custom Fields */
    var $custom_fields;
    /** @var boolean Flag whether to flush the rewrite rules or not */
    var $flush_rewrite_rules = false;
    /** @var boolean Flag whether the users have the ability to declair post type for their own blogs */
    var $enable_subsite_content_types = false;

    /**
      * Constructor
     *
     * @return void
     */
    function CustomPress_Content_Types() {
        add_action( 'init', array( &$this, 'handle_post_type_requests' ), 0 );
        add_action( 'init', array( &$this, 'register_post_types' ), 2 );
        add_action( 'init', array( &$this, 'handle_taxonomy_requests' ), 0 );
        add_action( 'init', array( &$this, 'register_taxonomies' ), 1 );
        add_action( 'init', array( &$this, 'handle_custom_field_requests' ), 0 );
        add_action( 'admin_menu', array( &$this, 'create_custom_fields' ), 2 );
        add_action( 'save_post', array( &$this, 'save_custom_fields' ), 1, 1 );
        add_action( 'user_register', array( &$this, 'set_user_registration_rewrite_rules' ) );

		$this->init_vars();
    }

    /**
     * Initiate variables
     *
     * @return void
     */
    function init_vars() {
        $this->enable_subsite_content_types = apply_filters( 'enable_subsite_content_types', false );

        if ( $this->enable_subsite_content_types == 1 ) {
            $this->post_types    = get_option( 'ct_custom_post_types' );
            $this->taxonomies    = get_option( 'ct_custom_taxonomies' );
            $this->custom_fields = get_option( 'ct_custom_fields' );
        } else {
            $this->post_types    = get_site_option( 'ct_custom_post_types' );
            $this->taxonomies    = get_site_option( 'ct_custom_taxonomies' );
            $this->custom_fields = get_site_option( 'ct_custom_fields' );
        }

		if ( is_network_admin() ) {
            $this->post_types    = get_site_option( 'ct_custom_post_types' );
            $this->taxonomies    = get_site_option( 'ct_custom_taxonomies' );
            $this->custom_fields = get_site_option( 'ct_custom_fields' );
		}
    }

    /**
     * Intercept $_POST request and processes the custom post type submissions.
     *
     * @return void
     */
    function handle_post_type_requests() {
		// If add/update request is made 
        if ( isset( $_POST['submit'] ) 
            && isset( $_POST['_wpnonce'] ) 
            && wp_verify_nonce( $_POST['_wpnonce'], 'submit_post_type' ) 
        ) {
			// Validate input fields 
            if ( $this->validate_field( 'post_type', $_POST['post_type'] ) ) {
				// Post type labels 
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
				// Post type args 
                $args = array(
                    'labels'              => $labels,
                    'supports'            => $_POST['supports'],
                    'capability_type'     => ( isset( $_POST['capability_type'] ) ) ? $_POST['capability_type'] : 'post',
                    'description'         => $_POST['description'],
                    'menu_position'       => (int)  $_POST['menu_position'],
                    'public'              => (bool) $_POST['public'] ,
                    'show_ui'             => ( isset( $_POST['show_ui'] ) ) ? (bool) $_POST['show_ui'] : null,
                    'show_in_nav_menus'   => ( isset( $_POST['show_in_nav_menus'] ) ) ? (bool) $_POST['show_in_nav_menus'] : null,
                    'publicly_queryable'  => ( isset( $_POST['publicly_queryable'] ) ) ? (bool) $_POST['publicly_queryable'] : null,
                    'exclude_from_search' => ( isset( $_POST['exclude_from_search'] ) ) ? (bool) $_POST['exclude_from_search'] : null,
                    'hierarchical'        => (bool) $_POST['hierarchical'],
					'has_archive'		  => (bool) $_POST['has_archive'],
                    'rewrite'             => (bool) $_POST['rewrite'],
                    'query_var'           => (bool) $_POST['query_var'],
                    'can_export'          => (bool) $_POST['can_export']
                );

				// Remove empty labels so we can use the defaults 
                foreach( $args['labels'] as $key => $value ) {
                    if ( empty( $value ) )
                        unset( $args['labels'][$key] );
                }

				// Set menu icon 
                if ( !empty( $_POST['menu_icon'] ) )
                   $args['menu_icon'] = $_POST['menu_icon'];

				// remove keys so we can use the defaults 
                if ( $_POST['public'] == 'advanced' ) {
                    unset( $args['public'] );
                } else {
                    unset( $args['show_ui'] );
                    unset( $args['show_in_nav_menus'] );
                    unset( $args['publicly_queryable'] );
                    unset( $args['exclude_from_search'] );
                }

				// Set slug for post type archive pages
				if ( !empty( $_POST['has_archive_slug'] ) ) 
					$args['has_archive'] = $_POST['has_archive_slug']; 

				// Customize taxonomy rewrite  
                if ( !empty( $_POST['rewrite'] ) ) {

					if ( !empty( $_POST['rewrite_slug'] ) )
						$args['rewrite'] = (array) $args['rewrite'] + array( 'slug' => $_POST['rewrite_slug'] );

					$args['rewrite'] = (array) $args['rewrite'] + array( 'with_front' => !empty( $_POST['rewrite_with_front'] ) ? true : false );
					$args['rewrite'] = (array) $args['rewrite'] + array( 'feeds' => !empty( $_POST['rewrite_feeds'] ) ? true : false );
					$args['rewrite'] = (array) $args['rewrite'] + array( 'pages' => !empty( $_POST['rewrite_pages'] ) ? true : false );

					// Remove boolean remaining from the type casting
					if ( is_array( $args['rewrite'] ) )
						unset( $args['rewrite'][0] );

                    $this->flush_rewrite_rules = true;
                }

				// Set post type 
                $post_type = ( $_POST['post_type'] ) ? $_POST['post_type'] : $_GET['ct_edit_post_type'];

				// Set new post types 
                $post_types = ( $this->post_types ) ? array_merge( $this->post_types, array( $post_type => $args ) ) : array( $post_type => $args );

				// Check whether we have a new post type and set flag which will later be used in register_post_types() 
                if ( !is_array( $this->post_types ) || !array_key_exists( $post_type, $this->post_types ) )
                    $this->flush_rewrite_rules = true;
				
				// Update options with the post type options 
                if ( $this->enable_subsite_content_types == 1 && !is_network_admin() ) {
                    update_option( 'ct_custom_post_types', $post_types );
                } else {
                    update_site_option( 'ct_custom_post_types', $post_types );
					// Set flag for flush rewrite rules network-wide 
                    if ( $this->flush_rewrite_rules ) {
                        update_site_option( 'ct_frr_id', uniqid('') );
                    }
                }

				// Redirect to post types page 
				wp_redirect( self_admin_url( 'admin.php?page=ct_content_types&ct_content_type=post_type&updated&frr=' . $this->flush_rewrite_rules ) );
            }
        }
        elseif ( isset( $_POST['submit'] ) 
            && isset( $_POST['_wpnonce'] )
            && wp_verify_nonce( $_POST['_wpnonce'], 'delete_post_type' )  
        ) {
            $post_types = $this->post_types;
			// remove the deleted post type 
            unset( $post_types[$_POST['post_type_name']] );
			// update the available post types 
            if ( $this->enable_subsite_content_types == 1 && !is_network_admin() )
                update_option( 'ct_custom_post_types', $post_types );
            else
                update_site_option( 'ct_custom_post_types', $post_types );
			// Redirect to post types page 
            wp_redirect( self_admin_url( 'admin.php?page=ct_content_types&ct_content_type=post_type&updated' ));
        }
        elseif ( isset( $_POST['redirect_add_post_type'] ) ) {
            wp_redirect( self_admin_url( 'admin.php?page=ct_content_types&ct_content_type=post_type&ct_add_post_type=true' ) );
        }
    }

    /**
     * Get available custom post types and register them.
     * The function attach itself to the init hook and uses priority of 2. It loads
     * after the register_taxonomies() function which hooks itself to the init
     * hook with priority of 1 ( that's kinda improtant ) .
     *
     * @return void
     */
    function register_post_types() {
		// TODO This sucks, think of a better way 
		$keep_network_content_types = get_site_option('keep_network_content_types');

		if ( $keep_network_content_types == 1 ) {
			$post_types = get_site_option('ct_custom_post_types');
			// Register each post type if array of data is returned 
			if ( is_array( $post_types ) ) {
				foreach ( $post_types as $post_type => $args )
					register_post_type( $post_type, $args );
			}
		}

        $post_types = $this->post_types;
		// Register each post type if array of data is returned 
        if ( is_array( $post_types ) ) {
            foreach ( $post_types as $post_type => $args )
                register_post_type( $post_type, $args );
        }

        $this->flush_rewrite_rules();
    }

    /**
     * Intercepts $_POST request and processes the custom taxonomy requests
     *
     * @return void
     */
    function handle_taxonomy_requests() {
		// If valid add/edit taxonomy request is made 
        if (   isset( $_POST['submit'] ) 
            && isset( $_POST['_wpnonce'] )
            && wp_verify_nonce( $_POST['_wpnonce'], 'submit_taxonomy' ) 
        ) {
			// Validate input fields 
            $valid_taxonomy = $this->validate_field( 'taxonomy', ( isset( $_POST['taxonomy'] ) ) ? $_POST['taxonomy'] : null );
            $valid_object_type = $this->validate_field( 'object_type', ( isset( $_POST['object_type'] ) ) ? $_POST['object_type'] : null );

            if ( $valid_taxonomy && $valid_object_type ) {
				// Construct args 
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
                    'show_ui'             => ( isset( $_POST['show_ui'] ) ) ? (bool) $_POST['show_ui'] : null,
                    'show_tagcloud'       => ( isset( $_POST['show_tagcloud'] ) ) ? (bool) $_POST['show_tagcloud'] : null,
                    'show_in_nav_menus'   => ( isset( $_POST['show_in_nav_menus'] ) ) ? (bool) $_POST['show_in_nav_menus'] : null,
                    'hierarchical'        => (bool) $_POST['hierarchical'],
                    'rewrite'             => (bool) $_POST['rewrite'],
                    'query_var'           => (bool) $_POST['query_var']
                //  'capabilities'        => array () /** TODO implement advanced capabilities */
                );

				// Remove empty values from labels so we can use the defaults 
                foreach( $args['labels'] as $key => $value ) {
                    if ( empty( $value ))
                        unset( $args['labels'][$key] );
                }

				// If no advanced is set, unset values so we can use the defaults 
                if ( $_POST['public'] == 'advanced' ) {
                    unset( $args['public'] );
                } else {
                    unset( $args['show_ui'] );
                    unset( $args['show_tagcloud'] );
                    unset( $args['show_in_nav_menus'] );
                }

				// Customize taxonomy rewrite  
                if ( !empty( $_POST['rewrite'] ) ) {

					if ( !empty( $_POST['rewrite_slug'] ) )
						$args['rewrite'] = (array) $args['rewrite'] + array( 'slug' => $_POST['rewrite_slug'] );

					$args['rewrite'] = (array) $args['rewrite'] + array( 'with_front' => !empty( $_POST['rewrite_with_front'] ) ? true : false );
					$args['rewrite'] = (array) $args['rewrite'] + array( 'hierarchical' => !empty( $_POST['rewrite_hierarchical'] ) ? true : false );

					// Remove boolean remaining from the type casting
					if ( is_array( $args['rewrite'] ) )
						unset( $args['rewrite'][0] );

                    $this->flush_rewrite_rules = true;
                }

				// Set the assiciated object types ( post types ) 
                $object_type = $_POST['object_type'];

				// Set the taxonomy which we are adding/updating 
                $taxonomy = ( isset( $_POST['taxonomy'] )) ? $_POST['taxonomy'] : $_GET['ct_edit_taxonomy'];

				// Set new taxonomies 
                $taxonomies = ( $this->taxonomies )
                    ? array_merge( $this->taxonomies, array( $taxonomy => array( 'object_type' => $object_type, 'args' => $args ) ) )
                    : array( $taxonomy => array( 'object_type' => $object_type, 'args' => $args ) );

				// Check whether we have a new post type and set flush rewrite rules 
				if ( !is_array( $this->taxonomies ) || !array_key_exists( $taxonomy, $this->taxonomies ) )
					$this->flush_rewrite_rules = true;

				// Update wp_options with the taxonomies options 
                if ( $this->enable_subsite_content_types == 1 && !is_network_admin() ) {
                    update_option( 'ct_custom_taxonomies', $taxonomies );
                } else {
                    update_site_option( 'ct_custom_taxonomies', $taxonomies );

					// Set flag for flush rewrite rules network-wide 
                    if ( $this->flush_rewrite_rules == true ) {
                        update_site_option( 'ct_frr_id', uniqid('') );
                    }
                }

				// Redirect back to the taxonomies page 
				wp_redirect( self_admin_url( 'admin.php?page=ct_content_types&ct_content_type=taxonomy&updated&frr' . $this->flush_rewrite_rules ) );
            }
        }
        elseif ( isset( $_POST['submit'] ) 
            && isset( $_POST['_wpnonce'] )
            && wp_verify_nonce( $_POST['_wpnonce'], 'delete_taxonomy' ) 
        ) {
			// Set available taxonomies 
            $taxonomies = $this->taxonomies;

			// Remove the deleted taxonomy 
            unset( $taxonomies[$_POST['taxonomy_name']] );

			// Update the available taxonomies 
            if ( $this->enable_subsite_content_types == 1 && !is_network_admin() )
                update_option( 'ct_custom_taxonomies', $taxonomies );
            else
                update_site_option( 'ct_custom_taxonomies', $taxonomies );

			// Redirect back to the taxonomies page 
            wp_redirect( self_admin_url( 'admin.php?page=ct_content_types&ct_content_type=taxonomy&updated' ) );
        }
        elseif ( isset( $_POST['redirect_add_taxonomy'] ) ) {
            wp_redirect( self_admin_url( 'admin.php?page=ct_content_types&ct_content_type=taxonomy&ct_add_taxonomy=true' ));
        }
    }

    /**
     * Get available custom taxonomies and register them.
     * The function attaches itself to the init hook and uses priority of 1. It loads
     * before the ct_admin_register_post_types() func which hook itself to the init
     * hook with priority of 2 ( that's kinda important )
     *
     * @uses apply_filters() You can use the 'sort_custom_taxonomies' filter hook to sort your taxonomies
     * @return void
     */
    function register_taxonomies() {
		// TODO This sucks, think of a better way 
		$keep_network_content_types = get_site_option('keep_network_content_types');

		if ( $keep_network_content_types == 1 ) {
			$taxonomies = get_site_option('ct_custom_taxonomies');
			// If custom taxonomies are present, register them 
			if ( is_array( $taxonomies ) ) {
				// Register taxonomies 
				foreach ( $taxonomies as $taxonomy => $args )
					register_taxonomy( $taxonomy, $args['object_type'], $args['args'] );
			}
		}

        $taxonomies = $this->taxonomies;
		// Plugins can filter this value and sort taxonomies 
        $sort = null;
        $sort = apply_filters( 'sort_custom_taxonomies', $sort );
		// If custom taxonomies are present, register them 
        if ( is_array( $taxonomies ) ) {
			// Sort taxonomies 
            if ( $sort == 'alphabetical' )
                ksort( $taxonomies );
			// Register taxonomies 
            foreach ( $taxonomies as $taxonomy => $args )
                register_taxonomy( $taxonomy, $args['object_type'], $args['args'] );
        }
    }

    /**
     * Intercepts $_POST request and processes the custom fields submissions
     */
    function handle_custom_field_requests() {
		// If valid add/edit custom field request is made 
        if ( isset( $_POST['submit'] ) 
            && isset( $_POST['_wpnonce'] )
            && wp_verify_nonce( $_POST['_wpnonce'], 'submit_custom_field' ) 
        ) {
			// Validate input fields data 
            $field_title_valid       = $this->validate_field( 'field_title', ( isset( $_POST['field_title'] ) ) ? $_POST['field_title'] : null );
            $field_object_type_valid = $this->validate_field( 'object_type', ( isset( $_POST['object_type'] ) ) ? $_POST['object_type'] : null );

			// Check for specific field types and validate differently 
            if ( in_array( $_POST['field_type'], array( 'radio', 'checkbox', 'selectbox', 'multiselectbox' ) ) ) {
                $field_options_valid = $this->validate_field( 'field_options', $_POST['field_options'][1] );
				// Check whether fields pass the validation, if not stop execution and return 
                if ( $field_title_valid == false || $field_object_type_valid == false || $field_options_valid == false )
                    return;
            } else {
				// Check whether fields pass the validation, if not stop execution and return 
                if ( $field_title_valid == false || $field_object_type_valid == false )
                    return;
            }

            $field_id = ( empty( $_GET['ct_edit_custom_field'] )) ? $_POST['field_type'] . '_' . uniqid('') : $_GET['ct_edit_custom_field'];

            $args = array(
                'field_title'          => $_POST['field_title'],
                'field_type'           => $_POST['field_type'],
                'field_sort_order'     => $_POST['field_sort_order'],
                'field_options'        => $_POST['field_options'],
                'field_default_option' => ( isset( $_POST['field_default_option'] ) ) ? $_POST['field_default_option'] : NULL,
                'field_description'    => $_POST['field_description'],
                'object_type'          => $_POST['object_type'],
                //'required'             => $_POST['required'],
                'field_id'             => $field_id
            );

			// Unset if there are no options to be stored in the db 
            if ( $args['field_type'] == 'text' || $args['field_type'] == 'textarea' )
                unset( $args['field_options'] );

			// Set new custom fields 
			$custom_fields = ( $this->custom_fields ) 
				? array_merge( $this->custom_fields, array( $field_id => $args ) ) 
				: array( $field_id => $args );

            if ( $this->enable_subsite_content_types == 1 && !is_network_admin() )
                update_option( 'ct_custom_fields', $custom_fields );
            else
                update_site_option( 'ct_custom_fields', $custom_fields );

            wp_redirect( self_admin_url( 'admin.php?page=ct_content_types&ct_content_type=custom_field&updated' ) );
        }
        elseif ( isset( $_POST['submit'] ) 
            && isset( $_POST['_wpnonce'] ) 
            && wp_verify_nonce( $_POST['_wpnonce'], 'delete_custom_field' ) 
        ) {
			// Set available custom fields 
            $custom_fields = $this->custom_fields;

			// Remove the deleted custom field 
            unset( $custom_fields[$_POST['custom_field_id']] );

			// Update the available custom fields 
            if ( $this->enable_subsite_content_types == 1 && !is_network_admin() )
                update_option( 'ct_custom_fields', $custom_fields );
            else
                update_site_option( 'ct_custom_fields', $custom_fields );

			// Redirect back to the taxonomies page 
            wp_redirect( self_admin_url( 'admin.php?page=ct_content_types&ct_content_type=custom_field&updated' ) );
        }
        elseif ( isset( $_POST['redirect_add_custom_field'] ) ) {
            wp_redirect( self_admin_url( 'admin.php?page=ct_content_types&ct_content_type=custom_field&ct_add_custom_field=true' ));
        }
    }

    /**
     * Create the custom fields
     *
     * @return void
     */
    function create_custom_fields() {
		// TODO This sucks, think of a better way 
		$keep_network_content_types = get_site_option('keep_network_content_types');

		if ( $keep_network_content_types == 1 ) {
			$custom_fields = get_site_option('ct_custom_fields');

			if ( !empty( $custom_fields ) ) {
				foreach ( $custom_fields as $custom_field ) {
					foreach ( $custom_field['object_type'] as $object_type )
						add_meta_box( 'ct-network-custom-fields', 'Default Custom Fields', array( &$this, 'display_custom_fields_network' ), $object_type, 'normal', 'high' );
				}
			}
		}

        $custom_fields = $this->custom_fields;

        if ( !empty( $custom_fields ) ) {
            foreach ( $custom_fields as $custom_field ) {
                foreach ( $custom_field['object_type'] as $object_type )
                    add_meta_box( 'ct-custom-fields', 'Custom Fields', array( &$this, 'display_custom_fields' ), $object_type, 'normal', 'high' );
            }
        }
    }

    /**
     * Display custom fields template on add custom post pages
     *
     * @return void
     */
    function display_custom_fields() {
        $this->render_admin('display-custom-fields', array( 'type' => 'local' ) );
    }

    /**
     * Display custom fields template on add custom post pages
     *
     * @return void
     */
    function display_custom_fields_network() {
        $this->render_admin('display-custom-fields', array( 'type' => 'network' ) );
    }

    /**
     * Save custom fields data
     *
     * @param int $post_id The post id of the post being edited
     */
    function save_custom_fields( $post_id ) {
		// Prevent autosave from deleting the custom fields 
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE || defined('DOING_AJAX') && DOING_AJAX )
            return;

        $prefix = '_ct_';
        $custom_fields = $this->custom_fields;

        if ( !empty( $custom_fields )) {
            foreach ( $custom_fields as $custom_field ) {
                if ( isset( $_POST[$prefix . $custom_field['field_id']] ))
                    update_post_meta( $post_id, $prefix . $custom_field['field_id'], $_POST[$prefix . $custom_field['field_id']] );
                else
                    delete_post_meta( $post_id, $prefix . $custom_field['field_id'] );
            }
        }
    }

    /**
     * Flush rewrite rules based on boolean check
     *
     * @return void
     */
    function flush_rewrite_rules() {
		// Mechanisum for detecting changes in sub-site content types for flushing rewrite rules 
        if ( is_multisite() && !is_main_site() && $this->enable_subsite_content_types == 0 ) {
            $global_frr_id = get_site_option('ct_frr_id');
            $local_frr_id = get_option('ct_frr_id');
            if ( $global_frr_id != $local_frr_id ) {
                $this->flush_rewrite_rules = true;
                update_option('ct_frr_id', $global_frr_id );
            }
        }

        // flush rewrite rules
        if ( $this->flush_rewrite_rules || !empty( $_GET['frr'] ) ) {
            flush_rewrite_rules(false);
            $this->flush_rewrite_rules = false;
        }
    }

    /**
     * Check whether new users are registered, since we need to flush the rewrite
     * rules for them.
     *
     * @return void
     */
    function set_user_registration_rewrite_rules() {
        $this->flush_rewrite_rules = true;
    }

    /**
     * Validates input fields data
     *
     * @param string $field
     * @param mixed $value
     * @return bool true/false depending on validation outcome
     */
    function validate_field( $field, $value ) {
		// Validate set of common fields 
        if ( $field == 'taxonomy' || $field == 'post_type' ) {
			// Regular expression. Checks for alphabetic characters and underscores only 
            if ( preg_match( '/^[a-zA-Z0-9_]{2,}$/', $value ) ) {
                return true;
            } else {
                if ( $field == 'post_type' )
                    add_action( 'ct_invalid_field_post_type', create_function( '', 'echo "form-invalid";' ) );
                if ( $field == 'taxonomy' )
                    add_action( 'ct_invalid_field_taxonomy', create_function( '', 'echo "form-invalid";' ) );
                return false;
            }
        }
		// Validate set of common fields 
        if ( $field == 'object_type' || $field == 'field_title' || $field == 'field_options' ) {
            if ( empty( $value ) ) {
                if ( $field == 'object_type' )
                    add_action( 'ct_invalid_field_object_type', create_function( '', 'echo "form-invalid";' ) );
                if ( $field == 'field_title' )
                    add_action( 'ct_invalid_field_title', create_function( '', 'echo "form-invalid";' ) );
                if ( $field == 'field_options' )
                    add_action( 'ct_invalid_field_options', create_function( '', 'echo "form-invalid";' ) );
                return false;
            } else {
                return true;
            }
        }
    }
}

// Initiate Content Types Module 
new CustomPress_Content_Types();

?>
