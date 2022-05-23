=== Visual User Description Editor ===
Contributors: kevinlearynet, zwwuu
Tags: profile, biography, bio, rich, text, editor, wysiwyg, tinymce, wpeditor, visual, editor, biographic, info, description, profile biography, profile description, rich text, TinyMCE, user, user profile, users, author
Requires at least: 3.3
Tested up to: 5.9.3
Requires PHP: 5.3
Stable tag: 1.0.0
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Replaces the user "Biographical Info" profile field with a TinyMCE visual editor.

== Description ==

Replaces the user "Biographical Info" profile field with a TinyMCE visual editor, allowing you to write user biography using rich text.

This plugin is multisite-compatible; if you would like to use it on every blog, network activate the plugin from the network dashboard. Otherwise, activate the plugin for individual sites.

== Copyright ==

Visual User Description Editor
Copyright (c) 2022 zwwuu https://zwwuu.dev/
License: GPLv2
Source: https://github.com/zwwuu/visual-user-description-editor

Visual User Description Editor is based on Visual Editor Biography v1.4
License: GPLv2
Source: https://github.com/Kevinlearynet/Visual-Biography-Editor

== Installation ==

1. Search for 'Visual User Description Editor' in the 'Plugins > Add New' menu and click 'Install'
2. Activate the plugin through the 'Plugins' menu in WordPress

== Screenshots ==

1. Editing a user profile using the visual editor
2. Viewing a user archive page with the formatted description

== Changelog ==

= 1.0.0 =
* Initial release

== Upgrade Notice ==

= 1.0.0 =
Initial release

== Frequently Asked Questions ==

= How to change who can use visual editor? =

By default, the visual editor is available to current user with 'edit_post' capability.

You can change this by hooking into the 'vude_can_use_visual_editor' filter.

```php
add_filter( 'vude_use_visual_editor', 'my_custom_use_visual_editor' );
function my_custom_use_visual_editor( $use_visual_editor) {
    return current_user_can( 'edit_others_pages' )
}
```
