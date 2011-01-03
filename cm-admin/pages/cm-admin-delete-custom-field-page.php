<?php

function cm_admin_delete_custom_field_page( $custom_field ) {
    $nonce = wp_create_nonce( 'cm_delete_custom_field_verify' ); ?>

    <div class="wrap cm-wrap">
        <div class="icon32" id="icon-edit"><br></div>
        <h2><?php _e('Delete Custom Field', 'custompress'); ?></h2>
        <?php /** @todo
        <div class="updated below-h2" id="message">
            <p><a href=""></a></p>
        </div> */ ?>
        <form name="cm_form_delete_custom_field" action="" method="post" class="cm-form-single-btn">
            <input type="hidden" name="cm_delete_custom_field_secret" value="<?php echo( $nonce ); ?>" />
            <input type="submit" class="button-secondary" name="cm_delete_button" value="<?php _e('Delete Permanently', 'custompress'); ?>" />
        </form>
        <table class="widefat">
            <thead>
                <tr>
                    <th><?php _e('Custom Field', 'custompress'); ?></th>
                    <th><?php _e('Type', 'custompress'); ?></th>
                    <th><?php _e('Description', 'custompress'); ?></th>
                    <th><?php _e('Post Types', 'custompress'); ?></th>
                    <th><?php _e('Required', 'custompress'); ?></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th><?php _e('Custom Field', 'custompress'); ?></th>
                    <th><?php _e('Type', 'custompress'); ?></th>
                    <th><?php _e('Description', 'custompress'); ?></th>
                    <th><?php _e('Post Types', 'custompress'); ?></th>
                    <th><?php _e('Required', 'custompress'); ?></th>
                </tr>
            </tfoot>
            <tbody>
                <tr>
                    <td>
                        <strong>
                            <a href="<?php echo( admin_url( 'admin.php?page=' . $_GET['page'] . '&cm_edit_custom_field=' . $custom_field['field_id'] )); ?>"><?php echo( $custom_field['field_title'] ); ?></a>
                        </strong>
                        <div class="row-actions">
                            <span class="edit">
                                <a title="<?php _e('Edit this custom field', 'custompress'); ?>" href="<?php echo( admin_url( 'admin.php?page=' . $_GET['page'] . '&cm_edit_custom_field=' . $custom_field['field_id'] ) ); ?>"><?php _e('Edit', 'custompress'); ?></a> |
                            </span>
                            <span class="trash">
                                <a class="submitdelete" href="<?php echo( admin_url( 'admin.php?page=' . $_GET['page'] . '&cm_delete_custom_field=' . $custom_field['field_id'] . '&cm_delete_custom_field_secret=' . $nonce ) ); ?>"><?php _e('Delete Permanently', 'custompress'); ?></a>
                            </span>
                        </div>
                    </td>
                    <td><?php echo( $custom_field['field_type'] ); ?></td>
                    <td><?php echo( $custom_field['field_description'] ); ?></td>
                    <td>
                        <?php foreach( $custom_field['object_type'] as $object_type ): ?>
                            <?php echo( $object_type ); ?>
                        <?php endforeach; ?>
                    </td>
                    <td>
                        <?php if ( $custom_field['required'] ): ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/true.png' ); ?>" alt="<?php _e('True', 'custompress'); ?>" title="<?php _e('True', 'custompress'); ?>" />
                        <?php else: ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/false.png' ); ?>" alt="<?php _e('False', 'custompress'); ?>" title="<?php _e('False', 'custompress'); ?>" />
                        <?php endif; ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <form name="cm_form_delete_custom_field" action="" method="post" class="cm-form-single-btn">
            <input type="hidden" name="cm_delete_custom_field_secret" value="<?php echo( $nonce ); ?>" />
            <input type="submit" class="button-secondary" name="cm_delete_button" value="<?php _e('Delete Permanently', 'custompress'); ?>" />
        </form>
    </div> <?php
}
?>
