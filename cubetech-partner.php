<?php
/**
 * Plugin Name: cubetech Partner
 * Plugin URI: http://www.cubetech.ch
 * Description: cubetech Partner - create some partners, reusable within groups and shorttags
 * Version: 1.0
 * Author: cubetech GmbH
 * Author URI: http://www.cubetech.ch
 */

include_once('lib/cubetech-post-type.php');
include_once('lib/cubetech-shortcode.php');
include_once('lib/cubetech-metabox.php');

add_image_size( 'cubetech-partner-thumb', 152, 70 );

add_action('wp_enqueue_scripts', 'cubetech_partner_add_styles');

function cubetech_partner_add_styles() {
	wp_register_style('cubetech-partner-css', plugins_url('assets/css/cubetech-partner.css', __FILE__) );
	wp_enqueue_style('cubetech-partner-css');
	wp_enqueue_script('cubetech_partner_js', plugins_url('assets/js/cubetech-partner.js', __FILE__), array('jquery'));
}

?>
