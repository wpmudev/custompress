<?php

function cm_admin_delete_post_type_page( $args ) {
    $nonce = wp_create_nonce( 'cm_delete_post_type_verify' ); ?>

    <div class="wrap cm-wrap">
        <h2><?php _e('Delete Post Type', 'custommanager'); ?></h2>
        <form name="cm_form_delete_post_type" action="" method="post" class="cm-form-single-btn">
            <input type="hidden" name="cm_delete_post_type_secret" value="<?php echo( $nonce ); ?>" />
            <input type="submit" class="button-secondary" name="cm_delete_button" value="<?php _e('Delete Permanently', 'custommanager'); ?>" />
        </form>
        <table class="widefat">
            <thead>
                <tr>
                    <th><?php _e('Post Type', 'custommanager'); ?></th>
                    <th><?php _e('Name', 'custommanager'); ?></th>
                    <th><?php _e('Description', 'custommanager'); ?></th>
                    <th><?php _e('Menu Icon', 'custommanager'); ?></th>
                    <th><?php _e('Public', 'custommanager'); ?></th>
                    <th><?php _e('Hierarchical', 'custommanager'); ?></th>
                    <th><?php _e('Rewrite', 'custommanager'); ?></th>
                    <th><?php _e('Supports', 'custommanager'); ?></th>
                    <th><?php _e('Capability Type', 'custommanager'); ?></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th><?php _e('Post Type', 'custommanager'); ?></th>
                    <th><?php _e('Name', 'custommanager'); ?></th>
                    <th><?php _e('Description', 'custommanager'); ?></th>
                    <th><?php _e('Menu Icon', 'custommanager'); ?></th>
                    <th><?php _e('Public', 'custommanager'); ?></th>
                    <th><?php _e('Hierarchical', 'custommanager'); ?></th>
                    <th><?php _e('Rewrite', 'custommanager'); ?></th>
                    <th><?php _e('Supports', 'custommanager'); ?></th>
                    <th><?php _e('Capability Type', 'custommanager'); ?></th>
                </tr>
            </tfoot>
            <tbody>
                <tr>
                    <td>
                        <strong>
                            <a href="<?php echo( admin_url( 'admin.php?page=' . $_GET['page'] . '&cm_edit_post_type=' . $_GET['cm_delete_post_type'] ) ); ?>"><?php echo( $_GET['cm_delete_post_type'] ); ?></a>
                        </strong>
                        <div class="row-actions">
                            <span class="edit">
                                <a title="<?php _e('Edit this post type', 'custommanager'); ?>" href="<?php echo( admin_url( 'admin.php?page=' . $_GET['page'] . '&cm_edit_post_type=' . $_GET['cm_delete_post_type'] ) ); ?>"><?php _e('Edit', 'custommanager'); ?></a> |
                            </span>
                            <span class="trash">
                                <a class="submitdelete" href="<?php echo( admin_url( 'admin.php?page=' . $_GET['page'] . '&cm_delete_post_type=' . $_GET['cm_delete_post_type'] . '&cm_delete_post_type_secret=' . $nonce ) ); ?>"><?php _e('Delete Permanently', 'custommanager'); ?></a>
                            </span>
                        </div>
                    </td>
                    <td><?php echo( $args['labels']['name'] ); ?></td>
                    <td><?php echo( $args['description'] ); ?></td>
                    <td>
                        <img src="<?php echo( $args['menu_icon'] ); ?>" alt="<?php if ( empty( $args['menu_icon'] ) ) echo( 'No Icon'); ?>" />
                    </td>
                    <td>
                        <?php if ( $args['public'] == null ): ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/advanced.png' ); ?>" alt="<?php _e('Advanced', 'custommanager'); ?>" title="<?php _e('Advanced', 'custommanager'); ?>" />
                        <?php elseif ( $args['public'] ): ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/true.png' ); ?>" alt="<?php _e('True', 'custommanager'); ?>" title="<?php _e('True', 'custommanager'); ?>" />
                        <?php else: ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/false.png' ); ?>" alt="<?php _e('False', 'custommanager'); ?>" title="<?php _e('False', 'custommanager'); ?>" />
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ( $args['hierarchical'] ): ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/true.png' ); ?>" alt="<?php _e('True', 'custommanager'); ?>" title="<?php _e('True', 'custommanager'); ?>" />
                        <?php else: ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/false.png' ); ?>" alt="<?php _e('False', 'custommanager'); ?>" title="<?php _e('False', 'custommanager'); ?>" />
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ( $args['rewrite'] ): ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/true.png' ); ?>" alt="<?php _e('True', 'custommanager'); ?>" title="<?php _e('True', 'custommanager'); ?>" />
                        <?php else: ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/false.png' ); ?>" alt="<?php _e('False', 'custommanager'); ?>" title="<?php _e('False', 'custommanager'); ?>" />
                        <?php endif; ?>
                    </td>
                    <td class="cm-supports">
                        <?php foreach ( $args['supports'] as $value ): ?>
                            <?php echo( $value ); ?>
                        <?php endforeach; ?>
                    </td>
                    <td><?php echo( $args['capability_type'] ); ?></td>
                </tr>
            </tbody>
        </table>
        <form name="cm_form_delete_post_type" action="" method="post" class="cm-form-single-btn">
            <input type="hidden" name="cm_delete_post_type_secret" value="<?php echo( $nonce ); ?>" />
            <input type="submit" class="button-secondary" name="cm_delete_button" value="<?php _e('Delete Permanently', 'custommanager'); ?>" />
        </form>
    </div> <?php
}
?>