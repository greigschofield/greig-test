<?php if ( ! defined('ABSPATH')) exit('restricted access');

/** Theme settings note: don't remove it */
define('AM_THEMES', 'cinergy');
define('FRAME_WORK', 'Version 1.1');
define('THEME_URL', get_template_directory_uri());
define('THEME_PREFIX', 'fw_cinergy_'); //UNIQUE IDENTY MUST CONTAIN _ AT THE END
define ('FW_DIR', get_template_directory() . '/SnoopyIndustries/');
define ('FW_URI', get_template_directory_uri() . '/SnoopyIndustries/');

/** Initialize the FW panel */
require_once(FW_DIR . 'includes/options.php');
require_once(FW_DIR . 'theme_functions.php');
require_once(FW_DIR . "meta-box-class/my-meta-box-class.php");

//require_once('includes/launcher.php');

/** Load the default functions after theme setup */
add_action('after_setup_theme', 'fw_theme_setup');
add_action('admin_init', 'fw_theme_setup');
function fw_theme_setup(){
	global $column_options, $tr_options, $options, $_validation, $_dynamics, $_dynamic_headings, $wp_registered_sidebars;;
	
	include_once(FW_DIR . 'includes/options.php');

	require_once(FW_DIR . 'theme_functions.php');
	
	/** Add languages support */
	load_theme_textdomain('cinergy', get_template_directory()  .'/languages');
	
		
}

/***********************************************************************************************/
/*  Register Plugins */
/***********************************************************************************************/
if ( is_admin() && current_user_can( 'install_themes' ) ) {
    require_once( get_template_directory() . '/plugins/tgm-plugin-activation/register-plugins.php' );
}

/***********************************************************************************************/
/* Load JS and CSS Files */
/***********************************************************************************************/
function am_load_scripts() {

    if ( is_singular() )
      wp_enqueue_script( "comment-reply" );
    wp_enqueue_script('doubletaptogo', THEME_URL . '/js/doubletaptogo.min.js', array('jquery'), false, true);
    wp_enqueue_script('bootstrap.min', THEME_URL . '/js/bootstrap.min.js', array('jquery'), false, true);
    //wp_enqueue_script('html5', THEME_URL . '/js/html5.js', array('jquery'), false, true);
    wp_enqueue_script('jqcount', THEME_URL . '/js/jqcount.js', array('jquery'), false, true);
    wp_enqueue_script('jquery-easing-1.3', THEME_URL . '/js/jquery-easing-1.3.js', array('jquery'), false, true);
    wp_enqueue_script('jquery-migrate-1.2.1', THEME_URL . '/js/jquery-migrate-1.2.1.js', array('jquery'), false, true);
    wp_enqueue_script('jquery-transit-modified', THEME_URL . '/js/jquery-transit-modified.js', array('jquery'), false, true);
    wp_enqueue_script('jquery.appear', THEME_URL . '/js/jquery.appear.js', array('jquery'), false, true);
    wp_enqueue_script('jquery.easing-1.3.pack', THEME_URL . '/js/jquery.easing-1.3.pack.js', array('jquery'), false, true);
    wp_enqueue_script('jquery.fancybox-1.3.4.pack.min', THEME_URL . '/js/jquery.fancybox-1.3.4.pack.min.js', array('jquery'), false, true);
    wp_enqueue_script('jquery.glide.min', THEME_URL . '/js/jquery.glide.min.js', array('jquery'), false, true);
    wp_enqueue_script('jquery.isotope.min', THEME_URL . '/js/jquery.isotope.min.js', array('jquery'), false, true);
    wp_enqueue_script('jquery', THEME_URL . '/js/jquery.js', array('jquery'), false, true);
    //wp_enqueue_script('jquery.themepunch.plugins.min', THEME_URL . '/js/jquery.themepunch.plugins.min.js', array('jquery'), false, true);
    wp_enqueue_script('owl.carousel.min', THEME_URL . '/js/owl.carousel.min.js', array('jquery'), false, true);
    wp_enqueue_script('sharethis', 'https://w.sharethis.com/button/buttons.js', '', false, true);

    wp_enqueue_script('main-js', THEME_URL . '/js/custom.js', array('jquery'), false, true);
    

    
    wp_enqueue_style( 'boots-css', THEME_URL . "/css/bootstrap.css");
    wp_enqueue_style( 'boots-responsive-css', THEME_URL . "/css/bootstrap-responsive.css");
    wp_enqueue_style( 'font-awesome.min-css', THEME_URL . "/css/fonts/font-awesome.min.css");
    wp_enqueue_style( 'glide-slider-css', THEME_URL . "/css/glide-slider.css");
    wp_enqueue_style( 'isotope-css', THEME_URL . "/css/isotope.css");
    wp_enqueue_style( 'jquery.fancybox-1.3.4-css', THEME_URL . "/css/jquery.fancybox-1.3.4.css");
    wp_enqueue_style( 'owl.carousel-css', THEME_URL . "/css/owl.carousel.css");
    wp_enqueue_style( 'main-css', THEME_URL . "/style.css");
	wp_enqueue_style('googlefont', "https://fonts.googleapis.com/css?family=Ubuntu:400,300,500,700");
    
}

add_action('wp_enqueue_scripts', 'am_load_scripts');

function am_admin_load_scripts($hook) {
  if( $hook != 'widgets.php' ) 
    return;
  wp_enqueue_script('admin-js', THEME_URL . '/js/admin.js', array('jquery'), false, true);
}
add_action( 'admin_enqueue_scripts', 'am_admin_load_scripts' );

/***********************************************************************************************/
/* Add Menus */
/***********************************************************************************************/

function am_register_menus(){
    register_nav_menus(
        array(
            'main_menu'    => _x('Main menu', 'dashboard','cinergy'),
            'footer_menu'    => _x('Footer menu', 'dashboard','cinergy'),
        )
    );
}
add_action('init', 'am_register_menus');

/***********************************************************************************************/
/* Add Google Analytics */
/***********************************************************************************************/
add_action('wp_head', 'google_analytics_code_adder');
function google_analytics_code_adder() { ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-106147599-1', 'auto');
  ga('send', 'pageview');

</script>
<?php }

/*============================================= MetaBoxes ===========================================================*/

if (is_admin()){
  /* 
   * prefix of meta keys, optional
   * use underscore (_) at the beginning to make keys hidden, for example $prefix = '_ba_';
   *  you also can make prefix empty to disable it
   * 
   */
  $prefix = 'cinergy_';
  /* 
   * configure your meta box
   */
  $config = array(
    'id'             => 'layout',          // meta box id, unique per meta box
    'title'          => 'Layout',          // meta box title
    'pages'          => array('post', 'page' , 'case_study'),      // post types, accept custom post types as well, default is array('post'); optional
    'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'       => 'high',            // order of meta box: high (default), low; optional
    'fields'         => array(),            // list of meta fields (can be added by field arrays)
    'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  
  /*
   * Initiate your meta box
   */
  $layout_meta =  new AT_Meta_Box($config);
  //select field
  $layout_meta->addSelect($prefix.'layout',array('sidebar'=>'With Sidebar','full'=>'Full Width'),array('name'=> 'Choose the layout  ', 'std'=> array('sidebar')));
  //Image field
/*  $layout_meta->addImage($prefix.'menu_icon_custom',array('name'=> 'Or upload a custom image : '));
  //Download vcard link
  $layout_meta->addText($prefix.'download_vcard_link',array('name'=> 'Download vCard Link '));*/
  $layout_meta->Finish();
}
/*============================================= MetaBoxes END ===========================================================*/


/*---------------------------------------------Header logics--------------------------------------------------------------*/
add_action('wp_head','am_page_header');
function am_page_header(){

	//passing vars to JS
	echo "<script type='text/javascript'>var TemplateDir='".get_template_directory_uri()."'</script>";
	//Getting options
  $general_settings = get_option( THEME_PREFIX.'general_settings');
	$typography_settings = get_option( THEME_PREFIX.'typography_settings');
  $seo_settings = get_option( THEME_PREFIX.'seo_meta_settings');
	$custom_settings = get_option( THEME_PREFIX.'custom_settings');
  $protocol = is_ssl() ? 'https' : 'http';

  //meta
  if( $keywords = kvalue( $seo_settings, 'meta_keywords' ) ) echo '<meta name="keywords" content="'.$keywords.'">';
  if( $desc = kvalue( $seo_settings, 'meta_description' ) ) echo '<meta name="description" content="'.$desc.'" >';

	$custom_style = '';
	//favicon
	if(kvalue($general_settings, 'favicon'))
		echo '<link id="page_favicon" href="'.kvalue($general_settings, 'favicon').'" rel="icon" type="image/x-icon" />'."\n";
	//stylesheet
    if(kvalue($custom_settings, 'custom_css'))
    $custom_style .= kvalue($custom_settings, 'custom_css');
	//colors and fonts
  //home content font
  if(kvalue($general_settings, 'general_font')){
    $custom_style .= 'body{font-family:'.kvalue($general_settings, 'general_font').' !important;}'."\n";
    wp_enqueue_style( 'am-custom-font' . rand(), "$protocol://fonts.googleapis.com/css?family=" . str_replace(' ', '+', kvalue($general_settings, 'general_font')));
  }
	
  //background
  if(!empty($general_settings['background_image']))
    $custom_style .= 'body{background-image:url(\''.$general_settings['background_image']."') !important \n";
  elseif(!empty($general_settings['background_color']) && !empty($general_settings['background_color_switch']) && $general_settings['background_color_switch'] == 'on')
    $custom_style .= 'body{background:#'.$general_settings['background_color']." !important \n";
	/*if(kvalue($typography_settings, 'font'))
		$custom_style .= 'body{font-family:'.kvalue($typography_settings, 'font').' !important;}'."\n";*/
	
  wp_enqueue_style( 'custom-font', "$protocol://fonts.googleapis.com/css?family=Lato:300,400,700,400italic");
		
	echo '<style>'.$custom_style.'</style>'."\n";
  
	if(kvalue($custom_settings, 'header_code'))
		echo kvalue($custom_settings, 'header_code');

}
/*---------------------------------------------Footer logics--------------------------------------------------------------*/
function am_page_footer(){
	$custom_settings = get_option( THEME_PREFIX.'custom_settings');
	if(kvalue($custom_settings, 'footer_code'))
		echo kvalue($custom_settings, 'footer_code');
	if(kvalue($custom_settings, 'google_analytics_code'))
		echo kvalue($custom_settings, 'google_analytics_code');
}

add_action('wp_footer', 'am_page_footer');

/***********************************************************************************************/
/* Add Sidebars */
/***********************************************************************************************/
function am_register_sidebars(){
    if (function_exists('register_sidebar')) {
        register_sidebar(
            array(
                'name'           => _x('Blog Sidebar','dashboard', 'cinergy'),
                'id'             => 'blog',
                'description'    => _x('Blog sidebar Area','dashboard', 'cinergy'),
                'before_widget'  => '<aside class="sidebar-widget main-sidebar-widget %2$s">',
                'after_widget'   => '</aside>',
                'before_title'   => '<h2 class="sidebar-widget-title hide">',
                'after_title'    => '</h2>'
            )
        );
        register_sidebar(
            array(
                'name'           => _x('Footer Sidebar','dashboard', 'cinergy'),
                'id'             => 'footer',
                'description'    => _x('Footer sidebar Area','dashboard', 'cinergy'),
                'before_widget'  => '<section class="span4 footer-widgets">',
                'after_widget'   => '</section>',
                'before_title'   => '<h1 class="footer-widget-heading">',
                'after_title'    => '</h1>'
            )
        );
        register_sidebar(
            array(
                'name'           => _x('Contact Sidebar','dashboard', 'cinergy'),
                'id'             => 'contact',
                'description'    => _x('Contact Page Template Sidebar Area','dashboard', 'cinergy'),
                'before_widget'  => '<aside class="sidebar-widget main-sidebar-widget contact-widget">',
                'after_widget'   => '</aside>',
                'before_title'   => '<h2 class="sidebar-widget-title">',
                'after_title'    => '</h2>'
            )
        );
    }
}
add_action('widgets_init','am_register_sidebars');

/***********************************************************************************************/
/* Include Widgets */
/***********************************************************************************************/
require_once 'widgets/footer-widget.php';
require_once 'widgets/dribble-widget.php';
require_once 'widgets/dribble-widget-sidebar.php';
require_once 'widgets/recent_tweets_widget.php';
require_once 'widgets/posts_comments_widget.php';

/***********************************************************************************************/
/* Add custom post type Portfolios */
/***********************************************************************************************/

add_action('init', 'portfolio_register');
 
function portfolio_register() {
 
    $labels = array(
        'name'                  => _x('Portfolio', 'dashboard', 'cinergy'),
        'singular_name'         => _x('Portfolio', 'dashboard', 'cinergy'),
        'add_new'               => _x('Add New', 'dashboard', 'cinergy'),
        'add_new_item'          => _x('Add New Portfolio Item', 'dashboard', 'cinergy'),
        'edit_item'             => _x('Edit Portfolio Item', 'dashboard', 'cinergy'),
        'new_item'              => _x('New Portfolio Item', 'dashboard', 'cinergy'),
        'view_item'             => _x('View Portfolio item', 'dashboard', 'cinergy'),
        'search_items'          => _x('Search Portfolio items', 'dashboard', 'cinergy'),
        'not_found'             => _x('Nothing found', 'dashboard', 'cinergy'),
        'not_found_in_trash'    => _x('Nothing found in Trash', 'dashboard', 'cinergy')
    );
 
    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'query_var'             => true,
        'menu_icon'             => THEME_URL . '/img/portfolio.png',
        'rewrite'               => true,
        'capability_type'       => 'post',
        'hierarchical'          => true,
        'supports'              => array('title', 'editor', 'thumbnail', 'comments','excerpt'),
        'show_in_nav_menus'     => true,
        'show_in_menu'          => true,
        'has_archive'           => true,
        'show_in_admin_bar'     => true,
        'menu_position'         => 5
      ); 
 
    register_post_type( 'portfolio' , $args );
    
    }

    register_taxonomy("portfolio", 
      array("portfolio", "testimonial", "post", "page"), array(
        "hierarchical" => true,
        "label" => "Portfolio Categories", 
        "singular_label" => "Portfolio Category", 
        "rewrite" => true)
    );
	
add_action('init', 'testimonial_register');
 
function testimonial_register() {
 
    $labels = array(
        'name'                  => _x('Testimonial', 'dashboard', 'cinergy'),
        'singular_name'         => _x('Testimonial', 'dashboard', 'cinergy'),
        'add_new'               => _x('Add New', 'dashboard', 'cinergy'),
        'add_new_item'          => _x('Add New Testimonial Item', 'dashboard', 'cinergy'),
        'edit_item'             => _x('Edit Testimonial Item', 'dashboard', 'cinergy'),
        'new_item'              => _x('New Testimonial Item', 'dashboard', 'cinergy'),
        'view_item'             => _x('View Testimonial item', 'dashboard', 'cinergy'),
        'search_items'          => _x('Search Testimonial items', 'dashboard', 'cinergy'),
        'not_found'             => _x('Nothing found', 'dashboard', 'cinergy'),
        'not_found_in_trash'    => _x('Nothing found in Trash', 'dashboard', 'cinergy')
    );
 
    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'query_var'             => true,
        'menu_icon'             => THEME_URL . '/img/portfolio.png',
        'rewrite'               => true,
        'capability_type'       => 'post',
        'hierarchical'          => true,
        'supports'              => array('title', 'editor', 'thumbnail', 'comments','excerpt'),
        'show_in_nav_menus'     => true,
        'show_in_menu'          => true,
        'has_archive'           => true,
        'show_in_admin_bar'     => true,
        'menu_position'         => 5
      ); 
 
    register_post_type( 'testimonial' , $args );
    
    }



/*============================================= MetaBoxes - portfolio ===========================================================*/

if (is_admin()){
  
  $prefix = 'cinergy_';
  
  $config3 = array(
    'id'             => 'columns',          // meta box id, unique per meta box
    'title'          => 'Additional Settings',          // meta box title
    'pages'          => array('page'),      // post types, accept custom post types as well, default is array('post'); optional
    'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'       => 'low',            // order of meta box: high (default), low; optional
    'fields'         => array(),            // list of meta fields (can be added by field arrays)
    'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  $column_meta =  new AT_Meta_Box($config3);
  $column_meta->addSelect($prefix.'columns',array('2'=>'2 Columns','3'=>'3 Columns','4'=>'4 Columns'),array('name'=> 'Choose how many columns should be displayed ( used in portfolio and team page templates ) ', 'std'=> array('2')));
  $column_meta->addCheckbox($prefix.'masonry',array('name'=> 'Use filters and masonry ( used in portfolio page template )'));
  $column_meta->addText($prefix.'category',array('name'=> 'Category slug of posts to be displayed ( used in portfolio page template ). Defaults to all.'));
  $column_meta->Finish();


  $config2 = array(
    'id'             => 'porto_item',          // meta box id, unique per meta box
    'title'          => 'Portfolio Item Settings',          // meta box title
    'pages'          => array('portfolio'),      // post types, accept custom post types as well, default is array('post'); optional
    'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'       => 'low',            // order of meta box: high (default), low; optional
    'fields'         => array(),            // list of meta fields (can be added by field arrays)
    'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  $porto_item_meta =  new AT_Meta_Box($config2);
  
  $porto_item_meta->addText($prefix.'project_link',array('name'=> 'Project Link'));
  $porto_item_meta->addText($prefix.'project_awards',array('name'=> 'Project Awards'));

  $repeater_fields[] = $porto_item_meta->addImage($prefix.'slide_image',array('name'=> 'Image '),true);
  $repeater_fields[] = $porto_item_meta->addTextarea($prefix.'slide_caption',array('name'=> 'Description / Caption '),true);
  $porto_item_meta->addRepeaterBlock($prefix.'project_slider_',array(
    'inline'   => true, 
    'name'     => 'Portfolio item images',
    'fields'   => $repeater_fields, 
    'sortable' => true
  ));


  //Image field
/*  $porto_item_meta->addImage($prefix.'menu_icon_custom',array('name'=> 'Or upload a custom image : '));
  //Download vcard link
  $porto_item_meta->addText($prefix.'download_vcard_link',array('name'=> 'Download vCard Link '));*/
  $porto_item_meta->Finish();
}
/*============================================= MetaBoxes-portfolio END ===========================================================*/
add_image_size( '2cols_porto_thumb', 570, 200 , true);
add_image_size( '3cols_porto_thumb', 370, 200 , true);
add_image_size( '4cols_porto_thumb', 270, 200 , true);

/***********************************************************************************************/
/* Add custom post type Team */
/***********************************************************************************************/

add_action('init', 'team_register');
function team_register() {
  $labels = array(
      'name'                  => _x('Team', 'dashboard', 'cinergy'),
      'singular_name'         => _x('Team Member', 'dashboard', 'cinergy'),
      'add_new'               => _x('Add New', 'dashboard', 'cinergy'),
      'add_new_item'          => _x('Add New Team Member', 'dashboard', 'cinergy'),
      'edit_item'             => _x('Edit Team Member', 'dashboard', 'cinergy'),
      'new_item'              => _x('New Team Member', 'dashboard', 'cinergy'),
      'view_item'             => _x('View Team Member', 'dashboard', 'cinergy'),
      'search_items'          => _x('Search Team Members', 'dashboard', 'cinergy'),
      'not_found'             => _x('No team members found', 'dashboard', 'cinergy'),
      'not_found_in_trash'    => _x('No team members found in Trash', 'dashboard', 'cinergy')
  );
  $args = array(
      'labels'                => $labels,
      'public'                => false,
      'publicly_queryable'    => false,
      'show_ui'               => true,
      'query_var'             => true,
      'menu_icon'             => THEME_URL . '/img/team.png',
      'rewrite'               => true,
      'capability_type'       => 'post',
      'hierarchical'          => false,
      'supports'              => array('title', 'editor', 'thumbnail','excerpt'),
      'show_in_nav_menus'     => false,
      'show_in_menu'          => true,
      'has_archive'           => false,
      'show_in_admin_bar'     => false,
      'menu_position'         => 5
    ); 
  register_post_type( 'team' , $args );
}

/*============================================= MetaBoxes - Team ===========================================================*/

if (is_admin()){
  
  $prefix = 'cinergy_';
  
  $config4 = array(
    'id'             => 'team',          // meta box id, unique per meta box
    'title'          => 'Team Member Setting',          // meta box title
    'pages'          => array('team'),      // post types, accept custom post types as well, default is array('post'); optional
    'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'       => 'high',            // order of meta box: high (default), low; optional
    'fields'         => array(),            // list of meta fields (can be added by field arrays)
    'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  $team_meta =  new AT_Meta_Box($config4);
  $team_meta->addText($prefix.'position',array('name'=> 'Position / Job'));
  $team_meta->addText($prefix.'facebook',array('name'=> 'Facebook Link'));
  $team_meta->addText($prefix.'linkedin',array('name'=> 'Linkedin Link'));
  $team_meta->addText($prefix.'gplus',array('name'=> 'Gplus Link ( only with shortcode )'));
  $team_meta->addText($prefix.'twitter',array('name'=> 'Twitter Link'));
  $team_meta->addText($prefix.'email',array('name'=> 'Email Link'));
  $team_meta->addText($prefix.'flickr',array('name'=> 'Flickr Link'));
  $team_meta->addText($prefix.'skype',array('name'=> 'Skype Link'));
  $team_meta->addText($prefix.'dribble',array('name'=> 'Dribbble Link'));
  $team_meta->addText($prefix.'instagram',array('name'=> 'Instagram Link'));
  $team_meta->Finish();

}
/*============================================= MetaBoxes-Team END ===========================================================*/
add_image_size( 'team_shortcode', 270, 280 , true);

/***********************************************************************************************/
/* Add custom post type Services */
/***********************************************************************************************/

add_action('init', 'services_register');
function services_register() {
  $labels = array(
      'name'                  => _x('Services', 'dashboard', 'cinergy'),
      'singular_name'         => _x('Service', 'dashboard', 'cinergy'),
      'add_new'               => _x('Add New', 'dashboard', 'cinergy'),
      'add_new_item'          => _x('Add New Service', 'dashboard', 'cinergy'),
      'edit_item'             => _x('Edit Service', 'dashboard', 'cinergy'),
      'new_item'              => _x('New Service', 'dashboard', 'cinergy'),
      'view_item'             => _x('View Service', 'dashboard', 'cinergy'),
      'search_items'          => _x('Search Services', 'dashboard', 'cinergy'),
      'not_found'             => _x('No services found', 'dashboard', 'cinergy'),
      'not_found_in_trash'    => _x('No services found in Trash', 'dashboard', 'cinergy')
  );
  $args = array(
      'labels'                => $labels,
      'public'                => false,
      'publicly_queryable'    => false,
      'show_ui'               => true,
      'query_var'             => true,
      'menu_icon'             => THEME_URL . '/img/services.png',
      'rewrite'               => true,
      'capability_type'       => 'post',
      'hierarchical'          => false,
      'supports'              => array('title', 'editor', 'thumbnail'),
      'show_in_nav_menus'     => false,
      'show_in_menu'          => true,
      'has_archive'           => false,
      'show_in_admin_bar'     => false,
      'menu_position'         => 5
    ); 
  register_post_type( 'services' , $args );
}

add_image_size( 'service', 128, 128 , true);




add_image_size( 'case_study', 370, 300 , true);

/***********************************************************************************************/
/* Add custom post type Facts */
/***********************************************************************************************/

add_action('init', 'facts_register');
function facts_register() {
 
    $labels = array(
        'name'                  => _x('Facts', 'dashboard', 'cinergy'),
        'singular_name'         => _x('Fact', 'dashboard', 'cinergy'),
        'add_new'               => _x('Add New', 'dashboard', 'cinergy'),
        'add_new_item'          => _x('Add New Fact', 'dashboard', 'cinergy'),
        'edit_item'             => _x('Edit Fact', 'dashboard', 'cinergy'),
        'new_item'              => _x('New Fact', 'dashboard', 'cinergy'),
        'view_item'             => _x('View Fact', 'dashboard', 'cinergy'),
        'search_items'          => _x('Search Facts', 'dashboard', 'cinergy'),
        'not_found'             => _x('No facts found', 'dashboard', 'cinergy'),
        'not_found_in_trash'    => _x('No facts found in Trash', 'dashboard', 'cinergy')
    );
 
    $args = array(
        'labels'                => $labels,
        'public'                => true,
        'publicly_queryable'    => true,
        'show_ui'               => true,
        'query_var'             => true,
        'menu_icon'             => THEME_URL . '/img/facts.png',
        'rewrite'               => true,
        'capability_type'       => 'post',
        'hierarchical'          => false,
        'supports'              => array('title', 'editor'),
        'show_in_nav_menus'     => false,
        'show_in_menu'          => true,
        'has_archive'           => false,
        'show_in_admin_bar'     => true,
        'menu_position'         => 5
      ); 
 
    register_post_type( 'facts' , $args );
}
if (is_admin()){
  
  $prefix = 'cinergy_';
  
  $config5 = array(
    'id'             => 'team',          // meta box id, unique per meta box
    'title'          => 'Fact Settings',          // meta box title
    'pages'          => array('facts'),      // post types, accept custom post types as well, default is array('post'); optional
    'context'        => 'normal',            // where the meta box appear: normal (default), advanced, side; optional
    'priority'       => 'high',            // order of meta box: high (default), low; optional
    'fields'         => array(),            // list of meta fields (can be added by field arrays)
    'local_images'   => false,          // Use local or hosted images (meta box images for add/remove)
    'use_with_theme' => true          //change path if used with theme set to true, false for a plugin or anything else for a custom path(default false).
  );
  
  $facts_meta =  new AT_Meta_Box($config5);
  $facts_meta->addText($prefix.'fact_count',array('name'=> 'Fact Count ( Number )'));
  $facts_meta->addText($prefix.'fact_count_suffix',array('name'=> 'Fact Count Suffix ( for example "+" )'));
  $facts_meta->addColor($prefix.'fact_color',array('name'=> 'Color of the fact\'s circle '));
  $facts_meta->Finish();
}

/* ========================================================================================================================

  Comments

  ======================================================================================================================== */

function custom_comments( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
    if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
?><!-- Comment start -->
    <<?php echo $tag ?> <?php comment_class($depth > 1 ? 'comment-item level-2' : 'comment-item') ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
      <?php if ($args['avatar_size'] != 0 && !($comment->comment_type == 'pingback' || $comment->comment_type == 'trackback'))
          echo '<span class="comment-author"><img class="alighleft" src="'.get_avatar_url( get_avatar($comment, $args['avatar_size']) ).'" alt="author avatar" /></span>';
      if ($comment->comment_approved == '0') : ?>
          <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.','cinergy') ?></em>
          <br />
      <?php endif; ?>
      <span class="comment-meta-info">
        <?php comment_author_link()?>
        <?php _ex('says','comments','cinergy') ?>
        <!-- <a href="#" class="author-name author-link">John Smith </a>says -->
        <?php edit_comment_link(__('(Edit)','cinergy'),'  ','' ); ?>
        <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        
      </span>
      <span class="comment-content">
           <?php comment_text() ?>
      </span>
      <span class="comment-date"><?php echo human_time_diff( get_comment_time('U'), current_time('timestamp') ) . _x(' ago','comment','cinergy'); ?></span>
      <?php if ( 'div' != $args['style'] ) : ?>
        </div><!-- /Comment end -->
      <?php endif;
}

function custom_comments_closed( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
    if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
    if($comment->comment_type == 'pingback' || $comment->comment_type == 'trackback'):
?><!-- Comment start -->

    <<?php echo $tag ?> <?php comment_class('comment-item') ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
      <?php if ($args['avatar_size'] != 0)
          echo '<span class="comment-author"><img src="'.get_avatar_url( get_avatar($comment, $args['avatar_size']) ).'" alt="author avatar" /></span>';

      if ($comment->comment_approved == '0') : ?>
          <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.','cinergy') ?></em>
          <br />
      <?php endif; ?>
        <p class="alighleft">
          <?php echo get_comment_time('F jS, Y \a\t H:i') ?> by <?php echo get_comment_author_link() ?>
        </p>
        <p class="alignright">
          <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </p>
        <?php edit_comment_link(__('(Edit)','cinergy'),'  ','' ); ?>
        <br/>
        <br/>
          <?php comment_text() ?>
        <div class="clearfix"></div>
        <?php if ( 'div' != $args['style'] ) : ?>
          </div><!-- /Comment end -->
        <?php endif;
    else : echo "<div>";
  endif;
}

if( !function_exists( 'get_avatar_url' )) {

	function get_avatar_url( $avatar ) {

		preg_match( '#src=["|\'](.+)["|\']#Uuis', $avatar, $matches );

		return ( isset( $matches[1] ) && ! empty( $matches[1]) ) ?
			(string) $matches[1] : '';  

	}
	
}

function new_excerpt_more( $more ) {
  return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

function get_blog_page_url(){
  if( get_option('show_on_front') == 'page') {
    $posts_page_id = get_option( 'page_for_posts');
    return get_permalink($posts_page_id);
  }
  else 
    return site_url();
}

function SearchFilter($query) {
if ($query->is_search) {
$query->set('post_type', 'post');
}
return $query;
}

add_filter('pre_get_posts','SearchFilter');


/** Set the width of images and content. Should be equal to the width the theme	*/
$content = (isset($content_width)) ? 
	$content_width : 960;

/** Add feed link support */
add_theme_support( 'automatic-feed-links' );

/** Post thumnail Support and add new sizes that themes is required */
add_theme_support('post-thumbnails');

//Example Code
//add_image_size( 'post-image1', 363, 201, true );

/**
  * Function to check whether a key is exists in array, Otherwise return default value
  * @param arr  array an array from which a key need to be checked
  * @param key  string A string need to be checked either exists in an array or not
  * @param default string/array If the key is not exists in given array then the default value will be returned
  * 
  * @return string/array Either array or string will be returned.
  */
  
//@TODO: we have to add the support of xpath
function kvalue( $obj, $val, $def = '' )
{
	if( is_array($obj) ) 
	{
		if( isset( $obj[$val] ) ) return $obj[$val];
	}
	elseif( is_object( $obj ) )
	{
		if( isset( $obj->$val ) ) return $obj->$val;	
	}
	
	if( $def ) return $def;
	else return false;
}

function texttoslug($string)
{
	return trim(preg_replace("#([^a-z0-9])#i","_",strtolower($string)));
}



/*========================Video or image featured=======================================*/
function am_video_or_image_featured($echo = false) {
    global $post;
    $embed_code = get_post_meta($post->ID , THEME_NAME . '_video_embed', true);
    $patern = '<div class="entry-cover">%s</div>';

    if($echo){

        if(!empty($embed_code)) {
            return sprintf($patern, $embed_code);
        }else {
            if( has_post_thumbnail() && ! post_password_required() ){
                return sprintf($patern, get_the_post_thumbnail());
            }
        }

    }else{

        if(!empty($embed_code)) {
            printf($patern, $embed_code);
        }else {
            if( has_post_thumbnail() && ! post_password_required() ){
                printf($patern, get_the_post_thumbnail());
            }
        }

    }
}

/* ========================================================================================================================

  Likes

  ======================================================================================================================== */
add_action('wp_ajax_cinergy_like_post', 'am_cinergy_like_post');
add_action('wp_ajax_nopriv_cinergy_like_post', 'am_cinergy_like_post');

function am_cinergy_like_post(){
  if(!empty($_POST['id'])){
    $post_id = $_POST['id'];
    $likes = get_post_meta($post_id, 'cinergy_likes', true);
    if( isset($_COOKIE['cinergy_likes_'. $post_id]) ) 
      die('already liked');
    if(!$likes)
      $likes = 0 ;
    $likes++;
    if(update_post_meta($post_id, 'cinergy_likes', $likes)){
      setcookie('cinergy_likes_'. $post_id, $post_id, time()*20, '/');
      die('liked');
    }
    else{
      die('error');
    }
  }
  die();
}

/* ========================================================================================================================

  Views

  ======================================================================================================================== */

function getPostViews($postID){
    $count_key = 'cinergy_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return 0;
    }
    return $count;
}
function setPostViews($postID) {
    $count_key = 'cinergy_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
// Remove issues with prefetching adding extra views
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

/* ========================CONTACT FORM FUNCTION ==================================*/

function am_send_message() {
  $contact_settings = get_option(THEME_PREFIX.'contact_page_settings');
  $receiver_mail = (isset($contact_settings['contact_to'])) ? $contact_settings['contact_to'] : die('Contact Form not configured');
  $form_subject = !empty($_POST ['subject']) ? $_POST ['subject'] : '';
  $subject = !empty($contact_settings['subject']) ? $contact_settings['subject'] . $form_subject : ' from [WebSite]';

  /* SECTION II - CODE */

  $result = null;
  $header = array('From: '.$_POST['author'].' < ' . $_POST['email'] . '>', 'Reply-To: '.$_POST['author'].' < ' . $_POST['email'] . '>');
  if (!empty($_POST['author']) && !empty($_POST ['comment']) && !empty($_POST['email']) && !empty($_POST['subject_title'])) {
	  $message = "NAME: " . $_POST['author']."\r\n";
	  $message.= "EMAIL: " . $_POST['email']."\r\n";
	  $message.= "TELEPHONE: " . $_POST['subject_title']."\r\n";
	  $message.= "INTEREST: " . $_POST['select_category']."\r\n\r\n";
      $message.= $_POST['comment'];
      $message = wordwrap($message, 70, "\r\n");
      $header []= 'From: ' . $_POST['author'] ;
      if (mail($receiver_mail, $subject, $message))
          $result = !empty($contact_settings['success_message'])? $contact_settings['success_message'] : __('Mesage Successfully Sent','cinergy');
      else
          $result = __('Message could not be sent.','cinergy');
  } else {
      $result = __('Please fill all the fields','cinergy');
  }
  die($result);
}

add_action('wp_ajax_send_message', 'am_send_message');
add_action('wp_ajax_nopriv_send_message', 'am_send_message');

/* ========================================================================================================================

  Ajax Load more portfolio

  ======================================================================================================================== */
add_action('wp_ajax_load_more_portfolio', 'am_load_more_portfolio');
add_action('wp_ajax_nopriv_load_more_portfolio', 'am_load_more_portfolio');

function am_load_more_portfolio(){
  $columns = $_POST['columns'];
  $span = !empty($columns) ? 12 / $columns : 3;
  $portfolio_category = $_POST['portfolio_category'] !== 'false' ? $_POST['portfolio_category'] : false;
  $masonry = $_POST['masonry'];
  $page = $_POST['page'];
  $args = array(
      //Type & Status Parameters
      'post_type'   => 'portfolio',
      'post_status' => 'publish',

      //Pagination Parameters
      'posts_per_page'         => get_option('posts_per_page'),
      'paged'                  => $page,
  );
  if($portfolio_category)
    $args['tax_query'] = array(
        array(
            'taxonomy' => 'portfolio',
            'field' => 'slug',
            'terms' => $portfolio_category
            )
        );
  $cinergy_query = new WP_Query( $args );
  $output = '';
  ob_start();
  if ($cinergy_query->have_posts()) : 
    if ($masonry === 'false') echo "<div class='row'>";
    while($cinergy_query->have_posts()) : $cinergy_query->the_post(); ?>
      <?php 
      $likes = get_post_meta( get_the_ID(), 'cinergy_likes', true) ? get_post_meta( get_the_ID(), 'cinergy_likes', true) : 0; 
      if($masonry !== 'false'){
          $categories = '';
          $terms = get_the_terms( get_the_ID(), 'portfolio' );
          foreach ($terms as $category)
              $categories .= " " . $category->slug;
      }
      ?>
      
      <article class="portfolio-article span<?php echo $span ; if( $masonry !=='false' ) echo $categories ?>">
        <div class="portfolio-content article-content">
            <?php if (has_post_thumbnail( )) : ?>
                <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()) ); ?>" class="portfolio-teaser-pic fancybox">
                    <?php the_post_thumbnail( $columns . 'cols_porto_thumb' ); ?>
                </a>
            <?php endif; ?>
            <div class="meta-info">
                <span class="meta-info-buttons likes-no"><a href="<?php the_permalink(); ?>" data-post="<?php the_ID() ?>"><?php echo $likes ?></a></span>
                <span class="meta-info-buttons comments-no"><a href="<?php the_permalink(); ?>"><?php comments_number( '0', '1', '%' ) ?></a></span>
                <span class="meta-info-buttons download-no"><a href="<?php the_permalink(); ?>"><?php echo getPostViews(get_the_ID()) ?></a></span>
            </div>
            <div class="portfolio-content-wrap">
                <h1 class="portfolio-heading equal-padding-text article-heading">
                    <a href="<?php the_permalink(); ?>"><?php the_title()?></a>
                </h1>
                <?php $excerpt = get_the_excerpt();
                  if(!empty($excerpt)){
                      the_excerpt();
                  }else{
                      the_content('');
                  }
                  ?>
            </div>
        </div>
      </article>
    <?php endwhile;
  endif;
  $output = ob_get_contents();
  ob_end_clean();
  die($output);
}