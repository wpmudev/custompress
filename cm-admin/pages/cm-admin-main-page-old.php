<?php

function cm_admin_main_page( $post_types, $taxonomies, $custom_fields ) { ?>
    <div class="wrap cm-wrap">
        <h2><?php _e('Post Types', 'custommanager'); ?></h2>
        <?php /** @todo
        <div class="updated below-h2" id="message">
            <p><a href=""></a></p>
        </div> */ ?>
        <?php /*
        <form name="cm_form_redirect_add_post_type" action="" method="post" class="cm-form-single-btn">
            <input type="submit" class="button-secondary" name="cm_redirect_add_post_type" value="<?php _e('Add Post Type', 'custommanager'); ?>" />
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
                <?php $pt_i = 0; foreach ( $post_types as $post_type => $pt_args ): ?>
                <?php $class = ( $pt_i % 2) ? 'cm-edit-row alternate' : 'cm-edit-row'; $pt_i++; ?>
                <tr class="<?php echo ( $class ); ?>">
                    <td>
                        <strong>
                            <a href="<?php echo( admin_url( 'admin.php?page=cm_post_types&cm_edit_post_type=' . $post_type ) ); ?>"><?php echo( $post_type ); ?></a>
                        </strong>
                        <div class="row-actions">
                            <span class="edit">
                                <a title="<?php _e('Edit this post type', 'custommanager'); ?>" href="<?php echo( admin_url( 'admin.php?page=cm_post_types&cm_edit_post_type=' . $post_type ) ); ?>"><?php _e('Edit', 'custommanager'); ?></a> |
                            </span>
                            <span class="trash">
                                <a class="submitdelete" href="<?php echo( admin_url( 'admin.php?page=cm_post_types&cm_delete_post_type=' . $post_type ) ); ?>"><?php _e('Delete', 'custommanager'); ?></a>
                            </span>
                        </div>
                    </td>
                    <td><?php echo( $pt_args['labels']['name'] ); ?></td>
                    <td><?php echo( $pt_args['description'] ); ?></td>
                    <td>
                        <img src="<?php echo( $pt_args['menu_icon'] ); ?>" alt="<?php if ( empty( $pt_args['menu_icon'] ) ) echo( 'No Icon'); ?>" />
                    </td>
                    <td>
                        <?php if ( $pt_args['public'] === null ): ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/advanced.png' ); ?>" alt="<?php _e('Advanced', 'custommanager'); ?>" title="<?php _e('Advanced', 'custommanager'); ?>" />
                        <?php elseif ( $pt_args['public'] ): ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/true.png' ); ?>" alt="<?php _e('True', 'custommanager'); ?>" title="<?php _e('True', 'custommanager'); ?>" />
                        <?php else: ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/false.png' ); ?>" alt="<?php _e('False', 'custommanager'); ?>" title="<?php _e('False', 'custommanager'); ?>" />
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ( $pt_args['hierarchical'] ): ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/true.png' ); ?>" alt="<?php _e('True', 'custommanager'); ?>" title="<?php _e('True', 'custommanager'); ?>" />
                        <?php else: ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/false.png' ); ?>" alt="<?php _e('False', 'custommanager'); ?>" title="<?php _e('False', 'custommanager'); ?>" />
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ( $pt_args['rewrite'] ): ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/true.png' ); ?>" alt="<?php _e('True', 'custommanager'); ?>" title="<?php _e('True', 'custommanager'); ?>" />
                        <?php else: ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/false.png' ); ?>" alt="<?php _e('False', 'custommanager'); ?>" title="<?php _e('False', 'custommanager'); ?>" />
                        <?php endif; ?>
                    </td>
                    <td class="cm-supports">
                        <?php foreach ( $pt_args['supports'] as $pt_value ): ?>
                            <?php echo( $pt_value ); ?>
                        <?php endforeach; ?>
                    </td>
                    <td><?php echo( $pt_args['capability_type'] ); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <form name="cm_form_redirect_add_post_type" action="" method="post" class="cm-form-single-btn">
            <input type="submit" class="button-secondary" name="cm_redirect_add_post_type" value="<?php _e('Add Post Type', 'custommanager'); ?>" />
        </form>
        
        <h2><?php _e('Taxonomies', 'custommanager'); ?></h2> */ ?>
        <?php /** @todo
        <div class="updated below-h2" id="message">
            <p><a href=""></a></p>
        </div> */ ?><?php /*
        <form name="cm_form_redirect_add_taxonomy" action="" method="post" class="cm-form-single-btn">
            <input type="submit" class="button-secondary" name="cm_redirect_add_taxonomy" value="<?php _e('Add Taxonomy', 'custommanager'); ?>" />
        </form>
        <table class="widefat">
            <thead>
                <tr>
                    <th><?php _e('Taxonomy', 'custommanager'); ?></th>
                    <th><?php _e('Name', 'custommanager'); ?></th>
                    <th><?php _e('Post Types', 'custommanager'); ?></th>
                    <th><?php _e('Public', 'custommanager'); ?></th>
                    <th><?php _e('Hierarchical', 'custommanager'); ?></th>
                    <th><?php _e('Rewrite', 'custommanager'); ?></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th><?php _e('Taxonomy', 'custommanager'); ?></th>
                    <th><?php _e('Name', 'custommanager'); ?></th>
                    <th><?php _e('Post Types', 'custommanager'); ?></th>
                    <th><?php _e('Public', 'custommanager'); ?></th>
                    <th><?php _e('Hierarchical', 'custommanager'); ?></th>
                    <th><?php _e('Rewrite', 'custommanager'); ?></th>
                </tr>
            </tfoot>
            <tbody>
                <?php $tx_i = 0; foreach ( $taxonomies as $taxonomy => $tx_args ): ?>
                <?php $class = ( $tx_i % 2) ? 'cm-edit-row alternate' : 'cm-edit-row'; $tx_i++; ?>
                <tr class="<?php echo ( $class ); ?>">
                    <td>
                        <strong>
                            <a href="<?php echo( admin_url( 'admin.php?page=cm_taxonomies&cm_edit_taxonomy=' . $taxonomy ) ); ?>"><?php echo( $taxonomy ); ?></a>
                        </strong>
                        <div class="row-actions">
                            <span class="edit">
                                <a title="<?php _e('Edit this taxonomy', 'custommanager'); ?>" href="<?php echo( admin_url( 'admin.php?page=cm_taxonomies&cm_edit_taxonomy=' . $taxonomy ) ); ?>"><?php _e('Edit', 'custommanager'); ?></a> |
                            </span>
                            <span class="trash">
                                <a class="submitdelete" href="<?php echo( admin_url( 'admin.php?page=cm_taxonomies&cm_delete_taxonomy=' . $taxonomy ) ); ?>"><?php _e('Delete', 'custommanager'); ?></a>
                            </span>
                        </div>
                    </td>
                    <td><?php echo( $tx_args['args']['labels']['name'] ); ?></td>
                    <td>
                        <?php foreach( $tx_args['object_type'] as $tx_object_type ): ?>
                            <?php echo( $tx_object_type ); ?>
                        <?php endforeach; ?>
                    </td>
                    <td>
                        <?php if ( $tx_args['args']['public'] === null ): ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/advanced.png' ); ?>" alt="<?php _e('Advanced', 'custommanager'); ?>" title="<?php _e('Advanced', 'custommanager'); ?>" />
                        <?php elseif ( $tx_args['args']['public'] ): ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/true.png' ); ?>" alt="<?php _e('True', 'custommanager'); ?>" title="<?php _e('True', 'custommanager'); ?>" />
                        <?php else: ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/false.png' ); ?>" alt="<?php _e('False', 'custommanager'); ?>" title="<?php _e('False', 'custommanager'); ?>" />
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ( $tx_args['args']['hierarchical'] ): ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/true.png' ); ?>" alt="<?php _e('True', 'custommanager'); ?>" title="<?php _e('True', 'custommanager'); ?>" />
                        <?php else: ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/false.png' ); ?>" alt="<?php _e('False', 'custommanager'); ?>" title="<?php _e('False', 'custommanager'); ?>" />
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ( $tx_args['args']['rewrite'] ): ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/true.png' ); ?>" alt="<?php _e('True', 'custommanager'); ?>" title="<?php _e('True', 'custommanager'); ?>" />
                        <?php else: ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/false.png' ); ?>" alt="<?php _e('False', 'custommanager'); ?>" title="<?php _e('False', 'custommanager'); ?>" />
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <form name="cm_form_redirect_add_taxonomy" action="" method="post" class="cm-form-single-btn">
            <input type="submit" class="button-secondary" name="cm_redirect_add_taxonomy" value="<?php _e('Add Taxonomy', 'custommanager'); ?>" />
        </form>

        <h2><?php _e('Custom Fields', 'custommanager'); ?></h2> */ ?>
        <?php /** @todo
        <div class="updated below-h2" id="message">
            <p><a href=""></a></p>
        </div> */ ?><?php /*
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
                <?php $i = 0; foreach ( $custom_fields as $custom_field ): ?>
                <?php $class = ( $i % 2) ? 'cm-edit-row alternate' : 'cm-edit-row'; $i++; ?>
                <tr class="<?php echo ( $class ); ?>">
                    <td>
                        <strong>
                            <a href="<?php echo( admin_url( 'admin.php?page=cm_custom_fields&cm_edit_custom_field=' . $custom_field['field_id'] )); ?>"><?php echo( $custom_field['field_title'] ); ?></a>
                        </strong>
                        <div class="row-actions">
                            <span class="edit">
                                <a title="<?php _e('Edit this custom field', 'custommanager'); ?>" href="<?php echo( admin_url( 'admin.php?page=cm_custom_fields&cm_edit_custom_field=' . $custom_field['field_id'] ) ); ?>">Edit</a> |
                            </span>
                            <span class="trash">
                                <a class="submitdelete" href="<?php echo( admin_url( 'admin.php?page=cm_custom_fields&cm_delete_custom_field=' . $custom_field['field_id'] ) ); ?>">Delete</a>
                            </span>
                        </div>
                    </td>
                    <td><?php echo( $custom_field['field_type'] ); ?></td>
                    <td><?php echo( $custom_field['field_description'] ); ?></td>
                    <td>
                        <?php foreach( $custom_field['object_type'] as $object_type ): ?>
                            <?php echo( $object_type ); ?>
                        <?php endforeach; ?>
                    </td> */ ?>
                    <?php /** @todo implement required fields
                    <td>
                        <?php if ( $custom_field['required'] ): ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/true.png' ); ?>" alt="<?php _e('True', 'custommanager'); ?>" title="<?php _e('True', 'custommanager'); ?>" />
                        <?php else: ?>
                            <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/false.png' ); ?>" alt="<?php _e('False', 'custommanager'); ?>" title="<?php _e('False', 'custommanager'); ?>" />
                        <?php endif; ?>
                    </td>
                    */ ?><?php /*
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <form name="cm_form_redirect_add_custom_field" action="" method="post" class="cm-form-single-btn">
            <input type="submit" class="button-secondary" name="cm_redirect_add_custom_field" value="Add Custom Field" />
        </form> */ ?>
    </div> <?php
}

?>