<?php if ( ! defined('ABSPATH')) exit('restricted access');

if( ! is_admin())
{
	/** Include styles and scripts */
	add_action('wp_enqueue_scripts', 'fw_enqueue_scripts');
	
	/** add action to wp_print_styles for print our styles */
	add_action('wp_head', 'fw_theme_head', 30);
	
	/** add action wp_footer */
	add_action('wp_footer', 'fw_theme_footer');
}
if( is_admin() )
{
	add_action('admin_enqueue_scripts', 'fw_admin_enqueue_scripts');
}

function fw_enqueue_scripts()
{
	global $pagenow;
	
	/** make array of stylesheets */
	$styles = array (
		
		'base-css' => 'css/base.css',
		'skeleton-css' => 'css/skeleton.css',
		'layout-css' => 'css/layout.css',
		'fancybox' => 'css/fancybox/jquery.fancybox.css',
		'fancybox-buttons' => 'css/fancybox/helpers/jquery.fancybox-buttons.css',
		'fancybox-thumbs' => 'css/fancybox/helpers/jquery.fancybox-thumbs.css',
		'main-styles' => 'style.css',
	);
	
	foreach($styles as $css=>$file)
	{
		/** register our stylesheets from array */
		wp_register_style($css, THEME_URL.'/'.$file, false, '1.0', 'screen' );
		
		/** enqueue our stylesheets */
		wp_enqueue_style($css);
	}
	
	
	/** make an array of scripts */
	$scripts = array (
		'jquery-mousewheel' => '/js/jquery.mousewheel-3.0.6.pack.js',
		'jquery-fancybox' => '/js/jquery.fancybox.js',
		'jquery-fancybox-buttons' => '/js/jquery.fancybox-buttons.js',
		'jquery-fancybox-thumbs' => '/js/jquery.fancybox-thumbs.js',
		'jquery-fancybox-media' => '/js/jquery.fancybox-media.js',
		'theme-script' => '/js/ticketrama.js',
		'custom-script' => '/js/custom.js'
	);

	if(is_front_page() || is_page())
	{
		
	}
	
	if(is_singular('wpnukes_galleries') || is_tax('wpnukes_gallery'))
	{
		
	}
	
	wp_enqueue_script(array('jquery', 'jquery-effects-core', 'jquery-ui-tabs', 'jquery-ui-draggable','jquery-ui-accordion'), array(), '', true);
	
	/** register and enqueue scripts */
	foreach($scripts as $js => $file)
	{
		wp_register_script($js, THEME_URL .$file, array(), '', true);
		wp_enqueue_script($js);
	}
	
	if(is_single() || is_singular()) wp_enqueue_script('comment-reply'); 


	

}

function fw_admin_enqueue_scripts()
{
	global $pagenow;
	if ( $pagenow == 'user-edit.php' || $pagenow == 'profile.php' ) {
		wp_enqueue_media();
		//wp_enqueue_script('wp-media-uploader', get_template_directory_uri().'/libs/taxonomy/attachment.js', array('jquery'));
	}
}

function fw_theme_head()
{
	$options = get_option( THEME_PREFIX.'seo_meta_settings' );
	
	if( $keywords = kvalue( $options, 'meta_keywords' ) ) echo '<meta name="keywords" content="'.$keywords.'">';
	if( $desc = kvalue( $options, 'meta_description' ) ) echo '<meta name="description" content="'.$desc.'" >';
}

function fw_theme_footer()
{
	get_template_part('libs/fb');
}