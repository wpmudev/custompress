<?php

function cm_admin_content_types_page() { ?>
    <div class="wrap cm-wrap cm-content-types">
        <div class="icon32" id="icon-edit"><br></div>
        <h2>
            <a class="nav-tab <?php if ( $_GET['cm_content_type'] == 'post_type' || !isset( $_GET['cm_content_type'] )) { echo( 'nav-tab-active' ); } ?>" href="admin.php?page=cm_content_types&cm_content_type=post_type"><?php _e('Post Types', 'custompress'); ?></a>
            <a class="nav-tab <?php if ( $_GET['cm_content_type'] == 'taxonomy' ) { echo( 'nav-tab-active' ); } ?>" href="admin.php?page=cm_content_types&cm_content_type=taxonomy"><?php _e('Taxonomies', 'custompress'); ?></a>
            <a class="nav-tab <?php if ( $_GET['cm_content_type'] == 'custom_field' ) { echo( 'nav-tab-active' ); } ?>" href="admin.php?page=cm_content_types&cm_content_type=custom_field"><?php _e('Custom Fields', 'custompress'); ?></a>
        </h2>

        <?php
        if ( $_GET['cm_content_type'] == 'post_type' || !isset( $_GET['cm_content_type'] )) {
            if ( isset( $_GET['cm_add_post_type'] )) {
                include_once 'cm-admin-add-post-type-page.php';
                cm_admin_add_post_type_page();
            }
            elseif ( isset( $_GET['cm_edit_post_type'] )) {
                include_once 'cm-admin-edit-post-type-page.php';
                $post_types = get_site_option( 'cm_custom_post_types' );
                cm_admin_edit_post_type_page( $post_types[$_GET['cm_edit_post_type']] );
            }
            elseif ( isset( $_GET['cm_delete_post_type'] )) {
                include_once 'cm-admin-delete-post-type-page.php';
                $post_types = get_site_option( 'cm_custom_post_types' );
                cm_admin_delete_post_type_page( $post_types[$_GET['cm_delete_post_type']] );
            }
            else {
                include_once 'cm-admin-post-types-page.php';
                $post_types = get_site_option( 'cm_custom_post_types' );
                cm_admin_post_types_page( $post_types );
            }
        }
        elseif ( $_GET['cm_content_type'] == 'taxonomy' ) {
            if ( isset( $_GET['cm_add_taxonomy'] )) {
                include_once 'cm-admin-add-taxonomy-page.php';
                $post_types = get_post_types('','names');
                cm_admin_add_taxonomy_page( $post_types );
            }
            elseif ( isset( $_GET['cm_edit_taxonomy'] )) {
                include_once 'cm-admin-edit-taxonomy-page.php';
                $taxonomies = get_site_option( 'cm_custom_taxonomies' );
                $post_types = get_post_types('','names');
                cm_admin_edit_taxonomy_page( $taxonomies[$_GET['cm_edit_taxonomy']], $post_types );
            }
            elseif ( isset( $_GET['cm_delete_taxonomy'] )) {
                include_once 'cm-admin-delete-taxonomy-page.php';
                $taxonomies = get_site_option( 'cm_custom_taxonomies' );
                cm_admin_delete_taxonomy_page( $taxonomies[$_GET['cm_delete_taxonomy']] );
            }
            else {
                include_once 'cm-admin-taxonomies-page.php';
                $taxonomies = get_site_option( 'cm_custom_taxonomies' );
                cm_admin_taxonomies_page( $taxonomies );
            }
        }
        elseif ( $_GET['cm_content_type'] == 'custom_field' ) {
            if ( isset( $_GET['cm_add_custom_field'] )) {
                include_once 'cm-admin-add-custom-field-page.php';
                $post_types = get_post_types('','names');
                cm_admin_add_custom_field_page( $post_types );
            }
            elseif ( isset( $_GET['cm_edit_custom_field'] )) {
                include_once 'cm-admin-edit-custom-field-page.php';
                $custom_fields = get_site_option( 'cm_custom_fields' );
                $post_types = get_post_types('','names');
                cm_admin_edit_custom_field_page( $custom_fields[$_GET['cm_edit_custom_field']], $post_types );
            }
            elseif ( isset( $_GET['cm_delete_custom_field'] )) {
                include_once 'cm-admin-delete-custom-field-page.php';
                $custom_fields = get_site_option( 'cm_custom_fields' );
                cm_admin_delete_custom_field_page( $custom_fields[$_GET['cm_delete_custom_field']] );
            }
            else {
                include_once 'cm-admin-custom-fields-page.php';
                $custom_fields = get_site_option( 'cm_custom_fields' );
                cm_admin_custom_fields_page( $custom_fields );
            }
        }
        ?>

    </div>
<?php 
}
?>
