<?php
function cubetech_partner_create_post_type() {
	register_post_type('cubetech_partner',
		array(
			'labels' => array(
				'name' => __('Partner'),
				'singular_name' => __('Partner'),
				'add_new' => __('Partner hinzufügen'),
				'add_new_item' => __('Neuer Partner hinzufügen'),
				'edit_item' => __('Partner bearbeiten'),
				'new_item' => __('Neuer Partner'),
				'view_item' => __('Partner betrachten'),
				'search_items' => __('Partner durchsuchen'),
				'not_found' => __('Keine Partner gefunden.'),
				'not_found_in_trash' => __('Keine Partner gefunden.')
			),
			'capability_type' => 'post',
			'taxonomies' => false,
			'public' => true,
			'has_archive' => false,
			'rewrite' => array('slug' => 'partner', 'with_front' => false),
			'show_ui' => true,
			'menu_position' => '20',
			'menu_icon' => null,
			'hierarchical' => true,
			'supports' => array('title', 'editor', 'thumbnail')
		)
	);
	flush_rewrite_rules();
}
add_action('init', 'cubetech_partner_create_post_type');
?>
