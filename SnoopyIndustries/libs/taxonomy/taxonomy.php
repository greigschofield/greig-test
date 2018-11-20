<?php

class FW_Customize_Taxonomy
{
	
	function __construct()
	{
		/** Custom field for video categories */
		add_action('category_edit_form_fields', array($this, 'category_edit_form'));
		add_action('category_add_form_fields', array($this, 'category_edit_form'));
		
		/** Custom field for video categories data saving */
		add_action('created_term', array($this, 'save_term_data'));
        add_action('edit_term', array($this, 'save_term_data'));
		
		add_action('admin_enqueue_scripts', array($this, 'admin_print_scripts'));
	}
	
	
	function category_edit_form($term)
	{
		global $current_user;
		$term = (object) $term;
		$term->term_id = isset($term->term_id) ? $term->term_id : '';
		include('taxonomy_meta.php');
	}
	
	function save_term_data($term_id)
	{
		$current = wp_get_current_user();

		$key = '_wpnukes_'.kvalue($_POST, 'taxonomy').'_'.$term_id;

		if( kvalue($_POST, 'taxonomy') != 'category' ) return;
		
		update_option($key.'_image', kvalue( $_POST, 'ad_image'));		
	}
	
 
	function admin_print_scripts() {
		global $pagenow, $taxonomy;

		if ( $pagenow == 'edit-tags.php' && $taxonomy == 'category' ) {
			wp_enqueue_media();
			wp_enqueue_script('wp-media-uploader', FW_URI.'libs/taxonomy/attachment.js', array('jquery'));
		}
	}
}


new FW_Customize_Taxonomy;