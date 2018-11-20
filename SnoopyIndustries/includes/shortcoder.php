<?php

class FW_Shortcoder
{
	
	function __construct()
	{
		
		
		if(is_admin()){
			// init process for button control
			add_action('init', array($this, 'add_buttons'));

			add_action('admin_print_styles', array($this, 'admin_css'));
			add_action('admin_print_scripts', array($this, 'admin_js'));
			add_action('admin_footer', array($this, 'admin_footer'));
		}
		
		
	}
	
	// Shortcoder tinyMCE buttons
	function add_buttons() {
	   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
		 return;
	 
	   if ( get_user_option('rich_editing') == 'true') {
		 add_filter("mce_external_plugins", array($this, "add_tinymce_plugin"));
		 add_filter('mce_buttons', array($this, 'register_button'));
	   }
	}
	 
	function register_button($buttons) {
	   array_push($buttons, "|", "scbutton");
	   return $buttons;
	}
	
	function add_tinymce_plugin($plugin_array) {
	   $plugin_array['fwbutton'] = FW_URI . '/includes/js/editor_plugin.js';
	   return $plugin_array;
	}
	
	// Load the CSS
	function admin_css(){
		if (isset($_GET['page']) && $_GET['page'] == 'shortcoder') {
			wp_enqueue_style('shortcoder-admin-css', FW_URI . '/includes/css/admin-css.css');
		}
	}
	
	// Load the Javascripts
	function admin_js(){
		//wp_enqueue_script('fw_shorcodes_editor', get_bloginfo('template_url') . '/modules/js/editor_plugin.js');
	}
	
	function admin_footer(){
		if(in_array($GLOBALS['pagenow'], array('post.php', 'post-new.php'))){
			echo '<span id="sc_editorUrl" style="display:none;">' . home_url() . '?fw_editor_action=shortcode</span>';
		}
	}

}


new FW_Shortcoder;