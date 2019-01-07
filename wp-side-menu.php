<?php
/*
Plugin Name: WP Side Menu
Description: Responsive off-screen side menu for Wordpress based on Sidr.
Author: ThePopularizer, based on works by Cozmoslabs, Cristian Antohe
Version: 0.1
Author URI: http://www.thepopularizer.com

License: GPL2

== Copyright ==
Copyright 2011 Cozmoslabs (wwww.cozmoslabs.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/

define( 'WSM_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . dirname( plugin_basename( __FILE__ ) ) );

/* ready for localization */
load_plugin_textdomain( 'wsm', false, basename( dirname( __FILE__ ) ) . '/languages' );

/* Register the Theme Location */
add_action('init', 'wsm_theme_location' );
function wsm_theme_location(){
	register_nav_menu( 'wsmoffscreen', 'Offscreen Nav' );
}

/* Add Scripts and CSS*/
add_action('wp_head', 'wsm_print_css' );
function wsm_print_css($hook){
	wp_register_style('wsm-sidr-blacktheme', plugins_url('/assets/stylesheets/jquery.sidr.dark.css', __FILE__));
	wp_enqueue_style('wsm-sidr-blacktheme');

	wp_register_script('wsm-sidr-js', plugins_url('/assets/jquery.sidr.js', __FILE__), array( 'jquery' ), '1.0' );
	wp_enqueue_script('wsm-sidr-js');
}

add_action('wp_footer', 'wsm_print_scripts' );
function wsm_print_scripts($hook){
	wp_register_script('wsm-sidr-js', plugins_url('/assets/jquery.sidr.js', __FILE__), array( 'jquery' ), '1.0' );
	wp_enqueue_script('wsm-sidr-js');
}

/* Insert slider */
// add_action('wp_footer', 'wsm_insert_menu');
add_shortcode('responsive_menu', 'wsm_insert_menu');
function wsm_insert_menu(){
?>
<div id="mobile-header">
	<a href="#sidr" id="responsive-menu-button">Menu</a>
</div>

<?php

$args = array(
	'theme_location'  => 'wsmoffscreen',
	'container'       => 'div',
	'container_id'    => 'sidr',
	'menu_class'      => 'menu',
	'fallback_cb'     => 'wp_page_menu',
);

wp_nav_menu( $args );
}

?>
