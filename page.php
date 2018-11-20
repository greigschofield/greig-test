<?php get_header();
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
            <?php if (have_posts()) : 
                while(have_posts()) : the_post(); ?>
                    <?php if ( has_post_thumbnail() )  : ?>
                        <a href="<?php the_permalink() ?>" class="">
                            <?php the_post_thumbnail(); ?>
                        </a>
                    <?php endif;?>
                    <?php the_content( ); ?>

                <?php endwhile; ?>
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