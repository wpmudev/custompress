<?php

function cm_admin_edit_post_type_page( $args ) { ?>

    <div class="wrap cm-wrap">
        <div class="icon32" id="icon-edit"><br></div>
        <h2><?php _e('Edit Post Type', 'custommanager'); ?></h2>
        <form action="" method="post" class="cm-post-type">
            <?php wp_nonce_field( 'cm_submit_post_type_verify', 'cm_submit_post_type_secret' ); ?>
            <div class="cm-wrap-left">
                <div class="cm-table-wrap">
                    <div class="cm-arrow"><br></div>
                    <h3 class="cm-toggle"><?php _e('Post Type', 'custommanager') ?></h3>
                    <table class="form-table">
                        <tr>
                            <th>
                                <label for="post_type"><?php _e('Post Type', 'custommanager') ?> (<span class="cm-required"> required </span>)</label>
                            </th>
                            <td>
                                <input type="text" name="post_type" value="<?php echo ( $_GET['cm_edit_post_type'] ) ?>" disabled="disabled">
                                <span class="description"><?php _e('The new post type system name ( max. 20 characters ). Alphanumeric characters and underscores only. Min 2 letters. Once added the post type system name cannot be changed.', 'custommanager'); ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="cm-table-wrap">
                    <div class="cm-arrow"><br></div>
                    <h3 class="cm-toggle"><?php _e('Supports', 'custommanager') ?></h3>
                    <table class="form-table supports">
                        <tr>
                            <th>
                                <label for="supports"><?php _e('Supports', 'custommanager') ?></label>
                            </th>
                            <td>
                                <span class="description"><?php _e('An alias for calling add_post_type_support() directly.', 'custommanager'); ?></span>
                            </td>
                        </tr>
                       <tr>
                            <th></th>
                            <td>
                                <input type="checkbox" name="supports[title]" value="title" <?php if ( $args['supports']['title'] ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('Title', 'custommanager') ?></strong></span>
                                <br />
                                <input type="checkbox" name="supports[editor]" value="editor" <?php if ( $args['supports']['editor'] ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('Editor', 'custommanager') ?></strong> - <?php _e('Content', 'custommanager') ?></span>
                                <br />
                                <input type="checkbox" name="supports[author]" value="author" <?php if ( $args['supports']['author'] ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('Author', 'custommanager') ?></strong></span>
                                <br />
                                <input type="checkbox" name="supports[thumbnail]" value="thumbnail" <?php if ( $args['supports']['thumbnail'] ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('Thumbnail', 'custommanager') ?></strong> - <?php _e('Featured Image - current theme must also support post-thumbnails.', 'custommanager') ?></span>
                                <br />
                                <input type="checkbox" name="supports[excerpt]" value="excerpt" <?php if ( $args['supports']['excerpt'] ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('Excerpt', 'custommanager') ?></strong></span>
                                <br />
                                <input type="checkbox" name="supports[trackbacks]" value="trackbacks" <?php if ( $args['supports']['trackbacks'] ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('Trackbacks', 'custommanager') ?></strong></span>
                                <br />
                                <input type="checkbox" name="supports[custom_fields]" value="custom_fields" <?php if ( $args['supports']['custom_fields'] ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('Custom Fields', 'custommanager') ?></strong></span>
                                <br />
                                <input type="checkbox" name="supports[comments]" value="comments" <?php if ( $args['supports']['comments'] ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('Comments', 'custommanager') ?></strong> - <?php _e('Also will see comment count balloon on edit screen.', 'custommanager') ?></span>
                                <br />
                                <input type="checkbox" name="supports[revisions]" value="revisions" <?php if ( $args['supports']['revisions'] ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('Revisions', 'custommanager') ?></strong> - <?php _e('Will store revisions.', 'custommanager') ?></span>
                                <br />
                                <input type="checkbox" name="supports[page_attributes]" value="page_attributes" <?php if ( $args['supports']['page_attributes'] ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('Page Attributes', 'custommanager') ?></strong> - <?php _e('Template and menu order - Hierarchical must be true!', 'custommanager') ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="cm-table-wrap">
                    <div class="cm-arrow"><br></div>
                    <h3 class="cm-toggle"><?php _e('Capability Type', 'custommanager') ?></h3>
                    <table class="form-table">
                        <tr>
                            <th>
                                <label for="capability_type"><?php _e('Capability Type', 'custommanager') ?></label>
                            </th>
                            <td>
                                <input type="text" name="capability_type" value="<?php echo ( $args['capability_type'] ) ?>">
                                <input type="checkbox" name="capability_type_edit" value="1" />
                                <span class="description cm_ct_edit"><strong><?php _e('EDIT' , 'custommanager'); ?></strong> (<?php _e('advanced' , 'custommanager'); ?>)</span>
                                <span class="description"><?php _e('The post type to use for checking read, edit, and delete capabilities. Default: "post".' , 'custommanager'); ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="cm-table-wrap">
                    <div class="cm-arrow"><br></div>
                    <h3 class="cm-toggle"><?php _e('Labels', 'custommanager') ?></h3>
                    <table class="form-table">
                        <tr>
                            <th>
                                <label for="name"><?php _e('Name', 'custommanager') ?></label>
                            </th>
                            <td>
                                <input type="text" name="labels[name]" value="<?php echo ( $args['labels']['name'] ); ?>">
                                <span class="description"><?php _e('General name for the post type, usually plural.', 'custommanager'); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="singular_name"><?php _e('Singular Name', 'custommanager') ?></label>
                            </th>
                            <td>
                                <input type="text" name="labels[singular_name]" value="<?php echo ( $args['labels']['singular_name'] ); ?>">
                                <span class="description"><?php _e('Name for one object of this post type. Defaults to value of name.', 'custommanager'); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="add_new"><?php _e('Add New', 'custommanager') ?></label>
                            </th>
                            <td>
                                <input type="text" name="labels[add_new]" value="<?php echo ( $args['labels']['add_new'] ); ?>">
                                <span class="description"><?php _e('The add new text. The default is Add New for both hierarchical and non-hierarchical types.', 'custommanager'); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="add_new_item"><?php _e('Add New Item', 'custommanager') ?></label>
                            </th>
                            <td>
                                <input type="text" name="labels[add_new_item]" value="<?php echo ( $args['labels']['add_new_item'] ); ?>">
                                <span class="description"><?php _e('The add new item text. Default is Add New Post/Add New Page.', 'custommanager'); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="edit_item"><?php _e('Edit Item', 'custommanager') ?></label>
                            </th>
                            <td>
                                <input type="text" name="labels[edit_item]" value="<?php echo ( $args['labels']['edit_item'] ); ?>">
                                <span class="description"><?php _e('The edit item text. Default is Edit Post/Edit Page.', 'custommanager'); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="new_item"><?php _e('New Item', 'custommanager') ?></label>
                            </th>
                            <td>
                                <input type="text" name="labels[new_item]" value="<?php echo ( $args['labels']['new_item'] ); ?>">
                                <span class="description"><?php _e('The new item text. Default is New Post/New Page.', 'custommanager'); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="view_item"><?php _e('View Item', 'custommanager') ?></label>
                            </th>
                            <td>
                                <input type="text" name="labels[view_item]" value="<?php echo ( $args['labels']['view_item'] ); ?>">
                                <span class="description"><?php _e('The view item text. Default is View Post/View Page.', 'custommanager'); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="search_items"><?php _e('Search Items', 'custommanager') ?></label>
                            </th>
                            <td>
                                <input type="text" name="labels[search_items]" value="<?php echo ( $args['labels']['search_items'] ); ?>">
                                <span class="description"><?php _e('The search items text. Default is Search Posts/Search Pages.', 'custommanager'); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="not_found"><?php _e('Not Found', 'custommanager') ?></label>
                            </th>
                            <td>
                                <input type="text" name="labels[not_found]" value="<?php echo ( $args['labels']['not_found'] ); ?>">
                                <span class="description"><?php _e('The not found text. Default is No posts found/No pages found.', 'custommanager'); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="not_found_in_trash"><?php _e('Not Found In Trash', 'custommanager') ?></label>
                            </th>
                            <td>
                                <input type="text" name="labels[not_found_in_trash]" value="<?php echo ( $args['labels']['not_found_in_trash'] ); ?>">
                                <span class="description"><?php _e('The not found in trash text. Default is No posts found in Trash/No pages found in Trash.', 'custommanager'); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="parent_item_colon"><?php _e('Parent Item Colon', 'custommanager') ?></label>
                            </th>
                            <td>
                                <input type="text" name="labels[parent_item_colon]" value="<?php echo ( $args['labels']['parent_item_colon'] ); ?>">
                                <span class="description"><?php _e('The parent text. This string isn\'t used on non-hierarchical types. In hierarchical ones the default is Parent Page', 'custommanager'); ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="cm-table-wrap">
                    <div class="cm-arrow"><br></div>
                    <h3 class="cm-toggle"><?php _e('Description', 'custommanager') ?></h3>
                    <table class="form-table">
                        <tr>
                            <th>
                                <label for="description"><?php _e('Description', 'custommanager') ?></label>
                            </th>
                            <td>
                                <textarea name="description" cols="52" rows="3"><?php echo ( $args['description'] ); ?></textarea>
                                <span class="description"><?php _e('A short descriptive summary of what the post type is.', 'custommanager'); ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="cm-table-wrap">
                    <div class="cm-arrow"><br></div>
                    <h3 class="cm-toggle"><?php _e('Menu Position', 'custommanager') ?></h3>
                    <table class="form-table">
                        <tr>
                            <th>
                                <label for="menu_position"><?php _e('Menu Position', 'custommanager') ?></label>
                            </th>
                            <td>
                                <input type="text" name="menu_position" value="<?php echo ( $args['menu_position'] ); ?>">
                                <span class="description"><?php _e('5 - below Posts; 10 - below Media; 20 - below Pages; 60 - below first separator; 100 - below second separator', 'custommanager'); ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="cm-table-wrap">
                    <div class="cm-arrow"><br></div>
                    <h3 class="cm-toggle"><?php _e('Menu Icon', 'custommanager') ?></h3>
                    <table class="form-table">
                        <tr>
                            <th>
                                <label for="menu_icon"><?php _e('Menu Icon', 'custommanager') ?></label>
                            </th>
                            <td>
                                <input type="text" name="menu_icon" value="<?php echo ( $args['menu_icon'] ); ?>">
                                <span class="description"><?php _e('The url to the icon to be used for this menu.', 'custommanager'); ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="cm-wrap-right">
                <div class="cm-table-wrap">
                    <div class="cm-arrow"><br></div>
                    <h3 class="cm-toggle"><?php _e('Public', 'custommanager') ?></h3>
                    <table class="form-table publica">
                        <tr>
                            <th>
                                <label for="public"><?php _e('Public', 'custommanager') ?></label>
                            </th>
                            <td>
                                <span class="description"><?php _e('Meta argument used to define default values for publicly_queriable, show_ui, show_in_nav_menus and exclude_from_search.', 'custommanager'); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <input type="radio" name="public" value="1" <?php if ( $args['public'] === true ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('TRUE', 'custommanager'); ?></strong><br />
                                <?php _e('Display a user-interface for this "post_type"', 'custommanager');?><br />( show_ui = TRUE )<br /><br />
                                <?php _e('Show "post_type" for selection in navigation menus', 'custommanager'); ?><br />( show_in_nav_menus = TRUE )<br /><br />
                                <?php _e('"post_type" queries can be performed from the front-end', 'custommanager'); ?><br />( publicly_queryable = TRUE )<br /><br />
                                <?php _e('Exclude posts with this post type from search results', 'custommanager'); ?><br /> ( exclude_from_search = FALSE )</span>
                                <br /><br />
                                <input type="radio" name="public" value="0" <?php if ( $args['public'] === false ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('FALSE', 'custommanager'); ?></strong><br />
                                <?php _e('Don not display a user-interface for this "post_type"', 'custommanager');?><br />( show_ui = FALSE )<br /><br />
                                <?php _e('Hide "post_type" for selection in navigation menus', 'custommanager'); ?><br />( show_in_nav_menus = FALSE )<br /><br />
                                <?php _e('"post_type" queries cannot be performed from the front-end', 'custommanager'); ?><br />( publicly_queryable = FALSE )<br /><br />
                                <?php _e('Exclude posts with this post type from search results', 'custommanager'); ?><br /> ( exclude_from_search = TRUE )</span>
                                <br /><br />
                                <input type="radio" name="public" value="advanced" <?php if ( $args['public'] === NULL ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('ADVANCED', 'custommanager'); ?></strong> - <?php _e('You can set each component manualy.', 'custommanager'); ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="cm-table-wrap">
                    <div class="cm-arrow"><br></div>
                    <h3 class="cm-toggle"><?php _e('Show UI', 'custommanager') ?></h3>
                    <table class="form-table show-ui">
                        <tr>
                            <th>
                                <label for="show_ui"><?php _e('Show UI', 'custommanager') ?></label>
                            </th>
                            <td>
                                <span class="description"><?php _e('Whether to generate a default UI for managing this post type. Note that built-in post types, such as post and page, are intentionally set to false.', 'custommanager'); ?></span>
                            </td>
                        </tr>
                       <tr>
                            <th></th>
                            <td>
                                <input type="radio" name="show_ui" value="1" <?php if ( $args['show_ui'] ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('TRUE', 'custommanager'); ?></strong> - <?php _e('Display a user-interface (admin panel) for this post type.', 'custommanager'); ?></span>
                                <br />
                                <input type="radio" name="show_ui" value="0" <?php if ( !$args['show_ui'] ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('FALSE', 'custommanager'); ?></strong> - <?php _e('Do not display a user-interface for this post type.', 'custommanager'); ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="cm-table-wrap">
                    <div class="cm-arrow"><br></div>
                    <h3 class="cm-toggle"><?php _e('Show In Nav Menus ', 'custommanager') ?></h3>
                    <table class="form-table show-in-nav-menus">
                        <tr>
                            <th>
                                <label for="show_in_nav_menus"><?php _e('Show In Nav Menus', 'custommanager') ?></label>
                            </th>
                            <td>
                                <span class="description"><?php _e('Whether post_type is available for selection in navigation menus.', 'custommanager'); ?></span>
                            </td>
                        </tr>
                       <tr>
                            <th></th>
                            <td>
                                <input type="radio" name="show_in_nav_menus" value="1" <?php if ( $args['show_in_nav_menus'] ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('TRUE', 'custommanager'); ?></strong></span>
                                <br />
                                <input type="radio" name="show_in_nav_menus" value="0" <?php if ( !$args['show_in_nav_menus'] ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('FALSE', 'custommanager'); ?></strong></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="cm-table-wrap">
                    <div class="cm-arrow"><br></div>
                    <h3 class="cm-toggle"><?php _e('Publicly Queryable', 'custommanager') ?></h3>
                    <table class="form-table public-queryable">
                        <tr>
                            <th>
                                <label for="publicly_queryable"><?php _e('Publicly Queryable', 'custommanager') ?></label>
                            </th>
                            <td>
                                <span class="description"><?php _e('Whether post_type queries can be performed from the front end.', 'custommanager'); ?></span>
                            </td>
                        </tr>
                       <tr>
                            <th></th>
                            <td>
                                <input type="radio" name="publicly_queryable" value="1" <?php if ( $args['publicly_queryable'] ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('TRUE', 'custommanager'); ?></strong></span>
                                <br />
                                <input type="radio" name="publicly_queryable" value="0" <?php if ( !$args['publicly_queryable'] ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('FALSE', 'custommanager'); ?></strong></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="cm-table-wrap">
                    <div class="cm-arrow"><br></div>
                    <h3 class="cm-toggle"><?php _e('Exclude From Search', 'custommanager') ?></h3>
                    <table class="form-table exclude-from-search">
                        <tr>
                            <th>
                                <label for="exclude_from_search"><?php _e('Exclude From Search', 'custommanager') ?></label>
                            </th>
                            <td>
                                <span class="description"><?php _e('Whether to exclude posts with this post type from search results.', 'custommanager'); ?></span>
                            </td>
                        </tr>
                       <tr>
                            <th></th>
                            <td>
                                <input type="radio" name="exclude_from_search" value="1" <?php if ( $args['exclude_from_search'] ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('TRUE', 'custommanager'); ?></strong></span>
                                <br />
                                <input type="radio" name="exclude_from_search" value="0" <?php if ( !$args['exclude_from_search'] ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('FALSE', 'custommanager'); ?></strong></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="cm-table-wrap">
                    <div class="cm-arrow"><br></div>
                    <h3 class="cm-toggle"><?php _e('Hierarchical', 'custommanager') ?></h3>
                    <table class="form-table">
                        <tr>
                            <th>
                                <label for="hierarchical"><?php _e('Hierarchical', 'custommanager') ?></label>
                            </th>
                            <td>
                                <span class="description"><?php _e('Whether the post type is hierarchical. Allows Parent to be specified.', 'custommanager'); ?></span>
                            </td>
                        </tr>
                       <tr>
                            <th></th>
                            <td>
                                <input type="radio" name="hierarchical" value="1" <?php if ( $args['hierarchical'] ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('TRUE', 'custommanager'); ?></strong></span>
                                <br />
                                <input type="radio" name="hierarchical" value="0" <?php if ( !$args['hierarchical'] ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('FALSE', 'custommanager'); ?></strong></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="cm-table-wrap">
                    <div class="cm-arrow"><br></div>
                    <h3 class="cm-toggle"><?php _e('Rewrite', 'custommanager') ?></h3>
                    <table class="form-table">
                        <tr>
                            <th>
                                <label for="rewrite"><?php _e('Rewrite', 'custommanager') ?></label>
                            </th>
                            <td>
                                <span class="description"><?php _e('Rewrite permalinks with this format.', 'custommanager'); ?></span>
                            </td>
                        </tr>
                       <tr>
                            <th></th>
                            <td>
                                <input type="radio" name="rewrite" value="1" <?php if ( $args['rewrite'] === '1' ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('TRUE', 'custommanager'); ?></strong></span>
                                <br />
                                <input type="radio" name="rewrite" value="0" <?php if ( $args['rewrite'] === '0' ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('FALSE', 'custommanager'); ?></strong></span>
                                <br />
                                <input type="radio" name="rewrite" value="advanced" <?php if ( isset( $args['rewrite']['slug'] )) echo( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('CUSTOM SLUG', 'custommanager'); ?></strong></span>
                                <br />
                                <input type="text" name="rewrite_slug" value="<?php echo( $args['rewrite']['slug'] ); ?>" />
                                <br />
                                <span class="description"><?php _e('Prepend posts with this slug.', 'custommanager'); ?></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="cm-table-wrap">
                    <div class="cm-arrow"><br></div>
                    <h3 class="cm-toggle"><?php _e('Query var', 'custommanager') ?></h3>
                    <table class="form-table">
                        <tr>
                            <th>
                                <label for="query_var"><?php _e('Query var', 'custommanager') ?></label>
                            </th>
                            <td>
                                <span class="description"><?php _e('Name of the query var to use for this post type.', 'custommanager'); ?></span>
                            </td>
                        </tr>
                       <tr>
                            <th></th>
                            <td>
                                <input type="radio" name="query_var" value="1" <?php if ( $args['query_var'] ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('TRUE', 'custommanager'); ?></strong></span>
                                <br />
                                <input type="radio" name="query_var" value="0" <?php if ( !$args['query_var'] ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('FALSE', 'custommanager'); ?></strong></span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="cm-table-wrap">
                    <div class="cm-arrow"><br></div>
                    <h3 class="cm-toggle"><?php _e('Can Export', 'custommanager') ?></h3>
                    <table class="form-table">
                        <tr>
                            <th>
                                <label for="hierarchical"><?php _e('Can Export', 'custommanager') ?></label>
                            </th>
                            <td>
                                <span class="description"><?php _e('Can this post_type be exported.', 'custommanager'); ?></span>
                            </td>
                        </tr>
                       <tr>
                            <th></th>
                            <td>
                                <input type="radio" name="can_export" value="1" <?php if ( $args['can_export'] ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('TRUE', 'custommanager'); ?></strong></span>
                                <br />
                                <input type="radio" name="can_export" value="0" <?php if ( !$args['can_export'] ) echo ( 'checked="checked"' ); ?>>
                                <span class="description"><strong><?php _e('FALSE', 'custommanager'); ?></strong></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="cm-clear"></div>
            <input type="submit" class="button-primary" name="cm_submit_update_post_type" value="Update Post Type">
            <br /><br /><br /><br />
        </form>
    </div> <?php
}
?>
