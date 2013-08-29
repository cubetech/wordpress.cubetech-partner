<?php
function cubetech_partner_shortcode($atts)
{
	extract(shortcode_atts(array(
		'orderby' 		=> 'menu_order',
		'order'			=> 'asc',
		'numberposts'	=> 999,
		'offset'		=> 0,
		'poststatus'	=> 'publish',
	), $atts));
	
	$return .= '<div class="cubetech-partner-container">';

	$args = array(
		'posts_per_page'  	=> 999,
		'numberposts'     	=> $numberposts,
		'offset'          	=> $offset,
		'orderby'         	=> $orderby,
		'order'           	=> $order,
		'post_type'       	=> 'cubetech_partner',
		'post_status'     	=> $poststatus,
		'suppress_filters' 	=> true,
	);
		
	$posts = get_posts($args);
	
	$return .= cubetech_partner_content($posts);
		
	return $return;

}

add_shortcode('cubetech-partner', 'cubetech_partner_shortcode');

function cubetech_partner_content($posts) {

	$contentreturn = '';
	
	$i = 0;
	
	foreach ($posts as $post) {

		$post_meta_data = get_post_custom($post->ID);
		$terms = wp_get_post_terms($post->ID, 'cubetech_partner_group');
		$url = $post_meta_data['cubetech_partner_url'][0];
		
		$image = get_the_post_thumbnail( $post->ID, 'cubetech-partner-thumb', array('class' => 'cubetech-partner-thumb') );
		
		$contentreturn .= '
		<div class="cubetech-partner">
			<div class="cubetech-partner-image">
				' . $image . '
			</div>
			<div class="cubetech-partner-content">
				<h3>' . $post->post_title . '</h3>
				' . $post->post_content . '
			</div>
			<div class="cubetech-partner-link">
				<a class="cubetech-partner-button" target="_blank" href="' . $url . '">Website</a>
			</div>
		</div>';
		
		$i++;

	}
	
	return $contentreturn;
	
}
?>
