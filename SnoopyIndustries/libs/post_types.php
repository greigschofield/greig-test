<?php 
// Register Custom Post Type

$general_settings = get_option(THEME_PREFIX.'general_settings');

function fw_theme_custom_post_types() {

	$labels = array(
		'name'                => _x( 'Topics', 'Post Type General Name', AM_THEMES ),
		'singular_name'       => _x( 'Topic', 'Post Type Singular Name', AM_THEMES ),
		'menu_name'           => __( 'Topics', AM_THEMES ),
		'parent_item_colon'   => __( 'Parent Topic:', AM_THEMES ),
		'all_items'           => __( 'All Topics', AM_THEMES ),
		'view_item'           => __( 'View Topic', AM_THEMES ),
		'add_new_item'        => __( 'Add New Topic', AM_THEMES ),
		'add_new'             => __( 'New Topic', AM_THEMES ),
		'edit_item'           => __( 'Edit Topic', AM_THEMES ),
		'update_item'         => __( 'Update Topic', AM_THEMES ),
		'search_items'        => __( 'Search Topics', AM_THEMES ),
		'not_found'           => __( 'No Topics found', AM_THEMES ),
		'not_found_in_trash'  => __( 'No Topics found in Trash', AM_THEMES ),
	);
	$rewrite = array(
		'slug'                => 'topic',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'topic', AM_THEMES ),
		'description'         => __( 'Topic is used to manage topics', AM_THEMES ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'comments', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => '//labs.am-themes.com/Ticketrama_HTML/images/am-icon.png',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'topic', $args );
	
	$labels = array(
		'name'                => _x( 'Tickets', 'Post Type General Name', AM_THEMES ),
		'singular_name'       => _x( 'Ticket', 'Post Type Singular Name', AM_THEMES ),
		'menu_name'           => __( 'Tickets', AM_THEMES ),
		'parent_item_colon'   => __( 'Parent Ticket:', AM_THEMES ),
		'all_items'           => __( 'All Tickets', AM_THEMES ),
		'view_item'           => __( 'View Ticket', AM_THEMES ),
		'add_new_item'        => __( 'Add New Ticket', AM_THEMES ),
		'add_new'             => __( 'New Ticket', AM_THEMES ),
		'edit_item'           => __( 'Edit Ticket', AM_THEMES ),
		'update_item'         => __( 'Update Ticket', AM_THEMES ),
		'search_items'        => __( 'Search Tickets', AM_THEMES ),
		'not_found'           => __( 'No Tickets found', AM_THEMES ),
		'not_found_in_trash'  => __( 'No Tickets found in Trash', AM_THEMES ),
	);
	$rewrite = array(
		'slug'                => 'ticket',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'ticket', AM_THEMES ),
		'description'         => __( 'Ticket is used to manage Tickets', AM_THEMES ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'comments', ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => '//labs.am-themes.com/Ticketrama_HTML/images/am-icon.png',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	
	register_post_type( 'ticket', $args );

}

// Hook into the 'init' action
add_action( 'init', 'fw_theme_custom_post_types', 0 );