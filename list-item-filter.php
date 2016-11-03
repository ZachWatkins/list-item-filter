<?php
/**
 * Plugin Name: List Item Filter
 * Description: Filter out list items with a shortcode-generated search field.
 * Version: 1.3
 * Author: Zach Watkins
 * Author URI: http://zachwatkins.info
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
    'searchtitles' => 'false',
    'noresultsmsg' => 'no results'
  );

  // Ensure attributes are not misused
  foreach($atts as $key=>$value){
    $atts[$key] = str_replace('"', '', $value);
  }

  // Overwrite defaults with user-defined attributes
  $atts = array_merge($defaults, $atts);
  
  wp_enqueue_script( 'list_item_filter_wp_plugin' );

  return sprintf( '<form class="%s list-item-filter-plugin" action="%s" method="GET" data-lifp-search-titles="%s" data-lifp-no-results-msg="%s"><label><span>Filter list items below:</span> <input class="%s" placeholder="%s" autocomplete="off" name="filter" type="search" /></label></form><style type="text/css">.lifp-hide{display:none}form.list-item-filter-plugin label span{display:block;width:0;overflow:hidden;white-space:nowrap;text-indent:110em;}</style>',
    $atts['formclass'],
    home_url(add_query_arg(array(),$wp->request)),
    $atts['searchtitles'],
    $atts['noresultsmsg'],
    $atts['inputclass'],
    $atts['placeholder']
  );

}

add_shortcode( 'list_item_filter', 'list_item_filter_shortcode' );

?>
