<?php
/*
Template Name: Sector + case studies
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













<?php
	$masonry = get_post_meta( $post->ID , 'cinergy_masonry' ,true);
	$portfolio_category = get_post_meta( $post->ID , 'cinergy_category' ,true);
	$columns = get_post_meta( $post->ID , 'cinergy_columns' ,true);
?>
<div class="container">
    <div class="row">
        <main role="main" class="portfolio-wrapper three-cols-portfolio span12">
            <div class="row">
                <?php
                $args = array(
                            //Type & Status Parameters
                            'post_type'   => 'portfolio',
                            'post_status' => 'publish',
                                                
                            //Pagination Parameters
                            'posts_per_page'         => get_option('posts_per_page')
                        );
                    if($portfolio_category)
                        $args['tax_query'] = array(
                            array(
                                'taxonomy' => 'portfolio',
                                'field' => 'slug',
                                'terms' => $portfolio_category
                                )
                            );

                global $cinergy_query;
                $cinergy_query = new WP_Query( $args );
                
                if ($cinergy_query->have_posts()) : 
                    while($cinergy_query->have_posts()) : $cinergy_query->the_post(); ?>
                        <?php 
                        $likes = get_post_meta( get_the_ID(), 'cinergy_likes', true) ? get_post_meta( get_the_ID(), 'cinergy_likes', true) : 0; 
                        if($masonry){
                            $categories = '';
                            $terms = get_the_terms( get_the_ID(), 'portfolio' );
                            foreach ($terms as $category)
                                $categories .= " " . $category->slug;
                        }
                        ?>
                        <?php if (!$masonry && $cinergy_query->current_post != 0 && $cinergy_query->current_post % $columns == 0) : ?>
                            </div>
                            <div class="row">
                        <?php endif; ?>
                        <article class="portfolio-article span4">
                            <div class="portfolio-content article-content">
                                <?php if (has_post_thumbnail( )) : ?>
                                    <a href="<?php the_permalink(); ?>" class="">
                                        <?php if($masonry)
                                                the_post_thumbnail( ); 
                                            else 
                                                the_post_thumbnail( $columns . 'cols_porto_thumb' ); ?>
                                    </a>
                                <?php endif; ?>
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
                    <?php endwhile; ?>
                    <?php if ($masonry) : ?>
                            </div>
                        <?php endif; ?>
                <?php endif; ?>
            </div>
        </main>
        <?php if($cinergy_query->found_posts > get_option('posts_per_page')) : ?>
            <a class="load-more-items" href="#">
                <img src="<?php echo get_template_directory_uri(); ?>/img/portfolio/isotope/loadmore.png">
            </a>
        <?php endif; ?>
    </div>
</div>









<?php get_footer(); ?>