<?php get_header(); 
$provided_icon = get_post_meta( $post->ID , 'dash_menu_icon_provided' ,true);
$custom_icon = get_post_meta( $post->ID , 'dash_menu_icon_custom' ,true);?>

<div id="blog-tab" class="tab-wrapper open">
    <!-- VISIBLE TAB HEADER -->
    <section class="tab">
        <div class="tab-header tab-keppel tab-red alighleft">
            <div class="tab-icon alighleft"<?php echo !empty($page_widget_options['title_bg'])? ' style="background-color:'.$page_widget_options['title_bg'].'"': '' ?>>
                <?php if (!empty($custom_icon['url']))
                        echo '<img class="icon" src="'.$custom_icon['url'].'" alt="menu-icon">';
                    elseif(!empty($provided_icon))
                        echo '<i class="icon '.$provided_icon.' sprite"></i>';?>
            </div>
            <div class="tab-text alighleft"<?php echo !empty($page_widget_options['title_bg'])? ' style="border-color:'.$page_widget_options['title_bg'].'"': '' ?>>                                    
                <h4 class="title"><a href="<?php echo site_url()?>"><?php $page_title = wp_title('',false) ; echo !empty($page_title)?$page_title: bloginfo('name') ?></a></h4>
            </div>
            <div class="arrow alighleft"<?php echo !empty($page_widget_options['title_bg'])? ' style="border-left-color:'.$page_widget_options['title_bg'].'"': '' ?>></div>
        </div>
        <i class="tab-collapse tab-trigger sprite alignright"></i>
    </section>

    <!-- TAB DROPDOWN INNER CONTENT -->
    <div class="tab-content">
        <div class="content-wrapper twelve columns offset-by-one alpha">
            <section class="content-inner clearfix">
                <!-- HISTORY BOX -->
                <div class="eight columns alpha">
                    <div class="resume-history">
                        <ul class="history-list clearfix add-bottom">
                            <?php if (have_posts()) : 
                                while(have_posts()) : the_post(); ?>
                                    <li class="item seven columns offset-by-one alpha">
                                        <i class="indicator"></i>
                                        <a href="<?php the_permalink() ?>" class="blog_image">
                                            <?php if(has_post_thumbnail()) the_post_thumbnail(array(400,170)) ?>
                                            <div class="blog_meta">
                                                <span class="alighleft"><?php the_time('dS, F') ?></span>
                                                <div class="arrow alighleft">
                                                </div>
                                            </div>
                                        </a>
                                        <h5 class="half-bottom"><?php the_title() ?></h5>
                                        <?php the_content();?>
                                        <a class="button green alignright" href="<?php the_permalink() ?>">
                                            <?php _e('Read More','dash') ?>
                                        </a>
                                    </li>
                                <?php endwhile; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="blog_pagination">
                        <?php posts_nav_link(' ','Newer  Posts','Older Posts'); ?>
                    </div>
                </div>
                <?php get_sidebar() ?>
            </section>
        </div>
    </div>
    <!-- /TAB DROPDOWN INNER CONTENT  -->

    <i class="tab-collapse tab-trigger icon-close sprite"></i>
    <div class="arrow-down"></div>
</div>

<?php get_footer(); ?>