<?php

function cm_admin_custom_fields_page( $custom_fields ) { ?>

    <div class="wrap cm-wrap">
        <div class="icon32" id="icon-edit"><br></div>
        <h2><?php _e('Custom Fields', 'custommanager'); ?></h2>
        <?php /** @todo
        <div class="updated below-h2" id="message">
            <p><a href=""></a></p>
        </div> */ ?>
        <form name="cm_form_redirect_add_custom_field" action="" method="post" class="cm-form-single-btn">
            <input type="submit" class="button-secondary" name="cm_redirect_add_custom_field" value="Add Custom Field" />
        </form>
        <table class="widefat">
            <thead>
                <tr>
                    <th><?php _e('Custom Field', 'custommanager'); ?></th>
                    <th><?php _e('Field Type', 'custommanager'); ?></th>
                    <th><?php _e('Description', 'custommanager'); ?></th>
                    <th><?php _e('Post Types', 'custommanager'); ?></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th><?php _e('Custom Field', 'custommanager'); ?></th>
                    <th><?php _e('Field Type', 'custommanager'); ?></th>
                    <th><?php _e('Description', 'custommanager'); ?></th>
                    <th><?php _e('Post Types', 'custommanager'); ?></th>
                </tr>
            </tfoot>
            <tbody>
                <?php if ( !empty( $custom_fields )): ?>
                    <?php $i = 0; foreach ( $custom_fields as $custom_field ): ?>
                    <?php $class = ( $i % 2) ? 'cm-edit-row alternate' : 'cm-edit-row'; $i++; ?>
                    <tr class="<?php echo ( $class ); ?>">
                        <td>
                            <strong>
                                <a href="<?php echo( admin_url( 'admin.php?page=' . $_GET['page'] . '&cm_edit_custom_field=' . $custom_field['field_id'] )); ?>"><?php echo( $custom_field['field_title'] ); ?></a>
                            </strong>
                            <div class="row-actions">
                                <span class="edit">
                                    <a title="<?php _e('Edit this custom field', 'custommanager'); ?>" href="<?php echo( admin_url( 'admin.php?page=' . $_GET['page'] . '&cm_edit_custom_field=' . $custom_field['field_id'] ) ); ?>">Edit</a> |
                                </span>
                                <span class="trash">
                                    <a class="submitdelete" href="<?php echo( admin_url( 'admin.php?page=' . $_GET['page'] . '&cm_delete_custom_field=' . $custom_field['field_id'] ) ); ?>">Delete</a>
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
                        <?php /** @todo implement required fields
                        <td>
                            <?php if ( $custom_field['required'] ): ?>
                                <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/true.png' ); ?>" alt="<?php _e('True', 'custommanager'); ?>" title="<?php _e('True', 'custommanager'); ?>" />
                            <?php else: ?>
                                <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/false.png' ); ?>" alt="<?php _e('False', 'custommanager'); ?>" title="<?php _e('False', 'custommanager'); ?>" />
                            <?php endif; ?>
                        </td>
                        */ ?>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <form name="cm_form_redirect_add_custom_field" action="" method="post" class="cm-form-single-btn">
            <input type="submit" class="button-secondary" name="cm_redirect_add_custom_field" value="Add Custom Field" />
        </form>
    </div> <?php
}
?>
