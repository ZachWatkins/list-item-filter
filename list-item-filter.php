<?php
/**
 * Plugin Name: List Item Filter
 * Description: Provides a shortcode that generates a text input field, which filters out list items that do not contain that input field's text.
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
    'searchtitles' => 'false'
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
