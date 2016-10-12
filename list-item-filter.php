<?php
/**
 * Plugin Name: List Item Filter
 * Description: This plugin provides a shortcode [list_item_filter] that generates a text input field, which filters out list items that do not contain that input field's text. Each word in the input field is matched against the readable text of the list items, and list items which don't match are hidden. The "searchtitles" parameter expands text matching to include the first title attribute of the list item's HTML. The "placeholder" parameter allows you to set the input field's default text. The "formclass" and "inputclass" parameters allow you to add your own class names to these elements, which helps integrate the feature with your existing styles.
 * Version: 1.0
 * Author: Zach Watkins
 * Author URI: https://github.com/ZachWatkins
 * Author Email: watkinza@gmail.com
 * License: GPL2+
**/

// If this file is called directly, abort.
defined( 'ABSPATH' ) or die( 'access denied' );

function list_item_filter_addscript(){

  wp_register_script( 'list_item_filter_wp_plugin',
    plugin_dir_url( __FILE__ ) . 'js/main.js',
    false,
    true
  );

}

add_action( 'wp_enqueue_scripts', 'list_item_filter_addscript' );

function list_item_filter_shortcode( $atts ){

  global $wp;

  $defaults = array(
    'formclass' => 'search-form',
    'inputclass' => 'search-field',
    'placeholder' => 'Search',
    'searchtitles' => 'true'
  );

  // Ensure attributes are not misused
  foreach($atts as $key=>$value){
    $atts[$key] = str_replace('"', '', $value);
  }

  // Overwrite defaults with user-defined attributes
  $atts = array_merge($defaults, $atts);
  
  wp_enqueue_script( 'list_item_filter_wp_plugin' );

  return sprintf( '<form class="%s list-item-filter" action="%s" method="GET" data-lif-use-titles="%s"><input class="%s" placeholder="%s" autocomplete="off" name="filter" type="search" /></form>',
    $atts['formclass'],
    home_url(add_query_arg(array(),$wp->request)),
    $atts['searchtitles'],
    $atts['inputclass'],
    $atts['placeholder']
  );

}

add_shortcode( 'list_item_filter', 'list_item_filter_shortcode' );

?>
