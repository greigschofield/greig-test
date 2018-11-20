<?php
/*
Template Name: Sector
*/
get_header(); 
$columns = get_post_meta( $post->ID , 'cinergy_columns' ,true);

switch ($columns) {
    case '2':
        $classes = 'two-cols-portfolio';
        break;
    case '3':
        $classes = 'three-cols-portfolio';
        break;
    default:
        $classes = 'four-cols-portfolio';
        break;
}
$span = !empty($columns) ? 12 / $columns : 3;

$masonry = get_post_meta( $post->ID , 'cinergy_masonry' ,true);
$sector_category = get_post_meta( $post->ID , 'cinergy_category' ,true);
if($masonry)
    $classes .= ' isotope-portfolio';
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
        <main role="main" class="portfolio-wrapper <?php echo $classes ?> span12">
			<?php
				if (have_posts()) : 
                    while(have_posts()) : the_post(); ?>
						<div style="margin-bottom: 2em;">
							<?php if ( has_post_thumbnail() )  : ?>
								<?php the_post_thumbnail(); ?>
							<?php endif;?>
						</div>
                        <?php the_content( ); ?>

                    <?php endwhile; ?>
                <?php endif;
			?>
			
			<?php
				$sector_terms = get_the_terms($post->ID, 'portfolio');
				if(!empty($sector_terms)){
					?>
			<section class="related-items" style="display: none;">
				<h2>Related items section</h2>
				<p>This section will display if the page is tagged with a sector <strong>AND</strong> if there are any testimonials, case studies or blog posts tagged with the <strong>same</strong> sector</p>
			</section>
					<?php
				}
			?>
			
            <div class="row">
                <?php
                
				
                $args = array(
                            //Type & Status Parameters
                            'post_type'   => 'page',
                            'post_status' => 'publish',
                                                
                            //Pagination Parameters
                            'posts_per_page'         => get_option('posts_per_page'),
							'post_parent' => $post->ID
                        );
                if ($masonry) : 
                    $posts = get_posts($args);
                    foreach ($posts as $p){
                        $post_terms = wp_get_post_terms( $p->ID, 'portfolio' ) ;
                        foreach($post_terms as $post_term){
                            $terms[$post_term->slug] = $post_term->name; 
                        }
                    }?>
                    <ul id="isotope-filters" class="pagination-centered unstyled">
                        <li><a href="#" data-filter="*"><?php _e('show all','cinergy') ?></a></li>
                        <?php foreach($terms as $slug => $category) : ?>
                            <?php if(!empty($sector_category) && $sector_category == $slug) continue; ?>
                            <li><a href="#" data-filter=".<?php echo $slug ?>"><?php echo $category ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <div id="container">
                <?php endif;
                
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
                        <article class="portfolio-article span<?php echo $span ; if( $masonry ) echo $categories ?>">
                            <div class="portfolio-content article-content">
                                <?php if (has_post_thumbnail( )) : ?>
                                    <a href="<?php the_permalink(); ?>">
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
<script type="text/javascript">
    var page = 1;
    var masonry = <?php echo $masonry ? 'true' : 'false' ?>;
    var columns = <?php echo $columns ?>;
    var max_num_pages = <?php echo $cinergy_query->max_num_pages ?>;
    var portfolio_category = <?php echo !empty($sector_category) ? "'$sector_category'" : 'false' ?>;
    console.log(portfolio_category)
</script>
<?php get_footer(); ?>