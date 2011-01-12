<?php

function cm_admin_add_custom_field_page( $post_types ) { ?>

    <div class="wrap cm-wrap">
        <div class="icon32" id="icon-edit"><br></div>
        <h2><?php _e('Add Custom Field', 'custompress'); ?></h2>
        <form action="" method="post" class="cm-custom-fields">
            <?php wp_nonce_field( 'cm_submit_custom_field_verify', 'cm_submit_custom_field_secret' ); ?>
            <div class="cm-wrap-left">
                <div class="cm-table-wrap">
                    <div class="cm-arrow"><br></div>
                    <h3 class="cm-toggle"><?php _e('Field Title', 'custompress') ?></h3>
                    <table class="form-table <?php do_action('cm_invalid_field_title'); ?>">
                        <tr>
                            <th>
                                <label for="field_title"><?php _e('Field Title', 'custompress') ?> <span class="cm-required">( <?php _e('required', 'custompress'); ?> )</span></label>
                            </th>
                            <td>
                                <input type="text" name="field_title" value="<?php echo( $_POST['field_title'] ); ?>">
                                <span class="description"><?php _e('The title of the custom field.', 'custompress'); ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="cm-table-wrap">
                    <div class="cm-arrow"><br></div>
                    <h3 class="cm-toggle"><?php _e('Field Type', 'custompress') ?></h3>
                    <table class="form-table <?php do_action('cm_invalid_field_options'); ?>">
                        <tr>
                            <th>
                                <label for="field_type"><?php _e('Field Type', 'custompress') ?> <span class="cm-required">( <?php _e('required', 'custompress'); ?> )</span></label>
                            </th>
                            <td>
                                <select name="field_type">
                                    <option value="text" <?php if ( $_POST['field_type'] == 'text' ) echo( 'selected="selected"' ); ?>>Text Box</option>
                                    <option value="textarea" <?php if ( $_POST['field_type'] == 'textarea' ) echo( 'selected="selected"' ); ?>>Multi-line Text Box</option>
                                    <option value="radio" <?php if ( $_POST['field_type'] == 'radio' ) echo( 'selected="selected"' ); ?>>Radio Buttons</option>
                                    <option value="checkbox" <?php if ( $_POST['field_type'] == 'checkbox' ) echo( 'selected="selected"' ); ?>>Checkboxes</option>
                                    <option value="selectbox" <?php if ( $_POST['field_type'] == 'selectbox' ) echo( 'selected="selected"' ); ?>>Drop Down Select Box</option>
                                    <option value="multiselectbox" <?php if ( $_POST['field_type'] == 'multiselectbox' ) echo( 'selected="selected"' ); ?>>Multi Select Box</option>
                                </select>
                                <span class="description"><?php _e('Select one or more post types to add this custom field to.', 'custompress'); ?></span>
                                <div class="cm-field-type-options">
                                    <h4><?php _e('Fill in the options for this field', 'custompress'); ?>:</h4>
                                    <p><?php _e('Order By', 'custompress'); ?> :
                                        <select name="field_sort_order">
                                            <option value="default"><?php _e('Order Entered', 'custompress'); ?></option>
                                            <?php /** @todo introduce the additional order options 
                                            <option value="asc"><?php _e('Name - Ascending', 'custompress'); ?></option>
                                            <option value="desc"><?php _e('Name - Descending', 'custompress'); ?></option>
                                            */ ?>
                                        </select
                                    </p>
                                    <p><?php _e('Option', 'custompress'); ?> 1:
                                        <input type="text" name="field_options[1]" value="<?php echo( $_POST['field_options'][1] ); ?>">
                                        <input type="radio" value="1" name="field_default_option" <?php if ( $_POST['field_default_option'] == '1' ) echo( 'checked="checked"' ); ?>>
                                        <?php _e('Default Value', 'custompress'); ?>
                                    </p>
                                    <div class="cm-field-additional-options"></div>
                                    <input type="hidden" value="1" name="track_number">
                                    <p><a href="#" class="cm-field-add-option"><?php _e('Add another option', 'custompress'); ?></a></p>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="cm-table-wrap">
                    <div class="cm-arrow"><br></div>
                    <h3 class="cm-toggle"><?php _e('Field Description', 'custompress') ?></h3>
                    <table class="form-table">
                        <tr>
                            <th>
                                <label for="field_description"><?php _e('Field Description', 'custompress') ?></label>
                            </th>
                            <td>
                                <textarea class="cm_field_description" name="field_description" rows="3" ><?php echo( $_POST['field_description'] ); ?></textarea>
                                <span class="description"><?php _e('Description for the custom field.', 'custompress'); ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="cm-wrap-right">
                <div class="cm-table-wrap">
                    <div class="cm-arrow"><br></div>
                    <h3 class="cm-toggle"><?php _e('Post Type', 'custompress') ?></h3>
                    <table class="form-table <?php do_action('cm_invalid_field_object_type'); ?>">
                        <tr>
                            <th>
                                <label for="object_type"><?php _e('Post Type', 'custompress') ?> <span class="cm-required">( <?php _e('required', 'custompress'); ?> )</span></label>
                            </th>
                            <td>
                                <select name="object_type[]" multiple="multiple" class="cm-object-type">
                                    <?php if ( !empty( $post_types )): ?>
                                        <?php foreach( $post_types as $post_type ): ?>
                                            <option value="<?php echo ( $post_type ); ?>" <?php foreach ( $_POST['object_type'] as $post_value ) { if ( $post_value == $post_type ) echo( 'selected="selected"' ); } ?>><?php echo ( $post_type ); ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <br />
                                <span class="description"><?php _e('Select one or more post types to add this custom field to.', 'custompress'); ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <?php /** @todo implement required fields
                <div class="cm-table-wrap">
                    <div class="cm-arrow"><br></div>
                    <h3 class="cm-toggle"><?php _e('Required Field', 'custompress') ?></h3>
                    <table class="form-table">
                        <tr>
                            <th>
                                <label for="required"><?php _e('Required Field', 'custompress') ?></label>
                            </th>
                            <td>
                                <span class="description"><?php _e('Should this field be required.', 'custompress'); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <input type="radio" name="required" value="1">
                                <span class="description"><strong><?php _e('TRUE', 'custompress'); ?></strong></span>
                                <br />
                                <input type="radio" name="required" value="0" checked="checked">
                                <span class="description"><strong><?php _e('FALSE', 'custompress'); ?></strong></span>
                            </td>
                        </tr>
                    </table>
                </div>
                */ ?>
            </div>
            <br style="clear: left" />
            <input type="submit" class="button-primary" name="cm_submit_add_custom_field" value="Add Custom Field">
            <br /><br /><br /><br />
        </form>
    </div> <?php
}
?>