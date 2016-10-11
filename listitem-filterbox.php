<?php
/**
 * Plugin Name: List Item Filter Box
 * Description: Shortcode that provides a search box for filtering out items from an ordered or unordered list
 * Version: 1.0
 * Author: Zach Watkins
 * Author URI: https://github.com/ZachWatkins
 * Author Email: watkinza@gmail.com
 * License: GPL2+
**/

// If this file is called directly, abort.
defined( 'ABSPATH' ) or die( 'access denied' );

function listitem_filterbox_addscript(){

  wp_register_script( 'listitem_filterbox',
    plugin_dir_url( __FILE__ ) . 'js/main.js',
    false,
    true
  );

}

add_action( 'wp_enqueue_scripts', 'listitem_filterbox_addscript' );

function listitem_filterbox_shortcode( $atts ){

  global $wp;

  $defaults = array(
    'formclass' => 'search-form',
    'inputclass' => 'search-field',
    'placeholder' => 'Search',
    'usetitles' => 'true'
  );

  // Ensure attributes are not misused
  foreach($atts as $key=>$value){
    $atts[$key] = str_replace('"', '', $value);
  }

  // Overwrite defaults with user-defined attributes
  $atts = array_merge($defaults, $atts);
  
  wp_enqueue_script( 'listitem_filterbox' );

  return sprintf( '<form class="%s listitem-filterbox" action="%s" method="GET" data-lifb-use-titles="%s"><input class="%s" placeholder="%s" autocomplete="off" name="filter" type="search" /></form>',
    $atts['formclass'],
    home_url(add_query_arg(array(),$wp->request)),
    $atts['usetitles'],
    $atts['inputclass'],
    $atts['placeholder']
  );

}

add_shortcode( 'listitem_filterbox', 'listitem_filterbox_shortcode' );

?>
