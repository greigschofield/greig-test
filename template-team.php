<?php
/*
Template Name: Team
*/
get_header(); 
$columns = get_post_meta( $post->ID , 'cinergy_columns' ,true);
$span = !empty($columns) ? 12 / $columns : 3;
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
        <main role="main" class="team-container span12">
            <div class="row">
                <?php
                if (have_posts()) : 
                    while(have_posts()) : the_post(); ?>

                        <?php the_content( ); ?>

                    <?php endwhile; ?>
                <?php endif;
                $args = array(
                        //Type & Status Parameters
                        'post_type'   => 'team',
                        'post_status' => 'publish',
                                            
                        //Pagination Parameters
                        'posts_per_page'         => -1,
                        //'paged'                  => get_query_var('paged'),
                    );
                global $cinergy_query;
                $cinergy_query = new WP_Query( $args );
                
                if ($cinergy_query->have_posts()) : 
                    while($cinergy_query->have_posts()) : $cinergy_query->the_post(); 
                        $position = get_post_meta( get_the_ID() , 'cinergy_position' ,true);
                        $facebook = get_post_meta( get_the_ID() , 'cinergy_faceobook' ,true);
                        $linkedin = get_post_meta( get_the_ID() , 'cinergy_linkedin' ,true);
                        $twitter = get_post_meta( get_the_ID() , 'cinergy_twitter' ,true);
                        $email = get_post_meta( get_the_ID() , 'cinergy_email' ,true);
                        $flickr = get_post_meta( get_the_ID() , 'cinergy_flickr' ,true);
                        $skype = get_post_meta( get_the_ID() , 'cinergy_skype' ,true);
                        $dribble = get_post_meta( get_the_ID() , 'cinergy_dribble' ,true);
                        $instagram = get_post_meta( get_the_ID() , 'cinergy_instagram' ,true);
                        ?>
                        <?php if ($cinergy_query->current_post != 0 && $cinergy_query->current_post % $columns == 0) : ?>
                            </div>
                            <div class="row">
                        <?php endif; ?>
                        <article class="team-item-wrap span<?php echo $span ?>">

                            <div class="team-item">
                                <?php if (has_post_thumbnail( )) : ?>
                                    <span class="team-teaser-img">
                                        <?php the_post_thumbnail(  ); ?>
                                    </span>
                                <?php endif; ?>
                                <div class="team-content article-content">
                                     <header class="team-header-container article-header-container">
                                          <h1 class="team-heading article-heading">
                                               <?php the_title( ); ?>
                                          </h1>
                                          <h2 class="team-heading-description">
                                               <?php echo $position ?>
                                          </h2>
                                          <div class="team-single-content-container">
                                               <div class="team-single-content">
                                                    <!-- this will fix the scale issue -->
                                                    <div class="span<?php echo $span ?>">
                                                        <?php the_content( ); ?>
                                                        <div class="team-single-meta-icons">
                                                            <?php if($facebook) : ?>
                                                                <a class="facebook" href="<?php echo $facebook ?>"><img alt="facebook" src="<?php echo THEME_URL ?>/img/team/icons/facebook.png"/></a>
                                                            <?php endif; ?>
                                                            <?php if($linkedin) : ?>
                                                              <a class="linkedin" href="<?php echo $linkedin ?>"><img alt="linkedin" src="<?php echo THEME_URL ?>/img/team/icons/lin.png"/></a>
                                                            <?php endif; ?>
                                                            <?php if($twitter) : ?>
                                                              <a class="twitter" href="<?php echo $twitter ?>"><img alt="twitter" src="<?php echo THEME_URL ?>/img/team/icons/twitter.png"/></a>
                                                            <?php endif; ?>
                                                            <?php if($email) : ?>
                                                              <a class="email" href="<?php echo $email ?>"><img alt="email" src="<?php echo THEME_URL ?>/img/team/icons/email.png"/></a>
                                                            <?php endif; ?>
                                                            <?php if($flickr) : ?>
                                                              <a class="flickr" href="<?php echo $flickr ?>"><img alt="flickr" src="<?php echo THEME_URL ?>/img/team/icons/flickr.png"/></a>
                                                            <?php endif; ?>
                                                            <?php if($skype) : ?>
                                                              <a class="skype" href="<?php echo $skype ?>"><img alt="skype" src="<?php echo THEME_URL ?>/img/team/icons/skype.png"/></a>
                                                            <?php endif; ?>
                                                            <?php if($dribble) : ?>
                                                              <a class="dribble" href="<?php echo $dribble ?>"><img alt="dribble" src="<?php echo THEME_URL ?>/img/team/icons/dribble.png"/></a>
                                                            <?php endif; ?>
                                                            <?php if($instagram) : ?>
                                                              <a class="instagram" href="<?php echo $instagram ?>"><img alt="instagram" src="<?php echo THEME_URL ?>/img/team/icons/instagram.png"/></a>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                               </div>
                                          </div>
                                     </header>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                    <?php get_template_part('nav','main')?>
                <?php endif; ?>
            </div>
        </main>
    </div>
</div>
            

<?php get_footer(); ?>