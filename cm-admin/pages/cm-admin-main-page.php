<?php

function cm_admin_main_page( $post_types, $taxonomies, $custom_fields ) { ?>
    <div class="wrap cm-wrap">
        <h2><?php _e('Custom Manager', 'custommanager'); ?></h2>
        <?php $settings = get_site_option('cm_main_settings'); ?>
        <form action="" method="post" class="cm-main">
            <?php wp_nonce_field( 'cm_submit_settings_verify', 'cm_submit_settings_secret' ); ?>
            <?php /** @todo
            <div class="updated below-h2" id="message">
                <p><a href=""></a></p>
            </div> */ ?>
            <table class="form-table">
                <tr>
                    <th>
                        <label for="post_type"><?php _e('Display post types on: ', 'custommanager') ?></label>
                    </th>
                    <td>
                       <?php $pages = get_pages(); ?>

                       <span>Page: </span>
                       <select name="page" id="cm-select-page">
                           <option value="home" selected="selected">home</option>
                            <?php foreach ( $pages as $page ): ?>
                                <option value="<?php echo( $page->post_name ); ?>"><?php echo( $page->post_name ); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="description"><?php _e('Select page on which you want to display custom post types. You can define custom post types for more than one page.', 'custommanager'); ?></span>
                        <br /><br />
                        
                        <input type="checkbox" name="post_type[]" value="post" />
                        <span class="description"><strong>post</strong></span>
                        <br />
                        <input type="checkbox" name="post_type[]" value="page" />
                        <span class="description"><strong>page</strong></span>
                        <br />
                        <input type="checkbox" name="post_type[]" value="attachment" />
                        <span class="description"><strong>attachment</strong></span>
                        <br />
                        <?php if ( !empty( $post_types )): ?>
                            <?php foreach ( $post_types as $post_type => $args ): ?>
                            <input type="checkbox" name="post_type[]" value="<?php echo( $post_type ); ?>" />
                            <span class="description"><strong><?php echo( $post_type ); ?></strong></span>
                            <br />
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <br />
                        <span class="description"><?php _e('Check the custom post types you want to display on the selected page.', 'custommanager'); ?></span>
                        
                        <div class="cm-embed-codes"></div>
                    </td>
                </tr>
            </table>
            <table class="form-table">
                <tr>
                    <th>
                        <label for="post_type"><?php _e('Create theme file for: ', 'custommanager') ?></label>
                    </th>
                    <td>
                        <?php if ( !empty( $post_types )): ?>
                            <?php foreach ( $post_types as $post_type => $args ): ?>
                            <input type="checkbox" name="post_type_file[]" value="<?php echo( $post_type ); ?>" <?php if ( file_exists( TEMPLATEPATH . '/single-' .  $post_type . '.php' )) echo( 'checked="checked" disabled="disabled"' ); ?> />
                            <span class="description"><strong><?php echo( $post_type ); ?></strong></span>
                            <br />
                            <?php endforeach; ?>
                        <?php else: ?>
                            <span class="description"><strong><?php _e('No custom post types available', 'custommanager'); ?></strong></span>
                        <?php endif; ?>
                        <br />
                        <span class="description"><?php _e('Your active theme folder permissions have to be set to 777 for this option to work. This will create "single-[post_type].php" file inside your theme.This file will be the custom template for your custom post type. You can then edit the file and customize it however you like. After you finish editing you can set your folder permission back to 755.', 'custommanager'); ?></span>

                        <div class="cm-embed-codes"></div>
                    </td>
                </tr>
            </table>
            <table class="form-table">
                <tr>
                    <th>
                        <label for="post_type"><?php _e('Embed your custom taxonomies: ', 'custommanager') ?></label>
                    </th>
                    <td>
                            <span class="description"><code>[phptag] echo get_the_term_list( $post->ID, '<strong>taxonomy_name</strong>', '<strong>Text before taxonomy: </strong>', ', ', '' ); [/phptag]</code></span>
                        <br />
                        <span class="description"><?php _e('Replace [phptag] and [/phptag] with their proper php notation. Fill in the taxonomy "taxonomy_name" and "Text before taxonomy:". Place this in your "single-[post_type].php" file ( if you have it created ).', 'custommanager'); ?></span>

                        <div class="cm-embed-codes"></div>
                    </td>
                </tr>
            </table>
            <input type="submit" class="button-primary" name="cm_submit_settings" value="Save Changes">
        </form>

  
    </div> <?php
}

?>