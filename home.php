<?php get_header(); ?>

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
        <main role="main" class="2cols-blog-content span9">
            <?php if (have_posts()) : 
                while(have_posts()) : the_post(); ?>

                    <?php get_template_part('content','blog') ?>
                    

                <?php endwhile; ?>
                <?php get_template_part('nav','main')?>
            <?php endif; ?>
        </main>
        <aside role="complementary" class="2cols-blog-sidebar hidden-tablet hidden-phone span3">
            <?php get_sidebar() ?>
        </aside>
    </div>
</div>
            

<?php get_footer(); ?>