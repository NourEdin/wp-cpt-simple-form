<?php
/*
 *	Plugin Name: Simple Custom Post Type Edit Form
 *  Plugin URI:  https://github.com/NourEdin/wp-cpt-simple-form
 *  Description: A simple plugin that shows a custom form in the edit page of a custom post type
 *  Version: 	 1.0
 *  Author: 	 Nour Edin Al-Habal
 *  Author URI:  https://github.com/NourEdin
 */
 
function nscfp_simple_custom_metabox_html( $post ) {
	$url = get_post_meta($post->ID, 'nscfp_custom_external_url', true);
	
	?>
	<label for="nscfp-external-url">External Url</label>
	<input type="text" name="nscfp-external-url" id="nscfp-external-url" value="<?=$url?>"/>	
	<?php
} 

function nscfp_simple_custom_metabox( $type ) {
	if ($type == 'product') {
		add_meta_box(
			'nscfp_simple_custom_metabox_id',
			'Simple Custom Metabox',
			'nscfp_simple_custom_metabox_html'
		);
	}
}
add_action('add_meta_boxes', 'nscfp_simple_custom_metabox');

function nscfp_save_post( $post_id, $post ) {
	if ($post->post_type == 'product') {
		if ( array_key_exists( 'nscfp-external-url', $_POST ) ) {
			update_post_meta(
				$post_id,
				'nscfp_custom_external_url',
				$_POST['nscfp-external-url']
			);
		}
	}
    
}
add_action( 'save_post', 'nscfp_save_post' , 10, 2);

