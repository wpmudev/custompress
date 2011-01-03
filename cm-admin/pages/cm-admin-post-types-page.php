<?php

function cm_admin_post_types_page( $post_types ) { ?>

    <?php /** @todo
    <div class="updated below-h2" id="message">
        <p><a href=""></a></p>
    </div> */ ?>
    <form name="cm_form_redirect_add_post_type" action="" method="post" class="cm-form-single-btn">
        <input type="submit" class="button-secondary" name="cm_redirect_add_post_type" value="<?php _e('Add Post Type', 'custompress'); ?>" />
    </form>
    <table class="widefat">
        <thead>
            <tr>
                <th><?php _e('Post Type', 'custompress'); ?></th>
                <th><?php _e('Name', 'custompress'); ?></th>
                <th><?php _e('Description', 'custompress'); ?></th>
                <th><?php _e('Menu Icon', 'custompress'); ?></th>
                <th><?php _e('Supports', 'custompress'); ?></th>
                <th><?php _e('Capability Type', 'custompress'); ?></th>
                <th><?php _e('Public', 'custompress'); ?></th>
                <th><?php _e('Hierarchical', 'custompress'); ?></th>
                <th><?php _e('Rewrite', 'custompress'); ?></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th><?php _e('Post Type', 'custompress'); ?></th>
                <th><?php _e('Name', 'custompress'); ?></th>
                <th><?php _e('Description', 'custompress'); ?></th>
                <th><?php _e('Menu Icon', 'custompress'); ?></th>
                <th><?php _e('Supports', 'custompress'); ?></th>
                <th><?php _e('Capability Type', 'custompress'); ?></th>
                <th><?php _e('Public', 'custompress'); ?></th>
                <th><?php _e('Hierarchical', 'custompress'); ?></th>
                <th><?php _e('Rewrite', 'custompress'); ?></th>
            </tr>
        </tfoot>
        <tbody>
            <?php if ( !empty( $post_types )): ?>
                <?php $i = 0; foreach ( $post_types as $post_type => $args ): ?>
                <?php $class = ( $i % 2) ? 'cm-edit-row alternate' : 'cm-edit-row'; $i++; ?>
                <tr class="<?php echo ( $class ); ?>">
                    <td>
                        <strong>
                            <a href="<?php echo( admin_url( 'admin.php?page=' . $_GET['page'] . '&cm_content_type=post_type&cm_edit_post_type=' . $post_type ) ); ?>"><?php echo( $post_type ); ?></a>
                        </strong>
                        <div class="row-actions">
                            <span class="edit">
                                <a title="<?php _e('Edit this post type', 'custompress'); ?>" href="<?php echo( admin_url( 'admin.php?page=' . $_GET['page'] . '&cm_content_type=post_type&cm_edit_post_type=' . $post_type ) ); ?>"><?php _e('Edit', 'custompress'); ?></a> |
                            </span>
                            <span class="trash">
                                <a class="submitdelete" href="<?php echo( admin_url( 'admin.php?page=' . $_GET['page'] . '&cm_content_type=post_type&cm_delete_post_type=' . $post_type ) ); ?>"><?php _e('Delete', 'custompress'); ?></a>
                            </span>
                        </div>
                    </td>
                    <td><?php echo( $args['labels']['name'] ); ?></td>
                    <td><?php echo( $args['description'] ); ?></td>
                    <td>
                        <img src="<?php echo( $args['menu_icon'] ); ?>" alt="<?php if ( empty( $args['menu_icon'] ) ) echo( 'No Icon'); ?>" />
                    </td>
                    <td class="cm-supports">
                        <?php foreach ( $args['supports'] as $value ): ?>
                            <?php echo( $value ); ?>
                        <?php endforeach; ?>
                    </td>
                    <td><?php echo( $args['capability_type'] ); ?></td>
                    <td class="cm-tf-icons-wrap">
                        <?php if ( $args['public'] === null ): ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/advanced.png' ); ?>" alt="<?php _e('Advanced', 'custompress'); ?>" title="<?php _e('Advanced', 'custompress'); ?>" />
                        <?php elseif ( $args['public'] ): ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/true.png' ); ?>" alt="<?php _e('True', 'custompress'); ?>" title="<?php _e('True', 'custompress'); ?>" />
                        <?php else: ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/false.png' ); ?>" alt="<?php _e('False', 'custompress'); ?>" title="<?php _e('False', 'custompress'); ?>" />
                        <?php endif; ?>
                    </td>
                    <td class="cm-tf-icons-wrap">
                        <?php if ( $args['hierarchical'] ): ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/true.png' ); ?>" alt="<?php _e('True', 'custompress'); ?>" title="<?php _e('True', 'custompress'); ?>" />
                        <?php else: ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/false.png' ); ?>" alt="<?php _e('False', 'custompress'); ?>" title="<?php _e('False', 'custompress'); ?>" />
                        <?php endif; ?>
                    </td>
                    <td class="cm-tf-icons-wrap">
                        <?php if ( $args['rewrite'] ): ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/true.png' ); ?>" alt="<?php _e('True', 'custompress'); ?>" title="<?php _e('True', 'custompress'); ?>" />
                        <?php else: ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/false.png' ); ?>" alt="<?php _e('False', 'custompress'); ?>" title="<?php _e('False', 'custompress'); ?>" />
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <form name="cm_form_redirect_add_post_type" action="" method="post" class="cm-form-single-btn">
        <input type="submit" class="button-secondary" name="cm_redirect_add_post_type" value="<?php _e('Add Post Type', 'custompress'); ?>" />
    </form>
<?php
}
?>