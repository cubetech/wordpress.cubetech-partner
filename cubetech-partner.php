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

wp_enqueue_script('jquery');
wp_register_script('cubetech_partner_js', plugins_url('assets/js/cubetech-partner.js', __FILE__), array('jquery','wpdialogs'));
wp_enqueue_script('cubetech_partner_js');

add_action('wp_enqueue_scripts', 'cubetech_partner_add_styles');

if(!function_exists('enqueue_css'))
{
	function enqueue_css()
	{
		wp_register_style('custom_jquery-ui-dialog', plugins_url('assets/css/jquery-ui-dialog.min.css', __FILE__) );
		wp_enqueue_style('custom_jquery-ui-dialog');
	}
	add_action( 'admin_enqueue_scripts', 'enqueue_css' );
} 


function cubetech_partner_add_styles() {
	wp_register_style('cubetech-partner-css', plugins_url('assets/css/cubetech-partner.css', __FILE__) );
	wp_enqueue_style('cubetech-partner-css');
}

/* Add button to TinyMCE */
function cubetech_partner_addbuttons() {

	if ( (! current_user_can('edit_posts') && ! current_user_can('edit_pages')) )
		return;
	
	if ( get_user_option('rich_editing') == 'true') {
		add_filter("mce_external_plugins", "add_cubetech_partner_tinymce_plugin");
		add_filter('mce_buttons', 'register_cubetech_partner_button');
		add_action( 'admin_footer', 'cubetech_partner_dialog' );
	}
}
 
function register_cubetech_partner_button($buttons) {
   array_push($buttons, "|", "cubetech_partner_button");
   return $buttons;
}
 
function add_cubetech_partner_tinymce_plugin($plugin_array) {
	$plugin_array['cubetech_partner'] = plugins_url('assets/js/cubetech-partner-tinymce.js', __FILE__);
	return $plugin_array;
}

add_action('init', 'cubetech_partner_addbuttons');

function cubetech_partner_dialog() { 

	$args=array(
		'hide_empty' => false,
		'orderby' => 'name',
		'order' => 'ASC'
	);
	$taxonomies = get_terms('cubetech_partner_group', $args);
	
	?>
	<style type="text/css">
		#cubetech_partner_dialog { padding: 10px 30px 15px; }
	</style>
	<div style="display:none;" id="cubetech_partner_dialog">
		<div>
			<p><input type="submit" class="button-primary" value="Partner einfügen" onClick="tinyMCE.activeEditor.execCommand('mceInsertContent', 0, '[cubetech-partner]'); tinyMCEPopup.close();" /></p>
		</div>
	</div>
	<?php
}

?>
