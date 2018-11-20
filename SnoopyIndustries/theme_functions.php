<?php
include_once('includes/shortcodes.php');
include_once('includes/shortcoder.php');

// Shorcodes Editor

if(isset($_GET['fw_editor_action']) && $_GET['fw_editor_action'] == 'shortcode')
{
	include_once('includes/sc-editor.php');exit;
}
$FW_Shortcodes->add_shortcode();


//get_template_part( 'libs/post_types' );
//get_template_part( 'libs/taxonomy/taxonomy' );
//get_template_part( 'libs/ajax_handler' );
//get_template_part( 'libs/metaboxes/metaboxes' );
//get_template_part( 'libs/opauth-twitter/TwitterStrategy' );

function fw_get_meta_title()
{
	global $wp_query;
	$seo_settings = get_option(THEME_PREFIX.'seo_meta_settings');
	$title = '';
	$meta_after = '';
	$home_title = kvalue($seo_settings, 'meta_title') ? kvalue($seo_settings, 'meta_title') : get_bloginfo( 'name' );
	$slogan = kvalue($seo_settings, 'site_slogan') ? kvalue($seo_settings, 'site_slogan') : get_bloginfo( 'description' );
	$sep = kvalue($seo_settings, 'separator') ? kvalue($seo_settings, 'separator') : ' - ';

	$meta_before = (kvalue($seo_settings, 'meta_before_sep') == 'site_title') ? $home_title : wp_title( '', false );
	if( kvalue($seo_settings, 'meta_after_sep') == 'site_title' ) $meta_after = $home_title;
	elseif( kvalue($seo_settings, 'meta_after_sep') == 'slogan' ) $meta_after = get_bloginfo( 'description' );
	elseif( kvalue($seo_settings, 'meta_after_sep') == 'page_title' ) $meta_after = wp_title( '', false );

	if(is_home() || is_front_page()){
		
		$title = $home_title . $sep . $slogan;
	}else{
		$title = $meta_before . $sep . $meta_after;
	}

	echo $title;
}
