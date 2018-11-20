<?php
get_header(); 
$columns = get_post_meta( $post->ID , 'cinergy_columns' ,true);
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
        <main role="main" class="portfolio-wrapper single-portfolio span12">
            <?php if (have_posts()) : 
                while(have_posts()) : the_post(); ?>
                    <?php 
                    $likes = get_post_meta( get_the_ID(), 'cinergy_likes', true) ? get_post_meta( get_the_ID(), 'cinergy_likes', true) : 0;
                    $link = get_post_meta( get_the_ID() , 'cinergy_project_link' ,true);
                    $awards = get_post_meta( get_the_ID() , 'cinergy_project_awards' ,true);
                    ?>
                    <span class="article-heading">
                        <?php the_title( ); ?>
                    </span>
                    <div class="portfolio-project-slider-wrapper">
                        <div class="portfolio-project-slider">
                            <div class="slider">
                                <?php $slides = get_post_meta( get_the_ID() , 'cinergy_project_slider_' ,true); ?>
                                <?php if (!empty($slides)) : ?>
                                    <ul class="slides unstyled">
                                        <?php foreach ( $slides as $slide ) : ?>
                                            <li class="slide">
                                                <figure>
                                                        <img src="<?php echo $slide['cinergy_slide_image']['url'] ?>">
                                                    <?php if(!empty($slide['cinergy_slide_caption'])) : ?>
                                                        <figcaption><?php echo $slide['cinergy_slide_caption'] ?></figcaption>
                                                    <?php endif; ?>
                                                </figure>
                                            </li>
                                        <?php endforeach; ?>    
                                    </ul>
                                <?php endif; ?>
                                <span id="slider-buttons"></span>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <article class="portfolio-article span9">
                            <div class="portfolio-content article-content">
                                
                                <div class="article-content portfolio-single-content">
                                    <?php the_content( ); ?>
                                </div>
                            </div>
                        </article>
                        <aside class="project-single-sidebar hidden-phone hidden-tablet">
                            <aside class="project-single-sidebar-container">
                                <h1 class="project-single-sidebar-heading">
                                    <?php _ex('Project Details','single-project','cinergy') ?>
                                </h1>
                                <div class="project-single-sidebar-content">
                                    <ul class="project-single-description-wrap">
										
										<?php
											$date = $cfs->get('date');
											if(!is_null($date)){
												$date_r = date('F Y', strtotime($date));
												printf( "<li class=\"project-single-description-item project-date\">%s</li>", $date_r);
											}
										?>
									
										
										<?php
											$details = $cfs->get('project_details');
											if(!empty($details)){
												foreach($details as $detail){
													printf("<li class=\"project-single-description-item\">%s</li>", $detail["project_detail"]);
												}
											}
										?>
                                        
                                        <?php if($awards) : ?>
                                            <li class="project-single-description-item project-awards"><?php echo $awards ?></li>
                                        <?php endif; ?>
                                        <?php if($link) : ?>
                                            <li class="project-single-description-item project-link"><a href="<?php echo $link ?>"><?php echo $link ?></a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </aside>
                        </aside>
                    </div>  
                    <?php setPostViews(get_the_ID()) ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </main>
    </div>
</div>
            

<?php get_footer(); ?>