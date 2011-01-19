<?php if (!defined('ABSPATH')) die('No direct access allowed!'); ?>

<?php
$allow_per_site_content_types = get_site_option('allow_per_site_content_types');
if ( $allow_per_site_content_types )
    $post_types = get_option('ct_custom_post_types');
else
    $post_types = get_site_option('ct_custom_post_types');
?>

<div class="wrap">
    <?php screen_icon('options-general'); ?>
    <h2><?php _e('CustomPress Settings', 'custompress'); ?></h2>

    <?php $this->render_admin('message'); ?>

    <form action="" method="post" class="cp-main">

        <?php if ( is_multisite() && is_super_admin() ): ?>
        <h3><?php _e( 'Allow', 'directory' ); ?></h3>
        <table class="form-table">
            <tr>
                <th>
                    <label for="allow_per_site_content_types"><?php _e('Allow per site content types.', 'custompress') ?></label>
                </th>
                <td>
                    <input type="checkbox" id="allow_per_site_content_types" name="allow_per_site_content_types" value="1" <?php if ( !empty( $allow_per_site_content_types ) ) echo 'checked="checked"'; ?>  />
                    <span class="description"><?php _e('If you enable this setting, sites on your network will be able to define their own content types. Please note, that these content types are local to each site ( including the root one ) so the already defined network-wide content types will not be available ( unless you uncheck this setting - they are preserved ). If you disable this setting ( default behaviour ) all sites on your network can use the network-wide content types set by you, the Super Admin, but they cannot modify them.', 'directory'); ?></span>
                </td>
            </tr>
        </table>
        <?php endif; ?>

        <h3><?php _e( 'Display', 'custompress' ); ?></h3>
        <table class="form-table">
            <tr>
                <th>
                    <label for="post_type"><?php _e('Display post types on "Home": ', 'custompress') ?></label>
                </th>
                <td>
                    <input type="checkbox" name="post_type[]" value="post" />
                    <span class="description"><strong>post</strong></span>
                    <br />
                    <input type="checkbox" name="post_type[]" value="page" />
                    <span class="description"><strong>page</strong></span>
                    <br />
                    <input type="checkbox" name="post_type[]" value="attachment" />
                    <span class="description"><strong>attachment</strong></span>
                    <br />
                    <?php if ( !empty( $post_types ) ): ?>
                        <?php foreach ( $post_types as $post_type => $args ): ?>
                            <input type="checkbox" name="post_type[]" value="<?php echo( $post_type ); ?>" />
                            <span class="description"><strong><?php echo $post_type; ?></strong></span>
                            <br />
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <br />
                    <span class="description"><?php _e('Check the custom post types you want to display on the "Home" page.', 'custompress'); ?></span>
                    <br /><br />
                    <input type="checkbox" name="post_type[]" value="default" />
                    <span class="description"><strong>default</strong></span><br /><br />
                    <span class="description"><?php _e('If "default" is checked the "Home" page will display the default post types.', 'custompress'); ?></span>
                </td>
            </tr>
        </table>

        <?php if ( is_multisite() && is_super_admin() ): ?>
        <h3><?php _e( 'Template Files', 'custompress' ); ?></h3>
        <table class="form-table">
            <tr>
                <th>
                    <label for="post_type"><?php _e('Create template file for: ', 'custompress') ?></label>
                </th>
                <td>
                    <?php if ( !empty( $post_types )): ?>
                        <?php foreach ( $post_types as $post_type => $args ): ?>
                            <input type="checkbox" name="post_type_file[]" value="<?php echo $post_type; ?>" <?php if ( file_exists( TEMPLATEPATH . '/single-' .  strtolower( $post_type ) . '.php' )) echo( 'checked="checked" disabled="disabled"' ); ?> />
                            <span class="description"><strong><?php echo $post_type; ?></strong></span>
                            <br />
                        <?php endforeach; ?>
                    <?php else: ?>
                        <span class="description"><strong><?php _e('No custom post types available', 'custompress'); ?></strong></span>
                    <?php endif; ?>
                    <br />
                    <span class="description"><?php _e('This will create "single-[post_type].php" file inside your active theme directory. This file will be the custom template for your custom post type. You can then edit and customize it.', 'custompress'); ?></span><br />
                    <span class="description"><?php _e('In some cases you may not want to do that. For example if you don\'t have a template for your custom post type the default "single.php" will be used.', 'custompress'); ?></span><br />
                    <span class="description"><?php _e('Your active theme folder permissions have to be set to 777 for this option to work. After the file is created you can set your active theme directory permissions back to 755.', 'custompress'); ?></span>
                </td>
            </tr>
        </table>
        <?php endif; ?>

        <p class="submit">
            <?php wp_nonce_field('verify'); ?>
            <input type="hidden" name="key" value="general_settings" />
            <input type="submit" class="button-primary" name="save" value="Save Changes">
        </p>
        
    </form>
</div>