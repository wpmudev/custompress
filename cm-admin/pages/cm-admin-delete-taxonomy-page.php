<?php

function cm_admin_delete_taxonomy_page( $args ) {
    $nonce = wp_create_nonce( 'cm_delete_taxonomy_verify' ); ?>

    <h3><?php _e('Delete Taxonomy', 'custompress'); ?></h3>
    <?php /** @todo
    <div class="updated below-h2" id="message">
        <p><a href=""></a></p>
    </div> */ ?>
    <form name="cm_form_delete_taxonomy" action="" method="post" class="cm-form-single-btn">
        <input type="hidden" name="cm_delete_taxonomy_secret" value="<?php echo( $nonce ); ?>" />
        <input type="submit" class="button-secondary" name="cm_delete_button" value="<?php _e('Delete Permanently', 'custompress'); ?>" />
    </form>
    <table class="widefat">
        <thead>
            <tr>
                <th><?php _e('Taxonomy', 'custompress'); ?></th>
                <th><?php _e('Name', 'custompress'); ?></th>
                <th><?php _e('Post Types', 'custompress'); ?></th>
                <th><?php _e('Public', 'custompress'); ?></th>
                <th><?php _e('Hierarchical', 'custompress'); ?></th>
                <th><?php _e('Rewrite', 'custompress'); ?></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th><?php _e('Taxonomy', 'custompress'); ?></th>
                <th><?php _e('Name', 'custompress'); ?></th>
                <th><?php _e('Post Types', 'custompress'); ?></th>
                <th><?php _e('Public', 'custompress'); ?></th>
                <th><?php _e('Hierarchical', 'custompress'); ?></th>
                <th><?php _e('Rewrite', 'custompress'); ?></th>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <td>
                    <strong>
                        <a href="<?php echo( admin_url( 'admin.php?page=' . $_GET['page'] . '&cm_content_type=taxonomy&cm_edit_taxonomy=' . $_GET['cm_delete_taxonomy'] )); ?>"><?php echo( $_GET['cm_delete_taxonomy'] ); ?></a>
                    </strong>
                    <div class="row-actions">
                        <span class="edit">
                            <a title="<?php _e('Edit this taxonomy', 'custompress'); ?>" href="<?php echo( admin_url( 'admin.php?page=' . $_GET['page'] . '&cm_content_type=taxonomy&cm_edit_taxonomy=' . $_GET['cm_delete_taxonomy'] )); ?>"><?php _e('Edit', 'custompress'); ?></a> |
                        </span>
                        <span class="trash">
                            <a class="submitdelete" href="<?php echo( admin_url( 'admin.php?page=' . $_GET['page'] . '&cm_content_type=taxonomy&cm_delete_taxonomy=' . $_GET['cm_delete_taxonomy'] . '&cm_delete_taxonomy_secret=' . $nonce )); ?>"><?php _e('Delete Permanently', 'custompress'); ?></a>
                        </span>
                    </div>
                </td>
                <td><?php echo( $args['args']['labels']['name'] ); ?></td>
                <td>
                    <?php foreach( $args['object_type'] as $object_type ): ?>
                        <?php echo( $object_type ); ?>
                    <?php endforeach; ?>
                </td>
                <td>
                    <?php if ( $args['args']['public'] === null ): ?>
                        <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/advanced.png' ); ?>" alt="<?php _e('Advanced', 'custompress'); ?>" title="<?php _e('Advanced', 'custompress'); ?>" />
                    <?php elseif ( $args['args']['public'] ): ?>
                        <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/true.png' ); ?>" alt="<?php _e('True', 'custompress'); ?>" title="<?php _e('True', 'custompress'); ?>" />
                    <?php else: ?>
                        <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/false.png' ); ?>" alt="<?php _e('False', 'custompress'); ?>" title="<?php _e('False', 'custompress'); ?>" />
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ( $args['args']['hierarchical'] ): ?>
                        <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/true.png' ); ?>" alt="<?php _e('True', 'custompress'); ?>" title="<?php _e('True', 'custompress'); ?>" />
                    <?php else: ?>
                        <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/false.png' ); ?>" alt="<?php _e('False', 'custompress'); ?>" title="<?php _e('False', 'custompress'); ?>" />
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ( $args['args']['rewrite'] ): ?>
                        <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/true.png' ); ?>" alt="<?php _e('True', 'custompress'); ?>" title="<?php _e('True', 'custompress'); ?>" />
                    <?php else: ?>
                        <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/false.png' ); ?>" alt="<?php _e('False', 'custompress'); ?>" title="<?php _e('False', 'custompress'); ?>" />
                    <?php endif; ?>
                </td>
            </tr>
        </tbody>
    </table>
    <form name="cm_form_delete_taxonomy" action="" method="post" class="cm-form-single-btn">
        <input type="hidden" name="cm_delete_taxonomy_secret" value="<?php echo( $nonce ); ?>" />
        <input type="submit" class="button-secondary" name="cm_delete_button" value="<?php _e('Delete Permanently', 'custompress'); ?>" />
    </form>
<?php
}
?>
