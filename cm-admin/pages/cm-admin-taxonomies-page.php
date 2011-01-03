<?php

function cm_admin_taxonomies_page( $taxonomies ) { ?>

    <div class="wrap cm-wrap">
        <h2><?php _e('Taxonomies', 'custommanager'); ?></h2>
        <?php /** @todo
        <div class="updated below-h2" id="message">
            <p><a href=""></a></p>
        </div> */ ?>
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
                <?php if ( !empty( $taxonomies )): ?>
                    <?php $i = 0; foreach ( $taxonomies as $taxonomy => $args ): ?>
                    <?php $class = ( $i % 2) ? 'cm-edit-row alternate' : 'cm-edit-row'; $i++; ?>
                    <tr class="<?php echo ( $class ); ?>">
                        <td>
                            <strong>
                                <a href="<?php echo( admin_url( 'admin.php?page=' . $_GET['page'] . '&cm_edit_taxonomy=' . $taxonomy ) ); ?>"><?php echo( $taxonomy ); ?></a>
                            </strong>
                            <div class="row-actions">
                                <span class="edit">
                                    <a title="<?php _e('Edit this taxonomy', 'custommanager'); ?>" href="<?php echo( admin_url( 'admin.php?page=' . $_GET['page'] . '&cm_edit_taxonomy=' . $taxonomy ) ); ?>"><?php _e('Edit', 'custommanager'); ?></a> |
                                </span>
                                <span class="trash">
                                    <a class="submitdelete" href="<?php echo( admin_url( 'admin.php?page=' . $_GET['page'] . '&cm_delete_taxonomy=' . $taxonomy ) ); ?>"><?php _e('Delete', 'custommanager'); ?></a>
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
                                <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/advanced.png' ); ?>" alt="<?php _e('Advanced', 'custommanager'); ?>" title="<?php _e('Advanced', 'custommanager'); ?>" />
                            <?php elseif ( $args['args']['public'] ): ?>
                                <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/true.png' ); ?>" alt="<?php _e('True', 'custommanager'); ?>" title="<?php _e('True', 'custommanager'); ?>" />
                            <?php else: ?>
                                <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/false.png' ); ?>" alt="<?php _e('False', 'custommanager'); ?>" title="<?php _e('False', 'custommanager'); ?>" />
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ( $args['args']['hierarchical'] ): ?>
                                <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/true.png' ); ?>" alt="<?php _e('True', 'custommanager'); ?>" title="<?php _e('True', 'custommanager'); ?>" />
                            <?php else: ?>
                                <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/false.png' ); ?>" alt="<?php _e('False', 'custommanager'); ?>" title="<?php _e('False', 'custommanager'); ?>" />
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ( $args['args']['rewrite'] ): ?>
                                <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/true.png' ); ?>" alt="<?php _e('True', 'custommanager'); ?>" title="<?php _e('True', 'custommanager'); ?>" />
                            <?php else: ?>
                                <img class="cm-tf-icons" src="<?php echo ( CM_PLUGIN_URL . '/images/false.png' ); ?>" alt="<?php _e('False', 'custommanager'); ?>" title="<?php _e('False', 'custommanager'); ?>" />
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
        <form name="cm_form_redirect_add_taxonomy" action="" method="post" class="cm-form-single-btn">
            <input type="submit" class="button-secondary" name="cm_redirect_add_taxonomy" value="<?php _e('Add Taxonomy', 'custommanager'); ?>" />
        </form>
    </div> <?php
}
?>
