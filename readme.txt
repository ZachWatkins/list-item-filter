=== List Item Filter ===
Contributors: Zach Watkins
Tags: list, filter, search
Requires at least: 2.5
Tested up to: 4.6
Stable tag: 1.0

Provides a shortcode [list_item_filter] that generates a text input field, which filters out list items that do not contain that input field's text.

== Description ==

This plugin provides a shortcode [list_item_filter] that generates a text input field, which filters out list items that do not contain that input field's text. Each word in the input field is matched against the readable text of the list items, and list items which don't match are hidden. The "searchtitles" parameter expands text matching to include the first title attribute of the list item's HTML. The "placeholder" parameter allows you to set the input field's default text. The "formclass" and "inputclass" parameters allow you to add your own class names to these elements, which helps integrate the feature with your existing styles.

== Installation ==

Upload the plugin to your blog, activate it, then use the shortcode in a page or post!

== Frequently Asked Questions ==

= How do I submit an issue or request? =

You can use the Issues section of the Github repository: https://github.com/ZachWatkins/list-item-filter-box/issues

== Changelog ==

= Version 1.0 =

* Provide shortcode parameters for class names, placeholder text, and searching title attributes
* Refactor Javascript to allow multiple instances per page

Example usage: [list_item_filter placeholder="Filter this list by terms" searchtitles="true"]

If you like this plugin or have a request, let me know!
