<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
    <?php $seo_meta_settings = get_option(THEME_PREFIX.'seo_meta_settings'); ?>
    <?php if (!empty($seo_meta_settings['meta_description'])) : ?>
        <meta name="description" content="<?php echo $seo_meta_settings['meta_description'] ?>">
    <?php endif; ?>
    <?php if (!empty($seo_meta_settings['meta_keywords'])) : ?>
        <meta name="keywords" content="<?php echo $seo_meta_settings['meta_keywords'] ?>">
    <?php endif; ?>
    <title><?php fw_get_meta_title();?></title>
    <!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
     <!-- Pingbacks -->
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" >
    <script type="text/javascript">var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';</script>
	<?php wp_head(); ?>
</head>
<body <?php body_class()?>>
	<!-- logo + menu -->
        <div class="fullwidth-container menu_handler_wrap">
            <div class="container">
                <header role="banner">
                    <!-- main logo wrap -->
                    <h1 class="logo-wrap">
                        <a href="<?php echo site_url() ?>">
                            <?php 
                            $general_settings = get_option(THEME_PREFIX.'general_settings');
                            if(!empty($general_settings['custom_logo'])) : ?>
                                <img <?php if(!empty($general_settings['logo_dim'])) echo 'style="width:'.$general_settings['logo_dim'].'px;height:'.$general_settings['logo_dim_1'].'px;"'?>
                                    src="<?php echo $general_settings['custom_logo'] ?>" alt="logo">
                            <?php endif; ?>
                        </a>
                    </h1>
                    <!-- THE END - main logo wrap -->

                    <!-- main nav wrap -->
                    <button type="button" class="btn btn-navbar hidden-desktop" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar menu-toggle fa fa-bars"></span>
                    </button>
                    <nav class="main-nav nav-collapse collapse" >
                        

                        <ul class="nav" >
                            <?php wp_nav_menu( array( 
                                'title_li'=>'',
                                'theme_location' => 'main_menu',
                                'container' => false,
                                'items_wrap' => '%3$s',
                                'fallback_cb' => 'wp_list_pages'
                            ) );?>
                        </ul>
                    </nav>
                    <!-- THE END - main nav wrap -->
                </header>
            </div>
        </div>
        <!--THE END - logo + menu-->
        <!--THE END - header.html-->