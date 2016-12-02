# List Item Filter

[WordPress plugin page](https://wordpress.org/plugins/list-item-filter/)

Filter out list items with a shortcode-generated search field.

## Description

This plugin provides a shortcode that generates a text input field, which filters out list items that do not contain that field's text. Any sibling elements of the shortcode, or children of those siblings, that are "li" elements will be searched by the text field it generates. As you type, each word in the text field is matched against the readable text of the list items (and optionally their title attributes). Any list items which don't match that text are hidden.

Example: `[list_item_filter placeholder="Filter this list by terms" searchtitles="true"]`

Shortcode parameters:

* **label** (string): Define the search field's label text. *Default value: Filter list items:*
* **showlabel** (boolean): Determine whether or not the search field's label is visible. *Default value: true*
* **placeholder** (string): Define the search field's placeholder text. *Default value: Search*
* **noresultsmsg** (string): Define the message shown when no list items are found. Provide an empty string to disable this feature. *Default value: no results*
* **searchtitles** (bool): Expand text matching to include the first title attribute of the list item's HTML. *Default value: false*
* **formclass** (string): Define one or more class names for the form. *Default value: search-form*
* **inputclass** (string): Define one or more class names for the search field. *Default value: search-field*

If you like this plugin or have a request, let me know!

## Installation

Upload the plugin to your blog, activate it, then use the shortcode in a page or post!
