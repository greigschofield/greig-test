<?php
/*
Template Name: Blog
*/
get_header(); 
$layout = get_post_meta( $post->ID , 'cinergy_layout' ,true);
$classes = !empty($layout) && $layout === 'full' ? 'full-width-blog-content span12' : '2cols-blog-content span9';
?>

<div class="full-width-container single-page-header-container">
    <header class="container">
        <h1 class="single-page-heading">
            <?php echo wp_title('',false) !== '' ? wp_title('',false) : get_bloginfo( 'name' ); ?>
        </h1>
        <div class="single-page-breadcrumbs">
            <?php if(function_exists('bcn_display'))
                {
                    bcn_display();
                }?>
        </div>
    </header>
</div>
<div class="container">
    <div class="row">
        <main role="main" class="<?php echo $classes ?>">
            <?php 
            $args = array(
                    //Type & Status Parameters
                    'post_type'   => 'post',
                    'post_status' => 'publish',
                                        
                    //Pagination Parameters
                    'posts_per_page'         => get_option('posts_per_page'),
                    'paged'                  => get_query_var('paged'),
                );
            global $cinergy_query;
            $cinergy_query = new WP_Query( $args );
            
            if ($cinergy_query->have_posts()) : 
                while($cinergy_query->have_posts()) : $cinergy_query->the_post(); ?>

                    <?php get_template_part('content','blog') ?>
                    

                <?php endwhile; ?>
                <?php get_template_part('nav','main')?>
            <?php endif; ?>
        </main>
        <?php if(empty($layout) || $layout !== 'full') : ?>
            <aside role="complementary" class="2cols-blog-sidebar hidden-tablet hidden-phone span3">
                <?php get_sidebar() ?>
            </aside>
        <?php endif; ?>
    </div>
</div>
            

<?php get_footer(); ?>