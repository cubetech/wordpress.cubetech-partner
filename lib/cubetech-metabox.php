<?php

// Add the Meta Box
function add_cubetech_partner_meta_box() {
	add_meta_box(
		'cubetech_partner_meta_box', // $id
		'Details des Partners', // $title 
		'show_cubetech_partner_meta_box', // $callback
		'cubetech_partner', // $page
		'normal', // $context
		'high'); // $priority
}
add_action('add_meta_boxes', 'add_cubetech_partner_meta_box');

// Field Array
$prefix = 'cubetech_partner_';

$cubetech_partner_meta_fields = array(
	array(
		'label'=> 'Link',
		'desc'	=> 'Link des Partners (mit http://)',
		'id'	=> $prefix.'url',
		'type'	=> 'text'
	),
);

// The Callback
function show_cubetech_partner_meta_box() {
global $cubetech_partner_meta_fields, $post;
// Use nonce for verification
echo '<input type="hidden" name="cubetech_partner_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
	
	// Begin the field table and loop
	echo '<table class="form-table">';
	foreach ($cubetech_partner_meta_fields as $field) {
		// get value of this field if it exists for this post
		$meta = get_post_meta($post->ID, $field['id'], true);
		// begin a table row with
		echo '<tr>
				<th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
				<td>';
				switch($field['type']) {
					// text
					case 'text':
						echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
							<br /><span class="description">'.$field['desc'].'</span>';
					break;
					// textarea
					case 'textarea':
						echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
							<br /><span class="description">'.$field['desc'].'</span>';
					break;
					// select
					case 'select':
						echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
						foreach ($field['options'] as $option) {

							if($meta == $option['value'] && $option['value'] != '') {
								$selected = ' selected="selected"';
							} elseif ($option['value'] == 'nope') {
								$selected = ' selected="selected"';
							} else {
								$selected = '';
							}
							echo '<option' . $selected . ' value="'.$option['value'].'">'.$option['label'].'</option>';
						}
						echo '</select><br /><span class="description">'.$field['desc'].'</span>';
					break;
				} //end switch
		echo '</td></tr>';
	} // end foreach
	echo '</table>'; // end table
}

// Save the Data
function save_cubetech_partner_meta($post_id) {
    global $cubetech_partner_meta_fields;
	
	// verify nonce
	if (empty($_POST['cubetech_partner_meta_box_nonce']) || !wp_verify_nonce($_POST['cubetech_partner_meta_box_nonce'], basename(__FILE__))) 
		return $post_id;
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return $post_id;
	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id))
			return $post_id;
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
	}
	
	// loop through fields and save the data
	foreach ($cubetech_partner_meta_fields as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
	} // end foreach
}
add_action('save_post', 'save_cubetech_partner_meta');  