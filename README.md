# CustomPress

**INACTIVE NOTICE: This plugin is unsupported by WPMUDEV, we've published it here for those technical types who might want to fork and maintain it for their needs.**

## Translations

Translation files can be found at https://github.com/wpmudev/translations

## CustomPress is the ultimate plugin for transforming WordPress from a blogging platform into a full content management system.

Take WordPress to the next level with CustomPress. Manage more content, more efficiently with custom post types.  

![Create custom post types for a truly custom CMS.](https://premium.wpmudev.org/wp-content/uploads/2010/11/custom-icon-735x470.jpg)

 Create custom post types for a truly custom CMS.

### Power, Organization and Control

Create and sort content into custom post types for everything from movies, to books, to real estate listings, to design galleries. Add control and flexibility for content management and design consistency. 

### Create Your Own Custom Fields

Distinguish your new post types with custom fields. Add text boxes, radio buttons, dropdown menus and checkboxes. Assign each field its own design and include tools to make organization and management fit your needs better.  

![Create beautiful designs around custom fields and taxonomies.](https://premium.wpmudev.org/wp-content/uploads/2010/11/custom-post-type-735x470.jpg)

 Create beautiful designs around custom fields and taxonomies.

### Fit Any Theme

Make custom post types, complete with tags, categories, custom fields and design elements – including dashboard icons (we thought of everything). The automatically generated theme files and shortcode library make it easy to style for a perfect design fit. 

## Usage

For help and information on installing plugins you can view our [Installing WordPress Plugins Manual](https://premium.wpmudev.org/manuals/wpmu-manual-2/installing-regular-plugins-on-wpmu/). _If you are using a **Multisite** please note: There are TWO ways to use CustomPress:_ _**1\. Network Activate.** In the **Network Admin>CustomPress>Settings** Menu you will need to enable subsite contents. There will be two checkboxes there: first enables the Content Type menu on subsites in the CustomPress section. The second allows subsites to use any Network level defined custom types. When network activate you can define custom types at the Network level and these will appear on all subsites. If enabled you can also define custom types at the subsite level and they will be restricted to just that subsite._ _**2\. Activate Site by Site.** Each site creates their own content and it is restricted to that site._ Important: if you wish to allow the creation of content types on each sub-site when the plugin is not network-activated, you must first network-activate it and enable sub-site content types. Then network-deactivate. **Pay attention to the above: You cannot move content around after it has been created so you would have to delete and re-enter. In most cases you probably should not network activate and activate locally on those that need CustomPress.** Before starting with creating your post types and content you should do a quick layout of how you see your Post Type, Taxonomies and Custom Fields working together. This will save you time later. CustomPress is a pretty big plugin and has lots of features, you shouldn't walk into using it without being prepared. To learn more about Post Types in WP [CLICK HERE](http://codex.wordpress.org/Post_Types). OK Onward! The **Network Admin >Content Types** menu is where you create your network content types. [

![Custompress dash](https://premium.wpmudev.org/wp-content/uploads/2010/11/Custompress-dash.png)

![i](https://premium.wpmudev.org/wp-content/uploads/2010/11/Custompress-dash.png)

 Let's create a Custom Post Type setup for a new website. This site is going to be a beginning gardening guide. So I'll follow my own advice and make a list of what I'll need to make this comprehensive. [

![Post Type outline](https://premium.wpmudev.org/wp-content/uploads/2010/11/game-plan.jpg "Post Type outline")](https://premium.wpmudev.org/wp-content/uploads/2010/11/game-plan.jpg)

   Now that I know what I'm going to be doing let's make a Post Type! First things First! Name your post type, and be sure you like it. **It cannot be changed!** Then you select the features that you want your post type to support. Title and Editor are defaults, everything else is up to you! _**Multisite installs can find the Content Types menu on the Network Admin_ [

![Add post type 1](https://premium.wpmudev.org/wp-content/uploads/2010/11/Add-post-type-1.png)

![i](https://premium.wpmudev.org/wp-content/uploads/2010/11/Add-post-type-1.png)


![Add post type 2](https://premium.wpmudev.org/wp-content/uploads/2010/11/Add-post-type-2.png)

![i](https://premium.wpmudev.org/wp-content/uploads/2010/11/Add-post-type-2.png)

 Quick Tour of the remaining settings:

*   **Support Regular Taxonomies:** translates to "do you want to use the default tags and categories for this Post Type?"
*   **Capability Type:** Should leave at default unless you know what you're doing. If you want to learn more [CLICK HERE](http://codex.wordpress.org/Function_Reference/register_post_type#Parameters).
*   **Map Meta Capabilities:** More advanced stuff, default is good here too. If you want to learn about it [CLICK HERE](http://codex.wordpress.org/Function_Reference/get_post_type_capabilities).
*   **Labels:** What wording your post type will use across your site. Each has an explanation and a default value.
*   **Description:** this one is easy! A summary of what the Post Type is (not required)
*   **Menu Position:** Where it displays on the Dashboard Menu. Default is just above first divider.
*   **Menu Icon:** Optional. Load 16px _x_ 16px image into your media library. Copy the URL here.
*   **Display Custom Fields Columns:** You'll only see this once you've added custom fields to your post type.
*   **Public:** You can choose to make the post type public or not. If you want granular control over the visibility you can set the following 4 parameters by selecting _Advanced_.
*   **Show UI, Show in Nav Menus, Publicly Queryable** and **Exclude From Search:** will all be grey and will mimic the True or False setting in the **Public** menu option. They become individually changable when you choose _Advanced_ in the **Public** menu.
*   **Hierarchical**: Does your post type use a hierarchy? Regular Post Types don't. If you're doing a simple single post type, leave this False.
*   **Has Archive:** determines if the post type is treated as having it's own archive.
*   Rewrite: allow permalinks to be rewritten at any time.
*   EP Mask: enables endpoint masks for permalinks. For more on this, see [HERE](https://premium.wpmudev.org/forums/topic/ep-mask-in-taxonomies-how-does-it-work#post-632891) and [HERE](https://premium.wpmudev.org/forums/topic/what-is-the-use-case-for-the-ep-mask-in-custompress#post-677221).
*   **Query Var:** allows your post to be query-able <--- _is that a word?_ _spellcheck says so, so I guess it must be..._
*   **Can Export:** another easy one, do you want to be able to export these?

PHEW! OK done with that! See not as hard as you thought, But you're not done yet! I need a way to categorize my Plant post type. So, I'm going to need a Taxonomy. What kind of taxonomy you say? Well I will tell you! I use a hierarchical taxonomy (fancy phrase for Category!). I don't need a non-hierarchical taxonomy (another fancy word for tags) because I am using the WP tags for this post type. Remember that "**Support Regular Taxonomies:**" setting? Aha! It's making sense now isn't it!? So here I go with my Taxonomy [

![Add Taxonomy 1](https://premium.wpmudev.org/wp-content/uploads/2010/11/Add-Taxonomy-1.png)

![i](https://premium.wpmudev.org/wp-content/uploads/2010/11/Add-Taxonomy-1.png)


![Add Taxonomy 2](https://premium.wpmudev.org/wp-content/uploads/2010/11/Add-Taxonomy-2.png)

![i](https://premium.wpmudev.org/wp-content/uploads/2010/11/Add-Taxonomy-2.png)

 You've seen most of these settings already, so let's pick out the one we haven't touched on. _They all tie in together so you'll see the same rules as you saw in the post type, just applied to your taxonomy now._ **Post Type:** you will have to pick a post type to assign this taxonomy to. Yes you can select more than one. HOLD ON! I see those wheels turning, just stay with me! We have one more thing to do before we can start making custom posts. _**Remember** the Hierarchical setting here will determine if your taxonomy behaves like categories or tags._ OK last go round in Custom Fields I actually have a few in my post type, but we only need to look at one, the settings are the same for all. It's just how you use them that will change. [

![Add Custom Field](https://premium.wpmudev.org/wp-content/uploads/2010/11/Add-Custom-Field.png)

![i](https://premium.wpmudev.org/wp-content/uploads/2010/11/Add-Custom-Field.png)

 All that Embed stuff at the top is important, but we don't need it yet, so it's OK to skip over it right now. Just don't forget about it! **Field Title:** where you determine your title and if it's a required field. You can also allow or deny other plugins or posts to use this field. **Field Type:** Your entry method. Text, multi-line text, radio button, check boxes, drop-down select, multiselect and date picker, are all options. Just choose and add the options or parameters accordingly. See, you're a pro at this now, you already know what the last two fields do! Now let's check out what we have! [

![new plant](https://premium.wpmudev.org/wp-content/uploads/2010/11/new-plant.png)

![i](https://premium.wpmudev.org/wp-content/uploads/2010/11/new-plant.png)

![types](https://premium.wpmudev.org/wp-content/uploads/2010/11/types.png)

![i](https://premium.wpmudev.org/wp-content/uploads/2010/11/types.png)

 Content Part is done! Easy Peasy right? Now to get it show up on our site to our users. Right now, we have lots of great info but it won't display on the front end just yet. We have to add it to our page template. You can do this by using the Embed Code that is created when you create a new content type. Since the Post Type option uses the default Post values when created we don't need to do anything special to get it to show. Here is a screenshot of what it looks like now: [

![Post pre-embed](https://premium.wpmudev.org/wp-content/uploads/2010/11/POST-TYPE-5.jpg "Post pre-embed")](https://premium.wpmudev.org/wp-content/uploads/2010/11/POST-TYPE-5.jpg)

 As you can see, the Post Title , Content, Tags and default Post items are showing fine, but our Custom Taxonomies and Custom Fields are not showing. We will use the **Embed Codes** that were created when we created our custom content to get these to show up on the post page. You will find the embed codes by hovering the item you want to add to the page template and clicking **Embed Code**. You'll find this on both Taxonomies and Custom Fields, as well as some additional info on the Custom Fields tab about using these codes.   [

![1\. Embed code 2\. Shortcode](https://premium.wpmudev.org/wp-content/uploads/2010/11/codes1.png)

![i](https://premium.wpmudev.org/wp-content/uploads/2010/11/codes1.png)

 1\. Embed code 
 
2\. Shortcode

 **You can use these Embed Codes 2 ways:**

1.  Simply enter the shortcode created on any page or post, directly in the WordPress editor, or

2.  You can embed the php embed code in the page template so that you don't have to manually add the shortcode to each post. To do this follow the instructions below:

First you need to find the page template you want to embed these into. You can create your own from scratch or you can copy your existing single.php and use the format "single-[post_type].php" . This is easily done by connecting to your site via FTP, opening your single.php template for the active theme in a Notepad editor _(NOT WORD..if you need one try your built in Notepad or [THIS](http://notepad-plus-plus.org/))_ and 'Save As' the new file-name. Then just put it back in your theme folder via FTP. There is a built in template creator that does what I have just described above, you will find it on the **CustomPress>Settings** menu. It only does what I have described above, it will **NOT** embed your custom taxonomies or fields. It's best to do create the template yourself if you are comfortable doing so. [

![Page Template](https://premium.wpmudev.org/wp-content/uploads/2010/11/POST-TYPE-6.jpg "Page Template")](https://premium.wpmudev.org/wp-content/uploads/2010/11/POST-TYPE-6.jpg)

   Now we just embed the php codes in our new page template somewhere [inside The Loop](http://codex.wordpress.org/The_Loop#Using_The_Loop).

_With Custom Fields you have the option of displaying your items all with one shortcode. This save the various entires that you need to make of each shortocode to display the Label and Value each individually._


![block](https://premium.wpmudev.org/wp-content/uploads/2010/11/block.png)

![i](https://premium.wpmudev.org/wp-content/uploads/2010/11/block.png)

 Here it is in my template: [

![1\. The loop 2\. The shortcode](https://premium.wpmudev.org/wp-content/uploads/2010/11/codes21.png)

![i](https://premium.wpmudev.org/wp-content/uploads/2010/11/codes21.png)

 1\. The loop  
 
2\. The shortcode

 Save and upload the changes via FTP. Now lets see how it looks on the site! 

![Shortcode on Site](https://premium.wpmudev.org/wp-content/uploads/2010/11/custompress-shortcode-site.jpg)

 Not too bad! A couple of CSS tweaks and we're looking good! :) CustomPress also provides a few additional Shortcodes, you can see these under the **Shortcodes** tab on the CustomPress menu (what? too obvious?) They give you a bit more advanced control over the Custom Field Input, Custom Field Filters and Custom Field Blocks. And that's it! Not so bad 'eh?!
