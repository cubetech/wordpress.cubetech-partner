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

			'description' => _x('Partner', 'Description', 'wptheme-foundation'),
			'supports' => array('title', 'editor', 'thumbnail', 'revisions'),
			'hierarchical'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 21,
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'rewrite'			  => array( 'slug' => 'partner', 'with_front' => false ),
			'menu_icon'			  => null,
		)
	);
}
add_action('init', 'cubetech_partner_create_post_type');
?>
