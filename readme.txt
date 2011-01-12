=== CustomPress ===
Contributors: ivanshaovchev
Donate link:
Tags: post types, taxonomies, custom fields
Requires at least: 3.0.1
Tested up to: 3.0.1
Stable tag: 1.0.5

CustomPress is a custom post, taxonomie and field manager.

== Description ==

The purpose of this plugin is to give you the ability to convert your WordPress
installation into a full blown CMS system through your back-end. The plugin serves
the needs of both regular users and developers.

If you want to obtain a better understanding of the Custom Post Types and their
power, you can go through this article on Codex.WordPress.org:
http://codex.wordpress.org/Custom_Post_Types

If you want to obtain a better understanding of the Custom Taxonomies and their
application you can go through this article on Codex.WordPress.org:
http://codex.wordpress.org/Custom_Taxonomies

If you want to obtain a better understanding of the Custom Fields and their
application you can go through this article on Codex.WordPress.org:
http://codex.wordpress.org/Custom_Fields

All of the above is provided for you in this plugin. The plugin uses the entire
WordPress internal API for the custom's which gives you absolute control over them.

== Installation ==

1. Extract the plugin archive file.
2. Upload `custompress` folder to the `/wp-content/plugins/` directory.
3. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

== Changelog ==

= 1.0.5 =
* Bug fixes.

= 1.0.4 =
* Bug fixes.

= 1.0.3 =
* Improved UI.
* Internal architecture improved.
* Submodules added.
* Localization added ( .pot files inside "cp-languages" and "ct-languages" ).
* Embed codes added.
* Bug fixes.

= 1.0.2 =
* Initial release.

== Upgrade Notice ==

= 1.0.3 =
Due to the fact that the internal architecture of the current version is completly
different from the previous one, the "v1.0.3" release is NOT backward compatible
with the "v1.0.2" release.

== Guides ==

= Basic workflow =

This guide assumes you are using the latest version of the plugin.

1.   Add a custom "Post Type":
1.1. Go to: CustomPress -> Content Types -> Post Types -> Add Post Type
1.2. Use the appropriate settings for your needs ( for most cases the default ones
     will do, you may want to change the "Labels" for your custom post type, so you
     can distinguish it from the rest )
1.3. You should see the newly created post type in your admin menu.
1.4. You can now add content, using your new post type. The new post type will have
     all the features of the regular post type plus more, depending on the settings
     you choose when adding it ( you can always edit the settings later ).

2.   Extend your new custom post type with a "Taxonomy". The purpose of the custom
     taxonomies is to give you the ability to organize your content in the best
     way you can think of.
2.1. Go to: CustomPress -> Content Types -> Taxonomies -> Add Taxonomy
2.2. Use the appropriate settings for your needs ( for most cases the default ones
     will do, you may want to change the "Labels" for your custom post type, so you
     can distinguish it from the rest ). One important setting is the "Hierarchical" option.
     Depending on the value of this option your taxonomy will behave like tag or like category.
2.3. Associate your custom taxonomy with the new post type you have previously created
     ( this is an option when you add/edit your custom taxonomy ).
2.4. You should see your new custom taxonomy below your custom post type.
2.5. You can add terms directly inside your post type ( recommended ) or inside
     the custom taxonomy admin page.
2.6. To display your custom taxonomies use the embed code associated with the
     particular taxonomy and place it in your "single.php" or "single-[post_type].php"
     ( if you have it created from CustomPress->Settings") file.

3.   Extend your new custom post type with "Custom Fields". This gives you the
     ability to add custom content to your post types.
3.1. Go to: CustomPress -> Content Types- > Custom Fields -> Add Custom Field
3.2. You can select different types of custom fields that can be associated with
     your custom post types ( textbox, textarea, dropdown, checkbox ... etc ).
3.3. To display your custom fields use the embed code associated with the particular
     custom field and place it in your "single.php" or "single-[post_type].php"
     ( if you have it created from CustomPress->Settings") file.

4.   Configure CustomPress:
4.1. Go to: CustomPress->Settings and select the check-boxes of the post types you
     want displayed on your Home page.
4.2. If you want to create a theme file for your custom post type. If you have
     theme file for your custom post type you can customize it differently than
     the main post types. All post from this post types will use this template.
     In some cases you may find using the default theme file better.

= Advanced Usage =

The power of this plugin can be experienced in full by advanced users/plugin developers.
So what can you do with it?

1.   Extend available post types.
1.1. With this plugin you can extend available custom post types and add new features
     to them easily. Most of the plugins use custom post types for their content.
     Use CustomPress to extend their custom post types and add new taxonomies and custom fields.

2.   Build your plugins on top of it.
2.1. The new architecture provides a submodule which handles only the Content Types
     and is loosely coupled with the rest of the plugin. The submodule resides in
     "cp-submodules" and is called "content-types". You can copy the content types
     submodule inside your own plugin and all content types will become part of it.
     The only thing you need to do is to include the "ct-loader.php" file from inside
     your plugin and setup the main menu slug of your plugin in "ct-config.php" so
     the UI can attach itself to it. You can use it in stealth mode also - activate
     the UI, add the necessary custom post types, custom taxonomies and custom fields
     and then deactivate the UI. All the custom content types will remain fully operational.
     Use the CustomPress plugin as skeleton for your plugins.