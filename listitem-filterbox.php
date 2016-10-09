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

function listitem_filterbox_shortcode( $atts ){
  global $wp;
  return sprintf( '<form class="search-form listitem-filterbox" action="%s" method="GET"><input placeholder="%s" autocomplete="off" name="filter" type="search" /><script type="text/javascript" src="%sjs/main.js"></script></form>', home_url(add_query_arg(array(),$wp->request)), $atts['placeholder'], plugin_dir_url( __FILE__ ) );
}

add_shortcode( 'listitem_filterbox', 'listitem_filterbox_shortcode' );

?>
